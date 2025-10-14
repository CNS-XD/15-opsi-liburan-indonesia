@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Edit Destination')
@section('activeMenuDestination', 'active open')
@section('activeSubMenuDestination', 'active open')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'Destination')
@section('breadcrumb2', 'Edit')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ route('backsite.destination.index') }}" class="btn btn-danger btn-glow round">
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

                            <form class="form form-horizontal form-bordered"
                                action="{{ route('backsite.destination.update', $data->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12 p-0">
                                            <div class="form-group row">
                                                <label class="col-md-3 pl1-2 pr1-2 label-control required">Title</label>
                                                <div class="col-md-9 pl1-2 pr1-2 mx-auto">
                                                    <input type="text" name="title" class="form-control" placeholder="ex: Bromo Mountain, Ijen Crater, Tumpak Sewu, Madakaripura Waterfall, dll" value="{{ $data->title }}" />
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
