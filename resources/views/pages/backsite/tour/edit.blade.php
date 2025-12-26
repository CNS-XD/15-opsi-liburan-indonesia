@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Edit Tour')
@section('activeMenuTour', 'active open')
@section('activeSubMenuTour', 'active open')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'Tour')
@section('breadcrumb2', 'Edit')

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
                                action="{{ route('backsite.tour.update', $data->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-body">

                                {{-- Image --}}
                                <div class="form-group row">
                                    <label class="col-md-3 label-control required">Photo</label>
                                    <div class="col-md-9">
                                        <img src="{{ $data->image ? asset('storage/'.$data->image) : asset('backsite-assets/images/no-image-available.jpg') }}"
                                            width="200" class="mb-1">
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                    </div>
                                </div>

                                {{-- Title --}}
                                <div class="form-group row">
                                    <label class="col-md-3 label-control required">Title</label>
                                    <div class="col-md-9">
                                        <input type="text" name="title" class="form-control"
                                            value="{{ $data->title }}">
                                    </div>
                                </div>

                                {{-- Description --}}
                                <div class="form-group row">
                                    <label class="col-md-3 label-control required">Description</label>
                                    <div class="col-md-9">
                                        <textarea name="description" class="form-control summernote-tour">{{ $data->description }}</textarea>
                                    </div>
                                </div>

                                {{-- Day Tour --}}
                                <div class="form-group row">
                                    <label class="col-md-3 label-control required">Day Tour</label>
                                    <div class="col-md-9">
                                        <select name="day_tour" class="form-control">
                                            @for ($i = 1; $i <= 7; $i++)
                                                <option value="{{ $i }}" {{ $data->day_tour == $i ? 'selected' : '' }}>
                                                    {{ $i }} Day
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                {{-- Time Tour --}}
                                <div class="form-group row">
                                    <label class="col-md-3 label-control required">Time Tour</label>
                                    <div class="col-md-9">
                                        <input type="text" name="time_tour" class="form-control"
                                            value="{{ $data->time_tour }}">
                                    </div>
                                </div>

                                {{-- Type Tour --}}
                                <div class="form-group row">
                                    <label class="col-md-3 label-control required">Type Tour</label>
                                    <div class="col-md-9">
                                        <label>
                                            <input type="radio" name="type_tour" value="0"
                                                {{ $data->type_tour == 0 ? 'checked' : '' }}> Private
                                        </label>
                                        <label class="ml-1">
                                            <input type="radio" name="type_tour" value="1"
                                                {{ $data->type_tour == 1 ? 'checked' : '' }}> Sharing
                                        </label>
                                    </div>
                                </div>

                                {{-- Price --}}
                                <div class="form-group row">
                                    <label class="col-md-3 label-control required">Price</label>
                                    <div class="col-md-9">
                                        <input type="number" name="price" class="form-control"
                                            value="{{ $data->price }}">
                                    </div>
                                </div>

                                {{-- Is Best --}}
                                <div class="form-group row">
                                    <label class="col-md-3 label-control">Best Tour</label>
                                    <div class="col-md-9">
                                        <label>
                                            <input type="radio" name="is_best" value="1"
                                                {{ $data->is_best == 1 ? 'checked' : '' }}> Yes
                                        </label>
                                        <label class="ml-1">
                                            <input type="radio" name="is_best" value="0"
                                                {{ $data->is_best == 0 ? 'checked' : '' }}> No
                                        </label>
                                    </div>
                                </div>

                                {{-- Group Size --}}
                                <div class="form-group row">
                                    <label class="col-md-3 label-control required">Group Size</label>
                                    <div class="col-md-9">
                                        <input type="text" name="group_size" class="form-control"
                                            value="{{ $data->group_size }}">
                                    </div>
                                </div>

                                {{-- Level Tour --}}
                                <div class="form-group row">
                                    <label class="col-md-3 label-control required">Level Tour</label>
                                    <div class="col-md-9">
                                        <select name="level_tour" class="form-control">
                                            <option value="Low" {{ $data->level_tour == 'Low' ? 'selected' : '' }}>Low</option>
                                            <option value="Medium" {{ $data->level_tour == 'Medium' ? 'selected' : '' }}>Medium</option>
                                            <option value="Hard" {{ $data->level_tour == 'Hard' ? 'selected' : '' }}>Hard</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Show --}}
                                <div class="form-group row">
                                    <label class="col-md-3 label-control required">Show</label>
                                    <div class="col-md-9">
                                        <label>
                                            <input type="radio" name="show" value="1"
                                                {{ $data->show == 1 ? 'checked' : '' }}> Publish
                                        </label>
                                        <label class="ml-1">
                                            <input type="radio" name="show" value="0"
                                                {{ $data->show == 0 ? 'checked' : '' }}> Draft
                                        </label>
                                    </div>
                                </div>
                                </div>

                                <div class="mt-1 mb-1">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Update
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
