
<div class="main-header navbar navbar-expand navbar-white navbar-light m-0">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">E-Com</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @if(Session::has('user'))
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/alluser">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/allproduct">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/allorder">Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/category">Category</a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/adminlogin">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/adminlogin">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/adminlogin">Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/adminlogin">Category</a>
        </li>
        @endif
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if(Session::has('user'))
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#"> {{ Session::get('user')['username'] }}
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/adminlogout">Logout</a></li>
          </ul>
        </li>
        @else
        <a class="nav-link" href="/adminlogin">Login</a>
        @endif
      </ul>
    </div>
  </div>
</div>