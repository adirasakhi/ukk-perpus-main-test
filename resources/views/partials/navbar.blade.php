<nav class="navbar navbar-expand-md navbar-light bg-light p-4 border shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">perpus-e</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="ms-auto my-auto">
                @auth
                    <ul class="navbar-nav">
                        <li class="nav-item my-2">
                            <a class="nav-link" href="#">Buku Kami</a>
                        </li>
                        <li class="nav-item my-2">
                            <a class="nav-link" href="#">Tentang Kami</a>
                        </li>
                        <li class="nav-item my-2">
                            <a class="nav-link" href="#">Cara Order</a>
                        </li>
                        <li class="nav-item my-2">
                            <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                        </li>
                        <li class="nav-item my-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-secondary">Logout</button>
                            </form>
                        </li>
                    </ul>
                @else
                    <ul class="navbar-nav">
                        <li class="nav-item my-2">
                            <a class="nav-link" href="#">Buku Kami</a>
                        </li>
                        <li class="nav-item my-2">
                            <a class="nav-link" href="#">Tentang Kami</a>
                        </li>
                        <li class="nav-item my-2">
                            <a class="nav-link" href="#">Cara Order</a>
                        </li>
                        <li class="nav-item my-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                        </li>
                        <li class="nav-item my-2">
                            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </div>
</nav>
