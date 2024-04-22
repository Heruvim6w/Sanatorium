<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!--
        Template 2085 Neuron
        http://www.tooplate.com/view/2085-neuron
        -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">

        <!-- Main css -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Lora|Merriweather:300,400" rel="stylesheet">
    </head>
    <body>
    <div class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">

            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>
                <a href="/" class="navbar-brand">СНТ "Нефтяник"</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('categories.show', 'news') }}">Новости</a></li>
                    <li><a href="{{ route('categories.show', 'ads') }}">Объявления</a></li>
                    <li><a href="{{ route('categories.show', 'meetings') }}">Общие собрания</a></li>
                    <li><a href="{{ route('categories.show', 'for_gardeners') }}">Садоводам СНТ</a></li>
                    @auth
                        <li>
                            <a href="{{ route('profile.edit') }}">
                                {{ __('Профиль') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                                {{ __('Выйти') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Войти</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">Регистрация</a></li>
                        @endif
                    @endauth
                </ul>
            </div>

        </div>
    </div>

    @yield('content')

    <footer>
        <div class="container">
            <div class="row">

                <div class="col-md-5 col-md-offset-1 col-sm-6">
                    <h3>СНТ "НЕФТЯНИК"</h3>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                        labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                    <div class="footer-copyright">
                        <p>Copyright &copy; {{ now()->year }} сайт создан c ❤️ Qualmii, дизайн:
                            <a href="ttp://www.tooplate.com/view/2085-neuron" target="_blank">Neuron</a>
                        </p>
                    </div>
                </div>

                <div class="col-md-4 col-md-offset-1 col-sm-6">
                    <h3>Контакты</h3>
                    <p><i class="fa fa-globe"></i> Рязанская обл.</p>
                    <p><i class="fa fa-phone"></i> 010-020-0990</p>
                    <p><i class="fa fa-save"></i> info@company.com</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back top -->
    <a href="#back-top" class="go-top"><i class="fa fa-angle-up"></i></a>

    <!-- SCRIPTS -->

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/particles.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.parallax.js') }}"></script>
    <script src="{{ asset('assets/js/smoothscroll.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    </body>
</html>
