<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\{PostRequest, PostRequest2};

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index')
                ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post;

        $categories = Category::all();

        $tags = Tag::all();

        return view('admin.posts.create')
                ->with('post', $post)
                ->with('categories', $categories)
                ->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());

        if ($request->file('file')) {
            $url = Storage::disk('public')->put('images', $request->file('file'));

            $post->image()->create([
                'url' => $url
            ]);
        }

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.edit', $post)
                ->with('info', 'La Post se agrego con existo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show')
                ->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        $tags = Tag::all();

        return view('admin.posts.edit')
                ->with('post', $post)
                ->with('categories', $categories)
                ->with('tags', $tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->fill($request->all());

        if ($request->file('file')) {
            $url = Storage::disk('public')->put('images', $request->file('file'));

            if ($post->image) {                
                Storage::disk('public')->delete($post->image->url);
            
                $post->image->update([
                    'url' => $url
                ]);
            }else{
                $post->image()->create([
                    'url' => $url
                ]);                
            }
        }

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        $post->save();

        return redirect()->route('admin.posts.edit', $post)
                ->with('info', 'La Post Actualizado Existosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing trashed of the resource.
     *
     * @return \Illuminate\Http\Response 
     * */
    public function trash()
    {
        $posts = Post::onlyTrashed()->get();
    
        return view('admin.posts.trash')
                ->with('posts', $posts);
    }

    /**
     * Restore the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(int $id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();

        $post->restore();

        return redirect()->route('admin.posts.trash')
                ->with('info', 'La Post Restaurado');
    }

    /**
     * Delete the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();

        if(Storage::disk('public')->exists($post->image->url)) {
            Storage::disk('public')->delete($post->image->url);
        }

        $post->forceDelete();

        return redirect()->route('admin.posts.trash')
                ->with('info', 'La Post Eliminado Permanentemente');
    }
}
