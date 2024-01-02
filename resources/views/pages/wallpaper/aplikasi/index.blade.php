<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap mx-auto justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Aplikasi') }}
                </h2>
            </div>
            <div>
                <a href="{{ route('aplikasi.create') }}"
                    class="text-green-500 border border-green-500 hover:bg-green-500 hover:text-white px-4 py-2 rounded-md">Tambah
                    Aplikasi</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="border-collapse table-auto w-full text-sm">
                            <thead>
                                <tr>
                                    <th
                                        class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-center align-middle">
                                        Gambar</th>
                                    <th
                                        class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-center align-middle">
                                        Nama Aplikasi</th>
                                    <th
                                        class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-center align-middle">
                                        Key</th>
                                    <th
                                        class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-center align-middle">
                                        Created At</th>
                                    <th
                                        class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-center align-middle">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white" x-data="{ isOpen: false }">
                                @foreach ($aplikasiPosts as $post)
                                    <tr>
                                        <td
                                            class="border-b border-slate-100 dark:border-slate-200 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                            <img src="{{ Storage::url($post->gambar_aplikasi) }}"
                                                class="mx-auto h-24 w-24 object-cover object-center"
                                                alt="Aplikasi Image">
                                        </td>
                                        <td
                                            class="border-b border-slate-100 dark:border-slate-200 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                            {{ $post->nama_aplikasi }}</td>
                                        <td
                                            class="border-b border-slate-100 dark:border-slate-200 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                            {{ $post->key_aplikasi }}</td>
                                        <td
                                            class="border-b border-slate-100 dark:border-slate-200 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                            {{ $post->created_at }}</td>
                                        <td
                                            class="border-b border-slate-100 dark:border-slate-200 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                            <div x-data="{ isOpen: false }" @click.away="isOpen = false">
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
                                                        <a href="{{ route('aplikasi.show', $post->id) }}"
                                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                                            role="menuitem">Tampilkan Detail</a>
                                                        <a href="{{ route('aplikasi.edit', $post->id) }}"
                                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                                            role="menuitem">Edit Aplikasi</a>
                                                        <a href="{{ route('aplikasi.edit', $post->id) }}"
                                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                                            role="menuitem">Tambah Kategori</a>
                                                        <button onclick="openDeleteModal()"
                                                            class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100 hover:text-red-900"
                                                            role="menuitem">Hapus Aplikasi</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Full-screen Modal Background -->
                                            <div id="deleteConfirmationModal"
                                                class="fixed inset-0 bg-black opacity-50 z-50 hidden"></div>

                                            <!-- Full-screen Modal Content -->
                                            <div id="deleteModal"
                                                class="fixed inset-0 flex items-center justify-center z-50 hidden">
                                                <div class="bg-white p-6 rounded-md shadow-md w-1/2">
                                                    <p class="text-gray-800 mb-4">Apa kamu yakin untuk menghapus
                                                        aplikasi ini? ini akan menghapus semua asset yang berada di dalam aplikasi ini.</p>
                                                    <form method="post"
                                                        action="{{ route('aplikasi.destroy', $post->id) }}"
                                                        class="inline flex justify-between">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            class="bg-red-500 text-white px-4 py-2 rounded-md mr-2">Ya,
                                                            Hapus Aplikasi!</button>
                                                        <button type="button" onclick="closeDeleteModal()"
                                                            class="border border-gray-400 px-4 py-2 rounded-md">Cancel</button>
                                                    </form>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="my-4">
                            {{ $aplikasiPosts->links('vendor.pagination.tailwind') }}
                        </div>
                    </div>
                </div>
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
