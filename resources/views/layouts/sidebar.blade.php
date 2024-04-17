@php use Illuminate\Support\Facades\Auth; @endphp
    <!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>







    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
<div class="wrapper">
    <aside id="sidebar" class="js-sidebar">
        <!-- Content For Sidebar -->
        <div class="h-100">
            <div class="sidebar-logo">
                <a style="font-size: 35px" href="/">Bariatrics</a>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a style="font-size: 16px" href="{{route('userList.meal')}}" class="sidebar-link">
                        <i class="fa fa-calendar fa-list pe-2"></i>
                        Приемы пищи
                    </a>
                </li>
                <li class="sidebar-item">
                    <a style="font-size: 16px" href="{{route('category.index')}}" class="sidebar-link">
                        <i class="fa fa-cutlery pe-2"></i>
                        Меню
                    </a>
                </li>
{{--                <li class="sidebar-item">--}}
{{--                    <a style="font-size: 16px" href="/offers" class="sidebar-link">--}}
{{--                        <i class="fa fa-cutlery pe-2"></i>--}}
{{--                        Еда--}}
{{--                    </a>--}}
{{--                </li>--}}

                <li class="sidebar-item">
                    <a style="font-size: 16px" href="{{route('userList.water')}}" class="sidebar-link">
                        <i class="fa fa-shower pe-2"></i>
                        Контроль воды
                    </a>
                </li>

                <li class="sidebar-item">
                    <a style="font-size: 16px" href="{{route('userList.step')}}" class="sidebar-link">
                        <i class="fa fa-wheelchair-alt pe-2"></i>
                        Шагомер
                    </a>
                </li>

                <li class="sidebar-item">
                    <a style="font-size: 16px" href="/users" class="sidebar-link">
                      <i class="fa-regular fa-user pe-2"></i>
                        Пользователи
                    </a>
                </li>

{{--                <li class="sidebar-item">--}}
{{--                    <a href="#" class="sidebar-link collapsed" data-bs-target="#multi" data-bs-toggle="collapse"--}}
{{--                       aria-expanded="false"><i class="fa-solid fa-share-nodes pe-2"></i>--}}
{{--                        Multi Dropdown--}}
{{--                    </a>--}}
{{--                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">--}}
{{--                        <li class="sidebar-item">--}}
{{--                            <a href="#" class="sidebar-link collapsed" data-bs-target="#level-1"--}}
{{--                               data-bs-toggle="collapse" aria-expanded="false">Level 1</a>--}}
{{--                            <ul id="level-1" class="sidebar-dropdown list-unstyled collapse">--}}
{{--                                <li class="sidebar-item">--}}
{{--                                    <a href="#" class="sidebar-link">Level 1.1</a>--}}
{{--                                </li>--}}
{{--                                <li class="sidebar-item">--}}
{{--                                    <a href="#" class="sidebar-link">Level 1.2</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
            </ul>
        </div>
    </aside>
    <div class="main">
        <nav class="navbar navbar-expand px-3 border-bottom">
            <button class="btn" id="sidebar-toggle" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse navbar">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                            <img src="{{getImage(Auth::user()->main_image)}}" class="avatar img-fluid rounded" alt="">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="{{route('profile.index')}}" class="dropdown-item">Профиль</a>
                            <a href="{{route('profile.logout')}}" class="dropdown-item">Выход</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="content px-3 py-2">
            @yield('content')
        </main>
        <a href="#" class="theme-toggle">
            <i class="fa-regular fa-moon"></i>
            <i class="fa-regular fa-sun"></i>
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
<script src="/js/script.js"></script>
