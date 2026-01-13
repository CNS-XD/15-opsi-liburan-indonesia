@extends('layouts.backsite')

@section('title', 'Add Tour Review')
@section('activeMenuTour', 'active open')
@section('activeSubMenuTourReview', 'active open')

@section('breadcrumb1', $tour->title)
@section('breadcrumb2', 'Add Tour Review')

@section('buttonRight')
<a href="{{ route('backsite.tour-review.index', $tour->id) }}" class="btn btn-danger btn-glow round">
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
                            <form action="{{ route('backsite.tour-review.store') }}"
                                  method="POST"
                                  enctype="multipart/form-data">
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
                                               value="{{ old('name') }}"
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
                                                    {{ old('rating') == $i ? 'selected' : '' }}>
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
                                                  required>{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                {{-- SHOW / HIDE --}}
                                <div class="form-group row">
                                    <label class="col-md-3 label-control required">Status</label>
                                    <div class="col-md-9">
                                        <select name="show"
                                                class="form-control select2"
                                                required>
                                            <option value="1" {{ old('show') == '1' ? 'selected' : '' }}>
                                                Show
                                            </option>
                                            <option value="0" {{ old('show') == '0' ? 'selected' : '' }}>
                                                Hidden
                                            </option>
                                        </select>
                                    </div>
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
    height: 200,
    toolbar: [
        ['style', ['bold', 'italic', 'underline']],
        ['para', ['ul', 'ol']],
        ['insert', ['link']],
        ['view', ['codeview']]
    ]
});
</script>
@endpush