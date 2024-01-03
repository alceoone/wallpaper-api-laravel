<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap mx-auto justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Detail Aplikasi') }}
                </h2>
            </div>
        </div>
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
                        <div class="w-2/6 p-2 bg-white">
                            <img src="{{ Storage::url($item->gambar_kategori) }}" class="w-32 h-32 rounded border">
                            {{ $item->nama_kategori }}
                            <div x-data="{ isOpen: false }" @click.away="isOpen = false" class="my-1">
                                <button @click="isOpen = !isOpen"
                                    class="inline-flex justify-between w-full px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    id="options-menu" aria-haspopup="true" aria-expanded="true">
                                    Actions
                                    <svg x-show="!isOpen" class="w-5 h-5 ml-2 -mr-1" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 12a2 2 0 100-4 2 2 0 000 4zM10 2a2 2 0 100 4 2 2 0 000-4zm0 14a2 2 0 100 4 2 2 0 000-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <svg x-show="isOpen" class="w-5 h-5 ml-2 -mr-1" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M5 10a2 2 0 114 0 2 2 0 01-4 0zM10 12a2 2 0 100-4 2 2 0 000 4zm5-2a2 2 0 114 0 2 2 0 01-4 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>

                                <!-- Alpine.js dropdown menu -->
                                <div x-show="isOpen" @click="isOpen = false"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100 transform scale-100"
                                    x-transition:leave-end="opacity-0 transform scale-95"
                                    class="absolute mt-2 w-56 bg-white border border-gray-200 rounded-md shadow-lg origin-top-right"
                                    id="dropdown-menu" role="menu" aria-orientation="vertical"
                                    aria-labelledby="options-menu">
                                    <div class="py-1">
                                        <a href=""
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                            role="menuitem">Edit Gambar</a>
                                        <button onclick="openDeleteModal()"
                                            class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100 hover:text-red-900"
                                            role="menuitem">Hapus Gambar</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Full-screen Modal Background -->
                            <div id="deleteConfirmationModal" class="fixed inset-0 bg-black opacity-50 z-50 hidden">
                            </div>
                            <!-- Full-screen Modal Content -->
                            <div id="deleteModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                                <div class="bg-white p-6 rounded-md shadow-md w-1/2">
                                    <p class="text-gray-800 mb-4">Apa kamu yakin untuk menghapus
                                        kategori ini? ini akan menghapus semua asset yang berada di dalam
                                        kategori ini.</p>
                                    <form method="post"
                                        action="{{ route('kategori.destroy', ['id' => $item->id, 'idApp' => $item->aplikasi_id]) }}"
                                        class="inline flex justify-between">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded-md mr-2">Ya,
                                            Hapus Kategori!</button>
                                        <button type="button" onclick="closeDeleteModal()"
                                            class="border border-gray-400 px-4 py-2 rounded-md">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="md:w-full flex flex-wrap">
                <div class="w-full p-6">
                    Assets Wallpaper
                </div>
                @foreach ($assets_aplikasi as $item)
                    <div class="w-1.2/12 p-2 text-center">
                        <img src="{{ Storage::url($item->gambar_asset_wallpaper) }}"
                            class="w-28 h-48 rounded border my-2">
                        <a href=""
                            class="w-full center bg-red-50 py-1 px-3 rounded border border-red-600 btn text-red-600">Delete</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function openDeleteModal() {
        document.getElementById('deleteConfirmationModal').style.display = 'block';
        document.getElementById('deleteModal').style.display = 'flex';
    }

    function closeDeleteModal() {
        document.getElementById('deleteConfirmationModal').style.display = 'none';
        document.getElementById('deleteModal').style.display = 'none';
    }
</script>
