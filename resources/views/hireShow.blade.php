<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg pl-10 ">
                <div class="p-6 text-gray-900">
                    <h2 class="font-bold text-xl mt-5 mb-4">Status Lamaran</h2>
                    <form action="{{ route('company.hire.update', $hire) }}" method="post">
                        @csrf
                        @method('put')
                        <!-- Approve -->
                        @php($tp = [['value' => '1', 'label' => 'Diterima'], ['value' => '0', 'label' => 'Ditolak']])
                        <div class="mt-4">
                            <select name="isApprove" id="isApprove" class="block mt-1 w-full" required>
                                @foreach ($tp as $data)
                                    <option @selected(old('isApprove', $hire->isApprove) == $data['value']) value="{{ $data['value'] }}">
                                        {{ $data['label'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-link href="{{ route('hire') }}">Kembali</x-link>
                            <x-primary-button class="ml-4">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <div class="p-6 text-gray-900">

                    <h2 class="font-bold text-xl">Informasi User</h2>

                    <!-- Photo -->
                    <div class="mt-4">
                        <x-input-label for="foto" :value="__('Foto')" />
                        <img src="{{ $user->profile && $user->profile->photo ? $user->profile->photo->url : '' }}"
                            alt="{{ $user->profile && $user->profile->photo ? $user->profile->photo->name : '' }}"
                            class="mt-4" width="150px">

                    </div>

                    <!-- about me -->
                    <div class="mt-4">
                        <x-input-label for="about_me" :value="__('Tentang saya')" />
                        <x-text-input id="about_me" class="block mt-1 w-full" type="text" name="about_me"
                            :value="old('about_me', $user->profile ? $user->profile->about_me : '')" disabled />
                    </div>

                    <!-- Name -->
                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Nama')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name', $user->name)" disabled />
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email', $user->email)" disabled />
                    </div>

                    <!-- Phone -->
                    <div class="mt-4">
                        <x-input-label for="phone" :value="__('No Hp')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                            :value="old('phone', $user->profile ? $user->profile->phone : '')" disabled />
                    </div>

                    <!-- birthdate -->
                    <div class="mt-4">
                        <x-input-label for="birth_date" :value="__('Tanggal Lahir')" />
                        <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date"
                            :value="old('birth_date', $user->profile ? $user->profile->birth_date : '')" disabled />
                    </div>

                    <!-- gender -->
                    <div class="mt-4">
                        <x-input-label for="gender" :value="__('Jenis Kelamin')" />
                        @php($jk = [['value' => 'L', 'label' => 'Laki-laki'], ['value' => 'P', 'label' => 'Perempuan']])
                        <select name="gender" id="gender" class="block mt-1 w-full" disabled>
                            @foreach ($jk as $data)
                                <option @selected(old('gender', $user->profile ? $user->profile->gender : '') === $data['value']) value="{{ $data['value'] }}">
                                    {{ $data['label'] }}</option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Address -->
                    <div class="mt-4">
                        <x-input-label for="address" :value="__('Alamat')" />
                        <x-text-area name="address" id="address" class="block mt-1 w-full" disabled>
                            {{ old('address', $user->profile && $user->profile->address ? $user->profile->address->description : '') }}
                        </x-text-area>
                    </div>
                    <div class="mt-4">

                        <x-input-label for="province" :value="__('Provinsi')" />
                        <x-text-input id="province" class="block mt-1 w-full" type="text" name="province"
                            :value="old(
                                'province',
                                $user->profile && $user->profile->address ? $user->profile->address->province : '',
                            )" disabled />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="city" :value="__('Kota')" />
                        <x-text-input id="city" class="block mt-1 w-full" type="text" name="city"
                            :value="old(
                                'city',
                                $user->profile && $user->profile->address ? $user->profile->address->city : '',
                            )" disabled />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="postal_code" :value="__('Kode Pos')" />
                        <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code"
                            :value="old(
                                'postal_code',
                                $user->profile && $user->profile->address ? $user->profile->address->postal_code : '',
                            )" disabled />
                    </div>

                    <h2 class="mt-10 font-bold text-xl">Pendidikan</h2>
                    <!-- TP -->
                    @php($tp = [['value' => 'SMK', 'label' => 'SMK'], ['value' => 'D3', 'label' => 'D3'], ['value' => 'D4', 'label' => 'D4'], ['value' => 'S1', 'label' => 'S1']])
                    <div class="mt-4">
                        <x-input-label for="tingkat_pendidikan" :value="__('Tingkat Pendidikan')" />
                        <select name="tingkat_pendidikan" id="tingkat_pendidikan" class="block mt-1 w-full" disabled>
                            @foreach ($tp as $data)
                                <option @selected(old('gender', $user->profile && $user->profile->education ? $user->profile->education->tingkat_pendidikan : '') === $data['value']) value="{{ $data['value'] }}">
                                    {{ $data['label'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Institusi -->
                    <div class="mt-4">
                        <x-input-label for="institusi" :value="__('Institusi')" />
                        <x-text-input id="institusi" class="block mt-1 w-full" type="text" name="institusi"
                            :value="old(
                                'institusi',
                                $user->profile && $user->profile->education ? $user->profile->education->institusi : '',
                            )" disabled />
                    </div>

                    <!-- jurusan -->
                    <div class="mt-4">
                        <x-input-label for="jurusan" :value="__('Jurusan')" />
                        <x-text-input id="jurusan" class="block mt-1 w-full" type="text" name="jurusan"
                            :value="old(
                                'jurusan',
                                $user->profile && $user->profile->education ? $user->profile->education->jurusan : '',
                            )" disabled />
                    </div>

                    <!-- nilai_akhir -->
                    <div class="mt-4">
                        <x-input-label for="nilai_akhir" :value="__('Nilai Akhir')" />
                        <x-text-input id="nilai_akhir" class="block mt-1 w-full" type="number" name="nilai_akhir"
                            :value="old(
                                'nilai_akhir',
                                $user->profile && $user->profile->education
                                    ? $user->profile->education->nilai_akhir
                                    : '',
                            )" disabled />
                    </div>

                    <!-- Tanggal Masuk -->
                    <div class="mt-4">
                        <x-input-label for="tanngal_masuk" :value="__('Tanggal Masuk')" />
                        <x-text-input id="tanngal_masuk" class="block mt-1 w-full" type="date"
                            name="tanggal_masuk" :value="old(
                                'tanngal_masuk',
                                $user->profile && $user->profile->education
                                    ? $user->profile->education->tanggal_masuk
                                    : '',
                            )" disabled />
                    </div>

                    <!-- Tanggal Lulus -->
                    <div class="mt-4">
                        <x-input-label for="tanggal_lulus" :value="__('Tanggal Lulus')" />
                        <x-text-input id="tanggal_lulus" class="block mt-1 w-full" type="date"
                            name="tanggal_lulus" :value="old(
                                'tanggal_lulus',
                                $user->profile && $user->profile->education
                                    ? $user->profile->education->tanggal_lulus
                                    : '',
                            )" disabled />
                    </div>

                    <h2 class="font-bold text-xl mt-10">Sosial Media</h2>
                    <!-- facebook -->
                    <div class="mt-4">
                        <x-input-label for="facebook" :value="__('Facebook')" />
                        <x-text-input id="facebook" class="block mt-1 w-full" type="text" name="facebook"
                            :value="old(
                                'facebook',
                                $user->profile && $user->profile->social_media
                                    ? $user->profile->social_media->facebook
                                    : '',
                            )" disabled />
                    </div>

                    <!-- instagram -->
                    <div class="mt-4">
                        <x-input-label for="instagram" :value="__('Instagram')" />
                        <x-text-input id="instagram" class="block mt-1 w-full" type="text" name="instagram"
                            :value="old(
                                'instagram',
                                $user->profile && $user->profile->social_media
                                    ? $user->profile->social_media->instagram
                                    : '',
                            )" disabled />
                    </div>

                    <!-- linkedin -->
                    <div class="mt-4">
                        <x-input-label for="linkedin" :value="__('Linkedin')" />
                        <x-text-input id="linkedin" class="block mt-1 w-full" type="text" name="linkedin"
                            :value="old(
                                'linkedin',
                                $user->profile && $user->profile->social_media
                                    ? $user->profile->social_media->linkedin
                                    : '',
                            )" disabled />
                    </div>
                    <h2 class="font-bold text-xl mt-10 mb-4">Berkas</h2>
                    {{-- cv --}}
                    <x-link href="{{ $hire->cv->url }}" download="{{ $hire->cv->name }}">Download CV</x-link>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
