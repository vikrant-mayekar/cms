<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;

class ArticleApiTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $author;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
        $this->admin = User::where('email', 'admin@example.com')->first();
        $this->author = User::where('email', 'author@example.com')->first();
    }

    public function test_can_get_all_articles()
    {
        Article::factory()->count(3)->create(['user_id' => $this->author->id]);
        $response = $this->actingAs($this->admin, 'api')->getJson('/api/articles');
        $response->assertStatus(200)->assertJsonCount(3);
    }

    public function test_can_create_article()
    {
        $category = Category::first();
        $articleData = [
            'title' => 'New Test Article',
            'content' => 'This is the content of the new test article.',
            'category_ids' => [$category->id]
        ];

        $response = $this->actingAs($this->author, 'api')->postJson('/api/articles', $articleData);
        
        $response->assertStatus(201)
            ->assertJsonFragment(['title' => 'New Test Article']);
        
        $this->assertDatabaseHas('articles', ['title' => 'New Test Article']);
    }

    public function test_can_update_own_article()
    {
        $article = Article::factory()->create(['user_id' => $this->author->id]);
        $updateData = ['title' => 'Updated Title'];

        $response = $this->actingAs($this->author, 'api')->putJson("/api/articles/{$article->id}", $updateData);

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => 'Updated Title']);
    }

    public function test_admin_can_update_any_article()
    {
        $article = Article::factory()->create(['user_id' => $this->author->id]);
        $updateData = ['title' => 'Admin Updated Title'];

        $response = $this->actingAs($this->admin, 'api')->putJson("/api/articles/{$article->id}", $updateData);

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => 'Admin Updated Title']);
    }

    public function test_author_cannot_update_others_article()
    {
        $otherAuthor = User::factory()->create();
        $article = Article::factory()->create(['user_id' => $otherAuthor->id]);
        $updateData = ['title' => 'Failed Update'];

        $response = $this->actingAs($this->author, 'api')->putJson("/api/articles/{$article->id}", $updateData);

        $response->assertStatus(403);
    }

    public function test_can_delete_article()
    {
        $article = Article::factory()->create(['user_id' => $this->author->id]);

        $response = $this->actingAs($this->author, 'api')->deleteJson("/api/articles/{$article->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }
} 