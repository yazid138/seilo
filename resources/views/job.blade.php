<x-app-layout>

    <div class="py-11">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 p-10 gap-6">

                    @forelse ($jobs as $job)
                        <div class="card-body bg-white h-50 w-100 rounded shadow-lg border-r">
                            <div class="px-6 py-4">
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
                                    <div class="px-6 pt-4">
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
                                    <div class="px-6 pt-4 pb-2 text-center">
                                        <x-link class="mt-auto" href="{{ route('company.job.show', $job) }}">Detail
                                        </x-link>

                                    </div>


                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Tidak ada lowongan</p>
                    @endforelse



                    {{-- <table class="min-w-full">
                        <thead class="border-b"">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">No</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Judul
                                    Pekerjaan</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Deskripsi Pekerjaan</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Nama Perusahaan</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($counter = 1)
                            @forelse ($jobs as $job)
                                <tr class="border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $counter++ }}</td>
                                    <td>{{ $job->title }}</td>
                                    <td>{{ $job->description }}</td>
                                    <td>{{ $job->company->name }}</td>
                                    <td>
                                        <x-link href="{{ route('company.job.show', $job) }}">Detail</x-link>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
