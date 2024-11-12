<x-app-layout>
        <div class="flex items-stretch justify-center h-1/2 mt-4">
            <div class="bg-white p-6 shadow-lg rounded-md w-1/4 mx-4">
                <h2 class="text-xl font-bold text-center">Navigation</h2>
                <hr class="border-gray-300 my-4 border-t-2">
                <ul>
                    <li><a href="/home" class="font-bold">Home</a></li>
                    <li><a href="/profiel" class="font-bold">Profile</a></li>
                    <li><a href="/friends" class="font-bold">Friends</a></li>
                    <li><a href="/messages" class="font-bold">Messages</a></li>
                </ul>
            </div>
            
            <!-- Scrollbare post-div -->
            <div class="bg-white p-6 shadow-lg rounded-md w-1/2 mx-4 relative max-h-[500px] overflow-y-auto">
                <h2 class="text-xl font-bold text-center">Post</h2>
                <hr class="border-gray-300 my-4 border-t-2">
                <div class="flex justify-center w-3/4 mx-auto">
                    <form class="w-full" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- Laravel CSRF token -->
                        
                        <textarea id="messageInput" name="content" class="w-full h-32 p-2 rounded border border-gray-300" maxlength="280" placeholder="Type your message here..." required></textarea>
                        
                        <div class="flex items-center justify-end space-x-2 mt-1">
                            <!-- Image preview with fixed size -->
                            <img id="preview" class="hidden w-10 h-10 rounded-md shadow-lg" alt="Image Preview">
                            
                            <!-- Hidden file input for image upload -->
                            <input type="file" id="imageUpload" name="image" class="hidden" accept="image/*" onchange="previewImage(event)">
                            
                            <!-- Button to trigger the file input -->
                            <label for="imageUpload" class="cursor-pointer bg-yellow-g text-black rounded w-10 h-10 flex items-center justify-center">🖼️</label>
                            
                            <!-- Emoji button -->
                            <button type="button" id="emojiBtn" class="bg-yellow-g text-black rounded w-10 h-10 flex items-center justify-center" onclick="toggleEmojiPicker()">😊</button>
                            
                            <!-- Send button -->
                            <button type="submit" class="bg-yellow-g text-black rounded w-10 h-10 flex items-center justify-center">📤</button>
                        </div>
                        
                        <!-- Emoji picker -->
                        <div id="emojiPicker" class="emoji-picker absolute bg-white border border-gray-300 rounded-lg shadow-lg max-h-48 overflow-y-auto w-48 hidden mt-2 z-10 right-0">
                            <button type="button" class="emoji" onclick="addEmoji('😀')">😀</button>
                            <button type="button" class="emoji" onclick="addEmoji('😁')">😁</button>
                            <button type="button" class="emoji" onclick="addEmoji('😂')">😂</button>
                            <button type="button" class="emoji" onclick="addEmoji('😃')">😃</button>
                            <button type="button" class="emoji" onclick="addEmoji('😄')">😄</button>
                            <button type="button" class="emoji" onclick="addEmoji('😅')">😅</button>
                            <button type="button" class="emoji" onclick="addEmoji('😆')">😆</button>
                            <button type="button" class="emoji" onclick="addEmoji('😉')">😉</button>
                            <button type="button" class="emoji" onclick="addEmoji('😊')">😊</button>
                            <button type="button" class="emoji" onclick="addEmoji('😋')">😋</button>
                            <button type="button" class="emoji" onclick="addEmoji('😎')">😎</button>
                            <button type="button" class="emoji" onclick="addEmoji('😍')">😍</button>
                            <button type="button" class="emoji" onclick="addEmoji('😘')">😘</button>
                            <button type="button" class="emoji" onclick="addEmoji('😗')">😗</button>
                            <button type="button" class="emoji" onclick="addEmoji('😙')">😙</button>
                            <button type="button" class="emoji" onclick="addEmoji('😚')">😚</button>
                            <button type="button" class="emoji" onclick="addEmoji('😜')">😜</button>
                            <button type="button" class="emoji" onclick="addEmoji('😝')">😝</button>
                            <button type="button" class="emoji" onclick="addEmoji('😞')">😞</button>
                            <button type="button" class="emoji" onclick="addEmoji('😟')">😟</button>
                            <button type="button" class="emoji" onclick="addEmoji('😠')">😠</button>
                            <button type="button" class="emoji" onclick="addEmoji('😡')">😡</button>
                            <button type="button" class="emoji" onclick="addEmoji('😔')">😔</button>
                            <button type="button" class="emoji" onclick="addEmoji('😕')">😕</button>
                            <button type="button" class="emoji" onclick="addEmoji('🙁')">🙁</button>
                            <button type="button" class="emoji" onclick="addEmoji('😯')">😯</button>
                            <button type="button" class="emoji" onclick="addEmoji('😶')">😶</button>
                            <button type="button" class="emoji" onclick="addEmoji('😇')">😇</button>
                        </div>
                    </form>
                </div>
                <hr class="border-gray-300 my-4 border-t-2">
                @foreach($posts as $post)
                <div class="mb-6">
                    <div class="flex items-center">
                        <!-- Optionele afbeelding -->
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="w-16 h-16 rounded-md mr-4" alt="Post Image">
                        @endif
                        <div>
                            @if($post->user)
                                <p class="font-bold">{{ $post->user->name }}</p>
                            @else
                                <p class="font-bold text-red-500">[User Deleted]</p>
                            @endif
                            <p>{{ $post->content }}</p>
                            <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <hr class="border-gray-300 my-4 border-t-2">
                </div>
                @endforeach
            </div>
            
            <div class="bg-white p-6 shadow-lg rounded-md w-1/4 mx-4">
                <h2 class="text-xl font-bold text-center">Friends list</h2>
                <hr class="border-gray-300 my-4 border-t-2">
                <p>Hier komt de feed uit de Database</p>
            </div>
        </div>
    </main>
    <x-footer/>
</x-app-layout>
<script>
    function toggleEmojiPicker() {
        const emojiPicker = document.getElementById('emojiPicker');
        emojiPicker.classList.toggle('hidden'); // Toggle the visibility of the emoji picker
    }

    function addEmoji(emoji) {
        const messageInput = document.getElementById('messageInput');
        messageInput.value += emoji; // Add emoji to the input field
        toggleEmojiPicker(); // Close the emoji picker after selecting
    }

    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImage = document.getElementById('preview');
                previewImage.src = e.target.result; // Set the source of the preview image
                previewImage.classList.remove('hidden'); // Show the preview image
            };
            reader.readAsDataURL(file);
        }
    }
</script>
</body>
</html>
