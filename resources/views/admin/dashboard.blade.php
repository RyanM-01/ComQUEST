<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('build/admindashboard.css') }}" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins" />

    <title>Admin Dashboard</title>
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
            <a href="adminpapanskor.html">
              <i class="uil uil-star"></i>
              <span class="link-name">Leaderboards</span>
            </a>
          </li>
          <li>
            <a href="admintoko.html">
              <i class="uil uil-shop"></i>
              <span class="link-name">Shop</span>
            </a>
          </li>
          <li>
            <a href="/admin/profile">
              <i class="uil uil-user-circle"></i>
              <span class="link-name">Profile</span>
            </a>
          </li>
        </ul>

        <ul class="logout-mode">
          <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="uil uil-sign-out-alt"></i>
              <span class="link-name">Logout</span>
            </a>
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
            <a href="{{ route('admin.matkul.create') }}">
                <div class="atas">
                    <i class="uil uil-plus-circle"></i>
                    <span class="text">Create</span>
                </div>
            </a>
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
                <a href="{{ route('admin.bab.create', $matkul->id) }}">
                  <div class="matkulpic">
                    @if($matkul->picture)
                    <img src="{{ asset('storage/images/' . $matkul->picture) }}" alt="Matkul Picture" />
                    @else
                      <!-- Tampilkan gambar default jika user tidak memiliki foto profil -->
                      <img src="{{ asset('images/download.png') }}" alt="picture"/>
                    @endif
                  </div>
                  <div class="textcontainer">
                    <span class="matkulcode">{{ $matkul->code }} |</span>
                    <span class="matkulname">{{ $matkul->name }}</span>
                  </div>
                </a>
                <div class="buttons">
                  <a href="{{ route('admin.matkul.edit', $matkul->id) }}"><button class="btn">EDIT</button></a>
                  <form action="{{ route('admin.matkul.destroy', $matkul->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn" type="submit">DELETE</button>
                  </form>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>

    <script src="{{ asset('js/filter.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
  </body>
</html>
