<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ブッカーズ</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f9f9f9] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col min-h-screen">

    <header class="w-full max-w-4xl mx-auto px-4 py-4 flex justify-end">
        <nav class="flex items-center space-x-4">
            @auth
            @else
            <a href="{{ route('login') }}" class="px-4 py-2 text-sm rounded text-gray-700 dark:text-gray-200 hover:underline">ログイン</a>
            <a href="{{ route('register') }}" class="px-4 py-2 text-sm rounded border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition">アカウント作成</a>
            @endauth
        </nav>
    </header>

    <main class="flex-1 flex flex-col items-center justify-center px-4 text-center">
        <h1 class="text-5xl font-extrabold text-gray-900 dark:text-white mb-6">ブッカーズへようこそ</h1>
        <p class="text-lg text-gray-600 dark:text-gray-300 mb-10 leading-relaxed">
            ブッカーズでは<br>
            様々な本についての意見、印象、感情を<br class="hidden lg:inline">共有し、交換することができます。
        </p>

        <div class="flex space-x-4">
            <a href="{{ route('register') }}" class="px-6 py-3 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition text-base font-medium shadow">アカウント作成</a>
            <a href="{{ route('login') }}" class="px-6 py-3 rounded-lg text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition text-base font-medium shadow">ログイン</a>
        </div>
    </main>

    <footer class="py-4 text-center text-sm text-gray-400 dark:text-gray-500">
        &copy; {{ date('Y') }} ブッカーズ
    </footer>

</body>

</html>