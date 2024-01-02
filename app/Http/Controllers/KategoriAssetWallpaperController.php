<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aplikasi;
use App\Models\Kategori;
use App\Models\AssetsWallpaper;
use App\Models\KategoriAssetWallpaper;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;


class KategoriAssetWallpaperController extends Controller
{
    public function index()
    {

        $dataApp = Aplikasi::orderBy('updated_at', 'desc')->get();
        // $dataApp->aplikasiKategori;

        return view("pages.wallpaper.assets.index", compact('dataApp'));
    }

    public function getSubcategoriesApiBlade($id)
    {
        $kategori = Kategori::where('aplikasi_id', $id)->get();

        return response()->json($kategori);
    }
    public function storeAssets(Request $request){

        if ($request->hasFile('featured_images')) {
            $images = $request->file('featured_images');
        
            foreach ($images as $image) {
                $filePath = $image->store('images/aplikasi/wallpaper/assets', 'public');
        
                AssetsWallpaper::create([
                    'kategori_id' => $request->kategori_id,
                    'aplikasi_id' => $request->aplikasi_id,
                    'tag' => $request->tag,
                    'gambar_asset_wallpaper' => $filePath,
                ]);
        
            }
            
            session()->flash('notif.success', 'Aplikasi berhasil di buat!');
            return redirect()->route('aplikasi.show', $request->aplikasi_id);
        }

        return abort(500);

    }
}
