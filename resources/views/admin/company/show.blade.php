<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="p-6 text-gray-900">
                    <h2 class="font-bold text-xl">Informasi Perusahaan</h2>
                    <form method="POST" action="{{ route('admin.company.update', $company) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <!-- Photo -->
                        <div class="mt-4">
                            <x-input-label for="companyLogo" :value="__('Logo Perusahaan')" />
                            <img src="{{ $company->photo->url }}" alt="{{ $company->photo->name }}" width="200"
                                class="mt-4">
                            <x-text-input id="companyLogo" class="block mt-4 w-full" type="file" name="companyLogo"
                                :value="old('companyLogo')" />
                            <x-input-error :messages="$errors->get('companyLogo')" class="mt-2" />
                        </div>

                        <!-- Name -->
                        <div class="mt-4">
                            <x-input-label for="companyName" :value="__('Nama Perusahaan')" />
                            <x-text-input id="companyName" class="block mt-1 w-full" type="text" name="companyName"
                                :value="old('companyName', $company->name)" required />
                            <x-input-error :messages="$errors->get('companyName')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <x-input-label for="companyEmail" :value="__('Alamat Email')" />
                            <x-text-input id="companyEmail" class="block mt-1 w-full" type="email" name="companyEmail"
                                :value="old('companyEmail', $company->email)" required />
                            <x-input-error :messages="$errors->get('companyEmail')" class="mt-2" />
                        </div>

                        <!-- Phone -->
                        <div class="mt-4">
                            <x-input-label for="companyPhone" :value="__('Nomor Telepon')" />
                            <x-text-input id="companyPhone" class="block mt-1 w-full" type="text" name="companyPhone"
                                :value="old('companyPhone', $company->phone)" required />
                            <x-input-error :messages="$errors->get('companyPhone')" class="mt-2" />
                        </div>

                        <!-- Web -->
                        <div class="mt-4">
                            <x-input-label for="companyWeb" :value="__('Situs Perusahaan')" />
                            <x-text-input id="companyWeb" class="block mt-1 w-full" type="text" name="companyWeb"
                                :value="old('companyWeb', $company->url)" required />
                            <x-input-error :messages="$errors->get('companyWeb')" class="mt-2" />
                        </div>


                        <!-- Address -->
                        <div class="mt-4">
                            <x-input-label for="address" :value="__('Alamat')" />
                            <x-text-area name="address" id="address" class="block mt-1 w-full">
                                {{ old('address', $company->address->description) }}
                            </x-text-area>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="province" :value="__('Provinsi')" />
                            <x-text-input id="province" class="block mt-1 w-full" type="text" name="province"
                                :value="old('province', $company->address->province)" required />
                            <x-input-error :messages="$errors->get('province')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="city" :value="__('Kota')" />
                            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city"
                                :value="old('city', $company->address->city)" required />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="postal_code" :value="__('Kode Pos')" />
                            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code"
                                :value="old('postal_code', $company->address->postal_code)" required />
                            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
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

    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-20">
                <div class="p-6 text-gray-900">

                    <h2 class="font-bold text-xl">Staff Perusahaan</h2>
                    <x-link class="mt-4 mb-4" href="{{ route('admin.company.user.register', $company) }}">Tambah Staff
                    </x-link>
                    <table class="min-w-full">
                        <thead class="border-b">
                            <tr>
                                <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">No</th>
                                <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Nama</th>
                                <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($counter = 1)
                            @forelse ($users as $user)
                                <tr class="border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $counter++ }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <x-link href="{{ route('admin.company.user.show', [$company, $user]) }}">Detail
                                        </x-link>
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
