<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;

class CategoryApiTest extends TestCase
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

    public function test_admin_can_get_all_categories()
    {
        $response = $this->actingAs($this->admin, 'api')->getJson('/api/categories');
        $response->assertStatus(200);
    }

    public function test_author_cannot_get_all_categories()
    {
        $response = $this->actingAs($this->author, 'api')->getJson('/api/categories');
        $response->assertStatus(403);
    }
    
    public function test_admin_can_create_category()
    {
        $categoryData = ['name' => 'New Category'];
        $response = $this->actingAs($this->admin, 'api')->postJson('/api/categories', $categoryData);
        $response->assertStatus(201)->assertJsonFragment($categoryData);
    }
    
    public function test_author_cannot_create_category()
    {
        $categoryData = ['name' => 'Author Category'];
        $response = $this->actingAs($this->author, 'api')->postJson('/api/categories', $categoryData);
        $response->assertStatus(403);
    }
    
    public function test_admin_can_update_category()
    {
        $category = Category::first();
        $updateData = ['name' => 'Updated Category Name'];
        $response = $this->actingAs($this->admin, 'api')->putJson("/api/categories/{$category->id}", $updateData);
        $response->assertStatus(200)->assertJsonFragment($updateData);
    }

    public function test_admin_can_delete_category()
    {
        $category = Category::first();
        $response = $this->actingAs($this->admin, 'api')->deleteJson("/api/categories/{$category->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
} 