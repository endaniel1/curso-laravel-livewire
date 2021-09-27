<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Post;

use Livewire\WithPagination;

class PostsIndex extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $user = auth()->user();
        $roles = $user->roles; //get roles
        $admin = in_array('Admin', $roles->pluck('name')->toArray()); //check admin

        if ($admin) {
            $posts = Post::where('name', 'LIKE', '%'. $this->search .'%')
                        ->latest('id')
                        ->paginate();
        }else{
            $posts = Post::where('user_id', $user->id)
                        ->where('name', 'LIKE', '%'. $this->search .'%')
                        ->latest('id')
                        ->paginate();
        }

        return view('livewire.admin.posts-index')
                ->with('posts', $posts);
    }
}
