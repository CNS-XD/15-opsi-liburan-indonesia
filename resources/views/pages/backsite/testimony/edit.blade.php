@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Edit Testimony')
@section('activeMenuTestimony', 'active open')
@section('activeSubMenuTestimony', 'active open')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'Testimony')
@section('breadcrumb2', 'Edit')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ route('backsite.testimony.index') }}" class="btn btn-danger btn-glow round">
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
                                action="{{ route('backsite.testimony.update', $data->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12 p-0">
                                            <div class="form-group row">
                                                <label class="col-md-3 pl1-2 pr1-2 label-control required">Photo</label>
                                                <div class="col-md-9 pl1-2 pr1-2 mx-auto">
                                                    <div id="place-image">
                                                        @if (!empty($data->image))
                                                            <img src="/storage/{{ $data->image }}" width="200px" id="img-canvas">
                                                        @else
                                                            <img src="/backsite-assets/images/no-image-available.jpg" width="200px" id="img-canvas">
                                                        @endif
                                                    </div>
                                                    <input type="file" name="image" class="form-control" accept="image/*" id="img-input">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-0">
                                            <div class="form-group row">
                                                <label class="col-md-3 pl1-2 pr1-2 label-control required">Name</label>
                                                <div class="col-md-9 pl1-2 pr1-2 mx-auto">
                                                    <input type="text" name="name" class="form-control" value="{{ $data->name }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-0">
                                            <div class="form-group row">
                                                <label class="col-md-3 pl1-2 pr1-2 label-control required">Rating</label>
                                                <div class="col-md-9 pl1-2 pr1-2 mx-auto">
                                                    <select name="rating" class="form-control">
                                                        <option value="1" {{ $data->rating == 1 ? 'selected' : '' }}>⭐</option>
                                                        <option value="2" {{ $data->rating == 2 ? 'selected' : '' }}>⭐⭐</option>
                                                        <option value="3" {{ $data->rating == 3 ? 'selected' : '' }}>⭐⭐⭐</option>
                                                        <option value="4" {{ $data->rating == 4 ? 'selected' : '' }}>⭐⭐⭐⭐</option>
                                                        <option value="5" {{ $data->rating == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐</option>
                                                    </select>
                                                    <small>Rating testimony user</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-0">
                                            <div class="form-group row">
                                                <label class="col-md-3 pl1-2 pr1-2 label-control required">Testimony</label>
                                                <div class="col-md-9 pl1-2 pr1-2 mx-auto">
                                                    <textarea name="description" class="form-control summernote" cols="30" rows="10">{{ $data->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 p-0">
                                            <div class="form-group row">
                                                <label class="col-md-3 pl1-2 pr1-2 label-control required">Show</label>
                                                <div class="col-md-9 pl1-2 pr1-2 mx-auto">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="show" value="1" id="activeShow" {{ $data->show == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="activeShow">
                                                            Active / Publish
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="show" value="0" id="nonActiveShow" {{ $data->show == 0 ? 'checked' : '' }}>
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
    
</script>
@endpush
