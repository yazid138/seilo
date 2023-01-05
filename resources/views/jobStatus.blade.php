<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="m-10 p-6 text-gray-900">
                    <h1 class="font-bold text-xl mb-5">Data Pelamar</h1>
                    @switch(Auth::user()->role)
                        @case('COMPANY')
                            <table class="min-w-full">
                                <thead class="border-b"">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">No</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Nama
                                            Pelamar</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Judul
                                            Pekerjaan</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Posisi
                                            Pekerjaan</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Status
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($counter = 1)
                                    @forelse ($hires as $hire)
                                        <tr class="border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $counter++ }}</td>
                                            <td>{{ $hire->user->name }}</td>
                                            <td>{{ $hire->job->title }}</td>
                                            <td>{{ $hire->job->position }}</td>
                                            <td>
                                                @if ($hire->isApprove === 1)
                                                    Diterima
                                                @elseif($hire->isApprove === 0)
                                                    Ditolak
                                                @else
                                                    Diproses
                                                @endif
                                            </td>
                                            <td>
                                                <x-link href="{{ route('hire.detail', $hire) }}">Detail</x-link>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        @break

                        @default
                            <table class="min-w-full">
                                <thead class="border-b"">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">No</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Judul
                                            Pekerjaan</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Posisi
                                            Pekerjaan</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Nama
                                            Perusahaan</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($counter = 1)
                                    @forelse ($hires as $hire)
                                        <tr class="border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $counter++ }}</td>
                                            <td>{{ $hire->job->title }}</td>
                                            <td>{{ $hire->job->position }}</td>
                                            <td>{{ $hire->company->name }}</td>
                                            <td>
                                                @if (isset($hire->isApprove))
                                                    <x-link href="{{ route('hire.detail', $hire) }}">Lihat Jawaban</x-link>
                                                @else
                                                    Diproses
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        @endswitch

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
