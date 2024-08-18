@extends('layouts.app')

@section('title', 'Admin dashboard')

@section('content')

    <div class="my-9 max-w-screen-lg 2xl:max-w-screen-xl mx-5 lg:mx-auto flex flex-col gap-5">

        <div class="w-full p-6 shadow-sm bg-white rounded-[30px] gap-4 flex md:flex-row flex-col justify-between">
            <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                <div class="bg-gray-800 text-white flex items-center justify-center w-16 h-16 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800">{{ Auth::user()->name }}</h1>
                    <h5 class="text-gray-400">{{ Auth::user()->email }}</h5>
                </div>
                <div class="border border-green-500 bg-green-100 flex items-center justify-center p-2 px-4 rounded-xl">
                    Points: <span class="text-xl ml-3 font-bold">{{ Auth::user()->points }}</span>
                </div>
                <div
                    class="relative border border-blue-500 bg-blue-100 flex items-center justify-between p-2 px-4 rounded-xl">
                    <div class="flex items-center">
                        <span>Referral Code:</span>
                        <span class="text-xl ml-3 font-bold">{{ Auth::user()->referral_code }}</span>
                    </div>
                    <button onclick="copyToClipboard('{{ Auth::user()->referral_code }}')" class="ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 hover:text-blue-800"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-8a2 2 0 00-2 2z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 7V5a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2h2" />
                        </svg>
                    </button>
                    <!-- Popup Notification -->
                    <div id="popup"
                        class="absolute top-0 right-0 transform translate-x-12 -translate-y-10 bg-blue-500 text-white text-sm p-2 rounded shadow-lg opacity-0 pointer-events-none transition-opacity duration-300">
                        Copied to clipboard!
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <a href="{{ url('logout') }}"
                    class="text-white text-center w-full font-semibold border-2 border-red-600 bg-red-600 px-4 py-1.5 rounded-xl hover:border-red-600 hover:bg-white hover:text-red-600 transition-all duration-300 ">
                    Logout
                </a>
            </div>
        </div>
        <div class="w-full space-y-5">
            <div class="w-full gap-4 border-b border-gray-300 p-6 shadow-sm bg-white rounded-[30px]">
                <h1 class="text-2xl font-bold">Recents Referral</h1>
                <div class="mt-4 overflow-auto">
                    {{-- Recent Referral Livewire Component --}}
                    @livewire('recent-referral')
                </div>
            </div>
        </div>
        <div class="w-full space-y-5">
            <div class="w-full gap-4 border-b border-gray-300 p-6 shadow-sm bg-white rounded-[30px]">
                <h1 class="text-2xl font-bold">Give Points</h1>
                <div class="mt-4 overflow-auto">
                    {{-- Give Points Livewire Component --}}
                    @livewire('give-points')
                </div>
            </div>
        </div>
        <div class="w-full space-y-5">
            <div class="w-full gap-4 border-b border-gray-300 p-6 shadow-sm bg-white rounded-[30px]">
                <h1 class="text-2xl font-bold">History Give</h1>
                <div class="mt-4 overflow-auto">
                    {{-- History Give Points Livewire Component --}}
                    @livewire('give-history')
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                const popup = document.getElementById('popup');
                popup.style.opacity = '1';
                setTimeout(() => {
                    popup.style.opacity = '0';
                }, 1500);
            });
        }
    </script>

@endsection
