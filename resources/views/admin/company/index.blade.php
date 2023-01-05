<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="p-6 text-gray-900">
                    <x-link class="mb-10" href="{{ route('admin.company.create') }}">Tambah Company</x-link>

                    <table class="min-w-full" id="table">
                        <thead class="border-b"">
                            <tr>
                                {{-- <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">No</th> --}}
                                <th colspan="1" scope="col"
                                    class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Nama
                                    Perusahaan</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Contact
                                    Perusahaan</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @php($counter = 1)
                            @forelse ($companies as $company)
                                <tr class="border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $counter++ }}</td>
                                    <td><img src="{{ $company->photo->url }}" alt="{{ $company->photo->name }}"
                                            width="100"></td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $company->name }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $company->email }}<br>{{ $company->phone }}</td>
                                    <td>
                                        <x-link href="{{ route('admin.company.show', $company) }}">Detail</x-link>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $.ajax({
                    url: "{{ route('company') }}"
                }).done(function(e) {
                    console.log(e)
                })

                $('#table').DataTable({
                    ajax: '{{ route('company') }}',
                    columns: [{
                        data: 'name',
                    }, {
                        data: 'email',
                    }, {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                    }],

                })


            })
        </script>
    @endpush
</x-app-layout>
