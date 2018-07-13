<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Region;
use App\Product;
use App\Complaint;
use App\Bid;





class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $auctions  = Product::join('bids',function($join) {
            $join->on('products.id','=','bids.product_id');
        })->count();
        $data = [
        'users' => User::all()->count(),
        'categories' => Category::all()->count(),
        'regions' => Region::all()->count(),
        'all_regions' => Region::all(),
        'products' => Product::all()->count(),
        'complaints' => complaint::all()->count(),
        'auctions' =>$auctions ];
        return view('admin.home')->with($data);
    }
}
