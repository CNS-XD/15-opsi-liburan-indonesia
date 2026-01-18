@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Edit Tour Review')
@section('activeMenuTour', 'active open')
@section('activeSubMenuTourReview', 'active open')

{{-- Breadcrumb --}}
@section('breadcrumb1', $data->title)
@section('breadcrumb2', 'Edit Tour Review')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ route('backsite.tour-review.index', $data->id_tour) }}" class="btn btn-danger btn-glow round">
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

                            <form class="form form-horizontal form-bordered"
                                enctype="multipart/form-data"
                                action="{{ route('backsite.tour-review.update', $data->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-body">

                                    {{-- TOUR (LOCKED) --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Tour</label>
                                        <div class="col-md-9">
                                            <select class="form-control" disabled>
                                                <option selected>{{ $tour->title }}</option>
                                            </select>

                                            <input type="hidden" name="id_tour" value="{{ $tour->id }}">
                                        </div>
                                    </div>

                                    {{-- NAME --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Name</label>
                                        <div class="col-md-9">
                                            <input type="text"
                                                name="name"
                                                class="form-control"
                                                value="{{ old('name', $data->name) }}"
                                                required>
                                        </div>
                                    </div>

                                    {{-- IMAGE --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Photo</label>
                                        <div class="col-md-9">
                                            <input type="file"
                                                name="image"
                                                class="form-control"
                                                accept="image/*">

                                            @if ($data->image)
                                                <div class="mt-1">
                                                    <img src="{{ asset('storage/'.$data->image) }}"
                                                        class="img-thumbnail"
                                                        style="height: 80px">
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- RATING --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Rating</label>
                                        <div class="col-md-9">
                                            <select name="rating"
                                                    class="form-control select2"
                                                    required>
                                                <option value="">-- Select Rating --</option>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ old('rating', $data->rating) == $i ? 'selected' : '' }}>
                                                        {{ $i }} Star
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    {{-- DESCRIPTION / REVIEW --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Review</label>
                                        <div class="col-md-9">
                                            <textarea name="description"
                                                    class="form-control summernote"
                                                    required>{{ old('description', $data->description) }}</textarea>
                                        </div>
                                    </div>

                                    {{-- SHOW / HIDE --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Status</label>
                                        <div class="col-md-9">
                                            <select name="show"
                                                    class="form-control select2"
                                                    required>
                                                <option value="1"
                                                    {{ old('show', $data->show) == 1 ? 'selected' : '' }}>
                                                    Show
                                                </option>
                                                <option value="0"
                                                    {{ old('show', $data->show) == 0 ? 'selected' : '' }}>
                                                    Hidden
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- SUBMIT --}}
                                    <div class="mt-1 mb-1">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i>
                                            Update
                                        </button>
                                    </div>

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
    $('.summernote-tour-price').summernote({
        height: 300,
        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['para', ['ul', 'ol']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview']]
        ]
    });
</script>
@endpush
