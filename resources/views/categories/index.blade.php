@extends('layouts.app')

@section('content')
    <section id="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 col-sm-12">
                    @foreach($category->articles as $articles)
                        <div class="blog-post-thumb">
                            <div class="blog-post-image">
                                <a href="{{ route('posts.show', $post->slug) }}">
                                    <img src="{{ asset('storage/posts/posters/' . $post->poster) }}" class="img-responsive" alt="Blog Image">
                                </a>
                            </div>
                            <div class="blog-post-title">
                                <h3><a href="{{ route('posts.show', $post->slug) }}">{{ $post->name }}</a></h3>
                            </div>
                            <div class="blog-post-format">
                                <span><a href="#"><img src="{{ asset('assets/images/author-image1.jpg') }}" class="img-responsive img-circle"> Jen Lopez</a></span>
                                <span><i class="fa fa-date"></i> {{ $post->created_at->translatedFormat('j F Y') }}</span>
                                <span><i class="fa fa-comment-o"></i> {{ trans_choice(':count комментарий|:count комментария|:count комментариев', $post->comments->count()) }}</span>
                            </div>
                            <div class="blog-post-des">
                                <p>{{ $post->description }}</p>
                                <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-default">Читать делее...</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
