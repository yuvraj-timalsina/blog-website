<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Livewire\Component;

class DashboardStats extends Component
{
    public function render()
    {
        return view('livewire.dashboard-stats', [
            'posts' => Post::query()->count(),
            'categories' => Category::query()->count(),
            'tags' => Tag::query()->count(),
            'authors' => User::query()->where('role', 'writer')->count(),
        ]);
    }
}
