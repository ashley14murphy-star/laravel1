<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DocDrive</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-900 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-xl w-full space-y-10">
        <!-- Logo Header Row -->
        <div class="flex items-center gap-2.5">
            <svg class="w-9 h-9 text-[#15803d]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="text-2xl font-extrabold tracking-tight text-slate-900">DocDrive</span>
        </div>

        <!-- Text and Button Content -->
        <div class="space-y-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs font-semibold text-emerald-700">All-In-One Workspace</span>
            </div>
            
            <h1 class="text-5xl font-extrabold text-slate-900 leading-[1.1] tracking-tight">
                Your documents &<br>cloud storage,<br>
                <span style="color: #15803d;">perfectly organized.</span>
            </h1>
            
            <p class="text-lg text-slate-500 font-normal leading-relaxed">
                Create and write down document notes instantly or safely back up your system files to a protected cloud directory. Simple, fast, and completely secure.
            </p>

            <div class="pt-4 flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" style="background-color: #15803d;" class="text-center text-white font-bold py-4 px-8 rounded-xl shadow transition-opacity hover:opacity-95">
                        Open Workspace
                    </a>
                @else
                    <a href="{{ route('register') }}" style="background-color: #15803d;" class="text-center text-white font-bold py-4 px-8 rounded-xl shadow transition-opacity hover:opacity-95">
                        Get Started Free
                    </a>
                    <a href="{{ route('login') }}" class="text-center bg-white border border-gray-200 text-slate-800 font-bold py-4 px-8 rounded-xl shadow-sm hover:bg-gray-50 transition-colors">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>
    </div>

</body>
</html>