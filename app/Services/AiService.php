<?php

namespace App\Services;

use Illuminate\Support\Str;

class AiService
{
    /**
     * Generates a unique, SEO-friendly slug from a title.
     * In a real application, an LLM could enhance this.
     *
     * @param string $title
     * @return string
     */
    public function generateSlug(string $title): string
    {
        return Str::slug($title) . '-' . uniqid();
    }

    /**
     * Generates a concise summary from content.
     * This is a simulation of an LLM call.
     *
     * @param string $content
     * @return string
     */
    public function generateSummary(string $content): string
    {
        return 'This is an AI-generated summary of the content: ' . Str::limit($content, 150);
    }
} 