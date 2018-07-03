<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductDetail;
use App\ProductPicture;
use App\Bid;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $params=[
        'title'=>' Products list',
            'products'=>Product::orderBy('id','ASC')->get()];

        return view('admin.products.products_list')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    
        return abort(404);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
   {
return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
         try
        {
            $product = Product::findOrFail($id);

            $params = [
                'title' => 'Delete product',
                'product' => $product,
            ];

            return view('admin.products.products_delete')->with($params);
        }
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        try
        {
            $product = Product::find($id);
        ProductDetail::where('product_id',$product->id)->delete();
        ProductPicture::where('product_id',$product->id)->delete();
        Bid::where('product_id',$product->id)->delete();
        $product->delete();
       

            return redirect()->route('products.index')->with('success', "The Product <strong>$product->name</strong> has successfully been archived.");
        }
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }
     public function validateProduct($id)
    {
        //

        try
        {
            $product = Product::find($id);
        $product->is_valid = true;
        $product->save();
       

            return redirect()->route('products.index')->with('success', "The Product <strong>$product->name</strong> has successfully been validated.");
        }
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }

    }
}
