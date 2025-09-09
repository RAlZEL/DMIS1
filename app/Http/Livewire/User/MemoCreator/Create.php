<?php

namespace App\Http\Livewire\User\MemoCreator;

use Livewire\Component;
use Illuminate\Support\Arr;

class Create extends Component
{
  
    public $date,$from_emp, $from_pos, $to, $to_emp, $to_pos, $attn_pos, $attn_emp, $thru_emp, $thru_pos, $subject, $body;
    public $have_attention, $have_thru, $CreateBody;

    public $ToEmployees,$AttnEmployees,$ThruEmployees;

    public $ToIndex;


    public function mount() {
        Arr::set($this->ToEmployees, 'to_emp', 'to_pos');
        $this->ToEmployees = array(['']);
        $this->AttnEmployees= [''];
        $this->ThruEmployees= [''];
        $this->have_attention = false;
        $this->have_thru = false;
        $this->CreateBody = false;
        $this->ToIndex = 1;
    }

    public function enableAttention() {

        if($this->have_attention == true) {
            $this->have_attention = false;
           } 
           else {
            $this->have_attention = true;
           }
    }

    public function removeTo($ToIndex) {
        $this->ToIndex = $this->ToIndex - 1;
        unset($this->ToEmployees[$this->ToIndex ]);
        $this->ToEmployees = array_values($this->ToEmployees);
       
    }      

    public function addBody() {
        $this->CreateBody = true;
    }

    public function addAttn() {
        $this->AttnEmployees[] = [''];
    }

    
    public function addThru() {
        $this->ThruEmployees[] = [''];
    }

    public function enableThru() {
       if($this->have_thru == true) {
        $this->have_thru = false;
       } 
       else {
        $this->have_thru = true;
       }
   
    }
    public function addTo() {
       $this->ToEmployees[] = [''];
       $this->ToIndex =(count($this->ToEmployees));
    }

    public function updated($key, $value) {
    
        $parts = explode(".", $key);
        if(count($parts)==2 && $parts[0] == 'to_emp') { 
            
            $this->ToEmployees[$parts[1]][0] = $value;
      
        }
        if(count($parts)==2 && $parts[0] == 'to_pos') {
            $this->ToEmployees[$parts[1]][1] = $value;
        }
        
    
    }
    public function createMemo() {
     
        foreach ($this->ToEmployees as $key => $ToEmp) 
        {   

        }
        $ToEmp = $this->validate([
            'to_emp.*' => 'required',
            'to_pos.*' => 'required',
        ]);
    dd($this->ToEmployees);
    }

    
    public function render()
    {
        return view('livewire.user.memo-creator.create');
    }
}
