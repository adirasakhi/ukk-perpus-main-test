<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\KategoriBuku;

class BookController extends Controller
{
    public function show($id)
    {
        $book = Buku::with('ulasan_buku')->findOrFail($id);

        return view('buku.show', compact('book'));
    }
    public function index()
    {
        $books = Buku::all();
        $categories = KategoriBuku::all();
        return view('admin.books.index', compact('books','categories'));
    }

    public function create()
    {
        $categories = KategoriBuku::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'sinopsis' => 'nullable',
            'kategori_id' => 'required|exists:kategori_buku,id',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('book_images', 'public');
        }

        $book = new Buku;
        $book->judul = $request->judul;
        $book->penulis = $request->penulis;
        $book->penerbit = $request->penerbit;
        $book->tahun_terbit = $request->tahun_terbit;
        $book->sinopsis = $request->sinopsis;
        $book->kategori_id = $request->kategori_id;
        $book->gambar = $imagePath;
        $book->save();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $book = Buku::findOrFail($id);
        $categories = KategoriBuku::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'sinopsis' => 'nullable',
            'kategori_id' => 'required|exists:kategori_buku,id',
        ]);

        $book = Buku::findOrFail($id);
        $book->update($request->all());

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $book = Buku::findOrFail($id);
        $book->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
    }
}
