@extends('dashboard.layouts.app')

@section('title', __('dashboard.contacts'))

@section('content')

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped" id="dataTables">
            <thead>
                <tr class="table-dark">
                    <th>@lang('dashboard.id')</th>
                    <th>@lang('dashboard.company')</th>
                    <th>@lang('dashboard.name')</th>
                    <th>@lang('dashboard.email')</th>
                    <th>@lang('dashboard.phone_number')</th>
                    <th>@lang('dashboard.status')</th>
                    <th>@lang('dashboard.action')</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal" id="contactMessage" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">@lang('dashboard.contacts.message')</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="@lang('dashboard.close')"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <p class="fw-bold mb-0">@lang('dashboard.company')</p>
                <p class="company"></p>
            </div>
            <div class="mb-3">
                <p class="fw-bold mb-0">@lang('dashboard.name')</p>
                <p class="name"></p>
            </div>
            <div class="mb-3">
                <p class="fw-bold mb-0">@lang('dashboard.email')</p>
                <p class="email"></p>
            </div>
            <div class="mb-3">
                <p class="fw-bold mb-0">@lang('dashboard.phone_number')</p>
                <p class="phone_number"></p>
            </div>
            <div class="mb-3">
                <p class="fw-bold mb-0">@lang('dashboard.message')</p>
                <p class="message"></p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">@lang('dashboard.close')</button>
        </div>
      </div>
    </div>
</div>
@endsection

@section('custom-js')
    <script src="{{ asset('back/js/contact-us-module.js') }}" type="module"></script>
    <script>
        var table
        $(document).ready( function () {
            table = $('#dataTables').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard.contact-us.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'company', name: 'company' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone_number', name: 'phone_number' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action'}
                ]
            });
        });
    </script>
@endsection