<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Region;
use App\Product;
use App\Complaint;
use App\Bid;
use App\Admin;
use Auth;





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

    public function profile()
    {
        return view('admin.profile');
    }

    public function postProfile(Request $request)
    {
        $this->validate($request, [
              "name" => "required|string|max:255",
           "email" => "required|email|max:255|unique:admins,email,".Auth::user()->id,
            ]);
      
        if($request->has('password')) {
            $this->validate($request,[
                 'password' => 'required|string|min:6|confirmed',

                ]);
        }
          $admin = Admin::find(Auth::user()->id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if($request->has('password')) {
            $admin->password= bcrypt($request->password);
        }

        $admin->save();
        return redirect()->route('profile.index')->with('success', "Profile successfully updated.");

    }
}
