<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
{
    $user = auth()->user();
    $borrowings = Peminjaman::where('user_id', $user->id)->get();
    $notReturnedCount = $borrowings->where('StatusPeminjaman', 'Dipinjam')->count() +
    $borrowings->where('StatusPeminjaman', 'DipinjamApprove')->count();

return view('profile.index', compact('user', 'borrowings', 'notReturnedCount'));
}
public function uploadPhoto(Request $request, $id)
{
    // Validate the form data
    $request->validate([
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file type and size as needed
    ]);

    // Find the user by ID
    $user = User::find($id);

    // Handle the file upload
    if ($request->hasFile('foto')) {
        $image = $request->file('foto');
        $imageName = 'profile_photo_' . $user->id . '.' . $image->getClientOriginalExtension();

        // Store the file in the storage directory
        Storage::putFileAs('public/profile_photos', $image, $imageName);

        // Update the user's profile photo field in the database
        $user->update(['foto' => $imageName]);

        return redirect()->back()->with('success', 'Profile photo uploaded successfully!');
    }

    return redirect()->back()->with('error', 'Failed to upload profile photo.');
}

}
