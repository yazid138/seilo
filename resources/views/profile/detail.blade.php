<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                        @csrf
                        <h2 class="font-bold text-xl">My Profile</h2>

                        <!-- Photo -->
                        <div class="mt-">
                            <x-input-label for="foto" :value="__('Foto Profil')" />

                            @if ($user->profile)
                                <img src="{{ $user->profile->photo->url }}" alt="{{ $user->profile->photo->name }}"
                                    width="200" class="mt-4 rounded-full">
                            @endif

                            {{-- <x-text-input id="foto" class="block mt-4 ml-5 w-full" type="file" name="foto"
                                :value="old('foto')" /> --}}
                            @if (!$user->profile)
                                <x-text-input id="foto" class="block mt-4 ml-5 w-full" type="file"
                                    name="foto" :value="old('foto')" required />
                            @else
                                <x-text-input id="foto" class="block mt-4 ml-5 w-full" type="file"
                                    name="foto" :value="old('foto')" />
                            @endif
                            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                        </div>

                        <!-- about me -->
                        <div class="mt-4">
                            <x-input-label for="about_me" :value="__('Tentang saya')" />
                            <x-text-input id="about_me" class="block mt-1 w-full" type="text" name="about_me"
                                :value="old('about_me', $user->profile ? $user->profile->about_me : '')" required />
                            <x-input-error :messages="$errors->get('about_me')" class="mt-2" />
                        </div>


                        <!-- Name -->
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Nama')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name', $user->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email', $user->email)" disabled />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Phone -->
                        <div class="mt-4">
                            <x-input-label for="phone" :value="__('No Hp')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                :value="old('phone', $user->profile ? $user->profile->phone : '')" required />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <!-- birthdate -->
                        <div class="mt-4">
                            <x-input-label for="birth_date" :value="__('Tanggal Lahir')" />
                            <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date"
                                :value="old('birth_date', $user->profile ? $user->profile->birth_date : '')" required />
                            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                        </div>

                        <!-- gender -->
                        <div class="mt-4">
                            <x-input-label for="gender" :value="__('Jenis Kelamin')" />
                            @php($jk = [['value' => 'L', 'label' => 'Laki-laki'], ['value' => 'P', 'label' => 'Perempuan']])
                            <select name="gender" id="gender" class="block mt-1 w-full">
                                @foreach ($jk as $data)
                                    <option @selected(old('gender', $user->profile ? $user->profile->gender : '') === $data['value']) value="{{ $data['value'] }}">
                                        {{ $data['label'] }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>

                        <!-- Address -->
                        <div class="mt-4">
                            <x-input-label for="address" :value="__('Alamat')" />
                            <x-text-area name="address" id="address" class="block mt-1 w-full">
                                {{ old('address', $user->profile && $user->profile->address ? $user->profile->address->description : '') }}
                            </x-text-area>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                        <div class="mt-4">

                            <x-input-label for="province" :value="__('Provinsi')" />
                            <x-text-input id="province" class="block mt-1 w-full" type="text" name="province"
                                :value="old(
                                    'province',
                                    $user->profile && $user->profile->address ? $user->profile->address->province : '',
                                )" required />
                            <x-input-error :messages="$errors->get('province')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="city" :value="__('Kota')" />
                            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city"
                                :value="old(
                                    'city',
                                    $user->profile && $user->profile->address ? $user->profile->address->city : '',
                                )" required />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="postal_code" :value="__('Kode Pos')" />
                            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code"
                                :value="old(
                                    'postal_code',
                                    $user->profile && $user->profile->address
                                        ? $user->profile->address->postal_code
                                        : '',
                                )" required />
                            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                        </div>

                        <!-- facebook -->
                        <div class="mt-4">
                            <x-input-label for="facebook" :value="__('Facebook')" />
                            <x-text-input id="facebook" class="block mt-1 w-full" type="text" name="facebook"
                                :value="old(
                                    'facebook',
                                    $user->profile && $user->profile->social_media
                                        ? $user->profile->social_media->facebook
                                        : '',
                                )" />
                            <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
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
                                )" />
                            <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
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
                                )" />
                            <x-input-error :messages="$errors->get('linkedin')" class="mt-2" />
                        </div>


                </div>
            </div>
        </div>
    </div>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 mb-20 ">
                <div class="p-6 text-gray-900">

                    <h2 class="font-bold text-xl">Pendidikan</h2>
                    <!-- TP -->
                    @php($tp = [['value' => 'SMK', 'label' => 'SMK'], ['value' => 'D3', 'label' => 'D3'], ['value' => 'D4', 'label' => 'D4'], ['value' => 'S1', 'label' => 'S1']])
                    <div class="mt-4">
                        <x-input-label for="tingkat_pendidikan" :value="__('Tingkat Pendidikan')" />
                        <select name="tingkat_pendidikan" id="tingkat_pendidikan" class="block mt-1 w-full">
                            @foreach ($tp as $data)
                                <option @selected(old('gender', $user->profile && $user->profile->education ? $user->profile->education->tingkat_pendidikan : '') === $data['value']) value="{{ $data['value'] }}">
                                    {{ $data['label'] }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('tingkat_pendidikan')" class="mt-2" />
                    </div>

                    <!-- Institusi -->
                    <div class="mt-4">
                        <x-input-label for="institusi" :value="__('Institusi')" />
                        <x-text-input id="institusi" class="block mt-1 w-full" type="text" name="institusi"
                            :value="old(
                                'institusi',
                                $user->profile && $user->profile->education ? $user->profile->education->institusi : '',
                            )" required autofocus />
                        <x-input-error :messages="$errors->get('institusi')" class="mt-2" />
                    </div>

                    <!-- jurusan -->
                    <div class="mt-4">
                        <x-input-label for="jurusan" :value="__('Jurusan')" />
                        <x-text-input id="jurusan" class="block mt-1 w-full" type="text" name="jurusan"
                            :value="old(
                                'jurusan',
                                $user->profile && $user->profile->education ? $user->profile->education->jurusan : '',
                            )" required autofocus />
                        <x-input-error :messages="$errors->get('jurusan')" class="mt-2" />
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
                            )" required autofocus />
                        <x-input-error :messages="$errors->get('nilai_akhir')" class="mt-2" />
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
                            )" required autofocus />
                        <x-input-error :messages="$errors->get('tanngal_masuk')" class="mt-2" />
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
                            )" required autofocus />
                        <x-input-error :messages="$errors->get('tanggal_lulus')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-5">
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
