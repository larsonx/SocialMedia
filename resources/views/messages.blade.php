<x-app-layout>
        <div class="flex items-stretch justify-center h-1/2 mt-4"> <!-- Marge boven de container -->
            <div class="bg-white p-6 shadow-lg rounded-md w-1/4 mx-4">
                <!-- Inhoud van de div -->
                <h2 class="text-xl font-bold text-center">Navigation</h2>
                <hr class="border-gray-300 my-4 border-t-2">
                <ul>
                    <li><a href="/home" class="font-bold">Home</a></li>
                    <li><a href="/profiel" class="font-bold">Profile</a></li>
                    <li><a href="/friends" class="font-bold">Friends</a></li>
                    <li><a href="/messages" class="font-bold">Messages</a></li>
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
</x-app-layout>
    </body>
</html>
