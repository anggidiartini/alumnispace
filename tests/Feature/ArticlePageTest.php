<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ArticlePageTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (!Schema::hasTable('articles')) {
            Schema::create('articles', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('author_id')->nullable();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('category', 100)->default('Sekolah');
                $table->string('thumbnail')->nullable();
                $table->text('excerpt')->nullable();
                $table->longText('content');
                $table->timestamp('published_at')->nullable();
                $table->boolean('is_published')->default(true);
                $table->timestamps();
            });
        }

        if (Article::count() === 0) {
            Article::create([
                'title' => 'Sample Article Testing',
                'slug' => 'sample-article-testing',
                'category' => 'Sekolah',
                'content' => 'Sample content for testing',
                'excerpt' => 'Sample excerpt',
                'is_published' => true,
            ]);
        }
    }

    public function test_articles_index_page_loads_successfully(): void
    {
        $response = $this->get('/artikel');

        $response->assertStatus(200);
        $response->assertViewIs('user.artikel.index');
        $response->assertViewHas('categories');
        $response->assertViewHas('articles');
    }

    public function test_article_detail_page_loads_successfully_with_slug(): void
    {
        $article = Article::first();

        $response = $this->get('/artikel/' . $article->slug);
        $response->assertStatus(200);
        $response->assertViewIs('user.artikel.detail');
        $response->assertSee('Sample Article Testing');
    }
}
