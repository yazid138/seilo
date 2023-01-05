<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrasi Perusahaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.company.store') }}" enctype="multipart/form-data">
                        @csrf

                        <h2 class="font-bold text-xl">Informasi Perusahaan</h2>

                        <!-- Photo -->
                        <div class="mt-4">
                            <x-input-label for="companyLogo" :value="__('Logo Perusahaan')" />
                            <x-text-input id="companyLogo" class="block mt-1 w-full" type="file" name="companyLogo"
                                :value="old('companyLogo')" required />
                            <x-input-error :messages="$errors->get('companyLogo')" class="mt-2" />
                        </div>

                        <!-- Name -->
                        <div class="mt-4">
                            <x-input-label for="companyName" :value="__('Nama Perusahaan')" />
                            <x-text-input id="companyName" class="block mt-1 w-full" type="text" name="companyName"
                                :value="old('companyName')" required autofocus />
                            <x-input-error :messages="$errors->get('companyName')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <x-input-label for="companyEmail" :value="__('Alamat Email')" />
                            <x-text-input id="companyEmail" class="block mt-1 w-full" type="email" name="companyEmail"
                                :value="old('companyEmail')" required />
                            <x-input-error :messages="$errors->get('companyEmail')" class="mt-2" />
                        </div>

                        <!-- Phone -->
                        <div class="mt-4">
                            <x-input-label for="companyPhone" :value="__('Nomor Telepon')" />
                            <x-text-input id="companyPhone" class="block mt-1 w-full" type="text" name="companyPhone"
                                :value="old('companyPhone')" required />
                            <x-input-error :messages="$errors->get('companyPhone')" class="mt-2" />
                        </div>

                        <!-- Web -->
                        <div class="mt-4">
                            <x-input-label for="companyWeb" :value="__('Situs Perusahaan')" />
                            <x-text-input id="companyWeb" class="block mt-1 w-full" type="text" name="companyWeb"
                                :value="old('companyWeb')" required />
                            <x-input-error :messages="$errors->get('companyWeb')" class="mt-2" />
                        </div>



                        <!-- Address -->
                        <div class="mt-4">
                            <x-input-label for="address" :value="__('Alamat')" />
                            <x-text-area name="address" id="address" class="block mt-1 w-full">
                                {{ old('address') }}
                            </x-text-area>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="province" :value="__('Provinsi')" />
                            <x-text-input id="province" class="block mt-1 w-full" type="text" name="province"
                                :value="old('province')" required />
                            <x-input-error :messages="$errors->get('province')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="city" :value="__('Kota')" />
                            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city"
                                :value="old('city')" required />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="postal_code" :value="__('Kode Pos')" />
                            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code"
                                :value="old('postal_code')" required />
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
</x-app-layout>
