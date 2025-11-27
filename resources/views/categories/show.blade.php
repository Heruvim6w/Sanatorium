@extends('layouts.app')

@section('content')
    <section id="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 col-sm-12">
                    @foreach($category->articles as $article)
                        <div class="blog-post-thumb">
                            <div class="blog-post-image">
                                <a href="{{ route('articles.show', $article->slug) }}">
                                    <img src="{{ asset('storage/' . $article->image) }}"
                                         class="img-responsive"
                                         alt="Blog Image">
                                </a>
                            </div>

                            <div class="blog-post-title">
                                <h3>
                                    <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                                </h3>
                            </div>

                            <div class="blog-post-format">
                                <span>
                                    <i class="fa fa-date"></i> {{ $article->published_at->translatedFormat('j F Y H:i') }}
                                </span>
                            </div>

                            <div class="blog-post-des">
                                <p>{!! $article->description !!}</p>
                                <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-default">
                                    Читать делее...
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
