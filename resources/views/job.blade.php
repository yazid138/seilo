<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Job') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>List Job</h1>
                    <table class="min-w-full">
                        <thead class="border-b"">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">No</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Judul
                                    Pekerjaan</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Deskripsi Pekerjaan</th>
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
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
