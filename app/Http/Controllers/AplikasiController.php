<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use App\Models\Kategori;
use App\Models\AssetsWallpaper;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests\Aplikasi\StoreRequest;
use App\Http\Requests\Aplikasi\UpdateRequest;

use Illuminate\Support\Facades\Storage;

class AplikasiController extends Controller
{
    public function index(Request $request) : Response {
        return response()->view('pages.wallpaper.aplikasi.index', [
            'aplikasiPosts' => Aplikasi::orderBy('updated_at', 'desc')->paginate(5),
        ]);
    }

    public function create() {
        return view("pages.wallpaper.aplikasi.create");
    }

    public function store(StoreRequest $request) : RedirectResponse {

        $validated = $request->validated();

        if ($request->hasFile('gambar_aplikasi')) {
             // put image in the public storage
            $filePath = Storage::disk('public')->put('images/aplikasi/wallpaper', request()->file('gambar_aplikasi'));
            $validated['gambar_aplikasi'] = $filePath;
        }

        // insert only requests that already validated in the StoreRequest
        $create = Aplikasi::create($validated);

        if($create) {
            // add flash for the success notification
            session()->flash('notif.success', 'Aplikasi berhasil di buat!');
            return redirect()->route('aplikasi.index');
        }

        return abort(500);
    }

    public function show(string $id): Response
    {
        return response()->view('pages.wallpaper.aplikasi.show', [
            'aplikasi' => Aplikasi::findOrFail($id),
            'kategori_aplikasi' => Kategori::where('aplikasi_id', $id)->get(),
            'assets_aplikasi' => AssetsWallpaper::where('aplikasi_id', $id)->get()
        ]);
    }

    public function edit(string $id): Response
    {
        return response()->view('posts.form', [
            'post' => Aplikasi::findOrFail($id),
        ]);
    }

    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        $Aplikasi = Aplikasi::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {
            // delete image
            Storage::disk('public')->delete($Aplikasi->featured_image);

            $filePath = Storage::disk('public')->put('images/Aplikasis/featured-images', request()->file('featured_image'), 'public');
            $validated['featured_image'] = $filePath;
        }

        $update = $Aplikasi->update($validated);

        if($update) {
            session()->flash('notif.success', 'Aplikasi updated successfully!');
            return redirect()->route('Aplikasis.index');
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $aplikasi = Aplikasi::findOrFail($id);

        Storage::disk('public')->delete($aplikasi->gambar_aplikasi);
        
        $delete = $aplikasi->delete($id);

        if($delete) {
            session()->flash('notif.success', 'Aplikasi berhasi di hapus!');
            return redirect()->route('aplikasi.index');
        }

        return abort(500);
    }
}
