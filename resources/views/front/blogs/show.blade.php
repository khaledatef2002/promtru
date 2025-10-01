@extends('front.layout')

@section('title', $blog->title)

@section('description', truncatePostAndRemoveImages($blog->description))

@section('display_image', $blog->display_image)

@section('content')

    <section id="blog-header" class="py-2 pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 px-4 mt-4 my-2 d-flex flex-column align-items-center" style="z-index: 99;">
                    <h1 class="text-center">@lang('custom.blog')</h1>
                    <a href="{{ route('front.blogs.index') }}" class="text-white">@lang('custom.return')</a>
                </div>
            </div>
        </div>
    </section>
    <div class="container blog-container">
        <div class="row">
            <div class="blog-header my-2 mb-3">
                <h2 class="text-center">{{ $blog->title }}</h2>
                <span class="date d-flex justify-content-center"><bdi class="fs-6">{{ $blog->created_at->format('y M D, H:i') }}</bdi></span>
            </div>
            <div class="blog-image col-lg-6 mx-auto">
                <img loading="lazy" src="{{ $blog->display_image }}">
            </div>
            <div class="blog-body mt-3">
                {!! $blog->description !!}
            </div>
        </div>
    </div>

@endsection