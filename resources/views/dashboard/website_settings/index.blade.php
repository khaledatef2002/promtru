@extends('dashboard.layouts.app')

@section('title', __('dashboard.website-settings'))

@section('content')

<form id="edit-website-settings-form" data-id="{{ $website_settings->id }}">
    <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img auto-image-show">
            <img src="{{ asset($website_settings->cover) }}" class="profile-wid-img" alt="">
            <div class="overlay-content">
                <div class="text-end p-3">
                    {{-- @if (Auth::user()->hasPermissionTo('website_settings_edit')) --}}
                        <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                            <input id="website-banner" name="cover" type="file" class="profile-foreground-img-file-input">
                            <label for="website-banner" class="profile-photo-edit btn btn-light">
                                <i class="ri-image-edit-line align-bottom me-1"></i> @lang('dashboard.website-cover')
                            </label>
                        </div>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-3">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto auto-image-show mb-4">
                            <img src="{{ asset($website_settings->logo) }}" class="avatar-xl img-thumbnail user-profile-image material-shadow" alt="user-profile-image">
                            <div class="avatar-xs p-0 profile-photo-edit">
                                <input id="profile-img-file-input" name="logo" type="file" class="profile-img-file-input">
                                {{-- @if (Auth::user()->hasPermissionTo('website_settings_edit')) --}}
                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title  bg-light text-body material-shadow">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                {{-- @endif --}}
                            </div>
                        </div>
                        <h5 class="fs-16 mb-1">@lang('dashboard.website-logo')</h5>
                    </div>
                </div>
            </div>
            <!--end card-->
            <div class="card mt-3">
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto auto-image-show mb-4">
                            <img src="{{ asset($website_settings->favicon) }}" class="avatar-xl img-thumbnail user-profile-image material-shadow" alt="user-profile-image">
                            <div class="avatar-xs p-0 profile-photo-edit">
                                <input id="profile-img-file-input" name="favicon" type="file" class="profile-img-file-input">
                                {{-- @if (Auth::user()->hasPermissionTo('website_settings_edit')) --}}
                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title  bg-light text-body material-shadow">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                {{-- @endif --}}
                            </div>
                        </div>
                        <h5 class="fs-16 mb-1">@lang('dashboard.website-favicon')</h5>
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#generalInfo" role="tab">
                                <i class="fas fa-home"></i> @lang('dashboard.website-settings')
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="generalInfo" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="title">@lang('dashboard.website-title')</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ $website_settings->title }}" placeholder="@lang('dashboard.enter') @lang('dashboard.website-title')">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="keywords" class="form-label">@lang('dashboard.website-keywords')</label>
                                        <input class="form-control" placeholder="@lang('dashboard.enter') @lang('dashboard.website-keywords')" id="keywords" name="keywords" data-choices data-choices-text-unique-true data-choices-removeItem type="text" value="{{ $website_settings->keywords }}" />
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="description">@lang('dashboard.website-description')</label>
                                        <textarea class="form-control" id="description" name="description" placeholder="@lang('dashboard.enter') @lang('dashboard.websitedescription')">{{ $website_settings->description }}</textarea>
                                    </div>
                                </div>
                                <hr>
                                {{-- Social Media --}}
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="facebook_url">@lang('dashboard.facebook_url')</label>
                                        <input class="form-control" id="facebook_url" name="facebook_url" type="url" placeholder="@lang('dashboard.enter') @lang('dashboard.facebook_url')" value="{{ $website_settings->facebook_url }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="instagram_url">@lang('dashboard.instagram_url')</label>
                                        <input class="form-control" id="instagram_url" name="instagram_url" type="url" placeholder="@lang('dashboard.enter') @lang('dashboard.instagram_url')" value="{{ $website_settings->instagram_url }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="linkedin_url">@lang('dashboard.linkedin_url')</label>
                                        <input class="form-control" id="linkedin_url" name="linkedin_url" type="url" placeholder="@lang('dashboard.enter') @lang('dashboard.linkedin_url')" value="{{ $website_settings->linkedin_url }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="twitter_url">@lang('dashboard.twitter_url')</label>
                                        <input class="form-control" id="twitter_url" name="twitter_url" type="url" placeholder="@lang('dashboard.enter') @lang('dashboard.twitter_url')" value="{{ $website_settings->twitter_url }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="youtube_url">@lang('dashboard.youtube_url')</label>
                                        <input class="form-control" id="youtube_url" name="youtube_url" type="url" placeholder="@lang('dashboard.enter') @lang('dashboard.youtube_url')" value="{{ $website_settings->youtube_url }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="tiktok_url">@lang('dashboard.tiktok_url')</label>
                                        <input class="form-control" id="tiktok_url" name="tiktok_url" type="url" placeholder="@lang('dashboard.enter') @lang('dashboard.tiktok_url')" value="{{ $website_settings->tiktok_url }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="snapchat_url">@lang('dashboard.snapchat_url')</label>
                                        <input class="form-control" id="snapchat_url" name="snapchat_url" type="url" placeholder="@lang('dashboard.enter') @lang('dashboard.snapchat_url')" value="{{ $website_settings->snapchat_url }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <hr>
                                {{-- Phone --}}
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="email">@lang('dashboard.email')</label>
                                        <input class="form-control" id="email" name="email" type="email" placeholder="@lang('dashboard.enter') @lang('dashboard.email')" value="{{ $website_settings->email }}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="location">@lang('dashboard.location')</label>
                                        <textarea class="form-control" id="location" name="location" placeholder="@lang('dashboard.enter') @lang('dashboard.location')">{{ $website_settings->location }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="phone_number">@lang('dashboard.phone_number')</label>
                                        <input class="form-control" id="phone_number" name="phone_number" type="text" placeholder="@lang('dashboard.enter') @lang('dashboard.phone_number')" value="{{ $website_settings->phone_number }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="whatsapp">@lang('dashboard.whatsapp')</label>
                                        <input class="form-control" id="whatsapp" name="whatsapp" type="text" placeholder="@lang('dashboard.enter') @lang('dashboard.whatsapp')" value="{{ $website_settings->whatsapp }}">
                                    </div>
                                </div>
                                <!--end col-->


                                {{-- @if (Auth::user()->hasPermissionTo('website_settings_edit')) --}}
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary loader-btn">
                                                <p>@lang('dashboard.save')</p>
                                                <div class="loader"></div>
                                            </button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                {{-- @endif --}}
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
</form>

@endsection
@section('custom-js')
    <script src="{{ asset('back/js/website-settings-module.js') }}" type="module"></script>
@endsection