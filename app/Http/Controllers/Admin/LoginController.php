<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    use AuthenticatesUsers;


    protected $redirectTo = 'admin/home';


    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        foreach ($this->guard()->user()->role as $role) {
            if ($role->name == 'admin') {
                return redirect('admin/home');
            }elseif ($role->name == 'editor') {
                return redirect('admin/editor');
            }
        }
    }



    public function showLoginForm()
    {
        return view('admin.login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
