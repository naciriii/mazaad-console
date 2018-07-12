<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bid;
use App\Product;
class AuctionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($product_id)
    {
    	  $params=[
        'title'=>' auctions list',
        'product' => Product::find($product_id),
            'auctions'=>Bid::where('product_id',$product_id)->orderBy('id','ASC')->get()];

        return view('admin.auctions.auctions_list')->with($params);
    
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
            $bid = Bid::findOrFail($id);

            $params = [
                'title' => 'Delete bid',
                'bid' => $bid,
            ];

            return view('admin.auctions.auctions_delete')->with($params);
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
        try
        {
         
            $bid = Bid::findOrFail($id);

            $params = [
                'title' => 'Edit Bid',
             
                'bid' => $bid
                
            ];

            return view('admin.auctions.auctions_edit')->with($params);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	dd($request->all());
        try
        {
               $this->validate($request, [
            'price' => 'required',
          
          
           
          
        ]);

            $bid = Bid::findOrFail($id);

            $bid->name = $request->input('name');
            if($request->has('is_winning')) {
             $bid->is_winning = true;
             $p = Product::find($bid->product->id);
             $p->is_available = false;
             $p->save();
         }
        
            
            
        
            

            $bid->save();

            return redirect()->route('auctions.index',['product_id'=>$bid->product->id])->with('success', "The Bid <strong>$bid->id</strong> has successfully been updated.");
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
            $bid = Bid::find($id);

            $bid->delete();

            return redirect()->route('auctions.index',['product_id'=>$bid->product->id])->with('success', "The Bid <strong>$bid->id</strong> has successfully been archived.");
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
