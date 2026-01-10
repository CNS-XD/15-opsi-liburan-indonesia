@extends('layouts.backsite')

@section('title', 'Add Tour Detail')
@section('activeMenuTour', 'active open')
@section('activeSubMenuTourDetail', 'active open')

@section('breadcrumb1', $tour->title)
@section('breadcrumb2', 'Add Tour Detail')

@section('buttonRight')
<a href="{{ route('backsite.tour-detail.index', $tour->id) }}" class="btn btn-danger btn-glow round">
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
                            <form action="{{ route('backsite.tour-detail.store') }}" method="POST">
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

                            {{-- TYPE --}}
                            <div class="form-group row">
                                <label class="col-md-3 label-control required">Type</label>
                                <div class="col-md-9">
                                    <select name="type" class="form-control select2" required>
                                        <option value="">-- Select Type --</option>
                                        @foreach ($types as $key => $label)
                                            <option value="{{ $key }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- DESCRIPTION --}}
                            <div class="form-group row">
                                <label class="col-md-3 label-control required">Description</label>
                                <div class="col-md-9">
                                    <textarea name="description" class="form-control summernote" required></textarea>
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
