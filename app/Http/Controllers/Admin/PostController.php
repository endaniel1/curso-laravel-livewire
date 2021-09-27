<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\PostRequest;

use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Instantiate a new controller instance.
     * 
     * @return void
    */
    public function __construct()
    {
        $this->middleware(['can:admin.posts.index'])->only('index');
        $this->middleware(['can:admin.posts.create'])->only('create', 'store');
        $this->middleware(['can:admin.posts.edit'])->only('edit', 'update');
        $this->middleware(['can:admin.posts.trash'])->only('trash');
        $this->middleware(['can:admin.posts.restore'])->only('restore');
        $this->middleware(['can:admin.posts.delete'])->only('delete');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('author', $post);

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
        $this->authorize('author', $post);

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
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('author', $post); 

        $post->delete();

        return redirect()->route('admin.posts.index')
                ->with('info', 'Post Eliminado Existosamente');
    }

    /**
     * Display a listing trashed of the resource.
     *
     * @return \Illuminate\Http\Response 
     * */
    public function trash()
    {
        $user = auth()->user();
        $roles = $user->roles; //get roles
        $admin = in_array('Admin', $roles->pluck('name')->toArray()); //check admin

        if ($admin) {        
            $posts = Post::onlyTrashed()
                        ->paginate();
        }else{        
            $posts = Post::onlyTrashed()
                        ->where('user_id', $user->id)
                        ->paginate();
        }
    
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
        $this->authorize('author', $post);

        $post = Post::onlyTrashed()->where('id', $id)->first();

        $post->forceDelete();

        return redirect()->route('admin.posts.trash')
                ->with('info', 'La Post Eliminado Permanentemente');
    }
}
