@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Edit Tour Photo')
@section('activeMenuTour', 'active open')
@section('activeSubMenuTourPhoto', 'active open')

{{-- Breadcrumb --}}
@section('breadcrumb1', $tour->title)
@section('breadcrumb2', 'Edit Tour Photo')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ route('backsite.tour-photo.index', $tour->id) }}" class="btn btn-danger btn-glow round">
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

                            {{-- ERROR MESSAGE --}}
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error! {{ $error }}</strong>
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                @endforeach
                            @endif

                            <form class="form form-horizontal form-bordered"
                                  action="{{ route('backsite.tour-photo.update', $data->id) }}"
                                  method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-body">

                                    {{-- TOUR (READONLY) --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Tour</label>
                                        <div class="col-md-9">
                                            <select class="form-control" disabled>
                                                <option selected>{{ $tour->title }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- CURRENT PHOTO --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Current Photo</label>
                                        <div class="col-md-9">
                                            <img src="{{ asset('storage/'.$data->image) }}"
                                                 class="img-thumbnail"
                                                 style="max-height:150px">
                                        </div>
                                    </div>

                                    {{-- NEW PHOTO --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Replace Photo</label>
                                        <div class="col-md-9">
                                            <input type="file"
                                                   name="image"
                                                   class="form-control"
                                                   accept="image/*">
                                            <small class="text-muted">
                                                Leave empty if you don’t want to change the photo
                                            </small>
                                        </div>
                                    </div>

                                    {{-- STATUS --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Status</label>
                                        <div class="col-md-9">
                                            <select name="show" class="form-control select2" required>
                                                <option value="1" {{ $data->show == 1 ? 'selected' : '' }}>
                                                    Show
                                                </option>
                                                <option value="0" {{ $data->show == 0 ? 'selected' : '' }}>
                                                    Hide
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- SUBMIT --}}
                                    <div class="mt-1 mb-1">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> Update
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
