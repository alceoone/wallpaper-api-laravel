<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aplikasi;
use App\Models\Kategori;
use App\Models\AssetsWallpaper;
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

    public function store(StoreRequest $request): RedirectResponse
    {

        $validated = $request->validated();

        if ($request->hasFile('gambar_kategori')) {
            // put image in the public storage
            $filePath = Storage::disk('public')->put('images/kategori/wallpaper', request()->file('gambar_kategori'));
            $validated['gambar_kategori'] = $filePath;
        }

        // insert only requests that already validated in the StoreRequest
        $create = Kategori::create($validated);

        if ($create) {
            // add flash for the success notification
            session()->flash('notif.success', 'Kategori berhasil di buat!');
            return redirect()->route('aplikasi.index');
        }

        return abort(500);
    }

    public function destroy(string $id, $idApp): RedirectResponse
    {
        $kategori = Kategori::findOrFail($id);

        Storage::disk('public')->delete($kategori->gambar_kategori);

        $assets = AssetsWallpaper::where('kategori_id', $kategori->id)->get();

        foreach ($assets as $asset) {
            Storage::disk('public')->delete($asset->gambar_asset_wallpaper);
        }

        AssetsWallpaper::where('kategori_id', $kategori->id)->delete();


        $delete = $kategori->delete($id);

        if ($delete) {
            session()->flash('notif.success', 'Aplikasi berhasi di hapus!');
            return redirect()->route('aplikasi.show', $idApp);
        }

        return abort(500);
    }
}
