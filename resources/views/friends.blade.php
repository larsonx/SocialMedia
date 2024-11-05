<x-app-layout>
    <div class="flex items-center mt-4 justify-center">
        <div class="bg-white p-6 shadow-lg rounded-md w-1/5 h-96 mx-4 hidden md:block">
            <h2 class="flex justify-center text-xl">Navigation</h2>
            <hr class="border-gray-300 my-4 border-t-2">
            <ul class="text-xl">
                <li><a href="/dashboard" class="hover:text-blue-500">Home</a></li>
                <li><a href="/profile" class="hover:text-blue-500">Profile</a></li>
                <li><a href="/friends" class="hover:text-blue-500">Friends</a></li>
                <li><a href="/messages" class="hover:text-blue-500">Messages</a></li>
            </ul>
        </div>
    
        <!-- Main Content -->
        <div class="flex flex-col h-96 w-full md:w-4/5 bg-white p-6 shadow-lg rounded-md mx-4">
            <div class="flex items-center justify-between mb-4">
                <!-- Title and Search Bar in One Row -->
                <h2 class="text-xl font-bold">Search Friends</h2>
                <div>
                    <!-- Adjusts the margin for alignment with the text -->
                    <x-search class="ml-4 w-full max-w-xs h-10" />
                </div>
            </div>
            <div>Users</div>
            <!-- Optional additional content goes here -->
            <div class="flex flex-col items-left">
                <!-- Content for friend search results, etc. -->
            </div>
        </div>
    </div>
    
    <!-- Added Friends List -->
    <div class="flex items-center mt-4 justify-center">
        <div class="flex flex-col w-full bg-white p-6 shadow-lg rounded-md mx-4 h-auto">
            <h2 class="text-lg font-bold mb-4">Added Friends</h2>
            
            <!-- Grid layout with 3 columns -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6"> 
                @foreach($users as $user)
                    @php
                        $friendship = Auth::user()->friends()->where('friend_id', $user->id)->first();
                        $reverseFriendship = Auth::user()->friendsFrom()->where('user_id', $user->id)->first();
                    @endphp
                    
                    @if (($friendship && $friendship->pivot->accepted) || ($reverseFriendship && $reverseFriendship->pivot->accepted))
                        <div class="flex items-center space-x-4">
                            <!-- Profile Image -->
                            <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-gray-300">
                                <img src="{{ asset('images/' . $user->image) }}" alt="Profile Image" class="w-full h-full object-cover"/>
                            </div>
                            
                            <!-- User Information -->
                            <div class="flex flex-col">
                                <p class="text-md font-semibold">{{ $user->name }}</p>
                                <p class="text-green-600 text-sm">Already friends</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <!-- Users to Send Requests or Pending Requests -->
    <div class="flex items-center mt-4 justify-center">
        <div class="flex flex-col w-full bg-white p-6 shadow-lg rounded-md mx-4 h-auto">
            <h2 class="text-lg font-bold mb-4">Users to Send Requests or Pending Requests</h2>
            
            <!-- Grid layout with 3 columns -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6"> 
                @foreach($users as $user)
                    @php
                        $friendship = Auth::user()->friends()->where('friend_id', $user->id)->first();
                        $reverseFriendship = Auth::user()->friendsFrom()->where('user_id', $user->id)->first();
                    @endphp
                    
                    @if (!$friendship && !$reverseFriendship)
                        <div class="flex items-center space-x-4">
                            <!-- Profile Image -->
                            <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-gray-300">
                                <img src="{{ asset('images/' . $user->image) }}" alt="Profile Image" class="w-full h-full object-cover"/>
                            </div>
                            
                            <!-- User Information -->
                            <div class="flex flex-col">
                                <p class="text-md font-semibold">{{ $user->name }}</p>
                                <form action="{{ route('friends.sendRequest', $user->id) }}" method="POST" class="mt-1">
                                    @csrf
                                    <button type="submit" class="text-blue-500 hover:underline text-sm">
                                        Send Friend Request
                                    </button>
                                </form>
                            </div>
                        </div>
                    @elseif ($friendship && !$friendship->pivot->accepted)
                        <div class="flex items-center space-x-4">
                            <!-- Profile Image -->
                            <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-gray-300">
                                <img src="{{ asset('images/' . $user->image) }}" alt="Profile Image" class="w-full h-full object-cover"/>
                            </div>
                            
                            <!-- User Information -->
                            <div class="flex flex-col">
                                <p class="text-md font-semibold">{{ $user->name }}</p>
                                <p class="text-yellow-600 text-sm">Friend request pending</p>
                            </div>
                        </div>
                    @elseif ($reverseFriendship && !$reverseFriendship->pivot->accepted)
                        <div class="flex items-center space-x-4">
                            <!-- Profile Image -->
                            <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-gray-300">
                                <img src="{{ asset('images/' . $user->image) }}" alt="Profile Image" class="w-full h-full object-cover"/>
                            </div>
                            
                            <!-- User Information -->
                            <div class="flex flex-col">
                                <p class="text-md font-semibold">{{ $user->name }}</p>
                                <form action="{{ route('friends.acceptRequest', $user->id) }}" method="POST" class="mt-1">
                                    @csrf
                                    <button type="submit" class="text-blue-500 hover:underline text-sm">
                                        Accept Friend Request
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>
