@extends('layouts.app')

@section('content')
    <section id="home" class="main-single-post parallax-section">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h1>{{ $article->title }}</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Single Post Section -->

    <section id="blog-single-post">
        <div class="container">
            <div class="row">

                <div class="col-md-offset-1 col-md-10 col-sm-12">
                    <div class="blog-single-post-thumb">
                        <div class="blog-post-format">
                            <span>
                                <i class="fa fa-date"></i> {{ $article->created_at->translatedFormat('j F Y') }}
                            </span>
                        </div>

                        <div class="blog-post-des">
                            {!! $article->description !!}
                        </div>

                        {!! $article->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .main-single-post {
            background: url({{ asset('storage/' . $article->image) }}) no-repeat;
        }
    </style>
@endsection
