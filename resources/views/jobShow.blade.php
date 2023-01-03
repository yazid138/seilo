<x-app-layout>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">

                    <div class="px-6 py-4">
                        <img class="" src="{{ $job->company->photo->url }}">
                        <div class="font-bold text-xl mt-4  mb-2">{{ $job->title }}</>
                            <p class="text-bold text-base mb-2">
                                {{ $job->company->name }}
                            </p>
                            <p class="text-gray-700 text-base">
                                <i class="fa-solid fa-location-dot"></i> {{ $job->location }}
                            </p>
                            <p class="text-gray-700 text-base">
                                <i class="fa-solid fa-briefcase"></i> {{ $job->position }}
                            </p>
                            <div class="pt-5">
                                <span
                                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-green-700 mr-2 mb-2">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ date('d-m-Y', strtotime($job->open_date)) }}
                                </span>

                                <span
                                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-red-700 mr-2 mb-2">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ date('d-m-Y', strtotime($job->close_date)) }}
                                </span>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p class="font-bold text-xl m-4  mb-2">Deskripsi</p>
                        <p class="m-4">
                            {{ $job->description }}
                        </p>

                    </div>
                </div>
                <div class="flex items-center justify-center mt-4 mb-4 p-4">
                    <x-link href="{{ route('user.hire.create', $job) }}"
                        class="ml-4 {{ $pernahLamar ? 'hidden' : '' }}">
                        {{ __('Lamar Sekarang') }}
                    </x-link>
                </div>
            </div>
        </div>
</x-app-layout>
