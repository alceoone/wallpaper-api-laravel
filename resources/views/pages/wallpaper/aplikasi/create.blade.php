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
                        <form method="post" action="{{ route('aplikasi.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        {{-- @method('post') --}}
                
                        <div>
                            <x-input-label for="nama_aplikasi" value="Nama Aplikasi" />
                            <x-text-input id="nama_aplikasi" name="nama_aplikasi" type="text" class="mt-1 block w-full" value="" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_aplikasi')" />
                        </div>

                        <div>
                            <x-input-label for="deskripsi_aplikasi" value="Deskripsi Aplikasi" />
                            {{-- use textarea-input component that we will create after this --}}
                            <x-textarea-input id="deskripsi_aplikasi" name="deskripsi_aplikasi" class="ckeditor mt-1 block w-full" required autofocus></x-textarea-input>
                            <x-input-error class="mt-2" :messages="$errors->get('deskripsi_aplikasi')" />
                        </div>

                        <div>
                            <x-input-label for="privacy_police_aplikasi" value="Privacy Police" />
                            {{-- use textarea-input component that we will create after this --}}
                            <x-textarea-input id="privacy_police_aplikasi" name="privacy_police_aplikasi" class="ckeditor mt-1 block w-full" required autofocus></x-textarea-input>
                            <x-input-error class="mt-2" :messages="$errors->get('privacy_police_aplikasi')" />
                        </div>

                        <div>
                            <x-input-label for="gambar_aplikasi" value="Gambar Aplikasi" />
                            <label class="block mt-2">
                                <span class="sr-only">Choose image</span>
                                <input type="file" id="gambar_aplikasi" name="gambar_aplikasi" class="block w-full text-sm text-slate-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-violet-50 file:text-violet-700
                                    hover:file:bg-violet-100
                                "/>
                            </label>
                            <div class="shrink-0 my-2">
                                <img id="gambar_aplikasi_preview" class="h-64 w-128 object-cover rounded-md" src="" alt="Gambar Aplikasi preview" />
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('gambar_aplikasi')" />
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

    <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
    <script>
        document.getElementById('gambar_aplikasi').onchange = function(evt) {
            const [file] = this.files
            if (file) {
                // if there is an image, create a preview in gambar_aplikasi_preview
                document.getElementById('gambar_aplikasi_preview').src = URL.createObjectURL(file)
            }
        }
    </script>
    
</x-app-layout>
