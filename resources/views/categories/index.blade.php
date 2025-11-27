@extends('layouts.app')

@section('content')
    <section id="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 col-sm-12">
                    @foreach($categories as $category)
                        @foreach($category->articles as $article)
                            <div class="blog-post-thumb">
                                <div class="blog-post-image">
                                    <a href="{{ route('articles.show', $article->slug) }}">
                                        <img src="{{ asset('storage/posts/posters/' . $article->poster) }}" class="img-responsive" alt="Blog Image">
                                    </a>
                                </div>
                                <div class="blog-post-title">
                                    <h3><a href="{{ route('articles.show', $article->slug) }}">{{ $article->name }}</a></h3>
                                </div>
                                <div class="blog-post-format">
{{--                                    <span><a href="#"><img src="{{ asset('assets/images/author-image1.jpg') }}" class="img-responsive img-circle"> Jen Lopez</a></span>--}}
                                    <span><i class="fa fa-date"></i> {{ $article->created_at->translatedFormat('j F Y') }}</span>
                                    <span><i class="fa fa-comment-o"></i> {{ trans_choice(':count комментарий|:count комментария|:count комментариев', $article->comments ? $article->comments->count() : 0) }}</span>
                                </div>
                                <div class="blog-post-des">
                                    <p>{{ $article->description }}</p>
                                    <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-default">Читать делее...</a>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
