<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>@yield('title','Laravel Blog')</title>

    <!-- إضافة رابط لملف CSS من Bootstrap عبر CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <h1>Laravel Blog</h1>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('posts.index')}}">Home</a>
                        </li>
                        @if(auth()->check() && auth()->user()->hasRole('admin'))
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('admin.index')}}">Manage Users And Roles</a>
                        </li>
                        @endif
                        @can('manage posts')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Create
                            </a>
                            <ul class="dropdown-menu">

                                <li><a class="dropdown-item" href="{{route('posts.create')}}">Create Post</a></li>

                                @if(auth()->check() && auth()->user()->hasRole('admin'))
                                    <li><a class="dropdown-item" href="{{route('Categories.index')}}">Category</a></li>
                                    <li><a class="dropdown-item" href="{{route('tags.index')}}">Tag</a></li>
                                @endif
                            </ul>
                            @endcan
                        </li>
                    </ul>
                    @auth
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button class="btn btn-primary" type="submit">Logout</button>
                    </form>
                    @else
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-primary me-md-2" href="{{route('register')}}" role="button">Register</a>
                    <a class="btn btn-primary" href="{{route('login')}}" role="button">Login</a>
                    @endauth
                </div>
                </div>
            </div>
        </nav>
    </header>

    @if (session('error'))
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <div>{{ session('error') }}</div>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">{{ session('success') }}</h4>
    </div>
    @endif

    <main>
        @yield('content')
    </main>

    <!-- إضافة رابط لملف JavaScript من Bootstrap عبر CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
