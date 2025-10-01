@extends('dashboard.layouts.app')

@section('title', __('dashboard.user.edit'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row g-2">
            <div class="col-sm-auto ms-auto">
                <a href="{{ route('dashboard.users.index') }}"><button class="btn btn-light"><i class="ri-arrow-go-forward-fill me-1 align-bottom"></i> @lang('dashboard.return')</button></a>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div>
<form id="edit-user-form" data-id="{{ $user->id }}">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name">@lang('dashboard.name')</label>
                        <input id="name" type="text" class="form-control ps-4" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email">@lang('dashboard.email')</label>
                        <input id="email" type="email" class="form-control ps-4" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="mb-1">@lang('dashboard.password')</label>
                        <div>
                            <input class="form-control" type="password" name="password">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="role">@lang('dashboard.role')</label>
                        <select class="form-control" id="role" name="role">
                            <option readonly disabled selected>@lang('dashboard.select.choose-option')</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $role->id == $user->roles()->first()->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <div class="row">
        <div class="text-end mb-">
            <button type="submit" class="btn btn-success w-sm loader-btn">
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
    <script src="{{ asset('back/js/users-module.js') }}" type="module"></script>
@endsection