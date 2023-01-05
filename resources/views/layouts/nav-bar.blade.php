<!-- component -->
<div class="font-sans m-0">
    <div class="bg-white shadow">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <div class="pl-10">
                    <a href="/">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                @if (Route::has('login'))

                    <div class="hidden sm:flex sm:items-center">
                        @auth
                            <div class="hidden sm:flex sm:items-center sm:ml-6">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            <div>
                                                @switch(Auth::user()->role)
                                                    @case('ADMIN')
                                                        Admin -
                                                    @break

                                                    @case('COMPANY')
                                                        {{ Auth::user()->company[0]->name }} -
                                                    @break

                                                    @default
                                                @endswitch
                                                {{ Auth::user()->name }}
                                            </div>

                                            <div class="ml-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        @switch(Auth::user()->role)
                                            @case('ADMIN')
                                                <x-dropdown-link :href="route('company')">
                                                    {{ __('Daftar Perusahaan') }}
                                                </x-dropdown-link>
                                            @break

                                            @case('COMPANY')
                                                <x-dropdown-link :href="route('company')">
                                                    {{ __('Profile Information') }}
                                                </x-dropdown-link>
                                            @break

                                            @default
                                                <x-dropdown-link :href="route('profile.detail')">
                                                    {{ __('Profile') }}
                                                </x-dropdown-link>
                                        @endswitch

                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Setting Account') }}
                                        </x-dropdown-link>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        @else
                            <a href="/" class="text-gray-800 text-sm font-semibold hover:text-[#4D61AD] mr-4">Home</a>
                            <a href="#internship"
                                class="text-gray-800 text-sm font-semibold hover:text-[#4D61AD] mr-4">Job</a>
                            <a href="#tentang-kami"
                                class="text-gray-800 text-sm font-semibold hover:text-[#4D61AD] mr-4">About Us</a>

                        </div>

                        <div class="hidden sm:flex sm:items-center">
                            <a href="{{ route('login') }}"
                                class="text-gray-800 text-sm font-semibold hover:text-[#4D61AD] mr-4">
                                Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="text-gray-800 text-sm font-semibold border px-4 py-2 rounded-lg hover:text-[#4D61AD] hover:border-purple-600">Register
                                </a>
                        </div>
                    @endif
                @endauth
            </div>
            @endif

            <div class="sm:hidden cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-grey-700" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M12.9499909,17 C12.7183558,18.1411202 11.709479,19 10.5,19 C9.29052104,19 8.28164422,18.1411202 8.05000906,17 L3.5,17 C3.22385763,17 3,16.7761424 3,16.5 C3,16.2238576 3.22385763,16 3.5,16 L8.05000906,16 C8.28164422,14.8588798 9.29052104,14 10.5,14 C11.709479,14 12.7183558,14.8588798 12.9499909,16 L20.5,16 C20.7761424,16 21,16.2238576 21,16.5 C21,16.7761424 20.7761424,17 20.5,17 L12.9499909,17 Z M18.9499909,12 C18.7183558,13.1411202 17.709479,14 16.5,14 C15.290521,14 14.2816442,13.1411202 14.0500091,12 L3.5,12 C3.22385763,12 3,11.7761424 3,11.5 C3,11.2238576 3.22385763,11 3.5,11 L14.0500091,11 C14.2816442,9.85887984 15.290521,9 16.5,9 C17.709479,9 18.7183558,9.85887984 18.9499909,11 L20.5,11 C20.7761424,11 21,11.2238576 21,11.5 C21,11.7761424 20.7761424,12 20.5,12 L18.9499909,12 Z M9.94999094,7 C9.71835578,8.14112016 8.70947896,9 7.5,9 C6.29052104,9 5.28164422,8.14112016 5.05000906,7 L3.5,7 C3.22385763,7 3,6.77614237 3,6.5 C3,6.22385763 3.22385763,6 3.5,6 L5.05000906,6 C5.28164422,4.85887984 6.29052104,4 7.5,4 C8.70947896,4 9.71835578,4.85887984 9.94999094,6 L20.5,6 C20.7761424,6 21,6.22385763 21,6.5 C21,6.77614237 20.7761424,7 20.5,7 L9.94999094,7 Z M7.5,8 C8.32842712,8 9,7.32842712 9,6.5 C9,5.67157288 8.32842712,5 7.5,5 C6.67157288,5 6,5.67157288 6,6.5 C6,7.32842712 6.67157288,8 7.5,8 Z M16.5,13 C17.3284271,13 18,12.3284271 18,11.5 C18,10.6715729 17.3284271,10 16.5,10 C15.6715729,10 15,10.6715729 15,11.5 C15,12.3284271 15.6715729,13 16.5,13 Z M10.5,18 C11.3284271,18 12,17.3284271 12,16.5 C12,15.6715729 11.3284271,15 10.5,15 C9.67157288,15 9,15.6715729 9,16.5 C9,17.3284271 9.67157288,18 10.5,18 Z" />
                </svg>
            </div>
        </div>


        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    {{-- <a href="{{ url('/dashboard') }}"
                        class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    <a href="{{ route('job') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">List
                        Job</a> --}}
                @else
                    <div class="block sm:hidden bg-white border-t-2 py-2">
                        <div class="flex flex-col">
                            <a href="/"
                                class="text-gray-800 text-sm font-semibold hover:text-[#4D61AD] mb-1">Beranda</a>
                            <a href="{{ route('job') }}"
                                class="text-gray-800 text-sm font-semibold hover:text-[#4D61AD] mb-1">Pekerjaan</a>
                            <div class="flex justify-between items-center border-t-2 pt-2">
                                <a href="{{ route('login') }}"
                                    class="text-gray-800 text-sm font-semibold hover:text-[#4D61AD] mr-4">Sign
                                    in</a>


                                @if (Route::has('register'))
                                    <a href="{{ route('register') }})"
                                        class="text-gray-800 text-sm font-semibold border px-4 py-1 rounded-lg hover:text-[#4D61AD] hover:border-purple-600">Sign
                                        up</a>
                            </div>
                        </div>
                    </div>
            @endif
        @endauth
    </div>
    @endif


</div>
