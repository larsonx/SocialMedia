<x-app-layout>
    <div class="flex items-stretch justify-center h-screen mt-4">
        <!-- Sidebar with friend list -->
        <div class="bg-white p-6 shadow-lg rounded-md w-1/4 mx-4 h-full overflow-y-auto">
            <h2 class="text-xl font-bold text-center mb-6">Friends</h2>
            <hr class="border-gray-300 my-4 border-t-2">

            <ul class="space-y-4">
                @foreach($friends as $friend)
                    <li>
                        <a href="{{ route('messages.show', $friend->id) }}" class="font-bold text-blue-600 hover:underline">
                            {{ $friend->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Chatroom -->
        <div class="bg-white p-6 shadow-lg rounded-md w-3/4 mx-4 h-full">
            <h2 class="text-xl font-bold text-center mb-6">Chat with {{ $friend->name ?? 'Select a friend' }}</h2>
            <hr class="border-gray-300 my-4 border-t-2">

            <div id="chat-container" class="h-72 overflow-y-auto mb-4">
                <!-- Messages will be dynamically loaded here -->
                @foreach($messages as $message)
                    <div class="message {{ $message->user_id == auth()->id() ? 'text-right' : 'text-left' }} p-2">
                        <strong>{{ $message->user->name }}:</strong>
                        <p>{{ $message->message }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Message Input -->
            <form action="{{ route('send-message') }}" method="POST" id="send-message-form">
                @csrf
                <input type="hidden" name="friend_id" value="{{ $friend->id }}">
                <input type="text" name="message" id="message" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Type a message..." required>
                <button type="submit" class="w-full mt-2 bg-blue-500 text-white p-2 rounded-md">Send</button>
            </form>
        </div>
    </div>

    <x-footer/>
</x-app-layout>
