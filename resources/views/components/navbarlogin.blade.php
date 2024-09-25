    @if (Route::has('login'))
    <div>
        <nav class="bg-yellow-g flex justify-between items-center h-14">
            <div class="flex items-center">
                <img class="w-24 h-24" src="/logo.png" alt="Logo">
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="rounded-md px-2 py-3">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="rounded-md px-3 py-3">Register</a>
                    @endif
                @endauth
            </div>
        </nav>
    </div>
    @endif
