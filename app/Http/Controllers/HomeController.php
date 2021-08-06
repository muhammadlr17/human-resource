<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Auth;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = Auth::user()->role;
        if($role == "admin"){
            return redirect()->to('admin');
        } else if($role == "user"){
            return redirect()->to('user');
        } else {
            return redirect()->to('logout');
        }
    }

    public function profile()
    {
        return view('profile');
    }

    public function profileUpdate(ProfileRequest $request, User $user)
    {
        $data = $request->all();
        if($request->file('photo')){
            File::delete('image/profile/'.$user->photo);
            $file = $request->file('photo');
            $nama_file = time().str_replace(" ","", $file->getClientOriginalName());
            $file->move('image/profile', $nama_file);
            $data['photo'] = $nama_file; 
        }
        $user->update($data);
        return redirect('profile')->with('success','Your profile have been succesfully updated!');
    }

    public function reset($username)
    {
        $user = User::where('username', $username)->first();
        return view('reset', compact(
            'user'
        ));
    }

    public function resetPassword(ResetPasswordRequest $request, $username)
    {
        $employee = User::where('username', $username)->first();
        if ($employee) {
            if(Hash::check($request->old_password, $employee->password)) {
                $employee->password = $request->password;
                $employee->save();
                return redirect("profile/reset/$username")->with('success','Change password successfully!');
            } else {
                return redirect("profile/reset/$username")->with('failed','Old password invalid!');
            }
        } else {
            return redirect('profile')->with('failed','User not Found');
        }
        
    }
}
