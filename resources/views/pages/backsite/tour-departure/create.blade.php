@extends('layouts.backsite')

@section('title', 'Add Tour Departure')
@section('activeMenuTour', 'active open')
@section('activeSubMenuTourDeparture', 'active open')

@section('breadcrumb1', $tour->title)
@section('breadcrumb2', 'Add Tour Departure')

@section('buttonRight')
<a href="{{ route('backsite.tour-departure.index', $tour->id) }}" class="btn btn-danger btn-glow round">
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

                            <form action="{{ route('backsite.tour-departure.store') }}" method="POST">
                            @csrf
                                {{-- MASTER DEPARTURE --}}
                                <div class="form-group row">
                                    <label class="col-md-3 label-control required">Departure</label>
                                    <div class="col-md-9">
                                        <select name="id_departure" class="form-control select2" required>
                                            <option value="">-- Pilih Departure --</option>
                                                @foreach ($departures as $departure)
                                                    <option value="{{ $departure->id }}">
                                                        {{ $departure->title }}
                                                    </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- MASTER TOUR --}}
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
                                <div class="mt-1">
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
    $('.select2').select2({
        width: '100%',
        placeholder: 'Pilih data'
    });
</script>
@endpush
