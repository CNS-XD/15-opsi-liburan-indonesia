@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Add Tour')
@section('activeMenuTour', 'active open')
@section('activeSubMenuTour', 'active open')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'Tour')
@section('breadcrumb2', 'Add')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ route('backsite.tour.index') }}" class="btn btn-danger btn-glow round">
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

                            <form class="form form-horizontal form-bordered" enctype="multipart/form-data"
                                action="{{ route('backsite.tour.store') }}" method="POST">
                                @csrf

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12 p-0">
                                            <div class="form-group row">
                                                <label class="col-md-3 pl1-2 pr1-2 label-control required">Photo</label>
                                                <div class="col-md-9 pl1-2 pr1-2 mx-auto">
                                                    <div id="place-image" class="ds-none">
                                                        <img src="" width="200px" id="img-canvas">
                                                    </div>
                                                    <input type="file" name="image" class="form-control" accept="image/*" id="img-input">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-0">
                                            <div class="form-group row">
                                                <label class="col-md-3 pl1-2 pr1-2 label-control required">Name</label>
                                                <div class="col-md-9 pl1-2 pr1-2 mx-auto">
                                                    <input type="text" name="name" class="form-control" placeholder="ex: Peter Cech" value="{{ old('name ') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-0">
                                            <div class="form-group row">
                                                <label class="col-md-3 pl1-2 pr1-2 label-control required">Rating</label>
                                                <div class="col-md-9 pl1-2 pr1-2 mx-auto">
                                                    <select name="rating" class="form-control">
                                                        <option value="1">⭐</option>
                                                        <option value="2">⭐⭐</option>
                                                        <option value="3">⭐⭐⭐</option>
                                                        <option value="4">⭐⭐⭐⭐</option>
                                                        <option value="5">⭐⭐⭐⭐⭐</option>
                                                    </select>
                                                    <small>Rating tour user</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-0">
                                            <div class="form-group row">
                                                <label class="col-md-3 pl1-2 pr1-2 label-control required">tour</label>
                                                <div class="col-md-9 pl1-2 pr1-2 mx-auto">
                                                    <textarea name="description" class="form-control summernote-tour" cols="30" rows="10">{{ old('description') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 p-0">
                                            <div class="form-group row">
                                                <label class="col-md-3 pl1-2 pr1-2 label-control required">Show</label>
                                                <div class="col-md-9 pl1-2 pr1-2 mx-auto">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="show" value="1" id="activeShow" checked>
                                                        <label class="form-check-label" for="activeShow">
                                                            Active / Publish
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="show" value="0" id="nonActiveShow">
                                                        <label class="form-check-label" for="nonActiveShow">
                                                            Non Active / Draft
                                                        </label>
                                                    </div>
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
    $('.summernote-tour').summernote({
        height: '300px',
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['font', ['color']],
            ['para', ['ul', 'ol']],
            ['insert', ['link']],
            ['misc', ['undo', 'redo', 'fullscreen', 'codeview', 'help']],
        ]
    });
</script>
@endpush
