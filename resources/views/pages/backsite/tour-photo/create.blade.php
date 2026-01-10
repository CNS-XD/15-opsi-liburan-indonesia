@extends('layouts.backsite')

@section('title', 'Add Tour Photo')
@section('activeMenuTour', 'active open')
@section('activeSubMenuTourPhoto', 'active open')

@section('breadcrumb1', $tour->title)
@section('breadcrumb2', 'Add Tour Photo')

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

                    @include('partials.backsite.content.card-header')

                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form action="{{ route('backsite.tour-photo.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- TOUR --}}
                                <div class="form-group row">
                                    <label class="col-md-3 label-control required">Tour</label>
                                    <div class="col-md-9">
                                        <select name="id_tour" class="form-control select2" required>
                                            <option value="{{ $tour->id }}" selected>
                                                {{ $tour->title }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                {{-- IMAGE --}}
                                <div class="form-group row">
                                    <label class="col-md-3 label-control required">Photo</label>
                                    <div class="col-md-9">
                                        <input type="file"
                                            name="image"
                                            class="form-control"
                                            accept="image/*"
                                            required>
                                    </div>
                                </div>

                                {{-- SHOW --}}
                                <div class="form-group row">
                                    <label class="col-md-3 label-control required">Status</label>
                                    <div class="col-md-9">
                                        <select name="show" class="form-control select2" required>
                                            <option value="1" selected>Show</option>
                                            <option value="0">Hide</option>
                                        </select>
                                    </div>
                                </div>

                                <button class="btn btn-primary">
                                    <i class="la la-save"></i> Save
                                </button>
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
$('.select2').select2({
    width: '100%'
});

$('.summernote').summernote({
    height: 250,
    toolbar: [
        ['style', ['bold', 'italic', 'underline']],
        ['para', ['ul', 'ol']],
        ['insert', ['link']],
        ['view', ['codeview']]
    ]
});
</script>
@endpush
