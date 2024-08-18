<div class="py-14 my-10 max-w-screen-lg 2xl:max-w-screen-xl mx-5 lg:mx-auto bg-white rounded-[30px]">
    <form action="" class="flex flex-col gap-5" wire:submit.prevent="user_login">
        <div class="text-center">
            <div class="flex items-center justify-center gap-2">
                <h1 class="font-bold text-4xl text-red-800">Masuk ke Akun</h1>
            </div>
        </div>
        <div class="mt-5 max-w-xl mx-5 md:mx-auto w-auto md:w-full flex flex-col gap-7">
            <div class="relative">
                <input wire:model.live="email" type="email" id="email" name="email" placeholder="Email"
                    class="w-full px-4 py-3 rounded-full bg-gray-100 border-gray-300 focus:border-red-500 focus:bg-white focus:ring-2 focus:ring-red-200 text-base outline-none text-gray-700 leading-8 transition-colors duration-200 ease-in-out pl-14">
                <span class="absolute left-3 top-3 text-white bg-[#797979] p-1.5 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                </span>
                @error('email')
                    <span class="text-red-600 text-[11px]">{{ $message }}</span>
                @enderror
            </div>
            <div class="relative">
                <input wire:model.live="password" type="password" id="password" name="password" placeholder="Password"
                    class="w-full px-4 py-3 rounded-full bg-gray-100 border-gray-300 focus:border-red-500 focus:bg-white focus:ring-2 focus:ring-red-200 text-base outline-none text-gray-700 leading-8 transition-colors duration-200 ease-in-out pl-14">
                <span class="absolute left-3 top-3 text-white bg-[#797979] p-1.5 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                </span>
                @error('password')
                    <span class="text-red-600 text-[11px]">{{ $message }}</span>
                @enderror
                <button type="button" id="togglePassword" class="absolute right-4 top-[18px] text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </button>
            </div>
            <div class="relative flex justify-center items-center">
                <div class="flex items-center h-5">
                    <input id="remember" type="checkbox" name="remember" wire:model="remember"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-red-300" />
                </div>
                <label for="remember" class="ms-2 text-sm font-normal text-gray-900">Remember me</label>
            </div>
            <div class="relative flex flex-col text-center gap-3">
                <button type="submit"
                    class="w-full bg-red-800 py-4 font-bold text-white rounded-2xl hover:bg-red-700 transition-all duration-300">Login</button>
                <p class="text-lg font-semibold text-gray-500">Belum punya akun? <a href="{{ url('/register') }}"
                        class="text-red-800 hover:text-red-700">Register di sini</a></p>
            </div>
        </div>
    </form>

    <script>
        function togglePasswordVisibility(inputId, buttonId) {
            const passwordInput = document.getElementById(inputId);
            const toggleButton = document.getElementById(buttonId);

            toggleButton.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleButton.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              `;
                } else {
                    passwordInput.type = 'password';
                    toggleButton.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                </svg>
              `;
                }
            });
        }

        // Call the function for each password field when the DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            togglePasswordVisibility('password', 'togglePassword');
        });
    </script>
</div>
