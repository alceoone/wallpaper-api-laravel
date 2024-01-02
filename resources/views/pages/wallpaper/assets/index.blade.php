<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Aplikasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        {{-- <form method="post" action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">class="mt-6 space-y-6"> --}}
                        <form method="post" action="{{ route('assets.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            {{-- add @method('put') for edit mode --}}
                            @isset($post)
                                @method('put')
                            @endisset
                            <div>
                                <x-input-label for="aplikasi_id" value="Nama Aplikasi" class="my-3" />
                                <select name="aplikasi_id" id="aplikasi_id"
                                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    required>

                                    <option value="" disabled selected>Pilih Aplikasi</option>
                                    @foreach ($dataApp as $option)
                                        <option value="{{ $option->id }}">{{ $option->nama_aplikasi }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('aplikasi_id')" />
                            </div>

                            <div>
                                <x-input-label for="kategori_id" value="Kategori" class="my-3" />
                                <select name="kategori_id" id="kategori_id"
                                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    required>
                                    <option value="" disabled selected>Pilih kategori</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('kategori_id')" />
                            </div>

                            <div>
                                <x-input-label for="tag" value="Tag" class="my-3" />
                                <x-text-input id="tag" name="tag" type="text" class="mt-1 block w-full"
                                    value="" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('tag')" />
                            </div>

                            <div>
                                <x-input-label for="featured_images" value="Featured Images" class="my-3" />
                                <label class="block mt-2">
                                    <span class="sr-only">Choose images</span>
                                    <input type="file" id="featured_images" name="featured_images[]"
                                        class="block w-full text-sm text-slate-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-violet-50 file:text-violet-700
                                            hover:file:bg-violet-100"
                                        multiple />
                                </label>
                                <div class="shrink-0 my-2">
                                    <div id="featured_images_preview" class="flex space-x-4">
                                        @if (isset($post) && $post->featured_images->count() > 0)
                                            @foreach ($post->featured_images as $index => $image)
                                                <div class="relative">
                                                    <img class="h-24 w-32 object-cover rounded-md"
                                                        src="{{ Storage::url($image) }}" alt="Featured image preview" />
                                                    <button type="button"
                                                        class="absolute top-0 right-0 p-1 bg-red-500 text-white rounded-full"
                                                        onclick="removeImage({{ $index }})">
                                                        X
                                                    </button>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('featured_images.*')" />
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('aplikasi_id').addEventListener('change', function() {
            var categoryId = this.value;

            // Menggunakan AJAX untuk mendapatkan subkategori berdasarkan kategori yang dipilih
            fetch('/assets/kategori/' + categoryId)
                .then(response => response.json())
                .then(data => {
                    var kategoriSelect = document.getElementById('kategori_id');
                    kategoriSelect.innerHTML =
                        '<option value="" disabled selected>Pilih Kategori</option>';

                    data.forEach(function(kategori) {
                        var option = document.createElement('option');
                        option.value = kategori.id;
                        option.text = kategori.nama_kategori;
                        kategoriSelect.add(option);
                    });
                });
        });

        // create onchange event listener for featured_images input
        document.getElementById('featured_images').onchange = function(evt) {
            const previewContainer = document.getElementById('featured_images_preview');
            previewContainer.innerHTML = ''; // Clear previous previews

            const files = this.files;
            if (files.length > 0) {
                // if there are images, create previews in featured_images_preview
                Array.from(files).forEach(file => {
                    const imgContainer = document.createElement('div');
                    imgContainer.className = 'relative';

                    const img = document.createElement('img');
                    img.className = 'h-24 w-32 object-cover rounded-md';
                    img.src = URL.createObjectURL(file);

                    const deleteBtn = document.createElement('button');
                    deleteBtn.type = 'button';
                    deleteBtn.className = 'absolute top-0 right-0 p-1 bg-red-500 text-white rounded-full';
                    deleteBtn.innerText = 'X';
                    deleteBtn.onclick = function() {
                        removeImage(imgContainer);
                    };

                    imgContainer.appendChild(img);
                    imgContainer.appendChild(deleteBtn);
                    previewContainer.appendChild(imgContainer);
                });
            }
        }

        function removeImage(container) {
            container.remove();
        }
    </script>

</x-app-layout>
