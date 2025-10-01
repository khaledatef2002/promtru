@extends('front.layout')

@section('title', __('custom.blog'))

@section('content')

    <section id="blog-header" class="py-2 pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 px-4 mt-4 my-2" style="z-index: 99;">
                    <h1 class="text-center">@lang('custom.blog')</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="container flex-fill d-flex flex-column justify-content-center">
        <div class="blogs-card">
            <div class="row">
                <x-blogs-list :blogs="$blogs" />
                <div class="BlogLoader justify-content-center w-100">
                    <span class="loader"></span>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js-after')
    <script>
        const lang = document.querySelector('html').getAttribute('lang')
        let LastBlogId = {{ $blogs->last()?->id | null }}
    </script>
@endsection