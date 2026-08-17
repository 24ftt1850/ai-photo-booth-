<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-neutral-950 antialiased">
        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">

            <!-- =========================
                 BRAND PANEL
            ========================== -->
            <div class="relative hidden h-full flex-col overflow-hidden bg-[#0A0C13] p-10 text-white lg:flex">
                <div class="pointer-events-none absolute -left-32 top-10 h-96 w-96 rounded-full bg-violet-600/25 blur-[120px]"></div>
                <div class="pointer-events-none absolute -right-24 bottom-10 h-96 w-96 rounded-full bg-cyan-500/15 blur-[120px]"></div>
                <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(139,92,246,0.12),transparent_45%)]"></div>

                <a href="{{ route('home') }}" class="relative z-20 flex items-center gap-3" wire:navigate>
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-violet-500 to-cyan-400 text-lg font-bold shadow-lg shadow-violet-500/20">
                        ✦
                    </span>
                    <span>
                        <span class="block text-lg font-bold tracking-tight">RupaVue</span>
                        <span class="block text-[10px] uppercase tracking-[0.25em] text-white/50">AI Photo Booth</span>
                    </span>
                </a>

                <div class="relative z-20 my-auto max-w-sm">
                    <span class="text-xs font-semibold uppercase tracking-[0.3em] text-violet-400">
                        AI Portrait Studio
                    </span>

                    <h2 class="mt-5 text-4xl font-bold leading-[1.1] tracking-tight">
                        Your moment.
                        <span class="block bg-gradient-to-r from-violet-400 via-purple-300 to-cyan-300 bg-clip-text text-transparent">
                            Reimagined.
                        </span>
                    </h2>

                    <p class="mt-5 text-sm leading-7 text-white/50">
                        Pick an event, capture your moment and let AI transform
                        it into something unforgettable.
                    </p>

                    <div class="mt-10 space-y-5">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-violet-500/10 text-violet-300">
                                ✦
                            </span>
                            <div>
                                <p class="text-sm font-semibold">Creative scenes</p>
                                <p class="text-xs text-white/40">Cinematic worlds, cultural themes and futuristic cities.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-cyan-400/10 text-cyan-300">
                                ◉
                            </span>
                            <div>
                                <p class="text-sm font-semibold">Your identity, kept</p>
                                <p class="text-xs text-white/40">Recognizable portraits, transformed surroundings.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="relative z-20 text-xs text-white/30">
                    © {{ date('Y') }} RupaVue — AI-powered event photography
                </p>
            </div>

            <!-- =========================
                 FORM PANEL
            ========================== -->
            <div class="w-full lg:p-8">
                <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[380px]">
                    <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 lg:hidden" wire:navigate>
                        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-violet-500 to-cyan-400 text-lg font-bold text-white shadow-lg shadow-violet-500/20">
                            ✦
                        </span>
                        <span class="sr-only">{{ config('app.name', 'RupaVue') }}</span>
                    </a>

                    <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
