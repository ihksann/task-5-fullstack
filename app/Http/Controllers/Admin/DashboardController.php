<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::count();
        $posts = Post::count();
        $users = User::count();

        return view('admin.dashboard', compact('categories','posts','users'));
    }
}
