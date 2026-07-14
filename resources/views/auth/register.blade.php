<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DocDrive - Register</title>
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
<body class="antialiased bg-gradient-to-br from-gray-50 to-emerald-50/30 dark:from-gray-950 dark:to-gray-900 min-h-screen flex items-center justify-center p-6">

    <div class="w-full sm:max-w-md bg-white dark:bg-gray-900 shadow-xl rounded-2xl border border-gray-100 dark:border-gray-800/60 overflow-hidden transform transition-all">
        <!-- Accent Top Bar -->
        <div class="h-1.5 w-full bg-emerald-600"></div>

        <div class="px-8 py-8">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center gap-2.5 mb-2.5">
                    <svg class="w-8 h-8 text-[#15803d]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="text-2xl font-black tracking-tight text-slate-900 dark:text-white">DocDrive</span>
                </div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Create your new cloud storage workspace</p>
            </div>

            <!-- Validation Errors (if any exist) -->
            @if ($errors->any())
                <div class="mb-5 p-4 rounded-xl bg-red-50 border border-red-200 text-sm text-red-600">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                        class="block mt-1.5 w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-950 text-sm py-3 px-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition-all" placeholder="John Doe">
                </div>

                <!-- Email Address Field -->
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                        class="block mt-1.5 w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-950 text-sm py-3 px-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition-all" placeholder="name@example.com">
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="block mt-1.5 w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-950 text-sm py-3 px-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition-all" placeholder="••••••••">
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="block mt-1.5 w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-950 text-sm py-3 px-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition-all" placeholder="••••••••">
                </div>

                <!-- Form Footer Actions -->
                <div class="flex items-center justify-between pt-2">
                    <a class="text-sm font-semibold text-slate-500 hover:text-[#15803d] dark:text-slate-400 dark:hover:text-emerald-400 transition-colors" href="{{ route('login') }}">
                        Already registered?
                    </a>

                    <button type="submit" style="background-color: #15803d;" class="text-white font-bold py-3 px-6 rounded-xl shadow-md transition-opacity hover:opacity-95 text-sm cursor-pointer">
                        Register Account
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>