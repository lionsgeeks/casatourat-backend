<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>{{ config('app.name', 'Casatourat') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body
    class="min-h-screen bg-background text-foreground font-sans antialiased selection:bg-primary selection:text-primary-foreground"
    x-data="{
        lang: 'french',
        formSuccess: {{ session('inscription_success') ? 'true' : 'false' }},
        formLoading: false,
    }"
>

    {{-- ── Ambient background glows ── --}}
    <div aria-hidden="true" class="pointer-events-none fixed inset-0 overflow-hidden -z-10">
        <div class="absolute -top-40 left-1/2 h-[40rem] w-[40rem] -translate-x-1/2 rounded-full bg-[rgb(var(--primary)/0.08)] blur-3xl"></div>
        <div class="absolute top-1/2 -right-32 h-[30rem] w-[30rem] -translate-y-1/2 rounded-full bg-[rgb(var(--primary)/0.05)] blur-3xl"></div>
        <div class="absolute -bottom-40 left-1/4 h-[35rem] w-[35rem] rounded-full bg-[rgb(var(--primary)/0.06)] blur-3xl"></div>
    </div>

    {{-- ── Fixed language switcher — top right ── --}}
    <div class="fixed right-4 top-4 z-50 sm:right-6">
        <label class="sr-only" for="lang">Language</label>
        <select
            id="lang"
            name="lang"
            x-model="lang"
            class="rounded-full border border-[rgb(var(--border))] bg-[rgb(var(--card))] px-3 py-1.5 text-xs font-semibold text-[rgb(var(--foreground))] shadow-md backdrop-blur-sm transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-[rgb(var(--ring))]"
        >
            <option value="english">🇬🇧 English</option>
            <option value="french">🇫🇷 Français</option>
            <option value="arabic">🇲🇦 عربية</option>
        </select>
    </div>

    <div class="relative">
        <main>

            {{-- ════════════════════════════════════════
                 HERO
            ════════════════════════════════════════ --}}
            <section class="relative overflow-hidden">

                {{-- Subtle grid pattern overlay --}}
                <div aria-hidden="true" class="pointer-events-none absolute inset-0 bg-[linear-gradient(rgb(var(--border)/0.35)_1px,transparent_1px),linear-gradient(90deg,rgb(var(--border)/0.35)_1px,transparent_1px)] bg-[size:48px_48px] [mask-image:radial-gradient(ellipse_80%_60%_at_50%_0%,black_40%,transparent_100%)]"></div>

                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="grid items-center gap-16 py-20 lg:grid-cols-2 lg:py-28">

                        {{-- ── LEFT — Copy ── --}}
                        <div class="space-y-8">

                            {{-- Badge pill --}}
                            <div class="inline-flex items-center gap-2 rounded-full border border-[rgb(var(--border))] bg-[rgb(var(--card))] px-3 py-1.5 text-xs font-medium text-[rgb(var(--foreground))] shadow-sm">
                                <span class="inline-block h-2 w-2 animate-pulse rounded-full bg-[rgb(var(--primary))]"></span>
                                <span x-show="lang === 'english'">Built for discovery in Casablanca</span>
                                <span x-show="lang === 'french'">Conçu pour découvrir Casablanca</span>
                                <span x-show="lang === 'arabic'" dir="rtl">مصمم لاكتشاف الدار البيضاء</span>
                            </div>

                            {{-- Headline --}}
                            <h1
                                data-reveal
                                class="text-balance text-5xl font-bold leading-[1.1] tracking-tight text-[rgb(var(--foreground))] opacity-0 translate-y-4 transition duration-700 ease-out will-change-transform sm:text-6xl lg:text-[4rem]"
                            >
                                <span x-show="lang === 'english'">
                                    Casablanca<br>
                                    <span class="text-[rgb(var(--primary))]">Revolutionized</span><br>
                                    with our App
                                </span>
                                <span x-show="lang === 'french'">
                                    Casablanca<br>
                                    <span class="text-[rgb(var(--primary))]">Révolutionnée</span><br>
                                    avec notre App
                                </span>
                                <span x-show="lang === 'arabic'" dir="rtl">
                                    الدار البيضاء<br>
                                    <span class="text-[rgb(var(--primary))]">ثورة جديدة</span><br>
                                    مع تطبيقنا
                                </span>
                            </h1>

                            {{-- Sub-copy --}}
                            <p
                                data-reveal
                                class="max-w-md text-pretty text-base font-medium text-[rgb(var(--muted))] opacity-0 translate-y-4 transition duration-700 ease-out delay-100 will-change-transform sm:text-lg"
                            >
                                <span x-show="lang === 'english'">Discover curated circuits, cultural places, and events — fast, clear, and beautiful.</span>
                                <span x-show="lang === 'french'">Découvrez des circuits sélectionnés, des lieux culturels et des événements — rapide, claire et belle.</span>
                                <span x-show="lang === 'arabic'" dir="rtl">اكتشف دوائر مختارة وأماكن ثقافية وأحداث — سريع، واضح، وجميل.</span>
                            </p>

                            {{-- CTA row --}}
                            <div data-reveal class="flex flex-col gap-3 opacity-0 translate-y-4 transition duration-700 ease-out delay-200 will-change-transform sm:flex-row sm:items-center">
                                <a
                                    href="#inscription"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[rgb(var(--primary))] px-7 py-3.5 text-sm font-semibold text-[rgb(var(--primary-foreground))] shadow-lg shadow-[rgb(var(--primary)/0.25)] ring-1 ring-[rgb(var(--primary)/0.20)] transition hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-[rgb(var(--ring))] no-underline"
                                >
                                    <span x-show="lang === 'english'">Get Started</span>
                                    <span x-show="lang === 'french'">Commencer</span>
                                    <span x-show="lang === 'arabic'" dir="rtl">ابدأ الآن</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"/><path d="m13 5 7 7-7 7"/>
                                    </svg>
                                </a>
                                <a
                                    href="#features"
                                    class="inline-flex items-center justify-center rounded-xl border border-[rgb(var(--border))] bg-[rgb(var(--card))] px-7 py-3.5 text-sm font-semibold text-[rgb(var(--foreground))] shadow-sm transition hover:bg-[rgb(var(--primary)/0.06)] focus:outline-none focus:ring-2 focus:ring-[rgb(var(--ring))] no-underline"
                                >
                                    <span x-show="lang === 'english'">See features</span>
                                    <span x-show="lang === 'french'">Voir les fonctionnalités</span>
                                    <span x-show="lang === 'arabic'" dir="rtl">عرض الميزات</span>
                                </a>
                            </div>

                            {{-- App store badges --}}
                            <div data-reveal class="flex flex-wrap items-center gap-3 opacity-0 translate-y-4 transition duration-700 ease-out delay-300 will-change-transform">
                                <a target="_blank" rel="noreferrer" href="https://apps.apple.com/us/app/casatourat/id6740987173" class="transition hover:-translate-y-0.5 hover:brightness-105">
                                    <img width="180" class="h-auto" src="{{ asset('assets/images/App_Store_(iOS)-Badge-Logo.wine.png') }}" alt="Download on the App Store" loading="lazy">
                                </a>
                                <a target="_blank" rel="noreferrer" href="https://play.google.com/store/apps/details?id=com.casatourat.casaguide" class="transition hover:-translate-y-0.5 hover:brightness-105">
                                    <img width="150" class="h-auto" src="{{ asset('assets/images/Google_Play-Badge-Logo.wine.png') }}" alt="Get it on Google Play" loading="lazy">
                                </a>
                            </div>

                            {{-- Social proof note --}}
                            <p data-reveal class="flex items-center gap-2 text-xs text-[rgb(var(--muted))] opacity-0 translate-y-4 transition duration-700 ease-out delay-[400ms] will-change-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0 text-[rgb(var(--primary))]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                                <span x-show="lang === 'english'">Free to download · No credit card required</span>
                                <span x-show="lang === 'french'">Téléchargement gratuit · Sans carte bancaire</span>
                                <span x-show="lang === 'arabic'" dir="rtl">تحميل مجاني · بدون بطاقة بنكية</span>
                            </p>
                        </div>

                        {{-- ── RIGHT — Two floating phone screens ── --}}
                        <div class="relative flex items-end justify-center lg:justify-end" style="min-height: 680px;">

                            {{-- Radial glow behind phones --}}
                            <div aria-hidden="true" class="absolute inset-0 flex items-center justify-center">
                                <div class="h-[28rem] w-[28rem] rounded-full bg-[rgb(var(--primary)/0.12)] blur-3xl"></div>
                            </div>

                            {{-- Phone 1 — back / slightly left, raised --}}
                            <div
                                data-reveal
                                class="relative z-10 -mr-12 w-[280px] opacity-0 translate-y-4 transition duration-700 ease-out will-change-transform sm:w-[300px]"
                                style="margin-bottom: 60px;"
                            >
                                {{-- Phone shell --}}
                                <div class="relative overflow-hidden rounded-[2.8rem] border-[3px] border-[rgb(var(--foreground)/0.08)] bg-[rgb(var(--foreground)/0.06)] shadow-2xl shadow-[rgb(var(--primary)/0.15)]">
                                    {{-- Notch --}}
                                    <div class="absolute left-1/2 top-2.5 z-20 h-5 w-24 -translate-x-1/2 rounded-full bg-[rgb(var(--foreground)/0.10)]"></div>
                                    {{-- Screen --}}
                                    <div class="overflow-hidden rounded-[2.6rem]">
                                        <img
                                            src="{{ asset('assets/images/Frame_65.png') }}"
                                            alt="Casatourat screen — circuits"
                                            class="h-auto w-full object-cover"
                                            loading="eager"
                                        />
                                    </div>
                                </div>

                                {{-- Floating stat badge — top-left of phone 1 --}}
                                <div class="absolute -left-14 top-12 z-30 hidden sm:block">
                                    <div class="flex items-center gap-2 rounded-2xl border border-[rgb(var(--border))] bg-[rgb(var(--card))] px-3 py-2.5 shadow-lg ring-1 ring-[rgb(var(--primary)/0.10)]">
                                        <div class="grid h-8 w-8 shrink-0 place-items-center rounded-xl bg-[rgb(var(--primary)/0.10)]">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[rgb(var(--primary))]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="m-0 text-xs font-bold text-[rgb(var(--foreground))]">#1</p>
                                            <p class="m-0 text-[10px] leading-tight text-[rgb(var(--muted))]">
                                                <span x-show="lang === 'english'">Best city app</span>
                                                <span x-show="lang === 'french'">Meilleure app</span>
                                                <span x-show="lang === 'arabic'" dir="rtl">أفضل تطبيق</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Phone 2 — front / slightly right, lower --}}
                            <div
                                data-reveal
                                class="relative z-20 w-[280px] opacity-0 translate-y-4 transition duration-700 ease-out delay-150 will-change-transform sm:w-[300px]"
                            >
                                {{-- Phone shell --}}
                                <div class="relative overflow-hidden rounded-[2.8rem] border-[3px] border-[rgb(var(--foreground)/0.08)] bg-[rgb(var(--foreground)/0.06)] shadow-2xl shadow-[rgb(var(--primary)/0.20)]">
                                    {{-- Notch --}}
                                    <div class="absolute left-1/2 top-2.5 z-20 h-5 w-24 -translate-x-1/2 rounded-full bg-[rgb(var(--foreground)/0.10)]"></div>
                                    {{-- Screen --}}
                                    <div class="overflow-hidden rounded-[2.6rem]">
                                        <img
                                            src="{{ asset('assets/images/Frame_64.png') }}"
                                            alt="Casatourat screen — events"
                                            class="h-auto w-full object-cover"
                                            loading="eager"
                                        />
                                    </div>
                                </div>

                                {{-- Floating stat badge — bottom-right of phone 2 --}}
                                <div class="absolute -bottom-4 -right-14 z-30 hidden sm:block">
                                    <div class="flex items-center gap-2 rounded-2xl border border-[rgb(var(--border))] bg-[rgb(var(--card))] px-3 py-2.5 shadow-lg ring-1 ring-[rgb(var(--primary)/0.10)]">
                                        <div class="flex -space-x-1.5">
                                            @foreach (['A','B','C'] as $i)
                                            <div class="grid h-6 w-6 place-items-center rounded-full border-2 border-[rgb(var(--card))] bg-[rgb(var(--primary)/0.15)] text-[9px] font-bold text-[rgb(var(--primary))]">{{ $i }}</div>
                                            @endforeach
                                        </div>
                                        <div>
                                            <p class="m-0 text-xs font-bold text-[rgb(var(--foreground))]">100K+</p>
                                            <p class="m-0 text-[10px] leading-tight text-[rgb(var(--muted))]">
                                                <span x-show="lang === 'english'">Satisfied users</span>
                                                <span x-show="lang === 'french'">Utilisateurs</span>
                                                <span x-show="lang === 'arabic'" dir="rtl">مستخدم راضٍ</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </section>

            {{-- ════════════════════════════════════════
                 FEATURES
            ════════════════════════════════════════ --}}
            <section id="features" class="py-16 sm:py-20">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                    {{-- Section header --}}
                    <div class="mx-auto max-w-2xl text-center">
                        <span class="inline-flex items-center gap-2 rounded-full border border-[rgb(var(--border))] bg-[rgb(var(--card))] px-3 py-1 text-xs font-semibold text-[rgb(var(--primary))] shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            <span x-show="lang === 'english'">Why Casatourat</span>
                            <span x-show="lang === 'french'">Pourquoi Casatourat</span>
                            <span x-show="lang === 'arabic'" dir="rtl">لماذا كازاتورات</span>
                        </span>
                        <h2 class="mt-4 text-2xl font-bold tracking-tight text-[rgb(var(--foreground))] sm:text-3xl">
                            <span x-show="lang === 'english'">Everything you need to explore with confidence</span>
                            <span x-show="lang === 'french'">Tout ce qu'il faut pour explorer en toute confiance</span>
                            <span x-show="lang === 'arabic'" dir="rtl">كل ما تحتاجه للاستكشاف بثقة</span>
                        </h2>
                        <p class="mt-3 text-base font-medium text-[rgb(var(--muted))]">
                            <span x-show="lang === 'english'">High-signal content, clear navigation, and experiences that feel local — not generic.</span>
                            <span x-show="lang === 'french'">Du contenu utile, une navigation claire, et une expérience vraiment locale.</span>
                            <span x-show="lang === 'arabic'" dir="rtl">محتوى عالي الجودة، تنقل واضح، وتجربة محلية حقيقية.</span>
                        </p>
                    </div>

                    {{-- Feature cards --}}
                    <div class="mt-12 grid gap-5 md:grid-cols-3">

                        {{-- Card 1 --}}
                        <div class="group relative overflow-hidden rounded-2xl border border-[rgb(var(--border))] bg-[rgb(var(--card))] p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                            <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-br from-[rgb(var(--primary)/0.04)] to-transparent opacity-0 transition group-hover:opacity-100"></div>
                            <div class="relative">
                                <div class="grid h-12 w-12 place-items-center rounded-xl bg-[rgb(var(--primary)/0.10)] ring-1 ring-[rgb(var(--primary)/0.20)]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[rgb(var(--primary))]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 21s-6-4.35-6-10a6 6 0 0 1 12 0c0 5.65-6 10-6 10Z"/>
                                        <circle cx="12" cy="11" r="2"/>
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-base font-semibold text-[rgb(var(--foreground))]">
                                    <span x-show="lang === 'english'">Curated places</span>
                                    <span x-show="lang === 'french'">Lieux sélectionnés</span>
                                    <span x-show="lang === 'arabic'" dir="rtl">أماكن مختارة</span>
                                </h3>
                                <p class="mt-2 text-sm font-medium text-[rgb(var(--muted))]">
                                    <span x-show="lang === 'english'">Open any place and instantly understand what it is and why it matters.</span>
                                    <span x-show="lang === 'french'">Comprenez en un instant ce qu'est un lieu et pourquoi il compte.</span>
                                    <span x-show="lang === 'arabic'" dir="rtl">افهم فوراً ما هو المكان ولماذا هو مهم.</span>
                                </p>
                            </div>
                        </div>

                        {{-- Card 2 (highlighted) --}}
                        <div class="group relative overflow-hidden rounded-2xl border border-[rgb(var(--primary)/0.25)] bg-[rgb(var(--primary)/0.04)] p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                            <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-br from-[rgb(var(--primary)/0.08)] to-transparent opacity-0 transition group-hover:opacity-100"></div>
                            <div class="relative">
                                <div class="grid h-12 w-12 place-items-center rounded-xl bg-[rgb(var(--primary))] ring-1 ring-[rgb(var(--primary)/0.40)]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M8 2v4"/><path d="M16 2v4"/>
                                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                                        <path d="M3 10h18"/>
                                        <path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/>
                                        <path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/>
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-base font-semibold text-[rgb(var(--foreground))]">
                                    <span x-show="lang === 'english'">Event-ready</span>
                                    <span x-show="lang === 'french'">Prêt pour les événements</span>
                                    <span x-show="lang === 'arabic'" dir="rtl">جاهز للأحداث</span>
                                </h3>
                                <p class="mt-2 text-sm font-medium text-[rgb(var(--muted))]">
                                    <span x-show="lang === 'english'">Know what's happening nearby and plan ahead without stress.</span>
                                    <span x-show="lang === 'french'">Sachez ce qui se passe et planifiez sans stress.</span>
                                    <span x-show="lang === 'arabic'" dir="rtl">اعرف ما يحدث وخطط مسبقاً بدون توتر.</span>
                                </p>
                            </div>
                        </div>

                        {{-- Card 3 --}}
                        <div class="group relative overflow-hidden rounded-2xl border border-[rgb(var(--border))] bg-[rgb(var(--card))] p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                            <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-br from-[rgb(var(--primary)/0.04)] to-transparent opacity-0 transition group-hover:opacity-100"></div>
                            <div class="relative">
                                <div class="grid h-12 w-12 place-items-center rounded-xl bg-[rgb(var(--primary)/0.10)] ring-1 ring-[rgb(var(--primary)/0.20)]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[rgb(var(--primary))]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-base font-semibold text-[rgb(var(--foreground))]">
                                    <span x-show="lang === 'english'">Fast planning</span>
                                    <span x-show="lang === 'french'">Planification rapide</span>
                                    <span x-show="lang === 'arabic'" dir="rtl">تخطيط سريع</span>
                                </h3>
                                <p class="mt-2 text-sm font-medium text-[rgb(var(--muted))]">
                                    <span x-show="lang === 'english'">Save time with circuits designed to flow naturally from stop to stop.</span>
                                    <span x-show="lang === 'french'">Gagnez du temps avec des circuits fluides et cohérents.</span>
                                    <span x-show="lang === 'arabic'" dir="rtl">وفّر الوقت بدوائر مصممة لتسير بسلاسة من محطة لأخرى.</span>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            {{-- ════════════════════════════════════════
                 EVENT INSCRIPTION
            ════════════════════════════════════════ --}}
            <section id="inscription" class="py-16 sm:py-20">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="grid gap-12 lg:grid-cols-2 lg:items-center">

                        {{-- Left — context copy --}}
                        <div class="space-y-6">
                            <div>
                                <span class="inline-flex items-center gap-2 rounded-full border border-[rgb(var(--border))] bg-[rgb(var(--card))] px-3 py-1 text-xs font-semibold text-[rgb(var(--primary))] shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                    <span x-show="lang === 'english'">Event Registration</span>
                                    <span x-show="lang === 'french'">Inscription aux événements</span>
                                    <span x-show="lang === 'arabic'" dir="rtl">التسجيل في الأحداث</span>
                                </span>

                                <h2 class="mt-4 text-2xl font-bold tracking-tight text-[rgb(var(--foreground))] sm:text-3xl">
                                    <span x-show="lang === 'english'">Reserve your spot at the next event</span>
                                    <span x-show="lang === 'french'">Réservez votre place au prochain événement</span>
                                    <span x-show="lang === 'arabic'" dir="rtl">احجز مكانك في الحدث القادم</span>
                                </h2>
                                <p class="mt-3 text-base font-medium text-[rgb(var(--muted))]">
                                    <span x-show="lang === 'english'">Pick an event, share your details, and we'll contact you with the schedule and meeting point.</span>
                                    <span x-show="lang === 'french'">Choisissez un événement, laissez vos infos, et nous vous envoyons le planning et le point de rendez-vous.</span>
                                    <span x-show="lang === 'arabic'" dir="rtl">اختر الحدث واترك بياناتك وسنرسل لك الجدول ونقطة اللقاء.</span>
                                </p>
                            </div>

                            {{-- Benefit cards --}}
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div class="rounded-2xl border border-[rgb(var(--border))] bg-[rgb(var(--card))] p-5 shadow-sm">
                                    <div class="flex items-start gap-3">
                                        <div class="mt-0.5 grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-[rgb(var(--primary)/0.10)]">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[rgb(var(--primary))]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="20 6 9 17 4 12"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="m-0 text-sm font-semibold text-[rgb(var(--foreground))]">
                                                <span x-show="lang === 'english'">Quick confirmation</span>
                                                <span x-show="lang === 'french'">Confirmation rapide</span>
                                                <span x-show="lang === 'arabic'" dir="rtl">تأكيد سريع</span>
                                            </p>
                                            <p class="m-0 mt-1 text-sm text-[rgb(var(--muted))]">
                                                <span x-show="lang === 'english'">Simple form, clean details, no friction.</span>
                                                <span x-show="lang === 'french'">Formulaire simple, infos claires, zéro friction.</span>
                                                <span x-show="lang === 'arabic'" dir="rtl">نموذج بسيط ومعلومات واضحة دون تعقيد.</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="rounded-2xl border border-[rgb(var(--border))] bg-[rgb(var(--card))] p-5 shadow-sm">
                                    <div class="flex items-start gap-3">
                                        <div class="mt-0.5 grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-[rgb(var(--primary)/0.10)]">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[rgb(var(--primary))]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/>
                                                <line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="m-0 text-sm font-semibold text-[rgb(var(--foreground))]">
                                                <span x-show="lang === 'english'">No spam, ever</span>
                                                <span x-show="lang === 'french'">Zéro spam, jamais</span>
                                                <span x-show="lang === 'arabic'" dir="rtl">لا رسائل مزعجة أبداً</span>
                                            </p>
                                            <p class="m-0 mt-1 text-sm text-[rgb(var(--muted))]">
                                                <span x-show="lang === 'english'">Only what matters — no noise.</span>
                                                <span x-show="lang === 'french'">Uniquement l'essentiel — pas de bruit.</span>
                                                <span x-show="lang === 'arabic'" dir="rtl">فقط المهم — بدون إزعاج.</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Social proof --}}
                            <div class="flex items-center gap-3 rounded-2xl border border-[rgb(var(--border))] bg-[rgb(var(--card))] px-5 py-4 shadow-sm">
                                <div class="flex -space-x-2">
                                    @foreach (['A','B','C','D'] as $initial)
                                    <div class="grid h-8 w-8 place-items-center rounded-full border-2 border-[rgb(var(--card))] bg-[rgb(var(--primary)/0.12)] text-xs font-bold text-[rgb(var(--primary))]">{{ $initial }}</div>
                                    @endforeach
                                </div>
                                <p class="m-0 text-sm font-medium text-[rgb(var(--foreground)/0.80)]">
                                    <span x-show="lang === 'english'">Join hundreds already exploring Casablanca with us.</span>
                                    <span x-show="lang === 'french'">Rejoignez des centaines qui explorent déjà Casablanca avec nous.</span>
                                    <span x-show="lang === 'arabic'" dir="rtl">انضم إلى المئات الذين يستكشفون الدار البيضاء معنا.</span>
                                </p>
                            </div>
                        </div>

                        {{-- Right — registration form --}}
                        <div>
                            <div class="relative mx-auto w-full max-w-lg">
                                {{-- Glow behind card --}}
                                <div aria-hidden="true" class="absolute -inset-4 rounded-[2.5rem] bg-gradient-to-br from-[rgb(var(--primary)/0.12)] to-transparent blur-2xl"></div>

                                <div class="relative overflow-hidden rounded-2xl border border-[rgb(var(--border))] bg-[rgb(var(--card))] shadow-xl">

                                    {{-- Card top accent bar --}}
                                    <div class="h-1 w-full bg-gradient-to-r from-[rgb(var(--primary))] via-[rgb(var(--primary)/0.60)] to-transparent"></div>

                                    <div class="p-6 sm:p-8">

                                        {{-- Card header --}}
                                        <div class="flex items-start justify-between gap-4">
                                            <div>
                                                <h3 class="text-lg font-bold text-[rgb(var(--foreground))]">
                                                    <span x-show="lang === 'english'">Reserve your spot</span>
                                                    <span x-show="lang === 'french'">Réservez votre place</span>
                                                    <span x-show="lang === 'arabic'" dir="rtl">احجز مكانك</span>
                                                </h3>
                                                <p class="mt-1 text-sm text-[rgb(var(--muted))]">
                                                    <span x-show="lang === 'english'">We'll confirm by phone or email.</span>
                                                    <span x-show="lang === 'french'">Confirmation par téléphone ou email.</span>
                                                    <span x-show="lang === 'arabic'" dir="rtl">سنؤكد عبر الهاتف أو البريد.</span>
                                                </p>
                                            </div>
                                            <div class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-[rgb(var(--primary)/0.10)] ring-1 ring-[rgb(var(--primary)/0.20)]">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[rgb(var(--primary))]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M8 2v4"/><path d="M16 2v4"/>
                                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                                    <path d="M3 10h18"/>
                                                    <path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/>
                                                </svg>
                                            </div>
                                        </div>

                                        {{-- Success state --}}
                                        <div x-show="formSuccess" x-transition class="mt-6 flex flex-col items-center gap-3 rounded-xl border border-[rgb(var(--primary)/0.20)] bg-[rgb(var(--primary)/0.06)] px-6 py-8 text-center">
                                            <div class="grid h-12 w-12 place-items-center rounded-full bg-[rgb(var(--primary))]">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12"/>
                                                </svg>
                                            </div>
                                            <p class="text-base font-semibold text-[rgb(var(--foreground))]">
                                                <span x-show="lang === 'english'">You're registered!</span>
                                                <span x-show="lang === 'french'">Vous êtes inscrit(e) !</span>
                                                <span x-show="lang === 'arabic'" dir="rtl">تم تسجيلك بنجاح!</span>
                                            </p>
                                            <p class="text-sm text-[rgb(var(--muted))]">
                                                <span x-show="lang === 'english'">We'll be in touch soon with all the details.</span>
                                                <span x-show="lang === 'french'">Nous vous contacterons bientôt avec tous les détails.</span>
                                                <span x-show="lang === 'arabic'" dir="rtl">سنتواصل معك قريباً بكل التفاصيل.</span>
                                            </p>
                                        </div>

                                        {{-- Form --}}
                                        <form
                                            x-show="!formSuccess"
                                            class="mt-6 grid gap-5"
                                            method="POST"
                                            action="{{ route('inscription.store') }}"
                                            @submit.prevent="
                                                formLoading = true;
                                                $el.submit();
                                            "
                                        >
                                            @csrf

                                            {{-- Validation errors --}}
                                            @if ($errors->any())
                                                <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                                                    <ul class="m-0 list-inside list-disc space-y-1">
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            {{-- Full name --}}
                                            <div class="grid gap-1.5">
                                                <label for="full_name" class="text-sm font-semibold text-[rgb(var(--foreground))]">
                                                    <span x-show="lang === 'english'">Full name</span>
                                                    <span x-show="lang === 'french'">Nom complet</span>
                                                    <span x-show="lang === 'arabic'" dir="rtl">الاسم الكامل</span>
                                                    <span class="text-[rgb(var(--primary))]">*</span>
                                                </label>
                                                <div class="relative">
                                                    <span class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center text-[rgb(var(--muted))]">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                                                        </svg>
                                                    </span>
                                                    <input
                                                        id="full_name"
                                                        name="full_name"
                                                        type="text"
                                                        autocomplete="name"
                                                        required
                                                        value="{{ old('full_name') }}"
                                                        placeholder="Ahmed Benali"
                                                        class="w-full rounded-xl border border-[rgb(var(--border))] bg-[rgb(var(--background))] py-3 pl-10 pr-4 text-sm text-[rgb(var(--foreground))] shadow-sm placeholder:text-[rgb(var(--muted))] transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-[rgb(var(--ring))]"
                                                    />
                                                </div>
                                            </div>

                                            {{-- Email --}}
                                            <div class="grid gap-1.5">
                                                <label for="email" class="text-sm font-semibold text-[rgb(var(--foreground))]">
                                                    <span x-show="lang === 'english'">Email address</span>
                                                    <span x-show="lang === 'french'">Adresse email</span>
                                                    <span x-show="lang === 'arabic'" dir="rtl">البريد الإلكتروني</span>
                                                    <span class="text-[rgb(var(--primary))]">*</span>
                                                </label>
                                                <div class="relative">
                                                    <span class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center text-[rgb(var(--muted))]">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                                        </svg>
                                                    </span>
                                                    <input
                                                        id="email"
                                                        name="email"
                                                        type="email"
                                                        autocomplete="email"
                                                        required
                                                        value="{{ old('email') }}"
                                                        placeholder="ahmed@example.com"
                                                        class="w-full rounded-xl border border-[rgb(var(--border))] bg-[rgb(var(--background))] py-3 pl-10 pr-4 text-sm text-[rgb(var(--foreground))] shadow-sm placeholder:text-[rgb(var(--muted))] transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-[rgb(var(--ring))]"
                                                    />
                                                </div>
                                            </div>

                                            {{-- Phone --}}
                                            <div class="grid gap-1.5">
                                                <label for="phone" class="text-sm font-semibold text-[rgb(var(--foreground))]">
                                                    <span x-show="lang === 'english'">Phone number</span>
                                                    <span x-show="lang === 'french'">Numéro de téléphone</span>
                                                    <span x-show="lang === 'arabic'" dir="rtl">رقم الهاتف</span>
                                                    <span class="text-[rgb(var(--primary))]">*</span>
                                                </label>
                                                <div class="relative">
                                                    <span class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center text-[rgb(var(--muted))]">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.8 19.8 0 0 1 3 5.18 2 2 0 0 1 5 3h3a2 2 0 0 1 2 1.72c.12.81.3 1.6.54 2.36a2 2 0 0 1-.45 2.11L9 10.09a16 16 0 0 0 4.91 4.91l.9-1.09a2 2 0 0 1 2.11-.45c.76.24 1.55.42 2.36.54A2 2 0 0 1 22 16.92Z"/>
                                                        </svg>
                                                    </span>
                                                    <input
                                                        id="phone"
                                                        name="phone"
                                                        type="tel"
                                                        autocomplete="tel"
                                                        inputmode="tel"
                                                        required
                                                        value="{{ old('phone') }}"
                                                        placeholder="+212 6xx-xxxxxx"
                                                        class="w-full rounded-xl border border-[rgb(var(--border))] bg-[rgb(var(--background))] py-3 pl-10 pr-4 text-sm text-[rgb(var(--foreground))] shadow-sm placeholder:text-[rgb(var(--muted))] transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-[rgb(var(--ring))]"
                                                    />
                                                </div>
                                            </div>

                                            {{-- Event select --}}
                                            <div class="grid gap-1.5">
                                                <label for="event_id" class="text-sm font-semibold text-[rgb(var(--foreground))]">
                                                    <span x-show="lang === 'english'">Select an event</span>
                                                    <span x-show="lang === 'french'">Choisir un événement</span>
                                                    <span x-show="lang === 'arabic'" dir="rtl">اختر حدثاً</span>
                                                    <span class="text-[rgb(var(--primary))]">*</span>
                                                </label>
                                                <div class="relative">
                                                    <span class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center text-[rgb(var(--muted))]">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M8 2v4"/><path d="M16 2v4"/>
                                                            <rect x="3" y="4" width="18" height="18" rx="2"/>
                                                            <path d="M3 10h18"/>
                                                        </svg>
                                                    </span>
                                                    <select
                                                        id="event_id"
                                                        name="event_id"
                                                        required
                                                        class="w-full appearance-none rounded-xl border border-[rgb(var(--border))] bg-[rgb(var(--background))] py-3 pl-10 pr-10 text-sm text-[rgb(var(--foreground))] shadow-sm transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-[rgb(var(--ring))]"
                                                    >
                                                        <option value="" selected disabled>
                                                            — Select an event —
                                                        </option>
                                                        @foreach (($events ?? []) as $event)
                                                            @php
                                                                $eventTitle = $event->title;
                                                                if (is_object($eventTitle)) {
                                                                    $eventTitle = $eventTitle->french
                                                                        ?? $eventTitle->english
                                                                        ?? $eventTitle->arabic
                                                                        ?? null;
                                                                }
                                                                $eventTitle = is_string($eventTitle) && trim($eventTitle) !== ''
                                                                    ? $eventTitle
                                                                    : ('Event #' . $event->id);
                                                                $eventDate = $event->start ? $event->start->format('d M Y') : null;
                                                            @endphp
                                                            <option value="{{ $event->id }}" @selected(old('event_id') == $event->id)>
                                                                {{ $eventTitle }}{{ $eventDate ? ' — ' . $eventDate : '' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    {{-- Custom chevron --}}
                                                    <span class="pointer-events-none absolute inset-y-0 right-3.5 flex items-center text-[rgb(var(--muted))]">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="m6 9 6 6 6-6"/>
                                                        </svg>
                                                    </span>
                                                </div>
                                                @if (empty($events) || (is_countable($events) && count($events) === 0))
                                                    <p class="m-0 text-xs text-[rgb(var(--muted))]">
                                                        <span x-show="lang === 'english'">No events available right now. Check back soon.</span>
                                                        <span x-show="lang === 'french'">Aucun événement disponible pour l'instant.</span>
                                                        <span x-show="lang === 'arabic'" dir="rtl">لا توجد أحداث متاحة حالياً.</span>
                                                    </p>
                                                @endif
                                            </div>

                                            {{-- Submit --}}
                                            <button
                                                type="submit"
                                                :disabled="formLoading"
                                                class="mt-1 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[rgb(var(--primary))] px-5 py-3.5 text-sm font-semibold text-[rgb(var(--primary-foreground))] shadow-md ring-1 ring-[rgb(var(--primary)/0.20)] transition hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-[rgb(var(--ring))] disabled:cursor-not-allowed disabled:opacity-60"
                                            >
                                                <span x-show="!formLoading">
                                                    <span x-show="lang === 'english'">Submit registration</span>
                                                    <span x-show="lang === 'french'">Envoyer l'inscription</span>
                                                    <span x-show="lang === 'arabic'" dir="rtl">إرسال التسجيل</span>
                                                </span>
                                                <span x-show="formLoading" class="inline-flex items-center gap-2">
                                                    <svg class="h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                                    </svg>
                                                    <span x-show="lang === 'english'">Sending…</span>
                                                    <span x-show="lang === 'french'">Envoi…</span>
                                                    <span x-show="lang === 'arabic'" dir="rtl">جارٍ الإرسال…</span>
                                                </span>
                                            </button>

                                            {{-- Consent note --}}
                                            <p class="m-0 text-center text-xs text-[rgb(var(--muted))]">
                                                <span x-show="lang === 'english'">By submitting, you agree to be contacted about this event. No spam, ever.</span>
                                                <span x-show="lang === 'french'">En envoyant, vous acceptez d'être contacté(e) au sujet de cet événement. Zéro spam.</span>
                                                <span x-show="lang === 'arabic'" dir="rtl">بإرسال النموذج، توافق على التواصل معك بخصوص هذا الحدث. بدون رسائل مزعجة.</span>
                                            </p>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            {{-- ════════════════════════════════════════
                 FOOTER STRIP
            ════════════════════════════════════════ --}}
            <footer class="border-t border-[rgb(var(--border))] bg-[rgb(var(--card)/0.60)] py-10">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-center">
                        <div>
                            <p class="m-0 text-sm font-semibold text-[rgb(var(--foreground))]">
                                © <span x-text="new Date().getFullYear()"></span> By Casamémoire
                            </p>
                            <p class="m-0 mt-1 text-sm text-[rgb(var(--muted))]">All rights reserved.</p>
                        </div>
                        <div class="flex flex-wrap items-center gap-3 text-sm font-medium">
                            <a href="#features" class="text-[rgb(var(--foreground)/0.70)] transition hover:text-[rgb(var(--foreground))] no-underline">
                                <span x-show="lang === 'english'">Features</span>
                                <span x-show="lang === 'french'">Fonctionnalités</span>
                                <span x-show="lang === 'arabic'" dir="rtl">الميزات</span>
                            </a>
                            <span class="text-[rgb(var(--border))]">•</span>
                            <a href="#inscription" class="text-[rgb(var(--foreground)/0.70)] transition hover:text-[rgb(var(--foreground))] no-underline">
                                <span x-show="lang === 'english'">Register</span>
                                <span x-show="lang === 'french'">S'inscrire</span>
                                <span x-show="lang === 'arabic'" dir="rtl">التسجيل</span>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>

        </main>
    </div>

    <script>
        (function () {
            const prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const revealEls = Array.from(document.querySelectorAll('[data-reveal]'));

            if (revealEls.length === 0) return;

            const show = (el) => {
                el.classList.remove('opacity-0', 'translate-y-4');
                el.classList.add('opacity-100', 'translate-y-0');
            };

            if (prefersReducedMotion || !('IntersectionObserver' in window)) {
                revealEls.forEach(show);
                return;
            }

            const observer = new IntersectionObserver(
                (entries) => entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    show(entry.target);
                    observer.unobserve(entry.target);
                }),
                { root: null, threshold: 0.15 }
            );

            revealEls.forEach((el) => observer.observe(el));
        })();
    </script>

</body>
</html>
