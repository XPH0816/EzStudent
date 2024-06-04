<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $randomProducts = Product::inRandomOrder()->get();
        if ($randomProducts->count() == 0) {
            $randomProducts->push((object)["image" => "https://picsum.photos/640/480?random=60851"]);
            $randomProducts->push((object)["image" => "https://picsum.photos/640/480?random=75474"]);
            $randomProducts->push((object)["image" => "https://picsum.photos/640/480?random=84204"]);
        }
        return view('dashboard', compact('randomProducts'));
    }

    public function admin()
    {
        $products = Product::all();
        return view('adminDashboard', compact('products'));
    }
}
