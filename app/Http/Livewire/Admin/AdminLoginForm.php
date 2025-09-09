<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminLoginForm extends Component
{

    public $login_id, $password;
    public $returnURL;

    public function mount() {
        $this->returnURL = request()->returnURL;
    }

    public function LoginHandler() {

  

        $fieldType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if ($fieldType == 'email') {
            $this->validate([
                    'login_id' => 'required|email|exists:users,email',
                    'password' => 'required|min:5'
                ], [
                    'login_id.required' => 'Email or Username is required',
                    'login_id.email' => 'Invalid email address',
                    'login_id.exists' => 'This email is not registered in database',
                    'password.required' => 'Password is required',
                ]);
        }
        else {
            $this->validate([
                'login_id' => 'required|exists:users,username',
                'password' => 'required|min:5'
            ], [
                'login_id.required' => 'Email or Username is required',
                'login_id.exists' => 'This username is not registered in database',
                'password.required' => 'Password is required',
            ]);
        }

        $creds = array($fieldType=>$this->login_id,'password'=>$this->password);


        if( Auth::guard('web')->attempt($creds) ){
  
            $checkUser = User::where($fieldType, $this->login_id)->first();
            if ($checkUser->is_admin == 1 && $checkUser->is_verified == 1) 
            {
             

                if ($this->returnURL != null) {
                    return redirect()->to($this->returnURL);
                }   
                else
                {
                    return redirect()->route('admin.home');
                }
            }
            else
            {
                Auth::guard('web')->logout();
                return redirect()->route('admin.login')->with('fail','Invalid Administrator Account');
            }
       
        }
        else{
            session()->flash('fail','Incorrect Email/Username or Password');
           
        }

    }

    public function render()
    {

        return view('livewire.admin.admin-login-form');
    }
}
