@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'About')
@section('activeMenuAbout', 'open active')
@section('activeSubMenuAbout', 'open active')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'Information')
@section('breadcrumb2', 'About')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ url('/') }}" class="btn btn-info btn-sm btn-glow round" target="_blank">
    View Page <i class="fa fa-arrow-right"></i>
</a>
@endsection

@section('content-body1')
<div class="content-body">
    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- Card Header --}}
                    @include('partials.backsite.content.card-header')

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
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
                                action="{{ route('backsite.about.update') }}" method="POST">
                                @csrf

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12 p-0">
                                            <div class="form-group row">
                                                <label class="col-md-3 pl1-2 pr1-2 label-control">Description</label>
                                                <div class="col-md-9 pl1-2 pr1-2 mx-auto">
                                                    <textarea name="description" class="form-control summernote" cols="30" rows="10">{{ $data->description ?? null }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-1 mb-1">
                                    @if (!empty($data->description))
                                        <button class="btn btn-warning" type="submit">
                                            <i class="fa fa-pencil"></i> Update
                                        </button>
                                    @else
                                        <button class="btn btn-primary" type="submit">
                                            <i class="la la-check-square-o"></i> Save
                                        </button>
                                    @endif
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