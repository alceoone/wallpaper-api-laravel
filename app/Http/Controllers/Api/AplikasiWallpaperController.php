<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aplikasi;
use App\Models\Kategori;
use App\Models\AssetsWallpaper;

class AplikasiWallpaperController extends Controller
{
    private function checkAplikasi(string $key)
    {
        return Aplikasi::where('key_aplikasi', $key)->firstOrFail();
    }

    private function jsonResponse($data, $status = 200)
    {
        return response()->json($data, $status);
    }

    public function index(Request $request, $key)
    {
        try {
            $data = $this->checkAplikasi($key);
            $assetWallpaper = AssetsWallpaper::select(
                "id",
                "kategori_id",
                "aplikasi_id",
                "tag",
                "gambar_asset_wallpaper",
                "view_count",
                "created_at",
                "updated_at"
            )->where('aplikasi_id', $data->id)->get();

            return $this->jsonResponse($assetWallpaper);
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], 401);
        }
    }
    public function getNewView(Request $request, $key){
        try {
            $data = $this->checkAplikasi($key);
        
            $assetWallpaper = AssetsWallpaper::select(
                    "id",
                    "kategori_id",
                    "aplikasi_id",
                    "tag",
                    \DB::raw('CONCAT("'.env('APP_URL').'","/storage/", COALESCE(gambar_asset_wallpaper, "")) AS gambar_asset_wallpaper'),
                    "view_count",
                    "created_at",
                    "updated_at"
                )->where('aplikasi_id', $data->id)
                ->orderBy('created_at', 'desc')
                ->limit(6)
                ->get();
        
            return $this->jsonResponse($assetWallpaper, 200);
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], 401);
        }
        
    }
    public function getTopView(Request $request, $key){
        try {
            $data = $this->checkAplikasi($key);
            $assetWallpaper = AssetsWallpaper::select(
                "id",
                "kategori_id",
                "aplikasi_id",
                "tag",
                \DB::raw('CONCAT("'.env('APP_URL').'","/storage/", COALESCE(gambar_asset_wallpaper, "")) AS gambar_asset_wallpaper'),
                "view_count",
                "created_at",
                "updated_at"
            )->where('aplikasi_id', $data->id)
                            ->orderBy('view_count', 'desc')
                            ->limit(6)
                            ->get();

            return $this->jsonResponse($assetWallpaper);
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], 401);
        }
    }
    public function getPageSplitView(Request $request, $key){
        try {
            $data = $this->checkAplikasi($key);
            $assetWallpaper = AssetsWallpaper::select(
                                "id",
                                "kategori_id",
                                "aplikasi_id",
                                "tag",
                                \DB::raw('CONCAT("'.env('APP_URL').'","/storage/", COALESCE(gambar_asset_wallpaper, "")) AS gambar_asset_wallpaper'),
                                "view_count",
                                "created_at",
                                "updated_at"
                            )->where('aplikasi_id', $data->id)
                            ->orderBy('view_count', 'desc')
                            ->paginate(1);

            return $this->jsonResponse($assetWallpaper->items());
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], 401);
        }
    }
    public function getAllView(Request $request, $key){
        try {
            $data = $this->checkAplikasi($key);
            $assetWallpaper = AssetsWallpaper::select(
                                "id",
                                "kategori_id",
                                "aplikasi_id",
                                "tag",
                                \DB::raw('CONCAT("'.env('APP_URL').'","/storage/", COALESCE(gambar_asset_wallpaper, "")) AS gambar_asset_wallpaper'),
                                "view_count",
                                "created_at",
                                "updated_at"
                            )->where('aplikasi_id', $data->id)
                            ->orderBy('view_count', 'desc')
                            ->paginate(6);

            return $this->jsonResponse($assetWallpaper->items());
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], 401);
        }
    }
    public function viewCountAssets($id){
        $asset = AssetsWallpaper::find($id);
        if ($asset) {
            $asset->view_count++;
            $asset->save();
        }
    }

    public function category($key)
    {
        try {
            $data = $this->checkAplikasi($key);
            $dataKategori = Kategori::select(
                "id",
                "aplikasi_id",
                "nama_kategori",
                \DB::raw('CONCAT("'.env('APP_URL').'","/storage/", COALESCE(gambar_kategori, "")) AS gambar_kategori'),
                "created_at",
                "updated_at"
            )->where('aplikasi_id', $data->id)->get();

            return $this->jsonResponse($dataKategori);
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], 401);
        }
    }

    public function getKategoriNewView(Request $request, $id){
        try {
        
            $assetWallpaper = AssetsWallpaper::select(
                    "id",
                    "kategori_id",
                    "aplikasi_id",
                    "tag",
                    \DB::raw('CONCAT("'.env('APP_URL').'","/storage/", COALESCE(gambar_asset_wallpaper, "")) AS gambar_asset_wallpaper'),
                    "view_count",
                    "created_at",
                    "updated_at"
                )->where('kategori_id', $id)
                ->orderBy('created_at', 'desc')
                ->limit(6)
                ->get();
        
            return $this->jsonResponse($assetWallpaper, 200);
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], 401);
        }
        
    }
    public function getKategoriTopView(Request $request, $id){
        try {
            $assetWallpaper = AssetsWallpaper::select(
                "id",
                "kategori_id",
                "aplikasi_id",
                "tag",
                \DB::raw('CONCAT("'.env('APP_URL').'","/storage/", COALESCE(gambar_asset_wallpaper, "")) AS gambar_asset_wallpaper'),
                "view_count",
                "created_at",
                "updated_at"
            )->where('kategori_id', $id)
                            ->orderBy('view_count', 'desc')
                            ->limit(6)
                            ->get();

            return $this->jsonResponse($assetWallpaper);
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], 401);
        }
    }
    public function getKategoriPageSplitView(Request $request, $id){
        try {
            $assetWallpaper = AssetsWallpaper::select(
                                "id",
                                "kategori_id",
                                "aplikasi_id",
                                "tag",
                                \DB::raw('CONCAT("'.env('APP_URL').'","/storage/", COALESCE(gambar_asset_wallpaper, "")) AS gambar_asset_wallpaper'),
                                "view_count",
                                "created_at",
                                "updated_at"
                            )->where('kategori_id', $id)
                            ->orderBy('view_count', 'desc')
                            ->paginate(1);

            return $this->jsonResponse($assetWallpaper->items());
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], 401);
        }
    }
    public function getKategoriForYouView(Request $request, $id){
        try {
            $assetWallpaper = AssetsWallpaper::select(
                                "id",
                                "kategori_id",
                                "aplikasi_id",
                                "tag",
                                \DB::raw('CONCAT("'.env('APP_URL').'","/storage/", COALESCE(gambar_asset_wallpaper, "")) AS gambar_asset_wallpaper'),
                                "view_count",
                                "created_at",
                                "updated_at"
                            )->where('kategori_id', $id)
                            ->orderBy('view_count', 'desc')
                            ->paginate(1);

            return $this->jsonResponse($assetWallpaper->items());
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], 401);
        }
    }
    
    public function getKategoriAllView(Request $request, $id){
        try {
            $assetWallpaper = AssetsWallpaper::select(
                                "id",
                                "kategori_id",
                                "aplikasi_id",
                                "tag",
                                \DB::raw('CONCAT("'.env('APP_URL').'","/storage/", COALESCE(gambar_asset_wallpaper, "")) AS gambar_asset_wallpaper'),
                                "view_count",
                                "created_at",
                                "updated_at"
                            )->where('kategori_id', $id)
                            ->orderBy('view_count', 'desc')
                            ->paginate(1);

            return $this->jsonResponse($assetWallpaper->items());
        } catch (\Exception $e) {
            return $this->jsonResponse(['error' => $e->getMessage()], 401);
        }
    }
}
