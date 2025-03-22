<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">

  <title>@yield('title', 'Student Information System')</title>

  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <style>
    .sidebar-link {
      text-decoration: none;
      color: black;
      display: flex;
      align-items: center;
      padding: 10px;
      border-radius: 8px;
      transition: background 0.3s, color 0.3s;
    }

    .sidebar-link i {
      margin-right: 12px;
      font-size: 1.2rem;
    }

    .sidebar-link:hover {
      background: linear-gradient(135deg, #4e73df, #1a73e8);
      color: white;
    }

    .sidebar-link.active {
      background: #1a73e8;
      color: white;
    }

    #sidenav-main {
      background: linear-gradient(135deg, #f3f4f6, #e2e8f0);
    }

    .navbar-brand {
      font-weight: bold;
      font-size: 18px;
    }
  </style>
</head>

<body class="bg-gray-100" style="margin: 0; padding: 0; box-sizing: border-box; overflow-x: hidden;">

  <!-- Sidebar -->
  <aside id="sidenav-main" style="position: fixed; left: 0; top: 0; bottom: 0; width: 260px; padding: 20px; box-shadow: 2px 0 8px rgba(0,0,0,0.1); z-index: 1030;">
    <div style="margin-bottom: 20px;">
      <a class="navbar-brand" target="_blank" style="text-decoration: none; color: black;">
        <i class="fas fa-user-circle"></i>
        <span>{{ Auth::user()->name }}</span>
      </a>
    </div>
    <hr style="border: 0; border-top: 1px solid #ccc; margin: 10px 0;">

    <ul style="list-style: none; padding-left: 0;">
      <li style="margin-bottom: 15px;">
        <a href="{{ route('userstudents.index') }}" class="sidebar-link {{ request()->routeIs('userstudents.index') ? 'active' : '' }}">
          <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
      </li>
    </ul>

    <div style="position: absolute; bottom: 20px; left: 20px;">
    <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link text-dark d-flex align-items-center" style="border: none; background: none; cursor: pointer; font-size: 1.1rem;">
                    <i class="fas fa-sign-out-alt me-2"></i> <!-- Font Awesome icon -->
                    Logout
                </button>
            </form>
    </div>
  </aside>

  <!-- Dashboard Content -->
  <div style="margin-left: 280px; padding: 20px;">
    @yield('content_student')
  </div>

</body>

</html>
