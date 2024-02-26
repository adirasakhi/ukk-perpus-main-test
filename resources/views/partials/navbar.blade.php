<style>
    .navbar {
        background-color: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        font-size: 1.5rem;
        font-weight: bold;
        color: #343a40;
    }



    .navbar-nav {
        margin-right: 10px;
    }

    .nav-link {
        color: #343a40;
        margin: 0 15px;
        font-weight: bold;
        transition: color 0.3s ease-in-out;
    }

    .nav-link:hover {
        color: #007bff;
    }

    .btn-secondary {
        background-color: #007bff;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #0056b3;
    }
    .ml-3 {
            margin-left: 0.75rem !important;
        }
</style>

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
                        <li class="nav-item">
                            <a class="nav-link" href="#">Buku Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cara Order</a>
                        </li>
                        <li class="nav-item ml-3 mb-3">
                            <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="btn btn-secondary">logout</a>

                        </li>
                    </ul>
                @else
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Buku Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cara Order</a>
                        </li>
                        <li class="nav-item ml-3 mb-3">
                            <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>

                        </li>
                        <li class="nav-item ml-3">
                            <a href="{{ route('register') }}" class="btn btn-secondary ">Register</a>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </div>
</nav>
