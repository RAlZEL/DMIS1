<?php

namespace App\Http\Livewire\User\InventoryManagement\Components\Article;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\InventoryManagement\article\ArticleName;
use App\Policies\FinancialManagement\Article\ArticlePolicy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArticleNameComponent extends Component
{

    use AuthorizesRequests;

    use WithPagination;
    
    public $updateArticle = false;
    public $selected_article_id;
    public $perPage;
    public $Search;
    public $article_name;
   
    protected $listeners = [
        'resetModalForm',
        'deleteArticle$ArticleAction',
    ];

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
    }

    public function updateperPage() {
        $this->perPage = $this->perPage;
    }

    public function updatingSearch() {
        $this->resetPage();
    }

    public function resetModalForm() {
        $this->resetErrorBag();
        $this->article_name = null;
        $this->updateArticle = false;

    } 


    public function addArticle() {
        $this->authorize('create', App\Models\InventoryManagement\article\ArticleName::class);
        $this->validate([
            'article_name' => 'required|max:50|unique:im_article_name,article_name',
        ], [
            'article_name.required' => 'Article$Article Name Field is required',

        ]);
        $ArticleName = new articlename();
        $ArticleName->article_name = $this->article_name;           
        $success = $ArticleName->save();

        if ($success)
        {
            
            $this->dispatchBrowserEvent('hideAddModal');
            $this->resetModalForm();
            $this->showToastr('New Article added Successfully.','success');

        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }

    }

    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }


    public function editArticle($id) {
        $Article = ArticleName::findOrFail($id);
        $this->authorize('update', $Article);
        $this->selected_article_id = $Article->id;
        $this->updateArticle = true;
        $this->article_name = $Article->article_name;
       
        $this->resetErrorBag();
        \Log::info('editArticle called for ID: ' . $id);
        $this->dispatchBrowserEvent('showUpdateModal');
    }


    public function updateArticle() {
        if ($this->selected_article_id) {
            $this->validate([
                'article_name' => 'required|max:50|unique:im_article_name,article_name,'.$this->selected_article_id,
                
            ], [
                'article_name.required' => 'Article Name Field is required',
                'article_name.unique' => 'Article Name is already taken',
    
            ]);

            $Article = ArticleName::findOrFail($this->selected_article_id);
            $Article->article_name = $this->article_name;
            $Success = $Article->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideUpdateModal');
                $this->resetModalForm();
                $this->showToastr('Article has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }

    
    

    
    
    public function render()
    {
        return view('livewire.user.inventory-management.article.articlename.index', [
            'ArticleNames' => ArticleName::orderby('id','asc')->search(trim($this->Search))->paginate($this->perPage),
        ]);
    }
}
