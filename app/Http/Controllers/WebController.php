<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MajorCategory;
use App\Models\Product;

class WebController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $major_categories = MajorCategory::all();

        $recently_products = Product::orderBy('created_at', 'desc')->take(4)->get();

        $recommend_products = Product::where('recommend_flag', true)->take(3)->get();

        /*レビューの平均が高い順で上から4つまでを変数$featured_productsに定義*/
        $featured_products = Product::withAvg('reviews', 'score')->orderBy('reviews_avg_score', 'desc')->take(4)->get();
        /*views>web>index.blade.phpに、compact()内の変数を渡す */
        return view('web.index', compact('major_categories', 'categories', 'recently_products', 'recommend_products', 'featured_products'));
    }
}
