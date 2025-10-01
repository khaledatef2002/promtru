@extends('dashboard.layouts.app')

@section('title', __('dashboard.roles.edit'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row g-2">
            <div class="col-sm-auto ms-auto">
                <a href="{{ route('dashboard.roles.index') }}"><button class="btn btn-light"><i class="ri-arrow-go-forward-fill me-1 align-bottom"></i> @lang('dashboard.return')</button></a>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div>
<form id="edit-role-form" data-id="{{ $role->id }}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="name">@lang('dashboard.roles.name')</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="@lang('dashboard.enter') @lang('dashboard.roles.name')" value="{{ $role->name }}">
                    </div>
                </div>
            </div>
            <!-- end card -->

            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('dashboard.permissions.module')</th>
                                <th>@lang('dashboard.permissions.permissions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>@lang('dashboard.modules.services')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::services_show->value }}" value="{{ \App\Enum\PermissionsType::services_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::services_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::services_show->value }}">
                                            @lang('dashboard.permissions.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::services_edit->value }}" value="{{ \App\Enum\PermissionsType::services_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::services_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::services_edit->value }}">
                                            @lang('dashboard.permissions.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::services_delete->value }}" value="{{ \App\Enum\PermissionsType::services_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::services_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::services_delete->value }}">
                                            @lang('dashboard.permissions.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::services_create->value }}" value="{{ \App\Enum\PermissionsType::services_create->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::services_create->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::services_create->value }}">
                                            @lang('dashboard.permissions.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.modules.blogs')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::blogs_show->value }}" value="{{ \App\Enum\PermissionsType::blogs_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::blogs_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::blogs_show->value }}">
                                            @lang('dashboard.permissions.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::blogs_edit->value }}" value="{{ \App\Enum\PermissionsType::blogs_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::blogs_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::blogs_edit->value }}">
                                            @lang('dashboard.permissions.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::blogs_delete->value }}" value="{{ \App\Enum\PermissionsType::blogs_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::blogs_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::blogs_delete->value }}">
                                            @lang('dashboard.permissions.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::blogs_create->value }}" value="{{ \App\Enum\PermissionsType::blogs_create->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::blogs_create->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::blogs_create->value }}">
                                            @lang('dashboard.permissions.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.modules.partners')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::partners_show->value }}" value="{{ \App\Enum\PermissionsType::partners_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::partners_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::partners_show->value }}">
                                            @lang('dashboard.permissions.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::partners_edit->value }}" value="{{ \App\Enum\PermissionsType::partners_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::partners_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::partners_edit->value }}">
                                            @lang('dashboard.permissions.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::partners_delete->value }}" value="{{ \App\Enum\PermissionsType::partners_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::partners_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::partners_delete->value }}">
                                            @lang('dashboard.permissions.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::partners_create->value }}" value="{{ \App\Enum\PermissionsType::partners_create->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::partners_create->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::partners_create->value }}">
                                            @lang('dashboard.permissions.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.modules.contact_us')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::contact_us_show->value }}" value="{{ \App\Enum\PermissionsType::contact_us_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::contact_us_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::contact_us_show->value }}">
                                            @lang('dashboard.permissions.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::contact_us_action->value }}" value="{{ \App\Enum\PermissionsType::contact_us_action->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::contact_us_action->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::contact_us_action->value }}">
                                            @lang('dashboard.permissions.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::contact_us_delete->value }}" value="{{ \App\Enum\PermissionsType::contact_us_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::contact_us_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::contact_us_delete->value }}">
                                            @lang('dashboard.permissions.delete')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.modules.users')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::users_show->value }}" value="{{ \App\Enum\PermissionsType::users_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::users_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::users_show->value }}">
                                            @lang('dashboard.permissions.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::users_edit->value }}" value="{{ \App\Enum\PermissionsType::users_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::users_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::users_edit->value }}">
                                            @lang('dashboard.permissions.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::users_delete->value }}" value="{{ \App\Enum\PermissionsType::users_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::users_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::users_delete->value }}">
                                            @lang('dashboard.permissions.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::users_create->value }}" value="{{ \App\Enum\PermissionsType::users_create->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::users_create->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::users_create->value }}">
                                            @lang('dashboard.permissions.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.modules.roles')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::roles_show->value }}" value="{{ \App\Enum\PermissionsType::roles_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::roles_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::roles_show->value }}">
                                            @lang('dashboard.permissions.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::roles_edit->value }}" value="{{ \App\Enum\PermissionsType::roles_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::roles_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::roles_edit->value }}">
                                            @lang('dashboard.permissions.edit')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::roles_delete->value }}" value="{{ \App\Enum\PermissionsType::roles_delete->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::roles_delete->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::roles_delete->value }}">
                                            @lang('dashboard.permissions.delete')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::roles_create->value }}" value="{{ \App\Enum\PermissionsType::roles_create->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::roles_create->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::roles_create->value }}">
                                            @lang('dashboard.permissions.create')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('dashboard.modules.website_settings')</td>
                                <td>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::website_settings_show->value }}" value="{{ \App\Enum\PermissionsType::website_settings_show->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::website_settings_show->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::website_settings_show->value }}">
                                            @lang('dashboard.permissions.show')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="permission[]" class="form-check-input" type="checkbox" id="{{ \App\Enum\PermissionsType::website_settings_edit->value }}" value="{{ \App\Enum\PermissionsType::website_settings_edit->value }}" {{ $role->hasPermissionTo(\App\Enum\PermissionsType::website_settings_edit->value) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ \App\Enum\PermissionsType::website_settings_edit->value }}">
                                            @lang('dashboard.permissions.edit')
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <div class="row">
        <div class="text-end mb-3">
            <button type="submit" class="btn btn-success w-sm loader-btn">
                <p class="mb-0">@lang('dashboard.save')</p>
                <div class="loader"></div>
            </button>
        </div>
    </div>
</form>

@endsection

@section('custom-js')
    <script src="{{ asset('back/js/roles-module.js') }}" type="module"></script>
@endsection