<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    // Profile Page
    public function page() {
        return view('user.profile.profilePage');
    }

    // Profile Edit Page
    public function editPage() {
        return view('user.profile.profileEdit');
    }

    // Profile Edit
    public function edit(Request $request) {

        $this->profileValidation($request) ;
        $data = $this->profileData($request) ;

        if( $request->hasFile('profile') ) {

            if( Auth::user()->profile != null ) {
                if( file_exists(public_path('/ProfileImage/' . Auth::user()->profile) ) ) {
                    unlink( public_path('/ProfileImage/' . Auth::user()->profile) );
                }
            }

            $file = $request->file('profile') ;
            $fileName = uniqid() . $file->getClientOriginalName() ;
            $file->move(public_path(). '/ProfileImage/' , $fileName) ;

            $data['profile'] = $fileName ;
        }else {
            $data['profile'] = Auth::user()->profile ;
        }

        User::where('id', Auth::user()->id)->update($data) ;

        Alert::warning('Update Profile', 'Profile Update Success');

        return to_route('user#profile#page')->with('update',"Profile Update Successfully");
    }

    // Change Password Page
    public function changePasswordPage() {
        return view('user.profile.changePassword');
    }

    // Change Password
    public function changePassword(Request $request) {

        $this->changePasswordValidation($request) ;

        $oldPassword = $request->currentPassword ;

        if( Hash::check($oldPassword, Auth::user()->password) ) {

            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);

            Alert::success('Change Password', 'Password Change Successfully');

            return to_route('user#profile#page')->with('pwSuccess', 'Your Password has been changed');

            // Auth::logout();

            // $request->session()->invalidate();

            // $request->session()->regenerateToken();

            // return redirect('/');
        }else {
            Alert::error('Password Error', 'Current Password do not match!');

            return back()->with('pwError', 'Current Password do not Match!');
        }
    }

// Private Function
    // Profile Validation
    private function profileValidation($request) {

        $rule = [
            'name' => 'required' ,
            'email' => 'required|unique:users,email,' . Auth::user()->id ,
            'phone' => 'required|unique:users,phone,' . Auth::user()->id ,
            'profile' => 'file|mimes:png,jpg,jpeg'
        ];

        $request->validate($rule) ;
    }

    // Profile Data
    private function profileData($request) {

        return [
            'name' => $request->name ,
            'email' => $request->email ,
            'phone' => $request->phone ,
            'address' => $request->address
        ];
    }

    // Change Password Validation
    private function changePasswordValidation($request) {

        $rule = [
            'currentPassword' => 'required|min:8|max:99' ,
            'newPassword' => 'required|min:8|max:99|same:confirmPassword' ,
            'confirmPassword' => 'required|min:8|max:99' ,
        ];

        $request->validate($rule);
    }

}
