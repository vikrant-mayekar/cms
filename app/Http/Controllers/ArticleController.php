<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\GenerateArticleDetails;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Article::with(['user', 'categories'])->latest();

        // Filter by category
        if ($request->has('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('published_date', [$request->start_date, $request->end_date]);
        }

        $articles = $query->get();
        return response()->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Article::class);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'sometimes|in:draft,published,archived',
            'category_ids' => 'sometimes|array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status ?? 'draft',
            'user_id' => Auth::id(),
            'published_date' => $request->status === 'published' ? now() : null,
        ]);

        if ($request->has('category_ids')) {
            $article->categories()->sync($request->category_ids);
        }

        GenerateArticleDetails::dispatch($article);

        return response()->json($article->load(['user', 'categories']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return response()->json($article->load(['user', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'status' => 'sometimes|in:draft,published,archived',
            'category_ids' => 'sometimes|array',
            'category_ids.*' => 'exists:categories,id',
        ]);
        
        $article->update($request->only('title', 'content', 'status'));

        if ($request->status === 'published' && !$article->published_date) {
            $article->update(['published_date' => now()]);
        }

        if ($request->has('category_ids')) {
            $article->categories()->sync($request->category_ids);
        }
        
        return response()->json($article->load(['user', 'categories']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        $article->delete();
        return response()->json(null, 204);
    }
}
