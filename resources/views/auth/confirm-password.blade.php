<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-6">
        <div class="w-14 h-14 mx-auto mb-4 bg-lime/10 rounded-2xl flex items-center justify-center">
            <svg class="w-7 h-7 text-lime" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
        </div>
        <h2 class="font-heading text-2xl text-forest">Konfirmasi Password</h2>
        <p class="text-sm text-moss/70 mt-1">Ini adalah area aman. Silakan konfirmasi password kamu</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

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
                    autocomplete="current-password"
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
        </div>

        <!-- Submit Button -->
        <x-primary-button class="w-full justify-center py-3.5 text-base font-semibold rounded-xl btn-hover">
            {{ __('Konfirmasi') }}
        </x-primary-button>
    </form>
</x-guest-layout>
