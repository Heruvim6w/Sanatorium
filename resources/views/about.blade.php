@extends('layouts.app')

@section('content')
    <section id="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 col-sm-12">
                    {!! $about->content !!}
                </div>
            </div>
        </div>
    </section>
@endsection
