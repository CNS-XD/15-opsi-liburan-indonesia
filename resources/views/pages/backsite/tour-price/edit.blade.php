@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Edit Tour Price')
@section('activeMenuTour', 'active open')
@section('activeSubMenuTourPrice', 'active open')

{{-- Breadcrumb --}}
@section('breadcrumb1', $data->title)
@section('breadcrumb2', 'Edit Tour Price')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ route('backsite.tour-price.index', $data->id_tour) }}" class="btn btn-danger btn-glow round">
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
                                action="{{ route('backsite.tour-price.update', $data->id) }}" method="POST">
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

                                    {{-- PAX --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Pax</label>
                                        <div class="col-md-9">
                                            <input type="number"
                                                name="pax"
                                                class="form-control"
                                                value="{{ old('pax', $data->pax) }}"
                                                min="1"
                                                required>
                                        </div>
                                    </div>

                                    {{-- PRICE --}}
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Price</label>
                                        <div class="col-md-9">
                                            <input type="number"
                                                name="price"
                                                class="form-control"
                                                value="{{ old('price', $data->price) }}"
                                                min="0"
                                                required>
                                        </div>
                                    </div>
                                    {{-- Submit --}}
                                    <div class="mt-1 mb-1">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i>
                                            {{ isset($data) ? 'Update' : 'Save' }}
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
