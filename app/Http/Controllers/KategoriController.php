<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aplikasi;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;


use App\Http\Requests\Kategori\StoreRequest;
use App\Http\Requests\Kategori\UpdateRequest;

use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    public function index()
    {
        $dataApp = Aplikasi::orderBy('updated_at', 'desc')->get();

        return view("pages.wallpaper.kategori.index", compact('dataApp'));
    }

    public function store(StoreRequest $request) : RedirectResponse {

        $validated = $request->validated();

        if ($request->hasFile('gambar_kategori')) {
             // put image in the public storage
            $filePath = Storage::disk('public')->put('images/kategori/wallpaper', request()->file('gambar_kategori'));
            $validated['gambar_kategori'] = $filePath;
        }

        // insert only requests that already validated in the StoreRequest
        $create = Kategori::create($validated);

        if($create) {
            // add flash for the success notification
            session()->flash('notif.success', 'Kategori berhasil di buat!');
            return redirect()->route('aplikasi.index');
        }

        return abort(500);
    }
}
