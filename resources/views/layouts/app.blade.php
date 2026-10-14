<!DOCTYPE html>
<html lang="id" class="h-full scroll-smooth dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IT-Go - Pusat Layanan & Helpdesk IT Perusahaan')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-[#0a0f1d] text-slate-100 min-h-screen flex flex-col font-sans antialiased selection:bg-blue-600 selection:text-white">

    {{-- Top Announcement Bar --}}
    <header
        class="bg-[#0d1527] text-slate-300 text-[11px] sm:text-xs py-1.5 sm:py-2 px-3 sm:px-4 border-b border-[#1e293b]">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-2">
            <div class="flex items-center gap-1.5 truncate">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                <span class="truncate">
                    <strong class="text-white font-medium">Helpdesk IT:</strong>
                    <span class="hidden sm:inline"> Jam Kerja 08:00 – 17:00 WIB (Senin – Jumat)</span>
                    <span class="sm:hidden"> 08:00–17:00</span>
                </span>
            </div>
            <div class="flex items-center gap-3 shrink-0 text-slate-300">
                <span class="hidden md:inline text-slate-400">SLA Respon &lt; 30 Menit</span>
                <span class="inline-flex items-center gap-1">
                    Hotline: <strong class="text-blue-400 font-mono">Ext. 108</strong>
                </span>
            </div>
        </div>
    </header>

    @include('layouts.navbar')

    @include('layouts.toast')

    {{-- Main Content Section --}}
    <main class="flex-grow py-6 sm:py-8">
        @yield('content')
    </main>

    @include('layouts.footer')
</body>

</html>
