<header
    x-data="{ openAnnouncement: true }"
    x-cloak
    class="fixed top-0 left-0 right-0 z-50 px-4 pb-2"
>
    {{-- Announcement bar --}}
    @isset($navbarEvent)
        <div
            class="hidden sm:block bg-forest text-white"
            id="announcement-bar"
            x-show="openAnnouncement"
            x-transition
        >
            <div class="max-w-6xl mx-auto flex items-center justify-between gap-4 px-4 py-1.5 text-xs">
                <div class="flex items-center gap-2 truncate">
                    <span class="text-[10px] font-bold tracking-widest px-2 py-0.5 rounded border border-white/40 shrink-0">
                        EVENT TERDEKAT
                    </span>
                    <span class="truncate">
                        {{ $navbarEvent->title }}
                        @if($navbarEvent->event_date)
                            · {{ $navbarEvent->event_date->translatedFormat('d F Y') }}
                        @endif
                    </span>
                </div>
                <div class="flex items-center gap-3 shrink-0">
                    <a href="{{ route('events.index') }}" class="hover:underline">Lihat →</a>
                    <button
                        type="button"
                        class="text-white/70 hover:text-white"
                        onclick="document.getElementById('announcement-bar')?.remove();"
                        @click="openAnnouncement = false"
                        aria-label="Tutup pengumuman"
                    >
                        ✕
                    </button>
                </div>
            </div>
        </div>
    @endisset

    <nav
        id="main-nav"
        x-data="{ open: false, shadow: false }"
        @scroll.window="shadow = window.scrollY > 10"
        class="max-w-6xl mx-3 sm:mx-auto mt-3 bg-white rounded-full border border-gray-100 px-4 sm:px-6 py-3 flex items-center justify-between gap-6 transition-shadow duration-300"
        :class="shadow ? 'shadow-lg border-gray-200' : 'shadow-md border-gray-100'"
    >
    <div class="w-full flex items-center justify-between gap-6">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img
                src="{{ asset('images/logo.jpg') }}"
                alt="Peduli Lingkungan"
                class="w-9 h-9 rounded-full object-cover ring-1 ring-emerald-700/30"
            >
            <div class="leading-tight">
                <p class="font-heading text-base md:text-lg font-semibold text-forest">
                    Peduli Lingkungan
                </p>
                <p class="text-[10px] uppercase tracking-[0.22em] text-slate-500">
                    Since 2025 · Purbalingga
                </p>
            </div>
        </a>

        <div class="hidden md:flex items-center justify-center gap-8 text-sm font-medium tracking-[0.08em] text-slate-600">
            <li>
                <a
                    href="{{ route('home') }}"
                    data-section="hero"
                    class="nav-link flex items-center gap-1.5 px-1 pb-1 border-b-2 border-transparent text-slate-600 transition-colors hover:text-emerald-700 hover:border-emerald-600"
                >
                    <span>Home</span>
                </a>
            </li>
            <a
                href="#about"
                data-section="about"
                class="nav-link flex items-center gap-1.5 px-1 pb-1 border-b-2 border-transparent text-slate-600 transition-colors hover:text-emerald-700 hover:border-emerald-600"
            >
                <span>Tentang Kami</span>
            </a>
            <a
                href="#events"
                data-section="events"
                class="nav-link flex items-center gap-1.5 px-1 pb-1 border-b-2 border-transparent text-slate-600 transition-colors hover:text-emerald-700 hover:border-emerald-600"
            >
                <span>Event</span>
            </a>
            <a
                href="#why-join"
                data-section="why-join"
                class="nav-link flex items-center gap-1.5 px-1 pb-1 border-b-2 border-transparent text-slate-600 transition-colors hover:text-emerald-700 hover:border-emerald-600"
            >
                <span>Kenapa Join?</span>
            </a>
            <a
                href="#articles"
                data-section="articles"
                class="nav-link flex items-center gap-1.5 px-1 pb-1 border-b-2 border-transparent text-slate-600 transition-colors hover:text-emerald-700 hover:border-emerald-600"
            >
                <span>Artikel</span>
            </a>
            <a
                href="#gallery"
                data-section="gallery"
                class="nav-link flex items-center gap-1.5 px-1 pb-1 border-b-2 border-transparent text-slate-600 transition-colors hover:text-emerald-700 hover:border-emerald-600"
            >
                <span>Galeri</span>
            </a>
        </div>

        <div class="hidden md:flex">
            <a
                href="{{ setting('wa_group_link', 'https://chat.whatsapp.com/Lo7XaVcbPi68DXbW212FX4') }}"
                target="_blank"
                class="inline-flex items-center gap-2 rounded-full border border-emerald-700/70 bg-emerald-700 text-white text-xs font-semibold px-5 py-2.5 shadow-sm shadow-emerald-900/20 hover:bg-emerald-800 hover:border-emerald-800 transition-colors"
            >
                <x-icons name="whatsapp" class="w-4 h-4" />
                Join Sekarang
            </a>
        </div>

        <button
            type="button"
            class="md:hidden inline-flex items-center justify-center w-9 h-9 rounded-full border border-slate-200 text-slate-700 bg-white/90"
            @click="open = !open"
        >
            <span x-show="!open"><x-icons name="bars-3" class="w-5 h-5" /></span>
            <span x-show="open" x-cloak><x-icons name="x-mark" class="w-5 h-5" /></span>
        </button>
    </div>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        class="md:hidden bg-white border-t border-gray-100 shadow-sm"
    >
        <div class="max-w-6xl mx-auto px-4 py-4 space-y-1 text-sm text-slate-700">
            <a href="{{ route('home') }}"
               class="flex items-center gap-2 px-4 py-3 rounded-lg transition-colors {{ request()->is('/') ? 'bg-emerald-50 text-emerald-800' : 'hover:bg-slate-50 hover:text-emerald-700' }}"
               @click="open = false">
                Home
            </a>
            <a href="#about" class="mobile-nav-link block py-3 px-3 rounded-lg hover:bg-slate-50 hover:text-emerald-700" @click="open = false">Tentang Kami</a>
            <a href="#events" class="mobile-nav-link block py-3 px-3 rounded-lg hover:bg-slate-50 hover:text-emerald-700" @click="open = false">Event</a>
            <a href="#why-join" class="mobile-nav-link block py-3 px-3 rounded-lg hover:bg-slate-50 hover:text-emerald-700" @click="open = false">Kenapa Join?</a>
            <a href="#articles" class="mobile-nav-link block py-3 px-3 rounded-lg hover:bg-slate-50 hover:text-emerald-700" @click="open = false">Artikel</a>
            <a href="#gallery" class="mobile-nav-link block py-3 px-3 rounded-lg hover:bg-slate-50 hover:text-emerald-700" @click="open = false">Galeri</a>
            <a
                href="{{ setting('wa_group_link', 'https://chat.whatsapp.com/Lo7XaVcbPi68DXbW212FX4') }}"
                target="_blank"
                class="block text-center mt-4 rounded-full bg-emerald-700 text-white font-semibold py-3 min-h-[44px] flex items-center justify-center gap-2 shadow-sm shadow-emerald-900/20"
                @click="open = false"
            >
                <x-icons name="whatsapp" class="w-5 h-5" />
                Gabung via WhatsApp
            </a>
        </div>
    </div>
</nav>
</header>

