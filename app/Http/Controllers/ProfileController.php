<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function updatePassword(Request $request)
    {
        // return $request->all();
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('password_error', 'Password saat ini tidak sesuai');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('password_success', 'Password berhasil diperbarui');
    }
}
