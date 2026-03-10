<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Peduli Lingkungan') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Custom animations */
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                25% { transform: translateY(-10px) rotate(2deg); }
                50% { transform: translateY(-5px) rotate(-1deg); }
                75% { transform: translateY(-15px) rotate(1deg); }
            }
            @keyframes pulse-soft {
                0%, 100% { transform: scale(1); opacity: 0.4; }
                50% { transform: scale(1.1); opacity: 0.6; }
            }
            @keyframes slide-up {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }
            @keyframes fade-in {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                20%, 40%, 60%, 80% { transform: translateX(5px); }
            }
            @keyframes bounce-gentle {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-3px); }
            }
            @keyframes glow {
                0%, 100% { box-shadow: 0 0 20px rgba(126, 203, 95, 0.3); }
                50% { box-shadow: 0 0 40px rgba(126, 203, 95, 0.6); }
            }
            @keyframes gradient-shift {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            
            .animate-float { animation: float 8s ease-in-out infinite; }
            .animate-pulse-soft { animation: pulse-soft 6s ease-in-out infinite; }
            .animate-slide-up { animation: slide-up 0.6s ease-out forwards; opacity: 0; }
            .animate-fade-in { animation: fade-in 0.4s ease-out forwards; }
            .animate-shake { animation: shake 0.5s ease-in-out; }
            .animate-bounce-gentle { animation: bounce-gentle 2s ease-in-out infinite; }
            .animate-glow { animation: glow 2s ease-in-out infinite; }
            .animate-gradient { background-size: 200% 200%; animation: gradient-shift 8s ease infinite; }
            
            .delay-100 { animation-delay: 0.1s; }
            .delay-200 { animation-delay: 0.2s; }
            .delay-300 { animation-delay: 0.3s; }
            .delay-400 { animation-delay: 0.4s; }

            /* Parallax container */
            .parallax-bg {
                transition: transform 0.1s ease-out;
            }

            /* Input focus animations */
            .input-group {
                transition: all 0.3s ease;
            }
            .input-group:focus-within {
                transform: translateY(-2px);
            }
            .input-group:focus-within label {
                color: #4a9e6b;
            }
            .input-focus:focus {
                box-shadow: 0 8px 25px -5px rgba(74, 158, 107, 0.35);
                border-color: #4a9e6b;
            }
            
            /* Button hover effects */
            .btn-hover {
                position: relative;
                overflow: hidden;
                transition: all 0.3s ease;
            }
            .btn-hover::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
                transition: left 0.5s ease;
            }
            .btn-hover:hover::before {
                left: 100%;
            }
            .btn-hover:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 30px -10px rgba(126, 203, 95, 0.5);
            }
            .btn-hover:active {
                transform: translateY(0);
            }

            /* Loading button state */
            .btn-loading {
                pointer-events: none;
                position: relative;
            }
            .btn-loading::after {
                content: '';
                position: absolute;
                width: 20px;
                height: 20px;
                top: 50%;
                left: 50%;
                margin-left: -10px;
                margin-top: -10px;
                border: 2px solid transparent;
                border-top-color: white;
                border-radius: 50%;
                animation: spin 0.8s linear infinite;
            }
            @keyframes spin {
                to { transform: rotate(360deg); }
            }

            /* Success checkmark animation */
            .checkmark {
                stroke-dasharray: 50;
                stroke-dashoffset: 50;
                animation: draw-check 0.5s ease forwards 0.3s;
            }
            @keyframes draw-check {
                to { stroke-dashoffset: 0; }
            }

            /* Floating label */
            .floating-label {
                transition: all 0.3s ease;
            }
            input:focus + .floating-label,
            input:not(:placeholder-shown) + .floating-label {
                transform: translateY(-25px) scale(0.85);
                color: #4a9e6b;
            }

            /* Password strength indicator */
            .password-strength {
                height: 4px;
                transition: all 0.3s ease;
            }
            .password-strength.weak { width: 33%; background: #ef4444; }
            .password-strength.medium { width: 66%; background: #f59e0b; }
            .password-strength.strong { width: 100%; background: #22c55e; }

            /* Error shake */
            .has-error {
                animation: shake 0.5s ease-in-out;
                border-color: #ef4444 !important;
            }

            /* Smooth scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
            }
            ::-webkit-scrollbar-track {
                background: #1a3a2a;
            }
            ::-webkit-scrollbar-thumb {
                background: #4a9e6b;
                border-radius: 4px;
            }
        </style>
    </head>
    <body class="font-body text-gray-900 antialiased">
        <!-- Background with theme colors -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center relative overflow-hidden bg-forest" id="bg-container">
            <!-- Background effects -->
            <div class="absolute inset-0 bg-gradient-to-br from-forest via-moss to-forest animate-gradient"></div>
            <div class="parallax-bg absolute -left-32 top-10 w-80 h-80 bg-lime/20 rounded-full blur-3xl animate-pulse-soft" data-speed="0.3"></div>
            <div class="parallax-bg absolute right-0 bottom-0 w-[600px] h-[600px] bg-leaf/10 rounded-[70%] blur-3xl animate-pulse-soft" data-speed="0.2" style="animation-delay: 2s;"></div>
            <div class="parallax-bg absolute left-1/3 bottom-1/4 w-40 h-40 bg-spring/10 rounded-full blur-2xl animate-float" data-speed="0.4"></div>
            
            <!-- Interactive decorative elements -->
            <div class="parallax-bg absolute top-20 right-20 w-3 h-3 bg-lime/40 rounded-full animate-float cursor-pointer hover:scale-150 transition-transform" data-speed="0.5" style="animation-delay: 0.5s;"></div>
            <div class="parallax-bg absolute bottom-32 left-16 w-2 h-2 bg-leaf/50 rounded-full animate-float cursor-pointer hover:scale-150 transition-transform" data-speed="0.3" style="animation-delay: 1s;"></div>
            <div class="parallax-bg absolute top-1/3 left-1/4 w-4 h-4 bg-spring/30 rounded-full animate-float cursor-pointer hover:scale-150 transition-transform" data-speed="0.4" style="animation-delay: 1.5s;"></div>
            <div class="parallax-bg absolute top-1/2 right-1/4 w-2 h-2 bg-lime/30 rounded-full animate-float cursor-pointer hover:scale-150 transition-transform" data-speed="0.6" style="animation-delay: 2s;"></div>
            
            <!-- Floating particles -->
            <div id="particles-container"></div>

            <!-- Main container -->
            <div class="relative z-10 w-full sm:max-w-md px-4 py-6">
                <!-- Logo -->
                <div class="text-center mb-6 animate-slide-up">
                    <a href="/" class="inline-block group">
                        <div class="w-16 h-16 mx-auto bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/20 mb-4 group-hover:animate-glow transition-all">
                            <svg viewBox="0 0 316 316" xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 fill-lime transition-transform group-hover:scale-110">
                                <path d="M305.8 81.125C305.77 80.995 305.69 80.885 305.65 80.755C305.56 80.525 305.49 80.285 305.37 80.075C305.29 79.935 305.17 79.815 305.07 79.685C304.94 79.515 304.83 79.325 304.68 79.175C304.55 79.045 304.39 78.955 304.25 78.845C304.09 78.715 303.95 78.575 303.77 78.475L251.32 48.275C249.97 47.495 248.31 47.495 246.96 48.275L194.51 78.475C194.33 78.575 194.19 78.725 194.03 78.845C193.89 78.955 193.73 79.045 193.6 79.175C193.45 79.325 193.34 79.515 193.21 79.685C193.11 79.815 192.99 79.935 192.91 80.075C192.79 80.285 192.71 80.525 192.63 80.755C192.58 80.875 192.51 80.995 192.48 81.125C192.38 81.495 192.33 81.875 192.33 82.265V139.625L148.62 164.795V52.575C148.62 52.185 148.57 51.805 148.47 51.435C148.44 51.305 148.36 51.195 148.32 51.065C148.23 50.835 148.16 50.595 148.04 50.385C147.96 50.245 147.84 50.125 147.74 49.995C147.61 49.825 147.5 49.635 147.35 49.485C147.22 49.355 147.06 49.265 146.92 49.155C146.76 49.025 146.62 48.885 146.44 48.785L93.99 18.585C92.64 17.805 90.98 17.805 89.63 18.585L37.18 48.785C37 48.885 36.86 49.035 36.7 49.155C36.56 49.265 36.4 49.355 36.27 49.485C36.12 49.635 36.01 49.825 35.88 49.995C35.78 50.125 35.66 50.245 35.58 50.385C35.46 50.595 35.38 50.835 35.3 51.065C35.25 51.185 35.18 51.305 35.15 51.435C35.05 51.805 35 52.185 35 52.575V232.235C35 233.795 35.84 235.245 37.19 236.025L142.1 296.425C142.33 296.555 142.58 296.635 142.82 296.725C142.93 296.765 143.04 296.835 143.16 296.865C143.53 296.965 143.9 297.015 144.28 297.015C144.66 297.015 145.03 296.965 145.4 296.865C145.5 296.835 145.59 296.775 145.69 296.745C145.95 296.655 146.21 296.565 146.45 296.435L251.36 236.035C252.72 235.255 253.55 233.815 253.55 232.245V174.885L303.81 145.945C305.17 145.165 306 143.725 306 142.155V82.265C305.95 81.875 305.89 81.495 305.8 81.125ZM144.2 227.205L100.57 202.515L146.39 176.135L196.66 147.195L240.33 172.335L208.29 190.625L144.2 227.205ZM244.75 114.995V164.795L226.39 154.225L201.03 139.625V89.825L219.39 100.395L244.75 114.995ZM249.12 57.105L292.81 82.265L249.12 107.425L205.43 82.265L249.12 57.105ZM114.49 184.425L96.13 194.995V85.305L121.49 70.705L139.85 60.135V169.815L114.49 184.425ZM91.76 27.425L135.45 52.585L91.76 77.745L48.07 52.585L91.76 27.425ZM43.67 60.135L62.03 70.705L87.39 85.305V202.545V202.555V202.565C87.39 202.735 87.44 202.895 87.46 203.055C87.49 203.265 87.49 203.485 87.55 203.695V203.705C87.6 203.875 87.69 204.035 87.76 204.195C87.84 204.375 87.89 204.575 87.99 204.745C87.99 204.745 87.99 204.755 88 204.755C88.09 204.905 88.22 205.035 88.33 205.175C88.45 205.335 88.55 205.495 88.69 205.635L88.7 205.645C88.82 205.765 88.98 205.855 89.12 205.965C89.28 206.085 89.42 206.225 89.59 206.325C89.6 206.325 89.6 206.325 89.61 206.335C89.62 206.335 89.62 206.345 89.63 206.345L139.87 234.775V285.065L43.67 229.705V60.135ZM244.75 229.705L148.58 285.075V234.775L219.8 194.115L244.75 179.875V229.705ZM297.2 139.625L253.49 164.795V114.995L278.85 100.395L297.21 89.825V139.625H297.2Z"/>
                            </svg>
                        </div>
                    </a>
                    <h1 class="font-heading text-2xl text-white group-hover:text-lime transition-colors">Peduli Lingkungan</h1>
                    <p class="text-spring/70 text-sm mt-1">Hijaukan Aksimu, Pedulikan Sekitarmu</p>
                </div>

                <!-- Form Container -->
                <div class="relative bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl shadow-forest/30 p-6 sm:p-8 border border-white/20 animate-slide-up delay-100" id="form-container">
                    {{ $slot }}
                </div>

                <!-- Back to home -->
                <div class="text-center mt-6 animate-slide-up delay-200">
                    <a href="/" class="inline-flex items-center gap-2 text-sm text-spring/80 hover:text-white transition-all hover:gap-3">
                        <span class="w-6 h-6 rounded-full bg-white/10 flex items-center justify-center group-hover:animate-bounce-gentle">←</span>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Create floating particles
                const particlesContainer = document.getElementById('particles-container');
                for (let i = 0; i < 15; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'absolute w-1 h-1 bg-lime/30 rounded-full animate-float';
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.top = Math.random() * 100 + '%';
                    particle.style.animationDelay = Math.random() * 5 + 's';
                    particle.style.animationDuration = (3 + Math.random() * 4) + 's';
                    particlesContainer.appendChild(particle);
                }

                // Parallax effect on mouse move
                const bgContainer = document.getElementById('bg-container');
                const parallaxElements = document.querySelectorAll('.parallax-bg');
                
                bgContainer.addEventListener('mousemove', function(e) {
                    const x = (e.clientX / window.innerWidth - 0.5) * 20;
                    const y = (e.clientY / window.innerHeight - 0.5) * 20;
                    
                    parallaxElements.forEach(el => {
                        const speed = parseFloat(el.dataset.speed) || 0.1;
                        el.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
                    });
                });

                // Reset parallax on mouse leave
                bgContainer.addEventListener('mouseleave', function() {
                    parallaxElements.forEach(el => {
                        el.style.transform = 'translate(0, 0)';
                    });
                });

                // Password visibility toggle with animation
                const toggleButtons = document.querySelectorAll('.toggle-password');
                toggleButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const input = this.closest('.relative').querySelector('input');
                        const icon = this.querySelector('svg');
                        
                        // Animate the button
                        this.style.transform = 'scale(0.9)';
                        setTimeout(() => {
                            this.style.transform = 'scale(1)';
                        }, 100);
                        
                        if (input.type === 'password') {
                            input.type = 'text';
                            // Change eye icon to eye-off
                            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
                            icon.classList.add('text-leaf');
                            icon.classList.remove('text-moss/50');
                        } else {
                            input.type = 'password';
                            // Change eye-off icon to eye
                            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
                            icon.classList.remove('text-leaf');
                            icon.classList.add('text-moss/50');
                        }
                    });
                });

                // Form submission with loading state
                const forms = document.querySelectorAll('form');
                forms.forEach(form => {
                    form.addEventListener('submit', function(e) {
                        // Validate first
                        const inputs = this.querySelectorAll('input[required]');
                        let isValid = true;
                        
                        inputs.forEach(input => {
                            if (!input.value.trim()) {
                                isValid = false;
                                input.closest('.input-group')?.classList.add('has-error');
                                setTimeout(() => {
                                    input.closest('.input-group')?.classList.remove('has-error');
                                }, 500);
                            }
                        });

                        if (!isValid) {
                            e.preventDefault();
                            return;
                        }

                        const submitBtn = this.querySelector('button[type="submit"]');
                        if (submitBtn && !submitBtn.disabled) {
                            // Add loading class
                            submitBtn.classList.add('btn-loading');
                            submitBtn.classList.add('opacity-75');
                            
                            // Store original text
                            const originalText = submitBtn.textContent.trim();
                            submitBtn.dataset.original = originalText;
                            
                            // Show loading text
                            submitBtn.textContent = 'Memuat...';
                            
                            // Disable to prevent double submission
                            submitBtn.disabled = true;
                        }
                    });
                });

                // Input animations and validation
                const inputs = document.querySelectorAll('input');
                inputs.forEach(input => {
                    // Focus effects
                    input.addEventListener('focus', function() {
                        this.closest('.input-group')?.classList.add('ring-2', 'ring-leaf/30');
                    });
                    
                    input.addEventListener('blur', function() {
                        this.closest('.input-group')?.classList.remove('ring-2', 'ring-leaf/30');
                        
                        // Validate on blur
                        if (this.required && !this.value.trim()) {
                            this.closest('.input-group')?.classList.add('has-error');
                            setTimeout(() => {
                                this.closest('.input-group')?.classList.remove('has-error');
                            }, 500);
                        }
                    });

                    // Real-time validation feedback
                    input.addEventListener('input', function() {
                        if (this.value.trim()) {
                            this.closest('.input-group')?.classList.remove('has-error');
                        }
                    });
                });

                // Password strength indicator (for registration)
                const passwordInput = document.getElementById('password');
                if (passwordInput) {
                    const strengthContainer = document.createElement('div');
                    strengthContainer.className = 'password-strength weak';
                    strengthContainer.style.cssText = 'height: 4px; border-radius: 2px; margin-top: 8px; transition: all 0.3s ease;';
                    
                    passwordInput.addEventListener('input', function() {
                        const password = this.value;
                        let strength = 0;
                        
                        if (password.length >= 8) strength++;
                        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
                        if (password.match(/[0-9]/)) strength++;
                        if (password.match(/[^a-zA-Z0-9]/)) strength++;
                        
                        strengthContainer.className = 'password-strength';
                        if (strength <= 1) {
                            strengthContainer.classList.add('weak');
                        } else if (strength <= 2) {
                            strengthContainer.classList.add('medium');
                        } else {
                            strengthContainer.classList.add('strong');
                        }
                    });

                    // Add after password input
                    const passwordGroup = passwordInput.closest('.input-group');
                    if (passwordGroup) {
                        passwordGroup.appendChild(strengthContainer);
                    }
                }

                // Auto-focus first input
                const firstInput = document.querySelector('form input:not([type="hidden"]):first-of-type');
                if (firstInput) {
                    setTimeout(() => firstInput.focus(), 300);
                }

                // Keyboard navigation
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        const activeElement = document.activeElement;
                        if (activeElement.tagName === 'INPUT') {
                            const form = activeElement.closest('form');
                            const inputs = Array.from(form.querySelectorAll('input:not([type="hidden"]):not(:disabled)'));
                            const currentIndex = inputs.indexOf(activeElement);
                            
                            if (currentIndex < inputs.length - 1) {
                                e.preventDefault();
                                inputs[currentIndex + 1].focus();
                            }
                        }
                    }
                });

                // Smooth scroll to errors
                const errorMessages = document.querySelectorAll('.text-red-600');
                if (errorMessages.length > 0) {
                    const firstError = errorMessages[0];
                    const formContainer = document.getElementById('form-container');
                    formContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                    // Shake animation on errors
                    formContainer.classList.add('animate-shake');
                    setTimeout(() => {
                        formContainer.classList.remove('animate-shake');
                    }, 500);
                }

                // Add hover effects to decorative elements
                const decorElements = document.querySelectorAll('.parallax-bg[data-speed]');
                decorElements.forEach(el => {
                    if (!el.classList.contains('cursor-pointer')) {
                        el.style.cursor = 'default';
                    }
                });
            });
        </script>
    </body>
</html>
