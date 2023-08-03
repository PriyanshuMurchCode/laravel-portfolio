<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User logout successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    } //end methond


    public function profile(){

        $id = Auth::user()->id;

        $adminData = User::find($id);

        return view('admin.admin_profile_view', compact('adminData'));
    } //end method

    public function editProfile(){

        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.admin_profile_edit', compact('adminData'));
    } //end method

    public function storeProfile(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->username = $request->username;

        if($request->file('profile-image')){
            $file = $request->file('profile-image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/admin_images'), $filename);
            $data['profile_image'] = $filename;
        }
        $data->save();
        $notification = array(
            'message' => 'User updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.profile')->with($notification);
    } //end method


    public function changePassword(){
        
        return view('admin.admin_change_password');
    } //end method

    public function updatePassword(Request $request){

        $validateData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'password_confirmation' => 'required| same:new_password',
        ]);

        $hashedPassword = Auth::user()->password;

        if(Hash::check($request->old_password, $hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = bcrypt($request->new_password);
            $user->save();

            session()->flash('message', 'Password updated successfully');
            return redirect()->back();
        }else{
            session()->flash('message', 'Old Password does not match');
            return redirect()->back();

        }
    } //end method
}
