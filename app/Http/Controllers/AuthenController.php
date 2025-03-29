<?php

namespace App\Http\Controllers;
    use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AuthenController extends Controller{

protected function authenticated(Request $request, $user)
{
    if ($user->role == 'etudiant') {
        return redirect()->route('dashboard');
    }

    return redirect()->route('admin.dashboard');
}
}