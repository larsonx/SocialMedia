@if (Route::has('login'))
    <nav class="bg-yellow-g flex flex-1 justify-end h-14">
        @auth
            <a
                href="{{ url('/dashboard') }}"
                class="rounded-md px-3 py-2"
            >
                Dashboard
            </a>
        @else
            <a
                href="{{ route('login') }}"
                class="rounded-md px-2 py-4"
            >
                Log in
            </a>

            @if (Route::has('register'))
                <a
                    href="{{ route('register') }}"
                    class="rounded-md px-4 py-4"
                >
                    Register
                </a>
            @endif
        @endauth
    </nav>
@endif
