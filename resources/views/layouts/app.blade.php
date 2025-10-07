<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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

            <div class="navbar-header container-fluid">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>
                <a href="/">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="navbar-brand-image img-fluid" width="75" height="68">
                </a>
                <a href="/" class="navbar-brand">
                    СНТ "Нефтяник"
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('categories.show', 'news') }}">Новости</a></li>
                    <li><a href="{{ route('categories.show', 'ads') }}">Объявления</a></li>
                    <li><a href="{{ route('categories.show', 'general_meetings') }}">Общие собрания</a></li>
                    <li><a href="{{ route('categories.show', 'for_gardeners') }}">Садоводам СНТ</a></li>
                    <li><a href="{{ route('documents.index') }}">Документы</a></li>
                    @auth
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
                    <h3>СНТ "НЕФТЯНИК" г. Рязань</h3>
                    <p>График работы дома правления:</p>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <p>Сезон<br>(с 1 мая по 30 сентября)</p>
                            <p>ЧТ с 17:30 до 20:00</p>
                            <p>СБ с 12:00 до 14:00</p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <p>Вне сезона<br>(с 1 октября по 30 апреля)</p>
                            <p>СБ с 12:00 до 14:00</p>
                        </div>
                    </div>
                    <p>Воскресенье и понедельник выходные</p>
                    <div class="footer-copyright">
                        <p>Copyright &copy; {{ now()->year }} сайт создан c ❤️ <a href="https://t.me/qualmii">Qualmii</a>, дизайн:
                            <a href="http://www.tooplate.com/view/2085-neuron" target="_blank">Neuron</a>
                        </p>
                    </div>
                </div>

                <div class="col-md-4 col-md-offset-1 col-sm-6">
                    <h3>Контакты</h3>
                    <p><i class="fa fa-globe"></i> Рязанская обл., г. Рязань, р-н Сысоево, д. 7 С/Т НЕФТЯНИК</p>
                    <p><i class="fa fa-phone"></i> Тел.: +7(4912)29-50-92</p>
                    <p><i class="fa fa-save"></i> snt_neftyanik@mail.ru</p>
                    <p>
                        <img src="{{ asset('assets/images/telegram-brands-solid-full.svg') }}" alt="" style="width: 2rem">
                        Telegram: <a href="https://t.me/+79006078472">+7(900)607-84-72 (только текстовые сообщения)</a>
                    </p>
                    <p>
                        <img src="{{ asset('assets/images/telegram-brands-solid-full.svg') }}" alt="" style="width: 2rem">
                        Группа Telegram: <a href="https://t.me/sntneftyanik62">t.me/sntneftyanik62 (ссылка-приглашение)</a>
                    </p>
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
