<x-app-layout>
    <div class="flex items-center mt-4 justify-center">
        <div class="bg-white p-6 shadow-lg rounded-md w-1/5 h-96 mx-4">
            <h2 class="flex justify-center text-xl">Navigation</h2>
            <hr class="border-gray-300 my-4 border-t-2">
            <ul class="text-xl">
                <li><a href="/dashboard" class="hover:text-blue-500">Home</a></li>
                <li><a href="/profile" class="hover:text-blue-500">Profile</a></li>
                <li><a href="/friend" class="hover:text-blue-500">Friend</a></li>
                <li><a href="/messages" class="hover:text-blue-500">Messages</a></li>
            </ul>
        </div>
        <div class="flex h-96 w-4/5 bg-white p-6 shadow-lg rounded-md mx-4">
            <div class="flex flex-col items-left">
                <div class="w-32 h-32 rounded-full overflow-hidden border-2 border-gray-300">
                    <img id="images" src="{{ asset('images/'.$user->image) }}" alt="Profile Image" class="w-full h-full object-cover"/>
                </div> 
                <div class="mt-6"> 
                    <ul>
                        <li class="mb-1">{{$user->name}}</li>
                        <li class="mb-1">{{$user->address}}</li>
                        <li class="mb-1">{{$user->birthdate}}</li>
                        <li class="mb-1">{{$user->description}}</li>
                        <!-- Add more list items as needed -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="flex items-center mt-4 justify-center">
    <div class="flex items-center justify-center  h-96 w-full bg-white p-6 shadow-lg rounded-md w-1/5 mx-4">
    </div>
    </div>
    <x-footer/>
</x-app-layout>
