<nav class="bg-white border-gray-200 shadow-lg sticky top-0 z-50">
    <div class="flex flex-wrap items-center justify-between py-6 max-w-screen-lg 2xl:max-w-screen-xl mx-5 lg:mx-auto">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/garuda-cyber.png') }}" class="h-14" alt="garuda" />
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            @if (Auth::check())
                <a href="{{ Auth::user()->hasRole('admin') ? url('admin/dashboard') : url('user/dashboard') }}"
                    class="flex items-center gap-2" data-tooltip-target="tooltip-default">
                    <p>Halo, <span class="font-semibold">{{ Auth::user()->name }}</span></p>
                    <img src="https://raw.githubusercontent.com/MartinHeinz/MartinHeinz/master/wave.gif" width="28px"
                        class="mb-2">
                </a>
                <div id="tooltip-default" role="tooltip"
                    class="absolute z-30 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                    Click go to dashboard
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            @else
                <ul
                    class="font-medium gap-3 md:gap-0 flex flex-col p-4 md:p-0 mt-4 text-sm border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-3 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white">
                    <li>
                        <a href="{{ url('/register') }}"
                            class="block text-center py-2 px-4 rounded-xl border-2 text-red-800 border-red-800 hover:bg-red-800 hover:text-white font-bold transition-all duration-300">
                            Register
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/login') }}"
                            class="block text-center py-2 px-4 rounded-xl border-2 border-red-800 text-white bg-red-800 hover:bg-red-700 hover:border-red-700 font-bold transition-all duration-300">
                            Login
                        </a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('a[href]');

        links.forEach(link => {
            link.addEventListener('click', function(event) {
                const currentPath = window.location.pathname;
                const targetPath = new URL(link.href).pathname;

                if (currentPath === targetPath) {
                    event.preventDefault(); // Mencegah redirect jika pathnya sama
                }
            });
        });
    });
</script>
