@extends('layouts.backsite')
@section('title', 'Contact')
@section('activeKontak', 'active')

@section('content')
<div class="content-header row">
    <div class="content-header-light col-12">
        <div class="row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h3 class="content-header-title">Leaflet Maps</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Maps</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Leaflet Maps</a>
                            </li>
                            <li class="breadcrumb-item active">Leaflet Maps
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="content-body">
        <!-- maps-leaflet start -->
        <section class="maps-leaflet">
            <!-- Basic map start -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Basic Map</div>
                    <div id="maps-leaflet-basic" class="maps-leaflet-container"></div>
                </div>
            </div>
            <!-- Basic map end -->
            <!-- Marker map start -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Marker, Circle & Polygon Map</div>
                    <div id="maps-leaflet-marker" class="maps-leaflet-container"></div>
                </div>
            </div>
            <!-- Marker map end -->
            <!-- Dragable Marker map start -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Draggable Marker With Popup Map</div>
                    <div id="maps-leaflet-marker-dragable" class="maps-leaflet-container"></div>
                </div>
            </div>
            <!-- Dragable Marker map end -->
            <!-- User Location map start -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">User Location Map</div>
                    <div id="maps-leaflet-user-location" class="maps-leaflet-container"></div>
                </div>
            </div>
            <!-- User Location map end -->
            <!-- Custom Icons map start -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Custom Icons Map</div>
                    <div id="maps-leaflet-custom-icons" class="maps-leaflet-container"></div>
                </div>
            </div>
            <!-- Custom Icons map end -->
            <!-- GeoJSON map start -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">GeoJSON Map</div>
                    <div id="maps-leaflet-geojson" class="maps-leaflet-container"></div>
                </div>
            </div>
            <!-- GeoJSON map end -->
            <!-- Layer Groups and Layers Control map start -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Layer Groups and Layers Control Map</div>
                    <div id="maps-leaflet-groups-control" class="maps-leaflet-container"></div>
                </div>
            </div>
            <!-- Layer Groups and Layers Control map end -->
        </section>
        <!-- maps-leaflet ends -->
    </div>
</div>
@endsection