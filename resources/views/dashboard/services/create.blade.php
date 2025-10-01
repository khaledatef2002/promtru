@extends('dashboard.layouts.app')

@section('title', __('dashboard.services.create'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row g-2">
            <div class="col-sm-auto ms-auto">
                <a href="{{ route('dashboard.services.index') }}"><button class="btn btn-light"><i class="ri-arrow-go-forward-fill me-1 align-bottom"></i> @lang('dashboard.return')</button></a>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div>
<form id="create-services-form">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="text-center">
                            <p class="mb-0 fw-bold">@lang('dashboard.image')</p>
                            <div class="position-relative d-inline-block auto-image-show">
                                <div class="position-absolute top-100 start-100 translate-middle">
                                    <label for="image" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Image">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                <i class="ri-image-fill"></i>
                                            </div>
                                        </div>
                                    </label>
                                    <input class="form-control d-none" name="image" id="image" type="file" accept="image/png, image/gif, image/jpeg, image/webp">
                                </div>
                                <div class="avatar-lg">
                                    <div class="avatar-title bg-light rounded">
                                        <img src="" id="product-img" style="min-height: 100%;min-width: 100%;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gap-2 mb-3 flex-fill">
                        <label for="title.ar">@lang('dashboard.ar.name')</label>
                        <input id="title.ar" type="text" class="form-control" name="ar[title]">
                    </div>
                    <div class="gap-2 mb-3 flex-fill">
                        <label for="title.en">@lang('dashboard.en.name')</label>
                        <input id="title.en" type="text" class="form-control" name="en[title]">
                    </div>

                    <div class="gap-2 mb-3 flex-fill">
                        <label for="description.ar">@lang('dashboard.ar.description')</label>
                        <input id="description.ar" type="text" class="form-control" name="ar[description]">
                    </div>
                    <div class="gap-2 mb-3 flex-fill">
                        <label for="description.en">@lang('dashboard.en.description')</label>
                        <input id="description.en" type="text" class="form-control" name="en[description]">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="text-end mb-3">
            <button type="submit" class="btn btn-success w-sm loader-btn ms-auto">
                <p class="mb-0">@lang('dashboard.create')</p>
                <div class="loader"></div>
            </button>
        </div>
    </div>
</form>

@endsection

@section('additional-js-libs')
    

@endsection

@section('custom-js')
    <script src="{{ asset('back/js/services-module.js') }}" type="module"></script>
@endsection