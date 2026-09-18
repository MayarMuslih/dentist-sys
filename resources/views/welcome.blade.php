<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="DentalFlow Enterprise is a centralized multi-clinic dental practice management system for modern care teams.">
        <title>DentalFlow Enterprise | Multi-Clinic Dental Management</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://unpkg.com/lucide@latest"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: { sans: ['DM Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'], display: ['Plus Jakarta Sans', 'DM Sans', 'ui-sans-serif', 'sans-serif'] },
                        colors: { ink: '#102a43', ocean: '#087e8b', mint: '#d9f6f0', cloud: '#f4fbfb' },
                        boxShadow: { soft: '0 20px 60px -24px rgba(16, 42, 67, 0.28)' },
                    },
                },
            };
        </script>
        <style>
            html { scroll-behavior: smooth; }
            body { background: #f8fcfc; }
            .hero-grid { background-image: linear-gradient(rgba(8, 126, 139, .07) 1px, transparent 1px), linear-gradient(90deg, rgba(8, 126, 139, .07) 1px, transparent 1px); background-size: 42px 42px; }
            @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
            .float-card { animation: float 6s ease-in-out infinite; }
        </style>
    </head>
    <body class="font-sans text-ink antialiased">
        <div class="relative isolate overflow-hidden">
            <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_80%_10%,rgba(135,224,207,0.3),transparent_28%),linear-gradient(180deg,#effcfb_0%,#f8fcfc_68%)]"></div>
            <div class="hero-grid absolute inset-x-0 top-0 -z-10 h-[39rem] opacity-60 [mask-image:linear-gradient(to_bottom,black,transparent)]"></div>

            <header class="mx-auto flex w-full max-w-7xl items-center justify-between px-6 py-6 lg:px-8">
                <a href="{{ url('/') }}" class="flex items-center gap-3" aria-label="DentalFlow Enterprise home">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-ink text-white shadow-lg shadow-ink/15"><i data-lucide="scan-heart" class="h-5 w-5"></i></span>
                    <span class="font-display text-base font-extrabold tracking-tight text-ink">DentalFlow <span class="font-sans font-semibold text-ocean">Enterprise</span></span>
                </a>
                <nav class="hidden items-center gap-8 text-sm font-semibold text-slate-600 md:flex">
                    <a href="#features" class="transition hover:text-ocean">Platform</a>
                    <a href="#stack" class="transition hover:text-ocean">Technology</a>
                    <a href="/admin" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white/80 px-4 py-2 text-ink shadow-sm transition hover:border-ocean hover:text-ocean">Open dashboard <i data-lucide="arrow-up-right" class="h-4 w-4"></i></a>
                </nav>
                <a href="/admin" class="inline-flex items-center gap-2 rounded-full bg-ink px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-ink/20 transition hover:-translate-y-0.5 hover:bg-ocean md:hidden">Demo <i data-lucide="arrow-up-right" class="h-4 w-4"></i></a>
            </header>

            <main>
                <section class="mx-auto grid max-w-7xl items-center gap-14 px-6 pb-20 pt-14 lg:grid-cols-[1.02fr_.98fr] lg:px-8 lg:pb-28 lg:pt-20">
                    <div class="max-w-2xl">
                        <div class="mb-7 inline-flex items-center gap-2 rounded-full border border-ocean/20 bg-white/75 px-3.5 py-2 text-xs font-bold uppercase tracking-[.14em] text-ocean shadow-sm"><span class="h-2 w-2 rounded-full bg-teal-400 shadow-[0_0_0_4px_rgba(45,212,191,.16)]"></span> The operating system for modern dentistry</div>
                        <h1 class="font-display text-5xl font-extrabold leading-[1.08] tracking-[-.04em] text-ink sm:text-6xl lg:text-[4.35rem]">Centralized Multi-Clinic <span class="text-ocean">Dental Practice Management</span></h1>
                        <p class="mt-7 max-w-xl text-lg leading-8 text-slate-600">One calm, connected workspace for multi-tenant oversight, interactive dental charting, appointments, treatment records, and billing across every clinic you operate.</p>
                        <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                            <a href="/admin" class="inline-flex items-center justify-center gap-2 rounded-xl bg-ocean px-5 py-3.5 text-sm font-bold text-white shadow-xl shadow-ocean/20 transition hover:-translate-y-0.5 hover:bg-[#066d78]">Access Admin Dashboard / Live Demo <i data-lucide="arrow-right" class="h-4 w-4"></i></a>
                            <a href="#features" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white/70 px-5 py-3.5 text-sm font-bold text-ink transition hover:border-ocean hover:text-ocean">Explore the platform <i data-lucide="move-down" class="h-4 w-4"></i></a>
                        </div>
                        <div class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-3 text-sm font-semibold text-slate-500"><span class="inline-flex items-center gap-2"><i data-lucide="shield-check" class="h-4 w-4 text-ocean"></i> Role-aware access</span><span class="inline-flex items-center gap-2"><i data-lucide="layers-3" class="h-4 w-4 text-ocean"></i> Built for scale</span></div>
                    </div>

                    <div class="relative mx-auto w-full max-w-xl lg:pl-8">
                        <div class="absolute -right-3 top-8 h-40 w-40 rounded-full bg-teal-200/40 blur-3xl"></div>
                        <div class="relative rounded-[2rem] border border-white/80 bg-white/75 p-3 shadow-soft backdrop-blur-sm">
                            <div class="overflow-hidden rounded-[1.35rem] border border-slate-200/80 bg-slate-50">
                                <div class="flex items-center justify-between border-b border-slate-200 bg-white px-5 py-4"><div class="flex items-center gap-3"><span class="flex h-9 w-9 items-center justify-center rounded-lg bg-mint text-ocean"><i data-lucide="layout-dashboard" class="h-4 w-4"></i></span><div><p class="text-xs font-bold text-ink">Practice overview</p><p class="text-[10px] text-slate-400">Monday, 18 September</p></div></div><span class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 text-slate-500"><i data-lucide="bell" class="h-4 w-4"></i></span></div>
                                <div class="grid grid-cols-2 gap-3 p-4 sm:grid-cols-3"><div class="rounded-xl bg-white p-3 shadow-sm"><p class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">Clinics</p><p class="mt-1 text-2xl font-extrabold text-ink">04</p><p class="mt-1 text-[10px] font-semibold text-emerald-600">All operational</p></div><div class="rounded-xl bg-white p-3 shadow-sm"><p class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">Patients</p><p class="mt-1 text-2xl font-extrabold text-ink">1,284</p><p class="mt-1 text-[10px] font-semibold text-ocean">+12.8% this month</p></div><div class="col-span-2 rounded-xl bg-ink p-3 text-white sm:col-span-1"><p class="text-[10px] font-semibold uppercase tracking-wider text-slate-300">Today</p><p class="mt-1 text-2xl font-extrabold">28 <span class="text-sm font-medium text-slate-300">visits</span></p><div class="mt-2 flex -space-x-2"><span class="h-5 w-5 rounded-full border-2 border-ink bg-teal-300"></span><span class="h-5 w-5 rounded-full border-2 border-ink bg-amber-200"></span><span class="h-5 w-5 rounded-full border-2 border-ink bg-rose-200"></span><span class="flex h-5 w-5 items-center justify-center rounded-full border-2 border-ink bg-slate-600 text-[8px]">+9</span></div></div></div>
                                <div class="grid gap-4 p-4 pt-1 sm:grid-cols-[1.1fr_.9fr]"><div class="rounded-xl border border-slate-200 bg-white p-4"><div class="flex items-center justify-between"><p class="text-xs font-bold text-ink">Appointments</p><span class="text-[10px] font-bold text-ocean">View schedule</span></div><div class="mt-5 flex h-24 items-end justify-between gap-2"><span class="h-8 w-full rounded-t bg-teal-100"></span><span class="h-14 w-full rounded-t bg-teal-200"></span><span class="h-11 w-full rounded-t bg-ocean"></span><span class="h-20 w-full rounded-t bg-ocean"></span><span class="h-16 w-full rounded-t bg-teal-300"></span><span class="h-10 w-full rounded-t bg-teal-100"></span><span class="h-14 w-full rounded-t bg-teal-200"></span></div><div class="mt-2 flex justify-between text-[9px] font-semibold text-slate-400"><span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span></div></div><div class="float-card rounded-xl border border-teal-100 bg-mint p-4"><div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white text-ocean"><i data-lucide="activity" class="h-4 w-4"></i></div><p class="mt-5 text-xs font-bold text-ink">Collection rate</p><p class="mt-1 text-2xl font-extrabold text-ocean">92.4%</p><div class="mt-3 h-1.5 rounded-full bg-white"><div class="h-1.5 w-[92%] rounded-full bg-ocean"></div></div><p class="mt-2 text-[10px] font-medium text-slate-500">Healthy financial pulse</p></div></div>
                            </div>
                        </div>
                        <div class="absolute -bottom-5 -left-3 hidden items-center gap-3 rounded-2xl border border-white bg-white px-4 py-3 shadow-xl sm:flex"><span class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100 text-emerald-600"><i data-lucide="check" class="h-4 w-4"></i></span><div><p class="text-xs font-bold text-ink">Treatment saved</p><p class="text-[10px] text-slate-400">Patient record updated just now</p></div></div>
                    </div>
                </section>

                <section class="mx-auto max-w-7xl px-6 pb-20 lg:px-8"><div class="grid gap-5 rounded-3xl border border-teal-100 bg-white p-5 shadow-soft sm:grid-cols-[1fr_auto] sm:items-center sm:p-7"><div class="flex items-start gap-4"><span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-600"><i data-lucide="key-round" class="h-5 w-5"></i></span><div><p class="text-sm font-extrabold text-ink">Portfolio demo access</p><p class="mt-1 text-sm text-slate-500">Step inside a seeded workspace and see the full admin experience.</p><div class="mt-4 flex flex-wrap items-center gap-3 text-sm"><code class="rounded-lg bg-slate-100 px-3 py-2 font-semibold text-slate-700">admin@example.com</code><code class="rounded-lg bg-slate-100 px-3 py-2 font-semibold text-slate-700">password</code></div></div></div><div class="flex flex-col gap-2 sm:min-w-44"><button id="copy-credentials" type="button" class="inline-flex items-center justify-center gap-2 rounded-xl bg-ink px-4 py-3 text-sm font-bold text-white transition hover:bg-ocean"><i data-lucide="copy" class="h-4 w-4"></i><span>Copy credentials</span></button><a href="/admin/login" class="inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2 text-xs font-bold text-ocean transition hover:bg-mint">Go to login <i data-lucide="arrow-up-right" class="h-3.5 w-3.5"></i></a></div></div></section>

                <section id="features" class="border-y border-slate-200/80 bg-white/70"><div class="mx-auto max-w-7xl px-6 py-20 lg:px-8 lg:py-24"><div class="max-w-2xl"><p class="text-sm font-bold uppercase tracking-[.16em] text-ocean">Everything in one view</p><h2 class="mt-3 font-display text-3xl font-extrabold tracking-[-.03em] text-ink sm:text-4xl">A clearer way to run every clinic.</h2><p class="mt-4 text-base leading-7 text-slate-500">Bring your clinical, operational, and financial workflows into one dependable command center.</p></div><div class="mt-12 grid gap-4 md:grid-cols-2 lg:grid-cols-4"><article class="rounded-2xl border border-slate-200 bg-white p-6 transition hover:-translate-y-1 hover:border-teal-200 hover:shadow-soft"><span class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600"><i data-lucide="network" class="h-5 w-5"></i></span><h3 class="mt-6 font-display text-lg font-bold text-ink">Multi-Clinic Architecture</h3><p class="mt-3 text-sm leading-6 text-slate-500">Centralized control across multiple clinics, teams, and staff roles with the right visibility for every user.</p></article><article class="rounded-2xl border border-slate-200 bg-white p-6 transition hover:-translate-y-1 hover:border-teal-200 hover:shadow-soft"><span class="flex h-11 w-11 items-center justify-center rounded-xl bg-teal-50 text-ocean"><i data-lucide="scan" class="h-5 w-5"></i></span><h3 class="mt-6 font-display text-lg font-bold text-ink">Interactive Adult Dental Chart</h3><p class="mt-3 text-sm leading-6 text-slate-500">Track tooth conditions, restoration history, and FDI notation with a chart designed for clinical clarity.</p></article><article class="rounded-2xl border border-slate-200 bg-white p-6 transition hover:-translate-y-1 hover:border-teal-200 hover:shadow-soft"><span class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600"><i data-lucide="calendar-clock" class="h-5 w-5"></i></span><h3 class="mt-6 font-display text-lg font-bold text-ink">Clinical Records & Appointments</h3><p class="mt-3 text-sm leading-6 text-slate-500">Keep patient history, scheduling, and treatment records connected from first visit to follow-up.</p></article><article class="rounded-2xl border border-slate-200 bg-white p-6 transition hover:-translate-y-1 hover:border-teal-200 hover:shadow-soft"><span class="flex h-11 w-11 items-center justify-center rounded-xl bg-rose-50 text-rose-600"><i data-lucide="receipt-text" class="h-5 w-5"></i></span><h3 class="mt-6 font-display text-lg font-bold text-ink">Financials & Invoicing</h3><p class="mt-3 text-sm leading-6 text-slate-500">See payments, outstanding balances, and service pricing in real time across your entire network.</p></article></div></div></section>

                <section id="stack" class="mx-auto max-w-7xl px-6 py-16 lg:px-8"><div class="flex flex-col gap-6 border-b border-slate-200 pb-10 sm:flex-row sm:items-end sm:justify-between"><div><p class="text-sm font-bold uppercase tracking-[.16em] text-ocean">Built to move with you</p><h2 class="mt-2 font-display text-2xl font-extrabold tracking-[-.02em] text-ink">A dependable modern stack.</h2></div><div class="flex flex-wrap gap-2"><span class="rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-bold text-slate-600">Laravel 11/12</span><span class="rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-bold text-slate-600">Filament v3</span><span class="rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-bold text-slate-600">PostgreSQL (Supabase)</span><span class="rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-bold text-slate-600">Livewire</span><span class="rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-bold text-slate-600">Docker</span></div></div></section>
            </main>

            <footer class="border-t border-slate-200 bg-ink text-white"><div class="mx-auto flex max-w-7xl flex-col gap-4 px-6 py-8 text-sm sm:flex-row sm:items-center sm:justify-between lg:px-8"><div class="flex items-center gap-3"><span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/10 text-teal-300"><i data-lucide="scan-heart" class="h-4 w-4"></i></span><span class="font-bold">DentalFlow Enterprise</span></div><p class="text-slate-400">One system. Every clinic. Better care.</p></div></footer>
        </div>

        <script>
            lucide.createIcons();
            document.getElementById('copy-credentials').addEventListener('click', async function () {
                const label = this.querySelector('span');
                try {
                    await navigator.clipboard.writeText('Email: admin@example.com\nPassword: password');
                    label.textContent = 'Credentials copied';
                } catch (error) {
                    label.textContent = 'Use the login link';
                }
                setTimeout(function () { label.textContent = 'Copy credentials'; }, 2200);
            });
        </script>
    </body>
</html>
