@extends('layouts.backsite')

{{-- Title dan Active Menu --}}
@section('title', 'Edit Theme')
@section('activeMenuTheme', 'open active')

{{-- Breadcrumb --}}
@section('breadcrumb1', 'Theme')
@section('breadcrumb2', 'Edit')

{{-- Button Pojok Kanan --}}
@section('buttonRight')
<a href="{{ route('backsite.theme.index') }}" class="btn btn-danger btn-glow round">
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
                                action="{{ route('backsite.theme.update', $data->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12 p-0">
                                            <div class="form-group row">
                                                <label class="col-md-3 pl1-2 pr1-2 label-control">Color</label>
                                                <div class="col-md-7 pl1-2 pr1-2 mx-auto">
                                                    <select name="color1" required class="select2"
                                                        id="select-color">
                                                        <option value="">Choose Color</option>
                                                        <option value="#EB118B"
                                                            {{ $data->color_1 == '#EB118B' ? 'selected' : '' }}>
                                                            Primary
                                                        </option>
                                                        <option value="#008FD3"
                                                            {{ $data->color_1 == '#008FD3' ? 'selected' : '' }}>
                                                            Blue 1
                                                        </option>
                                                        <option value="#191970"
                                                            {{ $data->color_1 == '#191970' ? 'selected' : '' }}>
                                                            Blue 2
                                                        </option>
                                                        <option value="#2F86A6"
                                                            {{ $data->color_1 == '#2F86A6' ? 'selected' : '' }}>
                                                            Blue 3
                                                        </option>
                                                        <option value="#5463FF"
                                                            {{ $data->color_1 == '#5463FF' ? 'selected' : '' }}>
                                                            Blue 4
                                                        </option>
                                                        <option value="#5C8301"
                                                            {{ $data->color_1 == '#5C8301' ? 'selected' : '' }}>
                                                            Green 1
                                                        </option>
                                                        <option value="#20B2AA"
                                                            {{ $data->color_1 == '#20B2AA' ? 'selected' : '' }}>
                                                            Green 2
                                                        </option>
                                                        <option value="#219F94"
                                                            {{ $data->color_1 == '#219F94' ? 'selected' : '' }}>
                                                            Green 3
                                                        </option>
                                                        <option value="#007d15"
                                                            {{ $data->color_1 == '#007d15' ? 'selected' : '' }}>
                                                            Green 4
                                                        </option>
                                                        <option value="#0B6623"
                                                            {{ $data->color_1 == '#0B6623' ? 'selected' : '' }}>
                                                            Green 5
                                                        </option>
                                                        <option value="#83a235"
                                                            {{ $data->color_1 == '#83a235' ? 'selected' : '' }}>
                                                            Green 6
                                                        </option>
                                                        <option value="#2F4F4F"
                                                            {{ $data->color_1 == '#2F4F4F' ? 'selected' : '' }}>
                                                            Gray 1
                                                        </option>
                                                        <option value="#716F81"
                                                            {{ $data->color_1 == '#716F81' ? 'selected' : '' }}>
                                                            Gray 2
                                                        </option>
                                                        <option value="#8B4513"
                                                            {{ $data->color_1 == '#8B4513' ? 'selected' : '' }}>
                                                            Brown 1
                                                        </option>
                                                        <option value="#2D2424"
                                                            {{ $data->color_1 == '#2D2424' ? 'selected' : '' }}>
                                                            Brown 2
                                                        </option>
                                                        <option value="#FF8E00"
                                                            {{ $data->color_1 == '#FF8E00' ? 'selected' : '' }}>
                                                            Orange 1
                                                        </option>
                                                        <option value="#FE7E6D"
                                                            {{ $data->color_1 == '#FE7E6D' ? 'selected' : '' }}>
                                                            Orange 2
                                                        </option>
                                                        <option value="#F14A16"
                                                            {{ $data->color_1 == '#F14A16' ? 'selected' : '' }}>
                                                            Orange 3
                                                        </option>
                                                        <option value="#3F0713"
                                                            {{ $data->color_1 == '#3F0713' ? 'selected' : '' }}>
                                                            Purple 1
                                                        </option>
                                                        <option value="#4C3F91"
                                                            {{ $data->color_1 == '#4C3F91' ? 'selected' : '' }}>
                                                            Purple 2
                                                        </option>
                                                        <option value="#DA1212"
                                                            {{ $data->color_1 == '#DA1212' ? 'selected' : '' }}>
                                                            Merah 1
                                                        </option>
                                                        <option value="#9B0000"
                                                            {{ $data->color_1 == '#9B0000' ? 'selected' : '' }}>
                                                            Merah 2
                                                        </option>
                                                        <option value="#ce0f2e"
                                                            {{ $data->color_1 == '#ce0f2e' ? 'selected' : '' }}>
                                                            Merah 3
                                                        </option>
                                                        <option value="#D4AC2B"
                                                            {{ $data->color_1 == '#D4AC2B' ? 'selected' : '' }}>
                                                            Kuning 1
                                                        </option>
                                                        <option value="#FFBD35"
                                                            {{ $data->color_1 == '#FFBD35' ? 'selected' : '' }}>
                                                            Kuning 2
                                                        </option>
                                                        <option value="#F10086"
                                                            {{ $data->color_1 == '#F10086' ? 'selected' : '' }}>
                                                            Pink 1
                                                        </option>
                                                        <option value="#C65D7B"
                                                            {{ $data->color_1 == '#C65D7B' ? 'selected' : '' }}>
                                                            Pink 2
                                                        </option>
                                                        <option value="#D885A3"
                                                            {{ $data->color_1 == '#D885A3' ? 'selected' : '' }}>
                                                            Pink 3
                                                        </option>
                                                        <option value="#533E85"
                                                            {{ $data->color_1 == '#533E85' ? 'selected' : '' }}>
                                                            Ungu 1
                                                        </option>
                                                        <option value="#3E065F"
                                                            {{ $data->color_1 == '#3E065F' ? 'selected' : '' }}>
                                                            Ungu 2
                                                        </option>
                                                        <option value="#8946A6"
                                                            {{ $data->color_1 == '#8946A6' ? 'selected' : '' }}>
                                                            Ungu 3
                                                        </option>
                                                        <option value="#864879"
                                                            {{ $data->color_1 == '#864879' ? 'selected' : '' }}>
                                                            Ungu 4
                                                        </option>
                                                        <option value="#495371"
                                                            {{ $data->color_1 == '#495371' ? 'selected' : '' }}>
                                                            Abu Abu 1
                                                        </option>
                                                        <option value="#30475E"
                                                            {{ $data->color_1 == '#30475E' ? 'selected' : '' }}>
                                                            Abu Abu 2
                                                        </option>
                                                        <option value="#787A91"
                                                            {{ $data->color_1 == '#787A91' ? 'selected' : '' }}>
                                                            Abu Abu 3
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-2" id="color-pick">
                                                    <p class="mt-2">Choose Color</p>
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
    $(document).ready(function() {
        color = $('#select-color').val()
        if (color != "") {
            $('#color-pick').html("")
            $('#color-pick').html(`<div style="background: ${color}; width:50px; height:50px"></div>`)
        } else {
            $('#color-pick').html("")
            $('#color-pick').html(`<p class="mt-2">Choose Color</p>`)
        }
    });

    // Select Color
    $('#select-color').on('change', function() {
        color = $(this).val()
        if (color != "") {
            $('#color-pick').html("")
            $('#color-pick').html(`<div style="background: ${color}; width:50px; height:50px"></div>`)
        } else {
            $('#color-pick').html("")
            $('#color-pick').html(`<p class="mt-2">Choose Color</p>`)
        }
    });
</script>
@endpush
