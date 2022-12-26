<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lamar Pekerjaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('user.hire.store', $job) }}" enctype="multipart/form-data">
                        @csrf

                        <!-- CV -->
                        <div class="mt-4">
                            <x-input-label for="cv" :value="__('CV')" />
                            <x-text-input id="cv" class="block mt-1 w-full" type="file" name="cv"
                                :value="old('cv')" />
                            <x-input-error :messages="$errors->get('cv')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Lamar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
