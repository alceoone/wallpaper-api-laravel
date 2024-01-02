<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-wrap">
            <div class="w-2/3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-1">
                        <img src="{{ Storage::url($aplikasi->gambar_aplikasi) }} "
                            class="w-32 h-32 rounded border m-auto" />
                    </div>
                    <div class="mb-1">
                        <div class="text-md text-gray-500">Nama Aplikasi</div>
                        <div class="text-md bg-gray-50 text-gray-700 p-2 my-1 rounded border">
                            {{ $aplikasi->nama_aplikasi }}
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="text-md text-gray-500">key Aplikasi</div>
                        <div class="text-md bg-gray-50 text-gray-700 p-2 my-1 rounded border">
                            {{ $aplikasi->key_aplikasi }}
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="text-md text-gray-500">Deskripsi Aplikasi</div>
                        <div class="text-md bg-gray-50 text-gray-700 p-2 my-1 rounded border">
                            {{ $aplikasi->deskripsi_aplikasi }}
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="text-md text-gray-500">Privacy Police</div>
                        <div class="text-md bg-gray-50 text-gray-700 p-2 my-1 rounded border">
                            {{ $aplikasi->privacy_police }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/3">
                <div class="px-6 text-md">
                    Kategori
                </div>
                <div class="p-3 flex flex-wrap">
                    @foreach ($kategori_aplikasi as $item)
                        <div class="w-1.2/6 p-2">
                            <img src="{{ Storage::url($item->gambar_kategori) }}" class="w-32 h-32 rounded border">
                            {{ $item->nama_kategori }}
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="md:w-full flex flex-wrap">
                <div class="w-full p-6">
                    Assets Wallpaper
                </div>
                @foreach ($assets_aplikasi as $item)
                    <div class="w-1.2/12 p-2">
                        <img src="{{ Storage::url($item->gambar_asset_wallpaper) }}" class="w-28 h-48 rounded border">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
