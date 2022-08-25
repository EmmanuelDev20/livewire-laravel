<?php

namespace Tests\Feature\Livewire;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ArticleFormTest extends TestCase
{
    use RefreshDatabase;
    // Laravel Dusk o Cypress para testear componentes blade livewire
    // Missing Livewire Assertions. Para no tener que modificar por ejemplo .lazy. Verifica que se reciba el parámetro y punto.


    /** @test */
    function article_form_renders_properly()
    {
        $this->get(route('articles.create'))->assertSeeLivewire('article-form');

        $article = Article::factory()->create();
        $this->get(route('articles.edit', $article))->assertSeeLivewire('article-form');
    }

    /** @test */
    function blade_template_is_wired_properly()
    {
        Livewire::test('article-form')
            ->assertSeeHtml('wire:submit.prevent="save"')
            ->assertSeeHtml('wire:model="article.title"')
            ->assertSeeHtml('wire:model="article.content"')
        ;
    }

    /** @test */
    function can_create_new_article()
    {
        Livewire::test('article-form')
            ->set('article.title', 'New article')
            ->set('article.content', 'Contenido del articulo')
            ->call('save')
            ->assertSessionHas('status')
            ->assertRedirect(route('articles.index'))
        ;

        $this->assertDatabaseHas('articles', [
            'title' => 'New article',
            'content' => 'Contenido del articulo'
        ]);
        // Livewire::test('Article::class');
    }

    /** @test */
    function can_update_articles()
    {
        $article = Article::factory()->create();

        Livewire::test('article-form', ['article' => $article])
            ->assertSet('article.title', $article->title)
            ->assertSet('article.content', $article->content)
            ->set('article.title', 'Updated title')
            ->call('save')
            ->assertSessionHas('status')
            ->assertRedirect(route('articles.index'))
        ;

        $this->assertDatabaseCount('articles', 1);

        $this->assertDatabaseHas('articles', [
            'title' => 'Updated title'
        ]);
    }

    /** @test */
    function title_is_required()
    {
        Livewire::test('article-form')
            ->set('article.content', 'Article content')
            ->call('save')
            ->assertHasErrors(['article.title' => 'required'])
            // ->assertSeeHtml('validation.required', ['attribute' => 'title'])
        ;
            // ->assertHasErrors('article.title')
    }

    /** @test */
    function title_must_have_4_characters_min()
    {
        Livewire::test('article-form')
            ->set('article.title', 'as')
            ->set('article.content', 'Article content')
            ->call('save')
            ->assertHasErrors(['article.title' => 'min'])
            // ->assertSeeHtml(__('validation.min.string', [
            //     'attribute' => 'title',
            //     'min' => 4
            //     ]))
        ;
            // ->assertHasErrors('article.title')
    }

    /** @test */
    function content_is_required()
    {
        Livewire::test('article-form')
            ->set('article.title', 'Title of content')
            ->call('save')
            ->assertHasErrors(['article.content' => 'required'])
            // ->assertSeeHtml(__('validation.min.string', ['attribute' => 'content']))
        ;
            // ->assertHasErrors('article.title')
    }

    /** @test */
    function real_time_validation_works_for_title()
    {
        Livewire::test('article-form')
            ->set('article.title', '')
            ->assertHasErrors(['article.title' => 'required'])
            ->set('article.title', 'New Article')
            ->assertHasNoErrors(['article.title' => 'min'])
            ->set('article.title', 'New Title')
            ->assertHasNoErrors('article.title')
        ;
    }

    /** @test */
    function real_time_validation_works_for_content()
    {
        Livewire::test('article-form')
            ->set('article.content', '')
            ->assertHasErrors(['article.content' => 'required'])
            ->set('article.content', 'New Article')
            ->assertHasNoErrors('article.content')
        ;
    }

}
