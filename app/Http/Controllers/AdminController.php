<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => \App\Models\User::count(),
            'posts' => \App\Models\Post::count(),
            'comments' => \App\Models\Comment::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = \App\Models\User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function posts()
    {
        $posts = \App\Models\Post::with(['user', 'category'])->latest()->paginate(10);
        return view('admin.posts', compact('posts'));
    }

    public function changeRole(\Illuminate\Http\Request $request, \App\Models\User $user)
    {
        // Empêcher de modifier son propre rôle pour éviter de se bloquer
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas modifier votre propre rôle.');
        }

        $request->validate(['role' => 'required|in:student,teacher,admin']);
        $user->update(['role' => $request->role]);

        return back()->with('status', 'Rôle de ' . $user->name . ' mis à jour.');
    }

    public function toggleStatus(\App\Models\Post $post)
    {
        $post->update([
            'status' => $post->status === 'published' ? 'draft' : 'published'
        ]);

        return back()->with('status', 'Statut de l\'article mis à jour.');
    }
}
