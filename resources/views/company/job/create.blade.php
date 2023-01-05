<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 mb-20">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('company.job.store') }}">
                        @csrf

                        <h2 class="font-bold text-xl">Tambah Lowongan Pekerjaan</h2>

                        <!-- title -->
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('Judul Pekerjaan')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Deskripsi Pekerjaan')" />
                            <x-text-area name="description" id="description" class="block mt-1 w-full">
                                {{ old('description') }}
                            </x-text-area>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- position -->
                        <div class="mt-4">
                            <x-input-label for="position" :value="__('Posisi Pekerjaan')" />
                            <x-text-input id="position" class="block mt-1 w-full" type="text" name="position"
                                :value="old('position')" required />
                            <x-input-error :messages="$errors->get('position')" class="mt-2" />
                        </div>

                        <!-- location -->
                        <div class="mt-4">
                            <x-input-label for="location" :value="__('Lokasi Pekerjaan')" />
                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location"
                                :value="old('location')" required />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <!-- open date -->
                        <div class="mt-4">
                            <x-input-label for="open_date" :value="__('Tanggal Dibuka Lamaran')" />
                            <x-text-input id="open_date" class="block mt-1 w-full" type="date" name="open_date"
                                :value="old('open_date')" required />
                            <x-input-error :messages="$errors->get('open_date')" class="mt-2" />
                        </div>

                        <!-- close date -->
                        <div class="mt-4">
                            <x-input-label for="close_date" :value="__('Tanggal Ditutup Lamaran')" />
                            <x-text-input id="close_date" class="block mt-1 w-full" type="date" name="close_date"
                                :value="old('close_date')" required />
                            <x-input-error :messages="$errors->get('close_date')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
