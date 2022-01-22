<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public  function UserView(){
        $data['allData'] = User::all();
        return view('backend.user.view_user',$data);
    }

    public function UserAdd(){
        return view('backend.user.add_user');
    }


    public function UserStore(UserRequest $request){
        $data=$request->except(['_token','_method']);
        $code = rand(0000,9999);
          User::create([
            "usertype" => 'Admin',
            "name" => $data["name"],
            "email" => $data["email"],
            'role'=>$data['role'],
            'code'=>$code,
            "password" =>  Hash::make($code)
        ]);
        $notification = array(
            'message' => 'User Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.view')->with($notification);
    }



    public function UserEdit($id){
        $user = User::find($id);
        return view('backend.user.edit_user',compact('user'));

    }


    public function UserUpdate(UserRequest $request, $id){
        $data=$request->except(['_token','_method']);
        User::where('id',$id)->update($data);
        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('user.view')->with($notification);
    }

    public function UserDelete($id){
        $user = User::find($id);
        $user->delete();

        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('user.view')->with($notification);

    }
}
