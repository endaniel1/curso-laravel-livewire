<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     * 
     * @return void
    */
    public function __construct()
    {
        $this->middleware(['can:admin.users.index'])->only('index');
        $this->middleware(['can:admin.users.create'])->only('create', 'store');
        $this->middleware(['can:admin.users.edit'])->only('edit', 'update');
        $this->middleware(['can:admin.users.trash'])->only('trash');
        $this->middleware(['can:admin.users.restore'])->only('restore');
        $this->middleware(['can:admin.users.delete'])->only('delete');
    }

    /**
     * Instantiate a new controller instance.
     * 
     * @return void
    */
    public function __construct()
    {
        $this->middleware(['can:admin.users.index'])->only('index');
        $this->middleware(['can:admin.users.edit'])->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;

        $roles = Role::all();

        return view('admin.users.create')
                ->with('roles', $roles)
                ->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.edit', $user)
                ->with('info', 'El Usuario se actualizo con existo');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit')
                ->with('roles', $roles)
                ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.edit', $user)
                ->with('info', 'El Usuario se actualizo con existo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //$this->authorize('author', $post); 

        $user->delete();

        return redirect()->route('admin.users.index')
                ->with('info', 'Usuario Eliminado Existosamente');
    }

    /**
     * Display a listing trashed of the resource.
     *
     * @return \Illuminate\Http\Response 
     * */
    public function trash()
    {
        $users = User::onlyTrashed()->paginate();
    
        return view('admin.users.trash')
                ->with('users', $users);
    }

    /**
     * Restore the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(int $id)
    {
        $user = User::onlyTrashed()->where('id', $id)->first();

        $user->restore();

        return redirect()->route('admin.users.trash')
                ->with('info', 'El Usuario Restaurado');
    }

    /**
     * Delete the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id)
    {
        //$this->authorize('author', $user);

        $user = User::onlyTrashed()->where('id', $id)->first();

        $user->forceDelete();

        return redirect()->route('admin.users.trash')
                ->with('info', 'El Usuario Eliminado Permanentemente');
    }
}
