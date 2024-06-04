<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('build/createbab.css')}}" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins" />

    <title>Document</title>
  </head>
  <body>
  <nav>
      <div class="logo-name">
        <div class="logo-image">
          <img src="logo.jpeg" alt="Logo" />
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
            <a href="adminprofile.html">
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
          <input type="text" placeholder="Cari bab..." />
        </div>

        <img src="image1.jpeg" alt="User Profile Picture" />
      </div>
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-paperclip"></i>
                    <span class="text">Create Quiz for {{ $bab->name }}</span>
                </div>
                <form action="{{ route('admin.quiz.store', $bab->id) }}" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Quiz Name" required >
                    <button type="submit">Add Quiz</button>
                </form>
                <div class="container">
                    @foreach ($bab->quizzes as $quiz)
                        <div class="babbox">
                            <form action="{{ route('admin.quiz.update', [$bab->id, $quiz->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input class ="namabab" type="text" name="name" value="{{ $quiz->name }}" required>
                                <button class="btn" type="submit" name="update"><i class="uil uil-edit"></i></button>
                            </form>
                            <form action="{{ route('admin.quiz.destroy', [$bab->id, $quiz->id]) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="delete-btn" type="submit"><i class="uil uil-trash-alt"></i></button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
