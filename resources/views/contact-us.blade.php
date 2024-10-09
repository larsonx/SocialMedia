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
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-300">
    <x-navbarlogin/>
    <main>
        <div class="min-h-1/2 flex flex-col sm:justify-center items-center mt-12 sm:pt-0">
            <div class="bg-white p-6 shadow-lg rounded-md w-1/2 mx-4">
                <!-- Inhoud van de div -->
                <h2 class="text-xl font-bold text-center">Contact us!</h2>
            </br>
                <p>
                    We’re here to help! Whether you have a question, feedback, or just want to say hello, we’d love to hear from you. At Socialize, your experience matters to us, and we're always looking for ways to improve.

Feel free to reach out to us for:

Support with your account or any technical issues
Questions about features and how to get the most out of Socialize
Feedback on how we can enhance your experience
Any other inquiries—our team is ready to assist!
You can contact us through the form below, or email us directly at 97100495@st.deltion.nl. We aim to respond as quickly as possible, because your voice is important to us.

                    </p>
                </br>
                    <h2 class=" font-bold text-center">Thank you for being a part of the Socialize community!</h2>
            </div>
        </div>
        
    </main>
    <x-footer/>
    </body>
</html>
