<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Card Database for personal collection" />
  <meta name="author" content="Jose David Garcia Corzo" />
  <title>Card Database</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <!-- Custom styles for this template -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Custom styles for this template -->
  <link href="{{url ('assets/style/dashboard.css') }}" rel="stylesheet" />
  
</head>
  <body class="vh-100">
    <div class="d-flex flex-column h-100 w-100" >
    <!-- Incluir las definiciones de simbolos de la fuente -->
    @include('backend.extra.definition')
      <header class="sticky-top bg-black p-2">
        <div class="container mx-auto">
          <div class="row align-items-center">
            <div class="col-lg-2 col-md-3 col-sm-4 col-4">
              <div class="logo text-center">
                <!-- logo -->
                <img src="{{ url('frontend/images/icons/logo-01.png') }}" alt="Logo" class="img-fluid" style="">
              </div>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-4 col-4 text-center">
              <!-- Título -->
              <h1 class="title mb-0 text-white fw-bold display-5 display-md-4 display-lg-3">Admin Manager</h1>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-4">
              <div class="social-icons text-end">
                <!-- Iconos de redes sociales -->
                <a href="#" class="text-white me-2"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
              </div>
            </div>
          </div>
        </div>
      </header>

      <div class="container-fluid">
        <div class="row">
          <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
            <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="sidebarMenuLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                  aria-label="Close"></button>
              </div>
              <div class="offcanvas-body d-md-flex flex-column p-0 overflow-y-auto">
                <ul class="nav flex-column bg-dark">
                  <li class="nav-item items">
                    <a class="nav-link d-flex align-items-center gap-2 mt-3" href="{{ url('admin') }}">
                      <svg class="bi">
                        <use xlink:href="#cart" />
                      </svg>
                      Productos
                    </a>
                  </li>
                  <li class="nav-item items">
                    <a class="nav-link d-flex align-items-center gap-2 mt-3" href="{{ url('user') }}">
                      <svg class="bi">
                        <use xlink:href="#people" />
                      </svg>
                      Usuarios
                    </a>
                  </li>
                  <li class="nav-item items">
                    <a class="nav-link d-flex align-items-center gap-2 mt-3" href="{{ url('/') }}">
                      <svg class="bi">
                        <use xlink:href="#house-fill" />
                      </svg>
                      Home
                    </a>
                  </li>
                <li class="nav-item items nav-link">
                    <form action="{{ route('usera.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link">
                            <svg class="bi">
                                <use xlink:href="#door-closed" />
                            </svg>
                            Log-out
                        </button>
                    </form>
                </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- para mostrar el mensaje de éxito-->
          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
            @yield('content') @if(session('message'))
          
            <div class="alert alert-success" role="alert">
              {{session ('message') }}; 
            </div>
            @endif
            <!-- para mostrar el mensaje de error-->
            @if($errors->any())
            <div class="alert alert-danger" role="alert">
              {{ $errors->first()}}
            </div>
            @endif
          </main>
        </div>
      </div>
      <footer class="bg-black">
        <div class="p-4 bg-footer bg-black d-flex pb-2 text-center">
            <p class="col-3 text-white">Copyright &copy 2024 J.David Garcia Corzo</p>
            <p class="col-8 text-white text-end">Desarrollo Entorno Servidor</p>
        </div>
      </footer>
  </div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>