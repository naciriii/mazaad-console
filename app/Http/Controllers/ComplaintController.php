<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complaint;
use Mail;

class ComplaintController extends Controller
{
    //

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
        'title'=>' Complaints list',
            'complaints'=>Complaint::orderBy('id','ASC')->get()];

        return view('admin.complaints.complaints_list')->with($params);
    }

    public function answer(Request $request)
    {
    	
        $contact = array(
            'to'        => $request->email,
            'subject'   => "Complaint",
            'html'      => $request->content,
            'from'      => 'contact@mazaad.com',
        );
          Mail::raw($contact['html'], function ($m) use ($contact) {
            $m->from($contact['from']);

            $m->to($contact['to'])->subject($contact['subject']);
        });



  return redirect()->route('complaints.index')
  ->with('success', 
  	"The Complaint  has successfully been answered.");


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
            $complaint = Complaint::findOrFail($id);

            $params = [
                'title' => 'Delete complaint',
                'complaint' => $complaint,
            ];

            return view('admin.complaints.complaints_delete')->with($params);
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
         
            $complaint = Complaint::findOrFail($id);

            $params = [
                'title' => 'Edit Complaint',
             
                'complaint' => $complaint
                
            ];

            return view('admin.complaints.complaints_edit')->with($params);
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

            $complaint = Complaint::findOrFail($id);

            $complaint->name = $request->input('name');
             $complaint->icon = $request->input('icon');
        
            
            
        
            

            $complaint->save();

            return redirect()->route('complaints.index')->with('success', "The Complaint <strong>$complaint->name</strong> has successfully been updated.");
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
            $complaint = Complaint::find($id);

            $complaint->delete();

            return redirect()->route('complaints.index')->with('success', "The Complaint <strong>$complaint->name</strong> has successfully been archived.");
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
