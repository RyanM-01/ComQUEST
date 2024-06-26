<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('build/profile.css') }}" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins" />
    <title>Profile</title>
  </head>
  <body>
  <nav>
      <div class="logo-name">
      <div class="logo-image">
          <img src="{{ asset('images/logo.jpeg') }}" alt="" />
        </div>

        <span class="logo_name">ComQuest</span>
      </div>

      <div class="menu-items">
        <ul class="nav-links">
          <li>
            <a href="/user/dashboard">
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
            <a href="/user/toko">
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
        @if($user->avatar)
          @if($user->avatar)
            <img src="{{ asset('userpfp/' . $user->avatar) }}" alt="Profile Picture" />
          @else
            <img src="{{ asset('images/default.jpeg') }}" alt="Default Profile Picture" />
          @endif
        @else
          <!-- Tampilkan gambar default jika user tidak memiliki foto profil -->
          <img src="{{ asset('images/default.jpeg') }}"/>
        @endif
      </div>

      <div class="dash-content">
        <div class="overview">
          <div class="container">
            <div class="Statistic">
              <div class="title">
                <i class="uil uil-paperclip"></i>
                <span class="text">Statistic</span>
              </div>
              <div class="boxes">
                <div class="box box1">
                  <i class="uil uil-fire"></i>
                  <span class="text">Score This Week</span>
                  <span class="number">{{$user->score}}</span>
                </div>
                <div class="box box2">
                  <i class="uil uil-bolt"></i>
                  <span class="text">Total Credit</span>
                  <span class="number">{{$user->balance}}</span>
                </div>
              </div>
            </div>
            <div class="profileContainer">
                    <div class="title">
                        <i class="uil uil-paperclip"></i>
                        <span class="text">Profile</span>
                    </div>
                    <form action="{{ route('user.profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <p>
                            <label for="avatar" class="text">Profile Picture </label><br />
                            <input class="form-control" type="file" name="avatar" id="avatar" autocomplete="off" />
                        </p>
                        <p>
                            <label for="name" class="text">Nama </label><br />
                            <input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}" required autocomplete="off" />
                        </p>
                        <p>
                            <label for="username" class="text">Username </label><br />
                            <input class="form-control" type="text" name="username" id="username" value="{{ $user->username }}" required autocomplete="off" />
                        </p>
                        <p>
                            <label for="email" class="text">Email </label><br />
                            <input class="form-control" type="email" name="email" id="email" value="{{ $user->email }}" required autocomplete="off" />
                        </p>
                        <p>
                            <label for="gender" class="text">Jenis Kelamin </label><br />
                            <label><input type="radio" name="gender" value="Laki-laki" {{ $user->gender == 'Laki-laki' ? 'checked' : '' }} required /> Laki-laki</label>
                            <label><input type="radio" name="gender" value="Perempuan" {{ $user->gender == 'Perempuan' ? 'checked' : '' }} required /> Perempuan</label>
                        </p>
                        <p>
                            <label for="password" class="text">Password </label><br />
                            <input class="form-control" type="password" name="password" id="password" autocomplete="off" />
                            <small>Biarkan kosong jika tidak ingin mengubah password</small>
                        </p>

                        <p>
                            <div class="button-container">
                                <button class="button1" type="submit">Update</button>
                            </div>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="{{asset('js/script.js') }}"></script>
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
