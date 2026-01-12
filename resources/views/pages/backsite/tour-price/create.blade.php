@extends('layouts.backsite')

@section('title', 'Add Tour Price')
@section('activeMenuTour', 'active open')
@section('activeSubMenuTourPrice', 'active open')

@section('breadcrumb1', $tour->title)
@section('breadcrumb2', 'Add Tour Price')

@section('buttonRight')
<a href="{{ route('backsite.tour-price.index', $tour->id) }}" class="btn btn-danger btn-glow round">
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
                            <form action="{{ route('backsite.tour-price.store') }}" method="POST">
                                @csrf

                                {{-- TOUR (LOCKED) --}}
                                <div class="form-group row">
                                    <label class="col-md-3 label-control required">Tour</label>
                                    <div class="col-md-9">
                                        <select class="form-control" disabled>
                                            <option selected>
                                                {{ $tour->title }}
                                            </option>
                                        </select>

                                        {{-- value tetap dikirim --}}
                                        <input type="hidden" name="id_tour" value="{{ $tour->id }}">
                                    </div>
                                </div>

                                {{-- PAX --}}
                                <div class="form-group">
                                    <label class="required">Pax</label>
                                    <input type="number" name="pax" class="form-control" required min="1">
                                </div>

                                {{-- PRICE --}}
                                <div class="form-group">
                                    <label class="required">Price</label>
                                    <input type="number" name="price" class="form-control" required min="0">
                                </div>

                                <button class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Save
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
