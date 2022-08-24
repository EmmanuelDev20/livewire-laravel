<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;

class ArticleForm extends Component
{
    // En lugar de definir cada campo como propiedad:
    // public $title;
    // public $content;
    // public $slug;
    // public $publishedAt;

    // Se puede definir el modelo directamente
    public Article $article;

    protected $rules = [
        'article.title' => ['required', 'min:4'], // la modificacion es porque ahora accedemos por medio del $article
        'article.content' => 'required'
    ];
    // protected $rules = [
    //     'title' => ['required', 'min:4'],
    //     'content' => 'required'
    // ];

    protected $messages = [
        'article.title.required'  => 'El :attribute es requerido'
    ];

    protected $validationAttributes = [
        'article.title' => 'Titulo'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName); // Esto nos permite validar en tiempo real el wire:model que se esta modificando
    }

    // Opcion 1
    // public function mount() {
    //     $this->article = new Article;
    // }
    //Opcion 2
    public function mount(Article $article) {
        $this->article = $article;
    }

    public function save()
    {
        //Opcion 1
        // Article::create($this->validate());

        // Opcion con $article como modelo
        $this->validate();
        $this->article->save();

        // $data = $this->validate(); // Si lo pasamos sin parametros, usa automaticamente $rules
        // $data = $this->validate([
        //     'title' => 'required',
        //     'content' => 'required'
        // ]);

        // Article::create($data);

        // $this->validate([
        //     'title' => 'required',
        //     'content' => 'required'
        // ]);
        // // Primera forma de guardar
        // $article = new Article;
        // $article->title = $this->title;
        // $article->content = $this->content;
        // $article->save();

        // $this->title = "";
        // $this->content = "";

        session()->flash('status', 'Articulo guardado');

        // $this->reset(); //convierte todos los valores del componente a su valor inicial
        $this->redirectRoute('articles.index');
        // !Primera forma de guardar
    }
    public function render()
    {
        return view('livewire.article-form');
    }
}
