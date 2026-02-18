<?php

namespace App\Http\Livewire\User\InventoryManagement\Components\Article;

use Livewire\Component;
use App\Models\InventoryManagement\article\ArticleName;

class CreateArticle extends Component
{
    public $article_name = '';

    protected $rules = [
        'article_name' => 'required|max:50|unique:im_article_name,article_name',
    ];

    protected $messages = [
        'article_name.required' => 'Article Name is required',
        'article_name.unique' => 'Article Name already exists',
    ];

    protected $listeners = ['openCreateArticleModal'];

    public function openCreateArticleModal()
    {
        $this->article_name = '';
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('show-create-article-modal');
    }

    public function saveArticle()
    {
        $this->validate();

        $article = new ArticleName();
        $article->article_name = $this->article_name;
        
        if ($article->save()) {
            $this->article_name = '';
            $this->resetErrorBag();
            $this->emit('articleCreated');
            $this->dispatchBrowserEvent('hide-create-article-modal');
            session()->flash('success', 'Article added successfully!');
        }
    }

    public function render()
    {
        return view('livewire.user.inventory-management.components.article.create-article');
    }
}
