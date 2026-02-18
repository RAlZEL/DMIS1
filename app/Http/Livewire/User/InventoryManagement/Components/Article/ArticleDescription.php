<?php

namespace App\Http\Livewire\User\InventoryManagement\Components\Article;

use App\Models\InventoryManagement\article\ArticleName;
use App\Models\InventoryManagement\article\ArticleDescription;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArticleDescriptionComponent extends Component
{

    use AuthorizesRequests;

    use WithPagination;
    

    public $updateArticle = false;
    public $selected_article_id;
    public $perPage;
    public $Search;
    public $article_name, $article_description;

    

    protected $listeners = [
       'resetModalForm',
        'deleteAccountAction',
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
        $this->article_description = null;
        $this->updateArticle = false;

    } 
    
    public function addArticle() {
        $this->authorize('create', App\Models\InventoryManagement\article\ArticleDescription::class);
        $this->validate([
            'article_name' => 'required',
            'article_description' => 'required|unique:im_article_description,article_description,',
        ], [
            'article_name.required' => 'Article Name Field is required',
            'article_description.required' => 'Article Description Field is required',
            'article_description.unique' => 'Article Description already taken',

        ]);

        $ArticleName = new articledescription();
        $ArticleName->article_id = $this->article_name;        
        $ArticleName->article_description = $this->article_description;
        $success = $ArticleName->save();

        if ($success)
        {
            
            $this->dispatchBrowserEvent('hideAddArticleModal');
            $this->resetModalForm();
            $this->showToastr('New Description added Successfully.','success');

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
        $ArticleName = ArticleDescription::findOrFail($id);
        $this->authorize('update', $ArticleName);
        $this->selected_article_id = $ArticleName->id;


        $this->updateArticle = true;
        $this->article_name = $ArticleName->ArticleName->article_name;        
        $this->article_description = $ArticleName->article_description;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateArticleDescriptionModal');
    }


    public function updateArticle() {
        if ($this->selected_article_id) {
            $this->validate([
                'article_name' => 'required',
                'article_description' => 'required|unique:im_article_description,article_description,'.$this->selected_article_id,
            ], [
                'article_name.required' => 'Article Name Field is required',
                'article_description.required' => 'Article Description Field is required',
                'article_description.unique' => 'Article Description already taken',
    
            ]);


            $ArticleName = ArticleDescription::findOrFail($this->selected_article_id);  
            $ArticleName->article_description = $this->article_description;
            $Success = $ArticleName->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideUpdateArticleDescriptionModal');
                $this->resetModalForm();
                $this->showToastr('Article Description has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }

    public function deleteArticle($id){
        $this->authorize('update', App\Models\InventoryManagement\article\ArticleDescription::class);;
        $delete_record = ArticleDescription::get_single($id);
       
        $this->dispatchBrowserEvent('showDeleteArticleDescriptionModal');
    }

    public function destroyArticle(){
        $this->authorize('update', App\Models\InventoryManagement\article\ArticleDescription::class);
        $delete_record = ArticleDescription::get_single($this->selected_article_id);

        $Success =  $delete_record->delete();
        if ($Success){
             $this->dispatchBrowserEvent('hideDeleteArticleDescriptionModal');
             $this->showToastr('Article Description has been successfully Deleted.','success');
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
    }

    public function render()
    {
        return view('livewire.user.inventory-management.article.articledescription.index',[            
            'ArticleDescriptions' => ArticleDescription::orderby('id','asc')->search(trim($this->Search))->paginate($this->perPage),
            'Articles' => ArticleName::orderby('article_name','asc')->get(),
        ]);
    }
}
