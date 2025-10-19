@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Edit Blog')
@section('activeMenuUpdate', 'active open')
@section('activeSubMenuBlog', 'active open')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'Blog')
@section('breadcrumb2', 'Edit')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ route('backsite.blog.index') }}" class="btn btn-danger btn-glow round">
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
                                action="{{ route('backsite.blog.update', $data->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12 p-0">
                                            <div class="form-group row">
                                                <label class="col-md-3 pl1-2 pr1-2 label-control required">Title</label>
                                                <div class="col-md-9 pl1-2 pr1-2 mx-auto">
                                                    <input type="text" name="title" class="form-control" value="{{ $data->title }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-0">
                                            <div class="form-group row">
                                                <label class="col-md-3 pl1-2 pr1-2 label-control required">Description</label>
                                                <div class="col-md-9 pl1-2 pr1-2 mx-auto">
                                                    <textarea name="description" class="form-control summernote" cols="30" rows="10">{{ $data->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-0">
                                            <div class="form-group row">
                                                <label class="col-md-3 pl1-2 pr1-2 label-control required">Type</label>
                                                <div class="col-md-9 pl1-2 pr1-2 mx-auto">
                                                    <select name="type" class="form-control">
                                                        <option value="">Select Type</option>
                                                        <option value="Tips" {{ $data->type === 'Tips' ? 'selected' : '' }}>Tips</option>
                                                        <option value="News" {{ $data->type === 'News' ? 'selected' : '' }}>News</option>
                                                        <option value="Blog" {{ $data->type === 'Blog' ? 'selected' : '' }}>Blog</option>
                                                        <option value="Article" {{ $data->type === 'Article' ? 'selected' : '' }}>Article</option>
                                                        <option value="Culinary" {{ $data->type === 'Culinary' ? 'selected' : '' }}>Culinary</option>
                                                        <option value="Inspiration" {{ $data->type === 'Inspiration' ? 'selected' : '' }}>Inspiration</option>
                                                        <option value="Lifestyle" {{ $data->type === 'Lifestyle' ? 'selected' : '' }}>Lifestyle</option>
                                                        <option value="Places" {{ $data->type === 'Places' ? 'selected' : '' }}>Places</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 p-0">
                                            <div class="form-group row">
                                                <label class="col-md-3 pl1-2 pr1-2 label-control required">Show</label>
                                                <div class="col-md-9 pl1-2 pr1-2 mx-auto">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="show" value="1" id="activeShow" {{ $data->show == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="activeShow">
                                                            Active / Publish
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="show" value="0" id="nonActiveShow" {{ $data->show == 0 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="nonActiveShow">
                                                            Non Active / Draft
                                                        </label>
                                                    </div>
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
