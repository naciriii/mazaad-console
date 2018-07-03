<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //
    public function index()
    {
    	# code...
    	$params=[
        'title'=>'Members List',
        'users'=>User::orderBy('id','ASC')->get(),
       	];
    	return view('admin.users.users_list')->with($params);
    }
  public function show($id)
    {
         try
        {
            $user = User::findOrFail($id);

            $params = [
                'title' => 'Delete member',
                'user' => $user,
            ];

            return view('admin.users.users_delete')->with($params);
        }
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }
    public function destroy($id)
    {
        //
        try
        {
            $user = User::find($id);

            $user->delete();

            return redirect()->route('users.index')->with('success', "The User <strong>$user->name</strong> has successfully been archived.");
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
