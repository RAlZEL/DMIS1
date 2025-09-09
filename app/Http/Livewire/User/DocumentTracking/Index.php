<?php

namespace App\Http\Livewire\User\DocumentTracking;


use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DocumentTracking\Document;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{

    use AuthorizesRequests;
    use WithPagination;

    public $perPage;

    public $Search;


  

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
        
    }

  

    public function viewDocument($id)
    {
        return redirect()->route('document-tracking.view',$id);
  
    }


    public function render()
    {
        $this->authorize('viewany', App\Models\DocumentTracking\Document::class);

        if (auth()->user()->Employee->officeid == 1) 
        {
            return view('livewire.user.document-tracking.index', [
                'Documents' => Document::orderby('created_at','desc')->search(trim($this->Search))->paginate($this->perPage),
            ]);
        }

        else {
            return view('livewire.user.document-tracking.index', [
                'Documents' => Document::orderby('created_at','desc')->where('origin', auth()->user()->Employee->officeid)->search(trim($this->Search))->paginate($this->perPage),
            ]);
        }
      


    }
}
