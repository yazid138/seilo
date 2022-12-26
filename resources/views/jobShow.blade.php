<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Lamaran Pekerjaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2>Informasi Lamaran Pekerjaan</h2>

                    <!-- title -->
                    <div class="mt-4">
                        <x-input-label for="title" :value="__('Judul Pekerjaan')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            :value="old('title', $job->title)" disabled />
                    </div>

                    <!-- description -->
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Deskripsi Pekerjaan')" />
                        <x-text-area name="description" id="description" class="block mt-1 w-full" disabled>
                            {{ old('description', $job->description) }}
                        </x-text-area>
                    </div>

                    <!-- position -->
                    <div class="mt-4">
                        <x-input-label for="position" :value="__('Posisi Pekerjaan')" />
                        <x-text-input id="position" class="block mt-1 w-full" type="text" name="position"
                            :value="old('position', $job->position)" disabled />
                    </div>

                    <!-- location -->
                    <div class="mt-4">
                        <x-input-label for="location" :value="__('Lokasi Pekerjaan')" />
                        <x-text-input id="location" class="block mt-1 w-full" type="text" name="location"
                            :value="old('location', $job->location)" disabled />
                    </div>

                    <!-- open date -->
                    <div class="mt-4">
                        <x-input-label for="open_date" :value="__('Tanggal Dibuka Lamaran')" />
                        <x-text-input id="open_date" class="block mt-1 w-full" type="date" name="open_date"
                            :value="old('open_date', $job->open_date)" disabled />
                    </div>

                    <!-- close date -->
                    <div class="mt-4">
                        <x-input-label for="close_date" :value="__('Tanggal Ditutup Lamaran')" />
                        <x-text-input id="close_date" class="block mt-1 w-full" type="date" name="close_date"
                            :value="old('close_date', $job->close_date)" disabled />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-link href="{{ route('user.hire.create', $job) }}"
                            class="ml-4 {{ $pernahLamar ? 'hidden' : '' }}">
                            {{ __('Lamar') }}
                        </x-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
