@extends('layouts.backsite')
@section('title', 'Profil')
@section('activeProfil', 'active')

@section('content')
<div class="content-header row">
    <div class="content-header-light col-12">
        <div class="row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h3 class="content-header-title">Profil</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="content-body">
        <!-- User Feed -->
        <section id="user-feed">

            <!-- Left Side Content -->
            <div class="row">
                <div class="col-12">
                    <img src="{{ asset('backsite-assets/app-assets/images/24.jpg') }}" class="img-fluid rounded" alt="timeline image">
                    <div class="user-data text-center bg-white rounded pb-2 mb-md-2">
                        <img src="{{ asset('frontsite-assets/images/rafi/7.jpg') }}" class="img-fluid rounded-circle width-150 profile-image shadow-lg border border-3" alt="timeline image">
                        <h4 class="mt-1 mb-0">Rafi Yahya</h4>
                        <p class="m-0">Mojokerto, Jawa Timur</p>
                    </div>
                </div>
            </div>
            <!-- Profile Intro -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card shadow-none">
                        <div class="card-body">
                            <h5 class="card-title">Profile Intro</h5>
                            <hr>
                            <div class="about-me mt-2">
                                <h5 class="card-title mb-1">About Me</h5>
                                <p class="font-small-3">Hi, I’m Rafi Yahya Ardiansyahh, I’m 17 & I work as a Web developer.</p>
                            </div>
                            <div class="favourite-show mt-2">
                                <h5 class="card-title mb-1">Favourite TV Shows</h5>
                                <p class="font-small-3">Breaking Good, RedDevil, People of Interest, The Running Dead, Found,
                                    American Guy.</p>
                            </div>
                            <div class="favourite-band mt-2">
                                <h5 class="card-title mb-1">Favourite Music Bands</h5>
                                <p class="font-small-3">NDX A.K.A, Bloc Party, People of Interest, The Running Dead,
                                    Found, American Guy.</p>
                            </div>
                            <div class="favourite-food mt-2">
                                <h5 class="card-title mb-1">Favourite Food</h5>
                                <p class="font-small-3">Pizza, burger, Guacamole, Tomato Salsa, Enchiladas, Guilt-Free Chilli</p>
                            </div>
                        </div>
                    </div>
                    <!-- My Spotify Playlist -->
                    <div class="card shadow-none mt-2">
                        <div class="card-body">
                            <div class="spotify-playlist">
                                <h5 class="card-title mb-1">My Spotify Playlist</h5>
                                <a href="https://youtu.be/F-DNqANxm60?si=n9zlDTtrN2NaC0_w">
                                    <div class="row mt-2">
                                        <div class="col-3 my-auto">
                                            <img src="{{ asset('backsite-assets/app-assets/images/gallery/1.jpg') }}" alt="" class="img-fluid width-30">
                                        </div>
                                            <div class="col-6 font-small-3 pl-0">
                                                <h5 class="m-0">Lintang Ati</h5>
                                                <p class="m-0">Happy Asmara</p>
                                            </div>
                                        <div class="col-3 p-0">
                                            <p>4:36</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="https://youtu.be/AGV7PzOibHE?si=U7yi8MuPolyTHKoT">
                                    <div class="row mt-2">
                                        <div class="col-3 my-auto">
                                            <img src="{{ asset('backsite-assets/app-assets/images/gallery/2.jpg') }}" alt="" class="img-fluid width-30">
                                        </div>
                                            <div class="col-6 font-small-3 pl-0">
                                                <h5 class="m-0">Diary Depresiku</h5>
                                                <p class="m-0">Last Child</p>
                                            </div>
                                        <div class="col-3 p-0">
                                            <p>4:44</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="https://youtu.be/Ez0qU1qv9Lg?si=NM3oDpFvucnlSCM-">
                                    <div class="row mt-2">
                                        <div class="col-3 my-auto">
                                            <img src="{{ asset('backsite-assets/app-assets/images/gallery/3.jpg') }}" alt="" class="img-fluid width-30">
                                        </div>
                                            <div class="col-6 font-small-3 pl-0">
                                                <h5 class="m-0">Duka</h5>
                                                <p class="m-0">Last Child</p>
                                            </div>
                                        <div class="col-3 p-0">
                                            <p>5:21</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="https://youtu.be/yg3EXDKvUAw?si=J97Qae3GSnRoPO4B">
                                    <div class="row mt-2">
                                        <div class="col-3 my-auto">
                                            <img src="{{ asset('backsite-assets/app-assets/images/gallery/4.jpg') }}" alt="" class="img-fluid width-30">
                                        </div>
                                            <div class="col-6 font-small-3 pl-0">
                                                <h5 class="m-0">My Heart</h5>
                                                <p class="m-0">Acha Septriasa </p>
                                            </div>
                                        <div class="col-3 p-0">
                                            <p>4:19</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="https://youtu.be/_3vLirCixCw?si=vUyWJOeZq83fY9u2">
                                    <div class="row mt-2">
                                        <div class="col-3 my-auto">
                                            <img src="{{ asset('backsite-assets/app-assets/images/gallery/5.jpg') }}" alt="" class="img-fluid width-30">
                                        </div>
                                        <div class="col-6 font-small-3 pl-0">
                                            <h5 class="m-0">Tresno Tekan Mati</h5>
                                            <p class="m-0">NDX A.K.A.</p>
                                        </div>
                                        <div class="col-3 p-0">
                                            <p>4:31</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="https://youtu.be/CSbqueGNj3A?si=f7FGNRcdbpt77qN4">
                                    <div class="row mt-2">
                                        <div class="col-3 my-auto">
                                            <img src="{{ asset('backsite-assets/app-assets/images/gallery/6.jpg') }}" alt="" class="img-fluid width-30">
                                        </div>
                                        <div class="col-6 font-small-3 pl-0">
                                            <h5 class="m-0">Sekuat hatimu</h5>
                                            <p class="m-0">Last Child</p>
                                        </div>
                                        <div class="col-3 p-0">
                                            <p>4:27</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Twitter Feed -->
                    <div class="card shadow-none mt-2">
                        <div class="card-body">
                            <div class="twitter-feed">
                                <h5 class="card-title mb-1">Twitter Feed</h5>
                                <hr>
                                <div class="row mt-3">
                                    <div class="col-3">
                                        <img src="{{ asset('backsite-assets/') }}app-assets/images/icons/twitter-avatar1.png" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-9 font-small-3 pl-0">
                                        <p class="m-0">I just submitted this instagram Redesign concept</p>
                                        <p class="m-0">@james_spiegelOK</p>
                                    </div>
                                    <div class="col-12 font-small-3 mt-1">
                                        <p class="primary m-0">#Dowboy #profile</p>
                                        <p>2 hours ago</p>
                                    </div>
                                </div>
                                <hr class="m-0">
                                <div class="row mt-3">
                                    <div class="col-3">
                                        <img src="{{ asset('backsite-assets/') }}app-assets/images/icons/twitter-avatar1.png" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-9 font-small-3 pl-0">
                                        <p class="m-0">I just submitted this instagram Redesign concept</p>
                                        <p class="m-0">@james_spiegelOK</p>
                                    </div>
                                    <div class="col-12 font-small-3 mt-1">
                                        <p class="primary m-0">#Dowboy #profile</p>
                                        <p>2 hours ago</p>
                                    </div>
                                </div>
                                <hr class="m-0">
                                <div class="row mt-3">
                                    <div class="col-3">
                                        <img src="{{ asset('backsite-assets/') }}app-assets/images/icons/twitter-avatar1.png" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-9 font-small-3 pl-0">
                                        <p class="m-0">I just submitted this instagram Redesign concept</p>
                                        <p class="m-0">@james_spiegelOK</p>
                                    </div>
                                    <div class="col-12 font-small-3 mt-1">
                                        <p class="primary m-0">#Dowboy #profile</p>
                                        <p>2 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Feed Section -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <!-- Write Post -->
                    <div class="card shadow-none">
                        <div class="catd-body">
                            <div class="feed-tabs">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link px-1 py-1 px-sm-1 active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="ft-activity mr-50"></i>
                                            Status</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-1 py-1 px-sm-1" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="ft-camera mr-50"></i>
                                            Multimedia</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-1 py-1" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><i class="ft-edit-2 mr-50"></i>
                                            Blog Post</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"></div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"></div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"></div>
                                </div>
                            </div>
                            <div class="write-post">
                                <div class="form-group">
                                    <textarea placeholder="Share what you are thinking here..." class="form-control border-0" id="exampleFormControlTextarea1" rows="5"></textarea>
                                </div>
                                <hr class="m-0">
                                <div class="row px-1">
                                    <div class="col-6 pt-2">
                                        <i class="ft-image ml-1 mr-2 mr-sm-0 h3"></i> <i class="ft-monitor mr-2 mr-sm-0 h3"></i>
                                        <i class="ft-map-pin h3"></i>
                                    </div>
                                    <div class="col-6 pt-1">
                                        <button type="button" class="btn btn-primary btn-min-width btn-glow mr-1 mb-1 pull-right">Post
                                            Status</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Post 1 -->
                    <div class="card shadow-none">
                        <div class="catd-body">
                            <div class="row p-2">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-lg-4 col-3">
                                            <img src="{{ asset('backsite-assets/') }}app-assets/images/portrait/small/avatar-s-8.png" alt="" class="img-fluid rounded-circle width-50">
                                        </div>
                                        <div class="col-lg-8 col-7 p-0">
                                            <h5 class="m-0">Elaine Dreyfuss</h5>
                                            <p>2 hours ago</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <i class="ft-more-vertical pull-right"></i>
                                </div>
                            </div>
                            <div class="write-post">
                                <div class="col-sm-12 px-2">
                                    <p>When searching for videos of a different singer, Scooter Braun, a former marketing
                                        executive of So So Def Recordings, clicked on one of Bieber's 2007 videos by</p>
                                </div>
                                <hr class="m-0">
                                <div class="row p-1">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-4 pr-0">
                                                <span><i class="ft-heart h4 align-middle danger"></i> 120</span>
                                            </div>
                                            <div class="col-8 pl-0">
                                                <ul class="list-unstyled users-list m-0">
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="John Doe" class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="{{ asset('backsite-assets/') }}app-assets/images/portrait/small/avatar-s-19.png" alt="Avatar">
                                                    </li>
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Katherine Nichols" class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="{{ asset('backsite-assets/') }}app-assets/images/portrait/small/avatar-s-18.png" alt="Avatar">
                                                    </li>
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Joseph Weaver" class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="{{ asset('backsite-assets/') }}app-assets/images/portrait/small/avatar-s-17.png" alt="Avatar">
                                                    </li>
                                                    <li class="avatar avatar-sm">
                                                        <span class="badge badge-info">+4 more</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="pull-right">
                                            <span class="pr-1"><i class="ft-message-square h4 align-middle"></i> 44</span>
                                            <span class="pr-1"><i class="ft-corner-up-right h4 align-middle"></i> 23</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- User Post 2 -->
                    <div class="card shadow-none">
                        <div class="catd-body">
                            <div class="row p-2">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-lg-4 col-3">
                                            <img src="{{ asset('backsite-assets/') }}app-assets/images/portrait/small/avatar-s-9.png" alt="" class="img-fluid rounded-circle width-50">
                                        </div>
                                        <div class="col-lg-8 col-7 p-0">
                                            <h5 class="m-0">Elaine Dreyfuss</h5>
                                            <p>4 hours ago</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <i class="ft-more-vertical pull-right"></i>
                                </div>
                            </div>
                            <div class="write-post">
                                <div class="col-sm-12 px-2">
                                    <p>When searching for videos of a different singer, Scooter Braun, a former marketing
                                        executive of So So Def Recordings, clicked on one of Bieber's 2007 videos by</p>
                                </div>
                                <hr class="m-0">
                                <div class="row p-1">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-sm-4 col-3 pr-0">
                                                <span><i class="ft-heart h4 align-middle danger"></i> 120</span>
                                            </div>
                                            <div class="col-sm-8 col-7 pl-0">
                                                <ul class="list-unstyled users-list m-0">
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="John Doe" class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="{{ asset('backsite-assets/') }}app-assets/images/portrait/small/avatar-s-19.png" alt="Avatar">
                                                    </li>
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Katherine Nichols" class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="{{ asset('backsite-assets/') }}app-assets/images/portrait/small/avatar-s-18.png" alt="Avatar">
                                                    </li>
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Joseph Weaver" class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="{{ asset('backsite-assets/') }}app-assets/images/portrait/small/avatar-s-17.png" alt="Avatar">
                                                    </li>
                                                    <li class="avatar avatar-sm">
                                                        <span class="badge badge-info">+4 more</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="pull-right">
                                            <span class="pr-1"><i class="ft-message-square h4 align-middle"></i> 44</span>
                                            <span class="pr-1"><i class="ft-corner-up-right h4 align-middle"></i> 23</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- User Post 3 -->
                    <div class="card shadow-none">
                        <div class="catd-body">
                            <div class="row p-2">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-lg-4 col-3">
                                            <img src="{{ asset('backsite-assets/') }}app-assets/images/portrait/small/avatar-s-8.png" alt="" class="img-fluid rounded-circle width-50">
                                        </div>
                                        <div class="col-lg-8 col-7 p-0">
                                            <h5 class="m-0">Elaine Dreyfuss</h5>
                                            <p>2 hours ago</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <i class="ft-more-vertical pull-right"></i>
                                </div>
                            </div>
                            <div class="write-post">
                                <div class="col-sm-12 px-2 pb-2">
                                    <img src="{{ asset('backsite-assets/') }}app-assets/images/gallery/party-flyer.jpg" alt="" class="img-fluid">
                                </div>
                                <hr class="m-0">
                                <div class="row p-1">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-lg-4 col-3 pr-0">
                                                <span><i class="ft-heart h4 align-middle danger"></i> 120</span>
                                            </div>
                                            <div class="col-lg-8 col-7 pl-0">
                                                <ul class="list-unstyled users-list m-0">
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="John Doe" class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="{{ asset('backsite-assets/') }}app-assets/images/portrait/small/avatar-s-19.png" alt="Avatar">
                                                    </li>
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Katherine Nichols" class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="{{ asset('backsite-assets/') }}app-assets/images/portrait/small/avatar-s-18.png" alt="Avatar">
                                                    </li>
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Joseph Weaver" class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle" src="{{ asset('backsite-assets/') }}app-assets/images/portrait/small/avatar-s-17.png" alt="Avatar">
                                                    </li>
                                                    <li class="avatar avatar-sm">
                                                        <span class="badge badge-info">+4 more</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="pull-right">
                                            <span class="pr-1"><i class="ft-message-square h4 align-middle"></i> 44</span>
                                            <span class="pr-1"><i class="ft-corner-up-right h4 align-middle"></i> 23</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Birthday Card -->
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <i class="ft-award white float-right font-medium-5"></i>
                            <img src="{{ asset('backsite-assets/') }}app-assets/images/portrait/small/avatar-s-4.png" alt="" class="img-fluid rounded-circle width-50 mb-50">
                            <p class="mb-25">Today is</p>
                            <h3 class="white">Marina Valentine’s Birthday!</h3>
                            <p class="card-text">Some quick example text to build on the card.</p>
                        </div>
                    </div>
                    <!-- Last Photos -->
                    <div class="card shadow-none mt-2">
                        <div class="card-body">
                            <div class="last-photos">
                                <h5 class="card-title mb-1">Last Photos</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-4">
                                        <img src="{{ asset('backsite-assets/') }}app-assets/images/backgrounds/bg-1.jpg" alt="" class="img-fluid mb-2 rounded">
                                    </div>
                                    <div class="col-4">
                                        <img src="{{ asset('backsite-assets/') }}app-assets/images/backgrounds/bg-2.jpg" alt="" class="img-fluid mb-2 rounded">
                                    </div>
                                    <div class="col-4">
                                        <img src="{{ asset('backsite-assets/') }}app-assets/images/backgrounds/bg-3.jpg" alt="" class="img-fluid mb-2 rounded">
                                    </div>
                                    <div class="col-4">
                                        <img src="{{ asset('backsite-assets/') }}app-assets/images/backgrounds/bg-4.jpg" alt="" class="img-fluid mb-2 rounded">
                                    </div>
                                    <div class="col-4">
                                        <img src="{{ asset('backsite-assets/') }}app-assets/images/backgrounds/bg-5.jpg" alt="" class="img-fluid mb-2 rounded">
                                    </div>
                                    <div class="col-4">
                                        <img src="{{ asset('backsite-assets/') }}app-assets/images/backgrounds/bg-6.jpg" alt="" class="img-fluid mb-2 rounded">
                                    </div>
                                    <div class="col-4">
                                        <img src="{{ asset('backsite-assets/') }}app-assets/images/backgrounds/bg-7.jpg" alt="" class="img-fluid mb-2 rounded">
                                    </div>
                                    <div class="col-4">
                                        <img src="{{ asset('backsite-assets/') }}app-assets/images/backgrounds/bg-8.jpg" alt="" class="img-fluid mb-2 rounded">
                                    </div>
                                    <div class="col-4">
                                        <img src="{{ asset('backsite-assets/') }}app-assets/images/backgrounds/bg-9.jpg" alt="" class="img-fluid mb-2 rounded">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Last Blog -->
                    <div class="card shadow-none mt-2">
                        <div class="card-body">
                            <div class="last-blog">
                                <h5 class="card-title mb-1">Last Blog</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4>The emergence and growth of blogs</h4>
                                        <p class="mt-1">Many blogs provide commentary on a particular subject or topic digital
                                            images.</p>
                                        <p class="mt-3">5 hours ago</p>
                                        <hr>
                                    </div>
                                    <div class="col-sm-12">
                                        <h4>On 16 February 2011</h4>
                                        <p class="mt-1">Many blogs provide commentary on a particular subject or topic digital
                                            images.</p>
                                        <p class="mt-3">10 hours ago</p>
                                        <hr>
                                    </div>
                                    <div class="col-sm-12">
                                        <h4>With posts written by large numbers</h4>
                                        <p class="mt-1">Many blogs provide commentary on a particular subject or topic digital
                                            images.</p>
                                        <p class="mt-3">23 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Last Video -->
                    <div class="card shadow-none mt-2">
                        <div class="card-body">
                            <div class="last-video">
                                <h5 class="card-title mb-1">Last Video</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe src="https://www.youtube.com/embed/fRh_vgS2dFE" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                        </div>
                                        <hr>
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe width="1280" height="720" src="https://www.youtube.com/embed/cBVGlBWQzuc" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ User Feed -->
    </div>
</div>
@endsection