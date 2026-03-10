<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', setting('meta_title', 'Peduli Lingkungan — Hijaukan Aksimu, Pedulikan Sekitarmu'))</title>
    <meta name="description" content="@yield('description', setting('meta_description', 'Komunitas pemuda peduli lingkungan di Purbalingga'))">
    <meta property="og:title" content="@yield('title', setting('meta_title', 'Peduli Lingkungan'))">
    <meta property="og:description" content="@yield('description', setting('meta_description', ''))">
    <meta property="og:image" content="@yield('og_image', setting('og_image') ? asset('storage/' . setting('og_image')) : asset('images/placeholder.svg'))">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>
<body class="bg-cream text-forest font-body antialiased">
    <div class="noise-overlay" aria-hidden="true"></div>
    @include('layouts.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('rv-ready');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, i) => {
                    if (entry.isIntersecting) {
                        entry.target.style.transitionDelay = (i * 0.08) + 's';
                        entry.target.classList.add('rv-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            document.querySelectorAll('.rv').forEach(el => observer.observe(el));

            // Scrollspy navbar sections
            const sectionIds = ['hero', 'about', 'events', 'why-join', 'articles', 'gallery'];
            const sections = sectionIds
                .map(id => document.getElementById(id))
                .filter(Boolean);
            const navLinks = Array.from(document.querySelectorAll('#main-nav a.nav-link'));

            if (sections.length && navLinks.length) {
                const linkBySection = {};
                navLinks.forEach(link => {
                    const section = link.dataset.section;
                    if (section) {
                        linkBySection[section] = link;
                    }
                });

                let activeId = null;
                const spyObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            activeId = entry.target.id;
                        }
                    });

                    if (!activeId || !linkBySection[activeId]) return;

                    navLinks.forEach(link => {
                        const isActive = link === linkBySection[activeId];
                        link.classList.toggle('text-emerald-700', isActive);
                        link.classList.toggle('border-emerald-600', isActive);
                    });
                }, { threshold: 0.5 });

                sections.forEach(sec => spyObserver.observe(sec));
            }
        });
    </script>
    @stack('scripts')
</body>
</html>

