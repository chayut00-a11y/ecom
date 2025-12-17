<nav class="fixed-top navbar navbar-expand-lg navbar-dark bg-dark p-2">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">E-Com</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                @if (Session::has('user'))
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/showproduct">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/orderlist">Order</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/showproduct">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/login">Order</a>
                    </li>
                @endif
            </ul>
            <form action="/search" class="d-flex justify-content-center mx-auto my-2" role="search">
                <input class="form-control me-2 search-box" type="search" name="query"
                    value="{{ request()->input('query') }}" placeholder="Search" aria-label="Search"
                    style="width: 400px;">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>


            <ul class="nav navbar-nav navbar-right">
                @if (Session::has('user'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders.index') }}">ตะกร้า</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                            {{ Session::get('user')['name'] }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/profile">Profile</a></li>
                            <li><a class="dropdown-item" href="/logout">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <a class="nav-link" href="/login">Login</a>
                    <a class="nav-link" href="/register">Register</a>
                @endif
            </ul>
        </div>
    </div>
</nav>
