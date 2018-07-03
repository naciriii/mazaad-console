<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;

class RegionController extends Controller
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
        'title'=>' Regions list',
            'regions'=>Region::orderBy('id','ASC')->get()];

        return view('admin.regions.regions_list')->with($params);
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
            'title' => 'Create Region'
           
            ];
          
        

        return view('admin.regions.regions_create')->with($params);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
   {

        if($request->hasFile('regions')) {
            $this->validate($request,[
                'regions'=>'required|mimes:csv,txt'
                ]);
          
            $handle =fopen($request->file('regions')->getRealPath(), 'r');
     
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
        Region::insert($data);

         }else {

        $this->validate($request, [
            'name' => 'required'
      
         
           
            
           
          
        ]);

            $region=new Region();
            $region->name=$request->input('name');
            $region->save();
        }

          
       

        return redirect()->route('regions.index')->with('success', "successfully been created.");
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
            $region = Region::findOrFail($id);

            $params = [
                'title' => 'Delete region',
                'region' => $region,
            ];

            return view('admin.regions.regions_delete')->with($params);
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
         
            $region = Region::findOrFail($id);

            $params = [
                'title' => 'Edit Region',
             
                'region' => $region
                
            ];

            return view('admin.regions.regions_edit')->with($params);
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
            'name' => 'required'
          
          
        ]);

            $region = Region::findOrFail($id);

            $region->name = $request->input('name');
        
            
            
        
            

            $region->save();

            return redirect()->route('regions.index')->with('success', "The Region <strong>$region->name</strong> has successfully been updated.");
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
            $region = Region::find($id);

            $region->delete();

            return redirect()->route('regions.index')->with('success', "The Region <strong>$region->name</strong> has successfully been archived.");
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
