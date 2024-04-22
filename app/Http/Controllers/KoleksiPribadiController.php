<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KoleksiPribadi;


class KoleksiPribadiController extends Controller
{
    public function index()
    {
        $userCollection = KoleksiPribadi::where('user_id', auth()->id())->get();
        return view('userPage.koleksi_pribadi', ['collection' => $userCollection]);
    }

}
