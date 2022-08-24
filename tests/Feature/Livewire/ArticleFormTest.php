<?php

namespace Tests\Feature\Livewire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ArticleFormTest extends TestCase
{
    use RefreshDatabase;
    /**test */
    function can_create_new_article()
    {
        Livewire::test('article-form')
            ->set('article.title', 'New article')
            ->set('article.content', 'Contenido del articulo')
            ->call('save')
            ->assertSessionHas('status')
            ->assertRedirect(route('article.index'))
        ;

        $this->assertDatabaseHas('articles', [
            'title' => 'New article',
            'content' => 'Contenido del articulo'
        ]);
        // Livewire::test('Article::class');

    }

}
