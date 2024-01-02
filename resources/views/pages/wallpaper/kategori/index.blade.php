<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('kategori.store') }}" class="mt-6 space-y-6"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-input-label for="aplikasi_id" value="Nama Aplikasi" class="my-3" />
                            <div class="mb-5">
                                <select name="aplikasi_id"
                                    class="form-select appearance-none  
                                      block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    required>
                                    {{-- <option value="1" {{ old('status', $post->status) == 1 ? 'selected' : '' }}>Publish</option>
                                    <option value="0" {{ old('status', $post->status) == 0 ? 'selected' : '' }}>Draft</option> --}}
                                    @foreach ($dataApp as $option)
                                        <option value="{{ $option->id }}">{{ $option->nama_aplikasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('aplikasi_id')" />
                        </div>

                        <div>
                            <x-input-label for="nama_kategori" value="Kategori Aplikasi" class="my-3" />
                            <x-text-input id="nama_kategori" name="nama_kategori" type="text"
                                class="mt-1 block w-full" value="" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_kategori')" />
                        </div>

                        <div>
                            <x-input-label for="gambar_kategori" value="Gambar kategori" />
                            <label class="block mt-2">
                                <span class="sr-only">Choose image</span>
                                <input type="file" id="gambar_kategori" name="gambar_kategori"
                                    class="block w-full text-sm text-slate-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-violet-50 file:text-violet-700
                                    hover:file:bg-violet-100" />
                            </label>
                            <div class="shrink-0 my-2">
                                <img id="gambar_kategori_preview" class="h-64 w-128 object-cover rounded-md"
                                    src="" alt="Gambar kategori preview" />
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('gambar_kategori')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('gambar_kategori').onchange = function(evt) {
            const [file] = this.files
            if (file) {
                document.getElementById('gambar_kategori_preview').src = URL.createObjectURL(file)
            }
        }
    </script>
</x-app-layout>
