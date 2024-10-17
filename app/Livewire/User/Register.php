<?php
namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $fname, $lname, $email, $password;

    public function render()
    {
        return view('livewire.user.register')->layout('layouts.user-login');
    }

    protected $messages = [
        'fname.regex' => 'Invalid format. The first name should only contain letters.',
        'lname.regex' => 'Invalid format. The last name should only contain letters and hyphens.',
    ];

    public function create()
    {
        $this->validate([
            'fname' => ['required', 'regex:/^[a-zA-Z]+$/', 'min:10', 'max:20'],
            'lname' => ['required', 'regex:/^[a-zA-Z-]+$/', 'min:10', 'max:20'],
            'email' => ['required', 'email', 'unique:users,email', 'max:45'],
            'password' => ['required', 'string', 'min:8', 'max:20'],
        ]);

        $user = new User();
        $user->fname = $this->fname;
        $user->lname = $this->lname;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->remember_token = 0;

        if ($user->save()) {
            session()->flash('success', 'Registered Successfully! Admin will approve your account');
            $this->resetForm();
            return redirect(route('user.login'));
        }
    }

    public function resetForm()
    {
        $this->fname = '';
        $this->lname = '';
        $this->email = '';
        $this->password = '';
    }
}
