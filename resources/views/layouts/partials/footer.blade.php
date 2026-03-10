<footer class="bg-forest text-white pt-16 pb-6 mt-0">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid md:grid-cols-4 gap-10 border-b border-white/10 pb-10">
            <div>
               <p class="font-heading text-2xl font-semibold mb-3 flex items-center gap-2 whitespace-nowrap">
    <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-8 h-8 rounded-full object-cover flex-shrink-0" />
    Peduli Lingkungan
</p>
<p class="text-sm text-spring/80 leading-relaxed mb-4">
    Komunitas pemuda Purbalingga yang bergerak untuk lingkungan lebih sehat, hijau, dan berkelanjutan — dimulai dari aksi nyata hari ini.
</p>
                <div class="flex gap-2">
                    <a href="{{ setting('instagram_url', '#') }}" target="_blank" class="social-icon" aria-label="Instagram">
                        <x-icons name="instagram" class="w-4 h-4" />
                    </a>
                    <a href="{{ setting('wa_group_link', '#') }}" target="_blank" class="social-icon" aria-label="WhatsApp">
                        <x-icons name="whatsapp" class="w-4 h-4" />
                    </a>
                    <a href="tel:{{ preg_replace('/[^0-9]/', '', setting('wa_phone', '081229428356')) }}" class="social-icon" aria-label="Telepon">
                        <x-icons name="phone" class="w-4 h-4" />
                    </a>
                </div>
            </div>

            <div>
                <h4 class="footer-title">Navigasi</h4>
                <ul class="space-y-2 text-sm text-spring/80">
                    <li><a href="#about" class="footer-link">Tentang Kami</a></li>
                    <li><a href="#events" class="footer-link">Event & Aksi</a></li>
                    <li><a href="#why-join" class="footer-link">Kenapa Join</a></li>
                    <li><a href="#gallery" class="footer-link">Galeri</a></li>
                    <li><a href="#testimonials" class="footer-link">Cerita Member</a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer-title">Program</h4>
                <ul class="space-y-2 text-sm text-spring/80">
                    <li><a href="#" class="footer-link">Tanam Pohon</a></li>
                    <li><a href="#" class="footer-link">Edukasi Sekolah</a></li>
                    <li><a href="#" class="footer-link">Bersih Sungai</a></li>
                    <li><a href="#" class="footer-link">Zero Waste</a></li>
                    <li><a href="#" class="footer-link">Advokasi Lokal</a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer-title">Kontak</h4>
                <ul class="space-y-2 text-sm text-spring/80">
                    <li class="flex items-center gap-2"><x-icons name="map-pin" class="w-4 h-4 flex-shrink-0" /> {{ setting('address', 'Purbalingga, Jawa Tengah') }}</li>
                    <li class="flex items-center gap-2"><x-icons name="phone" class="w-4 h-4 flex-shrink-0" /> {{ setting('wa_phone', '0812-2942-8356') }}</li>
                    <li class="flex items-center gap-2"><x-icons name="instagram" class="w-4 h-4 flex-shrink-0" /> {{ '@' . ltrim(str_replace(['https://instagram.com/', 'https://www.instagram.com/'], '', setting('instagram_url', 'pedullingkungan')), '@') }}</li>
                    <li class="flex items-center gap-2"><x-icons name="whatsapp" class="w-4 h-4 flex-shrink-0" /> Grup WhatsApp Komunitas</li>
                </ul>
            </div>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-between mt-6 text-xs text-spring/70 gap-2">
            <span>© {{ now()->year }} Peduli Lingkungan · Dibuat dengan <x-icons name="leaf" class="w-3 h-3 inline text-lime" /> untuk Bumi</span>
            <span>Purbalingga · Jawa Tengah · Indonesia</span>
        </div>
    </div>
</footer>

<a
    href="{{ setting('wa_group_link', 'https://chat.whatsapp.com/Lo7XaVcbPi68DXbW212FX4') }}"
    target="_blank"
    class="fixed wa-float z-40 w-14 h-14 rounded-full flex items-center justify-center tap-target"
>
    <div class="relative w-full h-full">
        <div class="absolute inset-0 rounded-full bg-[#25D366]/40 animate-ping"></div>
        <div class="relative w-14 h-14 rounded-full bg-[#25D366] flex items-center justify-center shadow-xl shadow-[#25D366]/40 hover:scale-105 active:scale-95 transition-transform">
            <x-icons name="whatsapp" class="w-7 h-7 text-white" />
        </div>
    </div>
</a>

