<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Fonts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="bg-gray-300">
    <x-navbarlogin/>
    <main>
        <div class="flex items-center justify-center h-1/2 bg-gray-300">
            <div class="bg-white p-6 shadow-lg rounded-md w-1/4 mx-4">
                <!-- Inhoud van de div -->
                <h2 class="text-xl font-bold text-center">Navigation</h2>
                <hr class="border-gray-300 my-4 border-t-2">
            
                <ul>
                <li><a href="/home" class="font-bold">Home</a></li>
                <li><a href="/home" class="font-bold">Profile</a></li>
                <li><a href="/home" class="font-bold">Friends</a></li>
                <li><a href="/home" class="font-bold">Messages</a><li>
                </ul>
            </div>
            <div class="bg-white p-6 shadow-lg rounded-md w-3/4 mx-4">
                <!-- Inhoud van de div -->
                <h2 class="text-xl font-bold text-center">Messages</h2>
                <hr class="border-gray-300 my-4 border-t-2">
                <p>Hier in komen rows van mensen waar jij een chatgeschiedenis mee hebt</p>
            </div>
        </div>
        
    </main>
    <x-footer/>
    </body>
</html>
