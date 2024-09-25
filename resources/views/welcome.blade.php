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
                <h2 class="text-xl font-bold">Welkom bij Socialize!</h2>
            </br>
                <p>Bij Socialize draait alles om verbinding maken en samen delen! Sluit je aan bij onze bruisende community waar je eenvoudig kunt chatten met vrienden, nieuwe contacten kunt leggen en jouw interesses kunt ontdekken.

                    Of je nu op zoek bent naar diepgaande gesprekken of gewoon een snelle uitwisseling van gedachten, met Socialize ben je altijd in het gezelschap van gelijkgestemden. Blader door posts die passen bij jouw passies en ontdek wat anderen te zeggen hebben.
                    
                    Neem de tijd om je profiel in te richten, je vrienden uit te nodigen en te genieten van een unieke sociale ervaring die volledig is afgestemd op jouw interesses.
                    
                    Dus waar wacht je nog op? Duik in de wereld van Socialize en begin vandaag nog met het delen van jouw verhaal!</p>
            </div>
        </div>
        
    </main>
    <x-footer/>
    </body>
</html>
