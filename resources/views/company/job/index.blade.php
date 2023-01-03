<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="m-10 p-6 text-gray-900">
                    <x-link href="{{ route('company.job.create') }}">Tambah Job</x-link>

                    <table class="mt-10 min-w-full">
                        <thead class="border-b"">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">No</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Judul
                                    Pekerjaan</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Open Date</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Close Date</th>
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
                                    <td>{{ date('d-m-Y', strtotime($job->open_date)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($job->close_date)) }}</td>
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
