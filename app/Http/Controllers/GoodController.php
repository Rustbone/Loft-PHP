<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Good;

class GoodController extends Controller
{
    public function index() {
        //$goods = Good::query()->get();
        return view('dashboard', [
            'goods' => Good::all(),
            'categories' => Category::all()
        ]);
    }

    public function good(int $id) {
        /** @var Good $good */
        $good = Good::query()->with('category')->find($id);
        //dd($good->category);
        return view('good', ['good' => $good]);
    }

    public function category(int $id) {
        /** @var Category $category */
        $category = Category::with('goods')->find($id);   
        // dd($category->good); 
        return view('dashboard', [
            'goods' => $category->goods,
            'categories' => Category::all(),
            'currentCategory' => Category::find($id)
        ]);
    }
}
