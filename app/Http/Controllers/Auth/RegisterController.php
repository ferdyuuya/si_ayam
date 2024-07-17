<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function index()
    {
        return view('profile.register');
    }

    public function userList()
    {
        return view('profile.index');
    }
    public function storeUser(Request $request)
    {
       if (Auth::user()->status != 0) { // 0 means false == not pengurus
            return redirect()->back()->with('error', 'Anda tidak memiliki izin.');
        }
         
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'status' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = $request->status;

        // dd($user);
        $user->save();

        return redirect('/userlist');
    }

    public function changePassword()
    {
        return view('profile.changepassword');
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
        ]);

        $user = User::find(auth()->user()->id);

        // Check if the current password matches the user's password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect('/userlist');
    }


    public function indexEdit($id)
    {
        $user = User::find($id);
        return view('profile.edit', compact('user'));
    }

    public function editUser(Request $request, $id)
    {
        if (Auth::user()->status != 0) { // 0 means false == not pengurus
                return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menambahkan stok.');
            }

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'status' => 'required'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = $request->status;
        $user->save();

        return redirect('/userlist');
    }

    public function deleteUser($id)
    {
        // Check if the current user is not a 'pengurus'
        if (Auth::user()->status != 0) { // 0 means not 'pengurus'
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus pengguna.');
        }

        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        // Delete the user
        $user->delete();

        // Redirect to profile page with success message
        return redirect('/userlist')->with('success', 'Pengguna berhasil dihapus.');
    }

}
