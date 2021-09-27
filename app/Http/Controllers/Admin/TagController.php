<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Instantiate a new controller instance.
     * 
     * @return void
    */
    public function __construct()
    {
        $this->middleware(['can:admin.tags.index'])->only('index');
        $this->middleware(['can:admin.tags.create'])->only('create', 'store');
        $this->middleware(['can:admin.tags.edit'])->only('edit', 'update');
        $this->middleware(['can:admin.tags.trash'])->only('trash');
        $this->middleware(['can:admin.tags.restore'])->only('restore');
        $this->middleware(['can:admin.tags.delete'])->only('delete');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return view('admin.tags.index')
                ->with('tags', $tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = new Tag;

        return view('admin.tags.create')
                ->with('tag', $tag);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:tags',
            'color' => 'required',
        ]);

        $tag = Tag::create($request->all());

        return redirect()->route('admin.tags.edit', $tag)
                ->with('info', 'La Etiqueta se agrego con existo');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required',
            'slug' => "required|unique:tags,slug,{$tag->id}",
            'color' => 'required',
        ]);

        $tag->fill($request->all());

        $tag->save();

        return redirect()->route('admin.tags.edit', $tag)
                ->with('info', 'La Etiqueta se actualizo con existo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.tags.index')
                ->with('info', 'La Etiqueta se elimino con existo');
    }

    /**
     * Display a listing trashed of the resource.
     *
     * @return \Illuminate\Http\Response 
     * */
    public function trash()
    {
        $tags = Tag::onlyTrashed()->get();
    
        return view('admin.tags.trash')
                ->with('tags', $tags);
    }

    /**
     * Restore the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(int $id)
    {
        $tag = Tag::onlyTrashed()->where('id', $id)->first();

        $tag->restore();

        return redirect()->route('admin.tags.trash')
                ->with('info', 'Etiqueta Restaurada');
    }

    /**
     * Delete the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id)
    {
        $tag = Tag::onlyTrashed()->where('id', $id)->first();

        $tag->forceDelete();

        return redirect()->route('admin.tags.trash')
                ->with('info', 'Etiqueta Eliminada Permanentemente');
    }
}
