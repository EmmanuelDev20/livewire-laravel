<?php

namespace App\Http\Livewire;

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

    public function render()
    {
        return view('livewire.articles', [
            // 'articles' => \App\Models\Article::all()
            'articles' => \App\Models\Article::where('title', 'LIKE', '%'.$this->search.'%')->get()
        ]);
    }
}


// Route::get('/search', function () {
//     return view('partials.users', [
//         'users' => User::where('name', 'LIKE', '%'.request('q').'%')->get()
//     ]);
// });
