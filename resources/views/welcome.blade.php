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
            <div class="bg-white p-6 shadow-lg rounded-md w-1/2 mx-4">
                <!-- Inhoud van de div -->
                <h2 class="text-xl font-bold text-center">Welcome to Socialize!</h2>
            </br>
                <p>At Socialize, it's all about making connections and sharing together! Join our vibrant community where you can easily chat with friends, meet new people, and explore your interests.

                    Whether you're looking for deep conversations or just a quick exchange of thoughts, with Socialize, you're always surrounded by like-minded individuals. Browse through posts that match your passions and see what others have to say.
                    
                    Take your time to set up your profile, invite friends, and enjoy a unique social experience that’s completely tailored to your interests.
                    
                    So, what are you waiting for? Dive into the world of Socialize and start sharing your story today!</p>
            </div>
        </div>
        
    </main>
    <x-footer/>
    </body>
</html>
