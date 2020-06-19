<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;

class usersController extends Controller
{
    //---- users view ----//
    public function view(){
        $users = User::all();
    	return view('layouts.Backend.users.usersView', compact('users'));
    }
    //---- users Add ----//
    public function add(){
    	return view('layouts.Backend.users.usersAdd');
    }
    //---- users Store ----//
    public function store(Request $request){
        // Validation 
         $validation = $request->validate([
        	'userRole' => 'required',
        	'name'     => 'required',
        	'email'    => 'required|email',
        	'password' => 'required|min:5',
        	'mobile'   => 'required',
        	'image'    => 'required|image'
        ]);
        // Image Check
       if($request->file('image')){
       	$file = $request->file('image');
       	 $fileName = time(). $file->getClientOriginalName();
       	 $filePath = public_path('/assets/Backend/images/');
       	 $file->move($filePath, $fileName);
       }
       // insert data
       $data = new User;
       $data->userRole = $request->userRole;
       $data->name     = $request->name;
       $data->email    = $request->email;
       $data->password = Hash::make($request->password);
       $data->number   = $request->mobile;
       $data->shopName = $request->shopName;
       $data->address  = $request->address;
       $data->profile  = $fileName;
       $data->save();

       // Redirect 
      return redirect()->route('users.view')->with('success', 'User Added Successfully');

    }
    //---- users Edit ----//
    public function edit($id){
    	$userEdit['edits'] = User::select('id','userRole','name','email','number','shopName','address','profile')->find($id);
    	return view('layouts.Backend.users.usersEdit', $userEdit);
    }
    //---- users Update ----//
    public function update($id, Request $request){
         // Validation 
    	$validation = $request->validate([
        	'userRole' => 'required',
        	'name'     => 'required',
        	'email'    => 'required|email',
        	'mobile'   => 'required'
        ]);
        // update
        $userUpdate = User::find($id);
        // Image Check
       if($request->file('image')){
         $file = $request->file('image');
         @unlink(public_path('assets/Backend/images/'.$userUpdate->profile));
       	 $fileName = time(). $file->getClientOriginalName();
       	 $filePath = public_path('/assets/Backend/images/');
       	 $file->move($filePath, $fileName);
       	 $userUpdate['profile'] = $fileName;
       }
       // Update 
       $userUpdate->userRole = $request->userRole;
       $userUpdate->name     = $request->name;
       $userUpdate->email    = $request->email;
       $userUpdate->number   = $request->mobile;
       $userUpdate->shopName = $request->shopName;
       $userUpdate->address  = $request->address;
       $userUpdate->save();
       // Redirect
       return redirect()->route('users.view')->with('success', 'User Updated Successfully');
    }
    //---- users Delete ----//
    public function delete($id){
        $userDelete = User::find($id);
        @unlink(public_path('assets/Backend/images/'. $userDelete->profile));
        $userDelete->delete();
        return redirect()->route('users.view')->with('success', 'User Deleted Successfully');
    }
    //---- users Password View ----//
    public function passwordView(){
      return view('layouts.Backend.users.passwordChange');
    }
    //---- users Password Update ----//
    public function passwordUpdate(Request $request){
          if(Auth::attempt(['id'=>Auth::user()->id, 'password'=>$request->current_password])){
            // validation
            $validation = $request->validate([
              'password' => 'required|confirmed'
            ]);
            // Change Password
            $user = User::find(Auth::user()->id);
            $user->update([
              'password' => Hash::make($request->password)
            ]);
            // Redirect
            return redirect()->back()->with('success','Your Password Update Successfully');
          } else{
            return redirect()->back()->with('error','Your Current Password Not Match');
          }
    }
}
