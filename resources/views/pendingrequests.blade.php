<x-app-layout>


<div class="flex items-center mt-4 justify-center">
    <div class="w-full bg-white p-6 shadow-lg rounded-md">
        <h2 class="text-2xl font-bold">Pending Friend Requests</h2>
        <hr class="border-gray-300 my-4">

        @if($pendingRequests->isEmpty())
            <p>No pending friend requests at the moment.</p>
        @else
            @foreach($pendingRequests as $request)
                <div class="flex items-center justify-between my-4 p-4 border-b">
                    <div>
                        <p class="text-xl">{{ $request->name }}</p>
                    </div>
                    <div class="flex">
                        <form action="{{ route('friends.acceptRequest', $request->id) }}" method="POST" class="mr-2">
                            @csrf
                            <button type="submit" class="btn btn-success">Accept</button>
                        </form>
        
                        <form action="{{ route('friends.declineRequest', $request->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Decline</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
</x-app-layout>