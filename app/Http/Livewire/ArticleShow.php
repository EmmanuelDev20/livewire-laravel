<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;

class ArticleShow extends Component
{
    //Definiendo el tipado, no ocupamos el mount
    public Article $article;

    // public function mount(Article $article) {
    //     $this->article = $article;
    // }
    // De esta forma, lo que estamos recibiendo es el id como tal
    // public function mount($article) {
    //     $this->article = Article::findOrFail($article);
    // }
    // De esta forma, no seria necesario pasarlo.
    // public $article;


    // public function mount() {
    //     $this->article = Article::find(request()->route('article'));
    // }

    public function render()
    {
        return view('livewire.article-show');
        // return view('livewire.article-show', [
        //     'article' => Article::find(request()->route('article'))
        // ]);
    }
}
