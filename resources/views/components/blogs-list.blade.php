@if ($blogs->count() == 0)
    <div class="text-center fw-bold w-100 my-5 fs-1">@lang('custom.blogs.no-results')</div>
@else
    @foreach ($blogs as $blog)
        <div class="col-lg-4 col-md-6 mb-3 mt-3">
            <a href="{{ route('front.blogs.show', $blog) }}" class="blogs-card-body">
                <div class="blogs-card-image">
                    <img loading="lazy" src="{{ $blog->display_image }}">
                </div>
                <div class="blogs-text px-2 py-2">
                    <h5>{{ $blog->title }}</h5>
                    <p>{{ truncatePostAndRemoveImages($blog->description) }}</p>
                    <div class="date d-flex flex-row-reverse justify-content-between" style="border-top: 1px solid #c3c3c3;padding-top: 7px;"><bdi class="fs-6">{{ $blog->created_at->format('Y-m-d h:i:sa') }}</bdi>
                        <span>
                            <i class="fas fa-pen"></i> 
                            <bdi>{{ $blog->user->name }}</bdi>
                        </span>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
@endif