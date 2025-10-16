@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Add ' . $role['role'])
@section('activeMenuUser', 'active open')
@section('activeSubMenu' . str_replace(' ', '', ucwords($role['role'])), 'active open')

{{-- Breadcrumb --}}
@section('breadcrumb1', $role['role'])
@section('breadcrumb2', 'Add')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ route('backsite.user.index', $role['index_role']) }}" class="btn btn-danger btn-glow round">
    <i class="fas fa-arrow-left mr5"></i> Back
</a>
@endsection

@section('content-body1')
<div class="content-body">
    <section id="horizontal-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    {{-- Card Header --}}
                    @include('partials.backsite.content.card-header')

                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="card-text">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Error! {{ $error }}</strong>
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <form class="form form-horizontal form-bordered" method="POST" enctype="multipart/form-data"
                                action="{{ route('backsite.user.store', ['role' => $role['index_role']]) }}">
                                @csrf

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12 p-0">
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-3 pl1-2 pr1-2 label-control required">Full Name</label>
                                                <div class="col-sm-12 col-md-9 pl1-2 pr1-2">
                                                    <input type="text" class="form-control" name="name" placeholder="ex: Peter Cech" value="{{ old('name') }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-3 pl1-2 pr1-2 label-control required">Email</label>
                                                <div class="col-sm-12 col-md-9 pl1-2 pr1-2">
                                                    <input type="email" class="form-control" name="email" placeholder="ex: example@gmail.com" value="{{ old('email') }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-3 pl1-2 pr1-2 label-control required">Password</label>
                                                <div class="col-sm-12 col-md-9 pl1-2 pr1-2">
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="min: 8 Character" value="{{ old('password') }}" required>
                                                    <i class="far fa-eye-slash" id="showPassword" data-show="false" style="cursor: pointer; float:right; margin-right:30px; position: relative; top:-25px"></i>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-3 pl1-2 pr1-2 label-control required">Phone</label>
                                                <div class="col-sm-12 col-md-9 pl1-2 pr1-2">
                                                    <input type="telp" class="form-control" name="phone" placeholder="ex: 087462643729" value="{{ old('phone') }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-3 pl1-2 pr1-2 label-control required">Nationality</label>
                                                <div class="col-sm-12 col-md-9 pl1-2 pr1-2">
                                                    <input type="text" class="form-control" name="nationality" placeholder="ex: Indonesia, Netherland, France" value="{{ old('nationality') }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-3 pl1-2 pr1-2 label-control required">Status</label>
                                                <div class="col-sm-12 col-md-9 pl1-2 pr1-2">
                                                    <select class="form-control" name="status" required>
                                                        <option value="0">Pending</option>
                                                        <option value="1" selected>Active</option>
                                                        <option value="2">Tidak Active</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-1 mb-1">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('after-script')
<script>
    $(document).on('click', '#showPassword', function() {
        show = $(this).data('show')
        ret = !show
        if (ret == true) {
            $(this).data('show', true)
            $(this).removeClass('fa-eye-slash')
            $(this).addClass('fa-eye')
            $('#password').attr('type', 'text')
        } else {
            $(this).data('show', false)
            $(this).removeClass('fa-eye')
            $(this).addClass('fa-eye-slash')
            $('#password').attr('type', 'password')
        }
    });
</script>
@endpush
