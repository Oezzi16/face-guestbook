<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class AdminGuestController extends Controller
{
    public function index(Request $request)
    {
        $query = Guest::latest();
        
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }
        
        $guests = $query->paginate(10);
        return view('admin.guests.index', compact('guests'));
    }

    public function print(Request $request)
    {
        $query = Guest::latest();
        
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }
        
        $guests = $query->get();
        return view('admin.guests.print', compact('guests'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        
        $guests = Guest::where('name', 'like', '%'.$search.'%')
            ->orWhere('email', 'like', '%'.$search.'%')
            ->orWhere('phone', 'like', '%'.$search.'%')
            ->latest()
            ->paginate(10);
            
        return view('admin.guests.index', compact('guests', 'search'));
    }

    public function destroy(Guest $guest)
    {
        if ($guest->photo_path && file_exists(public_path($guest->photo_path))) {
            unlink(public_path($guest->photo_path));
        }
        
        $guest->delete();
        return redirect()->route('admin.guests.index')->with('success', 'Data tamu berhasil dihapus');
    }
}