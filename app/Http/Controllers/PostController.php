<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = Post::create([
            'user_id' => $request->user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => \Illuminate\Support\Str::slug($request->title) . '-' . uniqid(),
            'content' => $request->content,
            'status' => 'published',
        ]);

        if ($request->has('tags')) {
            $this->syncTags($post, $request->tags);
        }

        return redirect()->route('posts.show', $post->slug)->with('status', 'Article publié avec succès !');
    }

    public function show(string $slug)
    {
        $post = Post::with(['user', 'category', 'comments.user', 'tags', 'likes'])->where('slug', $slug)->firstOrFail();
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        $this->authorizeAuthor($post);
        $post->load('tags');
        $categories = \App\Models\Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorizeAuthor($post);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post->update([
            'title' => $request->title,
            'slug' => \Illuminate\Support\Str::slug($request->title) . '-' . uniqid(),
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);

        if ($request->has('tags')) {
            $this->syncTags($post, $request->tags);
        }

        return redirect()->route('posts.show', $post->slug)->with('status', 'Article mis à jour !');
    }

    protected function syncTags(Post $post, string $tagsString)
    {
        $tagNames = collect(explode(',', $tagsString))
            ->map(fn($t) => trim($t))
            ->filter()
            ->unique();

        $tagIds = $tagNames->map(function ($name) {
            $tag = \App\Models\Tag::firstOrCreate([
                'slug' => \Illuminate\Support\Str::slug($name)
            ], [
                'name' => $name
            ]);
            return $tag->id;
        });

        $post->tags()->sync($tagIds);
    }

    public function destroy(Post $post)
    {
        $this->authorizeAuthor($post);
        $post->delete();

        return redirect()->route('dashboard')->with('status', 'Article supprimé !');
    }

    protected function authorizeAuthor(Post $post)
    {
        if (auth()->id() !== $post->user_id) {
            abort(403, 'Action non autorisée.');
        }
    }
}
