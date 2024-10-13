<x-app-layout>

        <div class="flex items-center mt-4 justify-center">
            <div class="bg-white p-6 shadow-lg rounded-md w-1/5 h-96 mx-4 hidden md:block">
                <h2 class="flex justify-center text-xl">Navigation</h2>
                <hr class="border-gray-300 my-4 border-t-2">
                <ul class="text-xl">
                    <li><a href="/dashboard" class="hover:text-blue-500">Home</a></li>
                    <li><a href="/profile" class="hover:text-blue-500">Profile</a></li>
                    <li><a href="/friend" class="hover:text-blue-500">Friends</a></li>
                    <li><a href="/messages" class="hover:text-blue-500">Messages</a></li>
                </ul>
            </div>
            <div class="flex h-96 w-full md:w-4/5 bg-white p-6 shadow-lg rounded-md mx-4">
                <h2>Search Friends</h2>
                <x-search></x-search>   
                <div class="flex flex-col items-left">
                    
                </div>
            </div>
        </div>
        <div class="flex items-center mt-4 justify-center">
        <div class="flex h-96 w-full bg-white p-6 shadow-lg rounded-md mx-4">
            <h2>Friends List</h2><br>

        </div>
        </div>
        <x-footer/>
</x-app-layout>
