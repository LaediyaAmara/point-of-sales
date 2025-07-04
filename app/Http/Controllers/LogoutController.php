<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();   // menghapus session
        $request->session()->regenerateToken(); // regenerasi CSRF token

        return redirect('/');  // atau ke halaman login
    }
}

