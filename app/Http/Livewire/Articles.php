<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;

class Articles extends Component
{
    // public $articles;
    // public $h1 = 'Listado desde h1';

    // Mount funciona como un constructor
    // public function mount()
    // {
    //     $this->articles = \App\Models\Article::all();
    // }

    // public array $category = [
    //     'name' => ''
    // ];

    // public $tags = '';

    // public $category = '';

    public $search = '';

    public $article;

    public function render()
    {
        $this->articles = Article::where('title', 'LIKE', '%'.$this->search.'%')->get();
        return view('livewire.articles', [
            'articles' => $this->articles
        ]);
    }
}
