<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->page){ //vemos en q pagina estamos
            $key = 'posts'. $request->page;
        }else{
            $key = 'posts';
        }

        //comprabamos si tenemos algo en la Cache
        if (Cache::has($key)) {
            $posts = Cache::get($key);
        }else{
            $posts = Post::where('status', 2)->latest('id')->paginate(8);

            Cache::put($key, $posts);
        }

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->authorize('published', $post);
        
        $similares = Post::where('category_id', $post->category_id)
                        ->where('status', 2)
                        ->where('id', '!=', $post->id)
                        ->latest('id')
                        ->take(4)
                        ->get();

        return view('posts.show')
                ->with('post', $post)
                ->with('similares', $similares);
    }

    public function category(Category $category)
    {
        $posts = Post::where('category_id', $category->id)
                        ->where('status', 2)
                        ->latest('id')
                        ->paginate(4);

        return view('posts.category')
                ->with('posts', $posts)
                ->with('category', $category);
    }

    public function tag(Tag $tag)
    {
        $posts = $tag->posts()
                    ->where('status', 2)
                    ->latest('id')
                    ->paginate(4);

        return view('posts.tag')
                    ->with('tag', $tag)
                    ->with('posts', $posts);
    }
}
