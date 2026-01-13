<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use App\Models\Tip;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Menampilkan Landing Page (Beranda)
     */
    public function index()
    {
        // Fallback: Jika tidak ada resep yang di-featured, ambil resep terbaru sebagai unggulan
        $featured = Recipe::where('is_featured', true)->first() ?? Recipe::latest()->first();

        return view('welcome', [
            'featured' => $featured,
            'recipes' => Recipe::latest()->get(),
            'categories' => Category::all(),
            'tips' => Tip::latest()->take(2)->get(),
        ]);
    }

    /**
     * Menampilkan Halaman Detail Resep & Ulasan
     */
    public function showRecipe(Recipe $recipe)
    {
        // Memuat relasi agar data kategori dan komentar tampil
        $recipe->load(['category', 'comments' => function($query) {
            $query->where('is_visible', true)->latest();
        }]);

        return view('recipes.show', compact('recipe'));
    }

    /**
     * Menampilkan Halaman Detail Tips & Trik
     */
    public function showTip(Tip $tip)
    {
        return view('tips.show', compact('tip'));
    }

    /**
     * Menyimpan Komentar Baru (Review per Resep)
     */
    public function storeComment(Request $request, Recipe $recipe)
    {
        $request->validate([
            'comment' => 'required|string|min:5',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $recipe->comments()->create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'rating' => $request->rating,
            'is_visible' => true, // Set true agar langsung tampil, atau false untuk moderasi
        ]);

        return back()->with('success', 'Ulasan Anda telah berhasil dikirim!');
    }
}
