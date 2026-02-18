<?php

namespace App\Http\Livewire\Admin\InventoryManagement\Components\Article;

use Livewire\Component;
use App\Models\InventoryManagement\article\ArticleName;
use App\Models\InventoryManagement\article\ArticleDescription;

class CreateArticleDescription extends Component
{
    public $article_id = '';
    public $article_description = '';
    
    public $ArticleNameLists = [];

    protected $rules = [
        'article_id' => 'required',
        'article_description' => 'required|unique:im_article_description,article_description',
    ];

    protected $messages = [
        'article_id.required' => 'Article Name is required',
        'article_description.required' => 'Article Description is required',
        'article_description.unique' => 'Article Description already exists',
    ];

    protected $listeners = ['openCreateDescriptionModal'];

    public function mount()
    {
        $this->ArticleNameLists = ArticleName::orderBy('article_name', 'asc')->get();
    }

    public function openCreateDescriptionModal()
    {
        $this->article_id = '';
        $this->article_description = '';
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('show-create-description-modal');
    }

    public function saveDescription()
    {
        $this->validate();

        $description = new ArticleDescription();
        $description->article_id = $this->article_id;
        $description->article_description = $this->article_description;
        
        if ($description->save()) {
            $this->article_id = '';
            $this->article_description = '';
            $this->resetErrorBag();
            $this->emit('descriptionCreated');
            $this->dispatchBrowserEvent('hide-create-description-modal');
            session()->flash('success', 'Article Description added successfully!');
        }
    }

    public function render()
    {
        return view('livewire.admin.inventory-management.components.article.create-article-description');
    }
}
