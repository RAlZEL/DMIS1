<?php

namespace App\Http\Livewire\Admin\AdminPanel\ExpenseClass;

use App\Models\Admin\AdminPanel\ExpenseClass\ExpenseClass;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class Index extends Component
{

    
    use AuthorizesRequests;

    use WithPagination;
    public $expense_class;
    public $selected_expense_id;
    public $updateExpense = false;
    public $perPage;
    public $Search;

    protected $listeners = [
        'resetModalForm',
        'deleteModalAction',
    ];

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
    }

    public function updatingSearch() {
        $this->resetPage();
    }
    
    public function resetModalForm() {
        $this->resetErrorBag();
        $this->expense_class = null;
    }   

    public function addExpenseClass() {
        
        $this->authorize('create', App\Models\Admin\AdminPanel\ExpenseClass\ExpenseClass::class);
        $this->validate([
            'expense_class' => 'required|unique:fm_expense_class,expense_class',
        ]);

        $ExpenseClass = new ExpenseClass();
        $ExpenseClass->expense_class = $this->expense_class;
        $success = $ExpenseClass->save();

        if ($success)
        {
            $this->dispatchBrowserEvent('hideAddModal');
            $this->expense_class = null;
            $this->showToastr('New Expense Class added Successfully.','success');

        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }

    }


    public function editExpenseClass($id) {
        $expense_class = ExpenseClass::findOrFail($id);
        $this->authorize('update', $expense_class);
        $this->selected_expense_id = $expense_class->id;
        $this->expense_class = $expense_class->expense_class;
        $this->updateExpense = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateModal');
    }


    public function updateExpenseClass() {

        if ($this->selected_expense_id) {
            $this->validate([
                'expense_class' => 'required|unique:fm_expense_class,expense_class,'.$this->selected_expense_id,
            ]);

            $expense_class = ExpenseClass::findOrFail($this->selected_expense_id);
            $expense_class->expense_class = $this->expense_class;
            $Success = $expense_class->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideUpdateeModal');
                $this->expense_class = null;
                $this->updateExpense = false;
                $this->showToastr('Expense Class has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }

    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }




    public function render()
    {
        $this->authorize('viewany', App\Models\Admin\AdminPanel\ExpenseClass\ExpenseClass::class);
        return view('livewire.admin.admin-panel.expense-class.index', [
            'ExpenseClasses' => ExpenseClass::orderby('expense_class','asc')->search(trim($this->Search))
            ->paginate($this->perPage),
        ]);
    }
}
