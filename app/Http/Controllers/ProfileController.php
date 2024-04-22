<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

return view('userPage.profile.index', compact('user', 'borrowings', 'notReturnedCount'));
}
public function uploadPhoto(Request $request, $id)
{
    // Validate the form data
    $request->validate([
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file type and size as needed
        'username' => 'required|unique:users,username,' . $id,
        'email' => 'required|email|unique:users,email,' . $id,
        'nama_lengkap' => 'required',
        'alamat' => 'required',
    ]);


    // Find the user by ID
    $user = User::find($id);
    $user->update([
        'username' => $request->input('username'),
        'email' => $request->input('email'),
        'nama_lengkap' => $request->input('nama_lengkap'),
        'alamat' => $request->input('alamat'),
    ]);
    // Handle the file upload
    if ($request->hasFile('foto')) {
        $image = $request->file('foto');
        $imageName = 'profile_photo_' . $user->id . '.' . $image->getClientOriginalExtension();

        // Store the file in the storage directory
        Storage::putFileAs('public/profile_photos', $image, $imageName);

        $user->update(['foto' => $imageName]);

        return redirect()->back()->with('success', 'Profile photo uploaded successfully!');
    }

    return redirect()->back()->with('error', 'Failed to upload profile photo.');
}

}
