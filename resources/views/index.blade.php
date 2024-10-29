@extends('layouts.app')

@section('content')
    <section id="home" class="main-home parallax-section">
        <div class="overlay"></div>
        <div id="particles-js"></div>
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-sm-12">
                    <h1>СНТ "НЕФТЯНИК" г. Рязань</h1>
                    <h2 style="color: #f00">САЙТ РАБОТАЕТ В ТЕСТОВОМ РЕЖИМЕ</h2>
                    <h4>Добро пожаловать!</h4>
                    <a href="{{ route('about_us') }}" class="smoothScroll btn btn-default">Подробнее</a>
                </div>

            </div>
        </div>
    </section>

    <section id="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 col-sm-12">
                    @foreach($categories as $category)
                        <div class="blog-post-thumb col-md-6">
                            <div class="blog-post-image">
                                <a href="{{ route('categories.show', $category->slug) }}">
                                    <img src="{{ asset('storage/' . $category->image) }}"
                                         class="img-responsive" alt="Blog Image">
                                </a>
                            </div>
                            <div class="blog-post-title">
                                <h3>
                                    <a href="{{ route('categories.show', $category->slug) }}">{{ $category->title }}</a>
                                </h3>
                            </div>

                            <div class="blog-post-des">
                                <p>{!! $category->description !!}</p>
                                <a href="{{ route('categories.show', $category->slug) }}" class="btn btn-default">
                                    Посмотреть...
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
