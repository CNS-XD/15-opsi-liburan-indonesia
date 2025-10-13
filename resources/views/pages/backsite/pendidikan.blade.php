@extends('layouts.backsite')

@section('title', 'Education')

@section('activePendidikan', 'active')

@section('content')
<div class="content-header row">
    <div class="content-header-light col-12">
        <div class="row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h3 class="content-header-title">Pendidikan</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard') }}">Profil</a>
                            </li>
                            <li class="breadcrumb-item active">Pendidikan
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-3 col-12">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                    <button class="btn btn-primary round dropdown-toggle dropdown-menu-right box-shadow-2 px-2 mb-1" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu"><a class="dropdown-item" href="component-alerts.html"> Alerts</a><a class="dropdown-item" href="material-component-cards.html"> Cards</a><a class="dropdown-item" href="component-progress.html"> Progress</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item" href="register-with-bg-image.html"> Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="content-body">
        <section id="knowledge-search">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-primary text-center white">
                        <div class="card-header mt-3 mb-0">
                            <h1 class="white my-0">
                                Have a Question?
                            </h1>
                        </div>
                        <div class="card-body p-0 mb-2">
                            <p class="card-text my-0">
                                If you have any question, enter what you are looking for!
                            </p>
                            <form class="form-group mx-5 my-3">
                                <input class="form-control" placeholder="Type your search items here" type="text">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="media">
                                    <div class="media-left align-self-center">
                                        <i class="fa ft-edit font-large-2 danger float-left">
                                        </i>
                                    </div>
                                    <div class="media-body text-center">
                                        <h3 class="mb-1 text-bold-700">
                                            Our Blog
                                        </h3>
                                        <span class="text-muted">
                                            53 Articles
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="media">
                                    <div class="media-left align-self-center">
                                        <i class="fa ft-message-circle font-large-2 danger float-left">
                                        </i>
                                    </div>
                                    <div class="media-body text-center">
                                        <h3 class="mb-1 text-bold-700">
                                            Forum
                                        </h3>
                                        <span class="text-muted">
                                            18 Topics
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="media">
                                    <div class="media-left align-self-center">
                                        <i class="fa ft-crosshair font-large-2 danger float-left">
                                        </i>
                                    </div>
                                    <div class="media-body text-center">
                                        <h3 class="mb-1 text-bold-700">
                                            Innovation
                                        </h3>
                                        <span class="text-muted">
                                            43 ideas
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="media">
                                    <div class="media-left align-self-center">
                                        <i class="fa ft-life-buoy font-large-2 danger float-left">
                                        </i>
                                    </div>
                                    <div class="media-body text-center">
                                        <h3 class="mb-1 text-bold-700">
                                            Support
                                        </h3>
                                        <span class="text-muted">
                                            28 Posts
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h3 class="text-bold-700">
                                            Featured Articles
                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                Activating an Account
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                User Profile
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                Using the Dashboard
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                Subscribing to Email Alerts
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                Changing a Password
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                Inviting and Managing Users
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                Creating and Managing Groups
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                Creating and Managing Groups
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                Granting Roles
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                Organizing Security Groups
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                if a User is Unable to Login
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <a class="card-link info">
                                        See all articles (50)
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h3 class="text-bold-700">
                                            Latest Articles
                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                Files Overview
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                Search Overview
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                Using Tasks
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                Events
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                Blogs
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                Basic Files Module Features
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                How to Add a Single File
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                Drag-and-Drop upload files
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                Searching Files
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa ft-chevron-right">
                                            </i>
                                            <p class="text-muted display-inline">
                                                Digital Rights Management
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <a class="card-link info">
                                        See all articles (73)
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card bg-warning">
                                <div class="card-content white text-center">
                                    <div class="card-header">
                                        <i class="fa ft-play-circle float-left font-large-1 text-bold-700 white">
                                        </i>
                                        <h1 class="card-title font-large-1 white">
                                            Support
                                        </h1>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            Contact our support team for
                                        </p>
                                        <h2 class="white">
                                            24x7
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12 col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h3 class="text-bold-700">
                                            Quick Links
                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                Our Blogs
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Plugins
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Ideas
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Wordpress
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Admin
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Themes
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Documentation
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Support
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12 col-sm-6">
                            <div class="card">
                                <div class="card-header pb-2">
                                    <div class="card-title">
                                        <h1 class="text-bold-700">
                                            Tags
                                        </h1>
                                    </div>
                                </div>
                                <div class="card-body pt-0 kw-wrapper">
                                    <span class="badge badge-secondary">
                                        admin
                                    </span>
                                    <span class="badge badge-secondary">
                                        admin dashboard
                                    </span>
                                    <span class="badge badge-secondary">
                                        admin
                                    </span>
                                    <span class="badge badge-secondary">
                                        admin theme
                                    </span>
                                    <span class="badge badge-secondary">
                                        bitcoin
                                    </span>
                                    <span class="badge badge-secondary">
                                        bootstrap
                                    </span>
                                    <span class="badge badge-secondary">
                                        bootstrap 4
                                    </span>
                                    <span class="badge badge-secondary">
                                        bootstrap admin
                                    </span>
                                    <span class="badge badge-secondary">
                                        bootstrap template
                                    </span>
                                    <span class="badge badge-secondary">
                                        bootstrap dashboard
                                    </span>
                                    <span class="badge badge-secondary">
                                        crypto cards
                                    </span>
                                    <span class="badge badge-secondary">
                                        crypto dashboard
                                    </span>
                                    <span class="badge badge-secondary">
                                        dashboard template
                                    </span>
                                    <span class="badge badge-secondary">
                                        responsive
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>

@endsection