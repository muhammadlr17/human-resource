<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Auth;
use Hash;
use File;

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
            alert()->success('Success','Login Success to Admin Panel!');
            return redirect()->to('admin');
        } else if($role == "user"){
            alert()->success('Success','Login Success to Employee Panel!');
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
        alert()->success('Success','Your profile have been succesfully updated!');
        return redirect('profile');
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
                alert()->success('Success','Change password successfully!');
                return redirect("profile/reset/$username");
            } else {
                alert()->error('ErrorAlert','Old password invalid!');
                return redirect("profile/reset/$username");
            }
        } else {
            alert()->error('ErrorAlert','User not Found');
            return redirect('profile');
        }

    }
}
