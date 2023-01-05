<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        @include('layouts.nav-bar')

        <!-- Page Content -->
        <main class="">
            <div class="max-w-full pt-6 px-24 flex justify-between bg-[#EDF1F0]">
                <div class="flex flex-col justify-center space-y-4">
                    <h2 class="text-3xl font-bold">Search Internship Location</h2>
                    <p>Find your internship with us</p>
                    <div class="">
                        <x-link href="#" class="">Cari Magang</x-link>
                    </div>
                </div>
                <div>
                    <img width="450px" src="{{ asset('images/gb-1.png') }}" alt="imgs">
                </div>
            </div>
            <svg id="tentang-kami" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200">
                <path fill="#edf1f0" fill-opacity="1"
                    d="M0,32L48,53.3C96,75,192,117,288,133.3C384,149,480,139,576,117.3C672,96,768,64,864,74.7C960,85,1056,139,1152,138.7C1248,139,1344,85,1392,58.7L1440,32L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
                </path>
            </svg>
            <div>
                <h3 class="text-2xl text-center font-bold">Collaboration</h3>
                <div class="flex justify-evenly mt-10 md:gap-80">
                    <img width="180px" src="{{ asset('images/col-1.png') }}" alt="col-1">
                    <img width="180px" src="{{ asset('images/col-2.png') }}" alt="col-2">
                </div>
            </div>
            <div class="mt-10 py-6 px-24 flex justify-between space-x-10 ">
                <div class="flex flex-col justify-center pl-20 pr-20">
                    <h2 class="text-2xl font-bold mb-4 text-[#4D61AD]">Tentang Kami</h2>
                    <p>SEILO merupakan sebuah sistem pencari tempat magang untuk membantu siswa SMK mendapatkan tempat
                        Praktik Kerja Lapangan atau PKL yang sesuai dengan keahliannya. Sistem ini menghubungkan siswa
                        SMK, Sekolah maupun Industri/Perusahaan.
                    </p>
                    <div class="mt-6">
                        <x-link href="#" class="bg-[#4D61AD] w-13 text-xl mr-1"><i
                                class="fa-brands fa-instagram"></i></x-link>
                        <x-link href="#" class="bg-[#4D61AD] w-13 text-xl"><i class="fa-brands fa-youtube"></i>
                        </x-link>
                    </div>
                </div>
                <div class="pr-20">
                    <img width="1200px" src="{{ asset('images/tentang.png') }}" alt="imgs">
                </div>
            </div>

            <div class="mt-10 py-6 px-24 bg-[#AEB1FF]">
                <h3 class="text-2xl text-center font-bold mt-6 text-white">Internship</h3>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 p-10 gap-6">

                            @forelse ($jobs as $job)
                                <div class="card-body bg-white h-50 w-200 rounded shadow-lg border-r">
                                    <div id="internship" class="px-6 py-4">
                                        <div class="font-bold text-l mt-4  mb-2">{{ $job->title }}</>
                                            <p class="text-sm text-base mb-2">
                                                {{ $job->company->name }}
                                            </p>
                                            <p class="text-gray-700 text-base">
                                                <i class="fa-solid fa-location-dot"></i> {{ $job->location }}
                                            </p>
                                            <p class="text-gray-700 text-base">
                                                <i class="fa-solid fa-briefcase"></i> {{ $job->position }}
                                            </p>

                                            <div class="px-6 pt-4 text-center">
                                                <x-link class="bg-[#4D61AD] mt-auto"
                                                    href="{{ route('company.job.show', $job) }}">
                                                    Detail
                                                </x-link>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Tidak ada lowongan</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-6 px-24 flex gap-40 space-x-10 m-auto">
            <img class="ml-20 mb-6" src="{{ asset('images/f-seilo.png') }}" alt="">
            <div class="mt-10">
                <h4 class="text-2xl font-bold mb-4 text-[#4D61AD]">Contact Us</h4>
                <div class="flex flex-col">
                    <p class="mt-2"><i class="fa-brands fa-instagram"></i> @seilo</p>
                    <p class="mt-2"><i class="fa-solid fa-envelope"></i> seilobdg@gmail.com</p>
                    <p class="mt-2"><i class="fa-brands fa-whatsapp"></i> +62 898-6513-711</p>
                </div>
            </div>
            <div class="mt-10">
                <h4 class="text-2xl font-bold mb-4 text-[#4D61AD]">SEILO</h4>
                <div class="flex flex-col">
                    <a href="/" class="text-gray-800 text-sm font-semibold hover:text-[#4D61AD] mr-4 mt-2 "> <i
                            class="fa-solid fa-right-long"></i> Home</a>
                    <a href="#internship" class="text-gray-800 text-sm font-semibold hover:text-[#4D61AD] mr-4 mt-2"><i
                            class="fa-solid fa-right-long"></i> Job</a>
                    <a href="#tentang-kami" class="text-gray-800 text-sm font-semibold hover:text-[#4D61AD] mr-4 mt-2">
                        <i class="fa-solid fa-right-long"></i> About Us</a>

                    <a href="{{ route('login') }}"
                        class="text-gray-800 text-sm font-semibold hover:text-[#4D61AD] mr-4 mt-2"> <i
                            class="fa-solid fa-right-long"></i> Login</a>

                    <a href="{{ route('register') }}"
                        class="text-gray-800 text-sm font-semibold hover:text-[#4D61AD] mr-4 mt-2"> <i
                            class="fa-solid fa-right-long"></i> Register</a>
                </div>
            </div>
        </footer>
    </div>
    <!-- jQuery -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    @stack('scripts')

</body>

</html>
