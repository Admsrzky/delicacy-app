<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Mengambil resep unik yang pernah dikomentari user
        $myRatedRecipes = \App\Models\Recipe::whereHas('comments', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['comments' => function($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->get();

        return view('profile.show', compact('user', 'myRatedRecipes'));
    }
}
