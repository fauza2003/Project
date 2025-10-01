<header>
  <nav class="navbar">
    <div class="container">
      <!-- Logo -->
      <a href="{{ route('home') }}" class="logo">GoCinema</a>
      

      <!-- Navigation Links -->
      <ul class="nav-links">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('movies') }}">Movies</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
        <li><a href="{{ route('about') }}">About</a></li>
        <li><a href="{{ route('profile') }}">Profil</a></li>

        @if(auth()->check() && auth()->user()->is_admin)
    <li><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
   
  @endif

  <!-- Menambahkan menu History untuk user biasa -->
  @if(auth()->check() && !auth()->user()->is_admin)
    <li><a href="{{ route('user.history') }}">History</a></li>
  @endif
</ul>
      </ul>

    

    </div>
  </nav>
</header>

<style>
  .navbar {
    background-color: #333;
    padding: 10px 20px;
    color: #fff;
  }

  .logo {
    font-size: 1.5em;
    color: #fff;
    text-decoration: none;
  }

  .nav-links {
    list-style: none;
    display: flex;
    gap: 15px;
  }

  .nav-links a {
    color: #fff;
    text-decoration: none;
    font-size: 1em;
  }

  .search-form {
    display: flex;
    gap: 5px;
  }

  .search-form input {
    padding: 5px;
    border: none;
    border-radius: 3px;
  }

  .search-form button {
    background-color: #555;
    color: #fff;
    border: none;
    padding: 5px 10px;
    border-radius: 3px;
    cursor: pointer;
  }
</style>
