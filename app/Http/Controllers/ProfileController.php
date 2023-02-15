<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //direct profile page
    public function index(){
        $user = User::select('id','name','email','phone','address','gender')
                    ->where('id',Auth::user()->id)->first();
        return view('admin.profile.index',compact('user'));
    }

    //update admin account
    public function updateAdminAccount(Request $request){
        $userData = $this->getUserInfo($request);
        $this->userValidationCheck($request);
        User::where('id',Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess' => 'Account Updated!']);

    }

    //direct change password
    public function directChangePassword(){
        return view('admin.profile.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword = $user->password;


        if(Hash::check($request->oldPassword, $dbPassword)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            return redirect()->route('dashboard');

        }else{
            return back()->with(['fail' => 'Old password does not match!']);
        }
    }

    //get request user data
    private function getUserInfo($request){
        return [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'phone' => $request->adminPhone,
            'address' => $request->adminAddress,
            'gender' => $request->adminGender,
            'updated_at' => Carbon::now()
                ];
    }

    //validation check
    private function userValidationCheck($request){
        Validator::make($request->all(),
            [
                'adminName' => 'required',
                'adminEmail' => 'required',
            ])->validate();
    }

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword',
        ])->validate();
    }


}
