<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('build/dashboard.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins" />

    <title>Document</title>
  </head>

  <body>
  <nav>
      <div class="logo-name">
      <div class="logo-image">
          <img src="{{ asset('images/logo.jpeg') }}" alt="" />
        </div>
        <span class="logo_name">ComQuiz</span>
      </div>

      <div class="menu-items">
        <ul class="nav-links">
          <li>
            <a href="/dashboard">
              <i class="uil uil-home"></i>
              <span class="link-name">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="/user/leaderboard">
              <i class="uil uil-star"></i>
              <span class="link-name">Leaderboards</span>
            </a>
          </li>
          <li>
            <a href="toko.html">
              <i class="uil uil-shop"></i>
              <span class="link-name">Shop</span>
            </a>
          </li>
          <li>
            <a href="/user/customize">
              <i class="uil uil-brush-alt"></i>
              <span class="link-name">Costumize</span>
            </a>
          </li>
          <li>
            <a href="/user/profile">
              <i class="uil uil-user-circle"></i>
              <span class="link-name">Profile</span>
            </a>
          </li>
        </ul>

        <ul class="logout-mode">
          <li>
            <!-- Tautan yang memicu pengiriman form logout -->
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="uil uil-sign-out-alt"></i>
              <span class="link-name">Logout</span>
            </a>
            <!-- Formulir logout  -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </div>
    </nav>

    <section class="dashboard">
        <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>
        <div class="search-box">
          <i class="uil uil-search"></i>
          <input type="text" placeholder="Cari matkul..." />
        </div>
        @if($user->avatar)
        <img src="{{ asset('storage/images/' . $user->avatar) }}" alt="Profile Picture" />
        @else
          <!-- Tampilkan gambar default jika user tidak memiliki foto profil -->
          <img src="{{ asset('images/default.jpeg') }}"/>
        @endif
      </div>
      <div class="dash-content">
        <div class="overview">
          <div class="kostumisasi">
            <div class="atas">
              <span class="namauser">Hallo {{$user->username }}!</span>
              <a href="/user/customize"><i class="uil uil-pen"></i></a>
            </div>

            <div class="poin">
              <a href="toko.html" class="poinframe">
                <i class="uil uil-usd-circle"></i>
                <span class="userpoin">{{$user->balance}}</span>
              </a>
            </div>
          </div>

          <div class="title">
            <i class="uil uil-paperclip"></i>
            <span class="text">Matkul overview</span>
          </div>

          <div id="filter" class="filter">
            <button class="btn" onclick="filterObject('all')">Show All</button>
            <button class="btn" onclick="filterObject('S3')">Semester 3</button>
            <button class="btn" onclick="filterObject('S4')">Semester 4</button>
            <button class="btn" onclick="filterObject('S5')">Semester 5</button>
          </div>

          <div class="matkulcontainer">
              @foreach ($matkuls as $matkul)
              <div class="matkul S3">
                  <a href="{{ route('user.babs.index', $matkul->id) }}">
                      <div class="matkulpic">
                          <img src="{{ asset('images/' . $matkul->image) }}" alt="{{ $matkul->name }}" />
                      </div>
                      <div class="textcontainer">
                          <span class="matkulcode">{{ $matkul->code }} |</span>
                          <span class="matkulname">{{ $matkul->name }}</span>
                      </div>
                  </a>
              </div>
              @endforeach
          </div>
    </section>
    <script src="{{ asset('js/filter.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
      // Memeriksa tema yang dipilih dari localStorage
      function getTheme() {
        return localStorage.getItem("theme");
      }

      // Menerapkan tema yang dipilih
      document.addEventListener("DOMContentLoaded", () => {
        const savedTheme = getTheme();
        if (savedTheme) {
          document.body.classList.add(savedTheme);
        }
      });
    </script>
  </body>
</html>
