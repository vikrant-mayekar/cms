<?php

namespace App\Jobs;

use App\Models\Article;
use App\Services\AiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateArticleDetails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Article $article)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(AiService $aiService): void
    {
        $slug = $aiService->generateSlug($this->article->title);
        $summary = $aiService->generateSummary($this->article->content);

        $this->article->update([
            'slug' => $slug,
            'summary' => $summary,
        ]);
    }
}
