@extends('layouts.app')

@section('content')
    <section id="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 col-sm-12">
                    @foreach($documents as $document)
                        <div class="blog-post-thumb">
                            <div class="blog-post-title">
                                <h3>
                                    <a href="{{ route('documents.download', $document->slug) }}">
                                        {{ $document->title }}
                                    </a>
                                </h3>
                            </div>
                            <div class="blog-post-format">
                                <span><i class="fa fa-date">

                                    </i> {{ $document->created_at->translatedFormat('j F Y') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
