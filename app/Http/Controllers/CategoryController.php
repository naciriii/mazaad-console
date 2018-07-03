<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
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
        'title'=>' Categories list',
            'categories'=>Category::orderBy('id','ASC')->get()];

        return view('admin.categories.categories_list')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    
        $params = [
            'title' => 'Create Category'
           
            ];
          
        

        return view('admin.categories.categories_create')->with($params);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
   {

        if($request->hasFile('categories')) {
            $this->validate($request,[
                'categories'=>'required|mimes:csv,txt'
                ]);
          
            $handle =fopen($request->file('categories')->getRealPath(), 'r');
     
        $data = array();
        $header = null;
        while (($row = fgetcsv($handle, 1000)) !== false)
        {
            if (!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
        Category::insert($data);

         }else {

        $this->validate($request, [
            'name' => 'required',
            'icon' => 'required'
         
           
            
           
          
        ]);

            $category=new Category();
            $category->name=$request->input('name');
              $category->icon = $request->input('icon');
            $category->save();
        }

          
       

        return redirect()->route('categories.index')->with('success', "successfully been created.");
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
            $category = Category::findOrFail($id);

            $params = [
                'title' => 'Delete category',
                'category' => $category,
            ];

            return view('admin.categories.categories_delete')->with($params);
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
         
            $category = Category::findOrFail($id);

            $params = [
                'title' => 'Edit Category',
             
                'category' => $category
                
            ];

            return view('admin.categories.categories_edit')->with($params);
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
        try
        {
               $this->validate($request, [
            'name' => 'required',
            'icon' => 'required'
          
          
           
          
        ]);

            $category = Category::findOrFail($id);

            $category->name = $request->input('name');
             $category->icon = $request->input('icon');
        
            
            
        
            

            $category->save();

            return redirect()->route('categories.index')->with('success', "The Category <strong>$category->name</strong> has successfully been updated.");
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
            $category = Category::find($id);

            $category->delete();

            return redirect()->route('categories.index')->with('success', "The Category <strong>$category->name</strong> has successfully been archived.");
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
