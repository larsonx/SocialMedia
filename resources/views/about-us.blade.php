<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="bg-grayc">
    <x-navbarlogin/>
    <main>
        <div class="flex items-center justify-center h-1/2 bg-gray-100">
            <div class="bg-white p-6 shadow-lg rounded-md w-1/2 mx-4">
                <!-- Inhoud van de div -->
                <h2 class="text-xl font-bold text-center">About us!</h2>
            </br>
                <p>Welcome to Socialize, where meaningful connections come to life. We believe that everyone deserves a space to share, explore, and engage with what truly matters to them. Our mission is simple: to bring people together through shared interests, dynamic conversations, and a vibrant community.

                    At Socialize, we celebrate individuality while fostering a sense of belonging. Whether you're here to catch up with friends, discover new passions, or simply be inspired by what others have to say, we’re all about creating an experience that's as unique as you are.
                    
                    Our platform is designed to be intuitive, engaging, and tailored to your needs. With a few clicks, you can start conversations, dive into topics you love, and connect with like-minded people from all over the world. We’re not just another social platform—we’re a community built around you.
                    
                    Join us on this journey and be part of a place where your voice is heard, your ideas are valued, and your connections are real.
                    </p>
                </br>
                    <h2 class=" font-bold text-center">Welcome to Socialize. Welcome home.</h2>
            </div>
        </div>
        
    </main>
    <x-footer/>
    </body>
</html>
