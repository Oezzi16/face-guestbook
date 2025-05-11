<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        abort(404);
        //return 404
        $guests = Guest::latest()->get();
        return view('guest.index', compact('guests'));
    }

    public function create()
    {
        return view('guest.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
            'message' => 'required|string',
            'photo_path' => 'required|string' // base64 image dari webcam
        ]);

        // Decode base64 image
        $image = $request->photo_path;
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = 'guest-' . time() . '.jpeg';

        \File::put(public_path('photos') . '/' . $imageName, base64_decode($image));

        $validated['photo_path'] = 'photos/' . $imageName;

        Guest::create($validated);

        return redirect()->route('guest.create')->with('success', 'Data tamu berhasil disimpan');
    }



    public function destroy(Guest $guest)
    {
        if (file_exists(public_path($guest->photo_path))) {
            unlink(public_path($guest->photo_path));
        }

        $guest->delete();

        return redirect()->route('guest.index')->with('success', 'Data tamu berhasil dihapus');
    }
}
