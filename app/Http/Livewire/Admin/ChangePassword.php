<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ChangePassword extends Component
{

    public $current_password, $new_password, $confirm_new_password;

    use AuthorizesRequests;

    public function changePassword() {
        $this->validate([
            'current_password' => [
                'required', function ($attribute, $value, $fail) {
                    if (!hash::check($value, User::find(auth('web')->id())->password)) {
                        return $fail(__('The current password is incorrect'));
                    }
                },
            ],
            'new_password' => 'required|min:5|max:25',
            'confirm_new_password' => 'same:new_password'
        ],[
            'current_password.required' => 'Enter your current password',
            'new_password.required' => 'Enter new password',
            'confirm_new_password.same' => 'The confirm password must be the same to the new password',
        ]);

        $query = User::find(auth('web')->id())->update([
            'password' => Hash::make($this->new_password)
        ]);

        if ($query) {
            $this->showToastr('Your password has been successfully updated.','success');
            $this->current_password = $this->new_password = $this->confirm_new_password = null;
        }
        else {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
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
        $this->authorize('viewany', App\Models\User::class);
        return view('livewire.admin.change-password');
    }
}
