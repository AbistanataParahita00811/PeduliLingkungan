<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-6">
        <div class="w-14 h-14 mx-auto mb-4 bg-lime/10 rounded-2xl flex items-center justify-center">
            <svg class="w-7 h-7 text-lime" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
        <h2 class="font-heading text-2xl text-forest">Verifikasi Email</h2>
        <p class="text-sm text-moss/70 mt-1">Terima kasih telah mendaftar! Silakan verifikasi email kamu</p>
    </div>

    <div class="mb-6 p-4 rounded-xl bg-cream/50 text-sm text-moss">
        {{ __('Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi email kamu dengan mengklik link yang telah kami kirim. Jika kamu tidak menerima email, kami akan mengirimkannya ulang dengan senang hati.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-4 rounded-xl bg-leaf/10 border border-leaf/20 text-forest text-sm">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-leaf" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ __('Link verifikasi baru telah dikirim ke email yang kamu berikan saat pendaftaran.') }}
            </div>
        </div>
    @endif

    <div class="space-y-4">
        <!-- Resend Verification Email -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="w-full justify-center py-3.5 text-base font-semibold rounded-xl btn-hover">
                {{ __('Kirim Ulang Email Verifikasi') }}
            </x-primary-button>
        </form>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-center text-sm text-moss hover:text-forest transition-colors py-2">
                {{ __('Keluar') }}
            </button>
        </form>
    </div>
</x-guest-layout>
