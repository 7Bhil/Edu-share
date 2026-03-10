<?php

namespace App\Http\Controllers;
 
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $posts = $user->posts()->with(['category', 'user'])->latest()->get();
        
        return view('users.show', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
