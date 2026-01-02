@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Edit Tour Departure')
@section('activeMenuTour', 'active open')
@section('activeSubMenuTourDeparture', 'active open')

{{-- Breadcrumb --}}
@section('breadcrumb1', $data->title)
@section('breadcrumb2', 'Edit Tour Departure')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ route('backsite.tour-departure.index', $data->id_tour) }}" class="btn btn-danger btn-glow round">
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
                                action="{{ route('backsite.tour-departure.update', $data->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Departure</label>
                                        <div class="col-md-9">
                                            <select name="id_departure" class="form-control select2" required>
                                                @foreach ($departures as $departure)
                                                    <option value="{{ $departure->id }}"
                                                        {{ $data->id_departure == $departure->id ? 'selected' : '' }}>
                                                        {{ $departure->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required">Tour</label>
                                        <div class="col-md-9">
                                            <select name="id_tour" class="form-control" required>
                                                <option value="{{ $data->id_tour }}" selected>
                                                    {{ $data->tour->title }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mt-1 mb-1">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> Update
                                            </button>
                                        </div>
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
    $('.summernote-tour-departure').summernote({
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
