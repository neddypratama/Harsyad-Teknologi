<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.auth.profile');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|max:225',
            'name' => 'required|string|max:255',
        ]);

        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required|min:6',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::find($id);

        if (!Hash::check($request->input('old_password'), $user->password)) {
            return back()->withErrors(['old_password' => 'The provided password does not match our records.']);
        } else {
            $user->update([
                'password' => Hash::make($request->get('password'))
            ]);
            return back()->withPasswordStatus(__('Password successfully updated.'));
        }
    }

    public function destroy($id)
    {
        $check = User::findOrFail($id);
        if(!$check){
            return redirect()->route('profile.index')->withError(__('Account cannot finded.'));
        }
        try{
                User::destroy($id);
                return redirect()->route('profile.index')->withStatus(__('Account successfully deleted.'));
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('profile.index')->withError(__('Account data failed to be deleted because there is another table associated with this data.'));
        }
    }
}
