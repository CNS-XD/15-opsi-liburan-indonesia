@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Add Tour Departure')
@section('activeMenuTour', 'active open')
@section('activeSubMenuTourDeparture', 'active open')

{{-- Breadcrumb --}}
@section('breadcrumb1', $data->title)
@section('breadcrumb2', 'Add Tour Departure')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ route('backsite.tour-departure.index', $data->id) }}" class="btn btn-danger btn-glow round">
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
                                action="{{ route('backsite.tour-departure.store') }}" method="POST">
                                @csrf

                                <div class="form-body">
                                    {{-- Image --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Image</label>
                                        <div class="col-md-9">
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                        </div>
                                    </div>

                                    {{-- Title --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Title</label>
                                        <div class="col-md-9">
                                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Tour title">
                                        </div>
                                    </div>

                                    {{-- Description --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Description</label>
                                        <div class="col-md-9">
                                            <textarea name="description" class="form-control summernote-tour-departure">{{ old('description') }}</textarea>
                                        </div>
                                    </div>

                                    {{-- Day Tour --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Day Tour</label>
                                        <div class="col-md-9">
                                            <select name="day_tour" class="form-control">
                                                @for ($i = 1; $i <= 7; $i++)
                                                    <option value="{{ $i }}">{{ $i }} Day</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Time Tour --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Time Tour</label>
                                        <div class="col-md-9">
                                            <input type="text" name="time_tour" class="form-control" value="{{ old('time_tour') }}" placeholder="ex: 3 Days 2 Nights">
                                        </div>
                                    </div>

                                    {{-- Type Tour --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Type Tour</label>
                                        <div class="col-md-9">
                                            <input type="radio" name="type_tour" value="0" checked> Private Tour
                                            <input type="radio" name="type_tour" value="1"> Sharing Tour
                                        </div>
                                    </div>

                                    {{-- Price --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Price</label>
                                        <div class="col-md-9">
                                            <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                                        </div>
                                    </div>

                                    {{-- Is Best --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">Best Tour</label>
                                        <div class="col-md-9">
                                            <input type="radio" name="is_best" value="1"> Yes
                                            <input type="radio" name="is_best" value="0" checked> No
                                        </div>
                                    </div>

                                    {{-- Group Size --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Group Size</label>
                                        <div class="col-md-9">
                                            <input type="text" name="group_size" class="form-control"
                                                value="{{ old('group_size') }}" placeholder="ex: 2-10 pax">
                                        </div>
                                    </div>

                                    {{-- Level Tour --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Level Tour</label>
                                        <div class="col-md-9">
                                            <select name="level_tour" class="form-control">
                                                <option value="Low">Low</option>
                                                <option value="Medium">Medium</option>
                                                <option value="Hard">Hard</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Show --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Show</label>
                                        <div class="col-md-9">
                                            <input type="radio" name="show" value="1" checked> Publish
                                            <input type="radio" name="show" value="0"> Draft
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
    $('.summernote-tour-departure').summernote({
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
