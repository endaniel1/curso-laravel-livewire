<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Instantiate a new controller instance.
     * 
     * @return void
    */
    public function __construct()
    {
        $this->middleware(['can:admin.categories.index'])->only('index');
        $this->middleware(['can:admin.categories.create'])->only('create', 'store');
        $this->middleware(['can:admin.categories.edit'])->only('edit', 'update');
        $this->middleware(['can:admin.categories.trash'])->only('trash');
        $this->middleware(['can:admin.categories.restore'])->only('restore');
        $this->middleware(['can:admin.categories.delete'])->only('delete');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index')
                ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category;

        return view('admin.categories.create')
                ->with('category', $category);
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
            'slug' => 'required|unique:categories',
        ]);

        $category = Category::create($request->all());

        return redirect()->route('admin.categories.edit', $category)
                ->with('info', 'La Categoria se agrego con existo');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'slug' => "required|unique:categories,slug,{$category->id}",
        ]);

        $category->fill($request->all());

        $category->save();

        return redirect()->route('admin.categories.edit', $category)
                ->with('info', 'La Categoria se actualizo con existo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
                ->with('info', 'La Categoria se elimino con existo');
    }

    /**
     * Display a listing trashed of the resource.
     *
     * @return \Illuminate\Http\Response 
     * */
    public function trash()
    {
        $categories = Category::onlyTrashed()->get();
    
        return view('admin.categories.trash')
                ->with('categories', $categories);
    }

    /**
     * Restore the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(int $id)
    {
        $category = Category::onlyTrashed()->where('id', $id)->first();

        $category->restore();

        return redirect()->route('admin.categories.trash')
                ->with('info', 'La Categor??a Restaurada');
    }

    /**
     * Delete the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id)
    {
        $category = Category::onlyTrashed()->where('id', $id)->first();

        $category->forceDelete();

        return redirect()->route('admin.categories.trash')
                ->with('info', 'La Categor??a Eliminada Permanentemente');
    }
}
