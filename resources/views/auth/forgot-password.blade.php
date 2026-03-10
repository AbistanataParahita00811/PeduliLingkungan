<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-6">
        <div class="w-14 h-14 mx-auto mb-4 bg-lime/10 rounded-2xl flex items-center justify-center">
            <svg class="w-7 h-7 text-lime" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
            </svg>
        </div>
        <h2 class="font-heading text-2xl text-forest">Lupa Password?</h2>
        <p class="text-sm text-moss/70 mt-1">Masukkan email kamu, kami akan mengirim link untuk reset password</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

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
                    autofocus 
                    placeholder="nama@email.com"
                />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Submit Button -->
        <x-primary-button class="w-full justify-center py-3.5 text-base font-semibold rounded-xl btn-hover">
            {{ __('Kirim Link Reset Password') }}
        </x-primary-button>

        <!-- Back to Login -->
        <div class="text-center">
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm text-leaf hover:text-forest transition-colors">
                <span class="w-6 h-6 rounded-full bg-moss/10 flex items-center justify-center">←</span>
                Kembali ke Login
            </a>
        </div>
    </form>
</x-guest-layout>
