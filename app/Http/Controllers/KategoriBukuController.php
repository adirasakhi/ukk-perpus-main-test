<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriBuku;

class KategoriBukuController extends Controller
{
    public function index()
    {
        $categories = KategoriBuku::all();
        return view('adminPage.Kategori.index', compact('categories'));
    }

    public function create()
    {
        return view('adminPage.Kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori_buku|max:255',
        ]);

        KategoriBuku::create($request->all());

        return redirect()->route('kategori_buku.index')->with('success', 'Kategori buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategoriBuku = KategoriBuku::findOrFail($id);
        return view('adminPage.Kategori.edit', compact('kategoriBuku'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|max:255|unique:kategori_buku,nama_kategori,'.$id,
        ]);

        $kategoriBuku = KategoriBuku::findOrFail($id);
        $kategoriBuku->update($request->all());

        return redirect()->route('kategori_buku.index')->with('success', 'Kategori buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategoriBuku = KategoriBuku::findOrFail($id);
        $kategoriBuku->delete();

        return redirect()->route('kategori_buku.index')->with('success', 'Kategori buku berhasil dihapus.');
    }
}
