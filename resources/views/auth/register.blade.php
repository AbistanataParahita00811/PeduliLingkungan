<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Header -->
        <div class="text-center mb-6">
            <h2 class="font-heading text-2xl text-forest">Buat Akun Baru</h2>
            <p class="text-sm text-moss/70 mt-1">Bergabung dengan komunitas hijau kami</p>
        </div>

        <!-- Name -->
        <div class="input-group">
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-forest font-medium" />
            <div class="relative mt-1.5">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-moss/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <x-text-input 
                    id="name" 
                    class="block mt-0 w-full pl-10 pr-4 py-3 bg-cream/50 border-cream focus:bg-white transition-all duration-300 input-focus text-forest placeholder-moss/40" 
                    type="text" 
                    name="name" 
                    :value="old('name')" 
                    required 
                    autofocus 
                    autocomplete="name" 
                    placeholder="Nama lengkap kamu"
                />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div class="input-group">
            <x-input-label for="email" :value="__('Email')" class="text-forest font-medium" />
            <div class="relative mt-1.5">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-moss/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <x-text-input 
                    id="email" 
                    class="block mt-0 w-full pl-10 pr-4 py-3 bg-cream/50 border-cream focus:bg-white transition-all duration-300 input-focus text-forest placeholder-moss/40" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autocomplete="username" 
                    placeholder="nama@email.com"
                />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="input-group">
            <x-input-label for="password" :value="__('Password')" class="text-forest font-medium" />
            <div class="relative mt-1.5">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-moss/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <x-text-input 
                    id="password" 
                    class="block mt-0 w-full pl-10 pr-12 py-3 bg-cream/50 border-cream focus:bg-white transition-all duration-300 input-focus text-forest placeholder-moss/40"
                    type="password"
                    name="password"
                    required 
                    autocomplete="new-password"
                    placeholder="••••••••"
                />
                <!-- Password Toggle -->
                <button type="button" class="toggle-password absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg class="w-5 h-5 text-moss/50 hover:text-leaf transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
            <p class="text-xs text-moss/60 mt-1">Minimal 8 karakter</p>
        </div>

        <!-- Confirm Password -->
        <div class="input-group">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-forest font-medium" />
            <div class="relative mt-1.5">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-moss/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <x-text-input 
                    id="password_confirmation" 
                    class="block mt-0 w-full pl-10 pr-12 py-3 bg-cream/50 border-cream focus:bg-white transition-all duration-300 input-focus text-forest placeholder-moss/40"
                    type="password"
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password"
                    placeholder="••••••••"
                />
                <!-- Password Toggle -->
                <button type="button" class="toggle-password absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg class="w-5 h-5 text-moss/50 hover:text-leaf transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <!-- Terms -->
        <div class="flex items-start">
            <input id="terms" type="checkbox" class="rounded border-moss/30 text-leaf focus:ring-leaf bg-cream/50 mt-0.5" required>
            <label for="terms" class="ml-2 text-xs text-moss">
                Saya setuju dengan 
                <a href="#" class="text-leaf hover:text-forest transition-colors">Syarat & Ketentuan</a>
                dan
                <a href="#" class="text-leaf hover:text-forest transition-colors">Kebijakan Privasi</a>
            </label>
        </div>

        <!-- Submit Button -->
        <x-primary-button class="w-full justify-center py-3.5 text-base font-semibold rounded-xl btn-hover">
            {{ __('Daftar Sekarang') }}
        </x-primary-button>

        <!-- Divider -->
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-moss/20"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-white text-moss/60">atau</span>
            </div>
        </div>

        <!-- Login Link -->
        <div class="text-center">
            <p class="text-sm text-moss">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-leaf font-semibold hover:text-forest transition-colors">
                    Masuk di sini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
