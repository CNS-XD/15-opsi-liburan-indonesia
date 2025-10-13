@extends('layouts.backsite')
@section('title', 'Form Edit Profil')

@section('content')
<div class="content-header row">
    <div class="content-header-light col-12">
        <div class="row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h3 class="content-header-title">Form Edit Profil</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard') }}">Profil</a>
                            </li>
                            <li class="breadcrumb-item active">Form Edit Profil
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
        <!-- account setting page start -->
        <section id="page-account-settings">
            <div class="row">
                <!-- left menu section -->
                <div class="col-md-3 mb-2 mb-md-0">
                    <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                        <li class="nav-item">
                            <a class="nav-link d-flex active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                <i class="ft-globe mr-50"></i>
                                General
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                <i class="ft-lock mr-50"></i>
                                Change Password
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex" id="account-pill-info" data-toggle="pill" href="#account-vertical-info" aria-expanded="false">
                                <i class="ft-info mr-50"></i>
                                Info
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex" id="account-pill-social" data-toggle="pill" href="#account-vertical-social" aria-expanded="false">
                                <i class="ft-camera mr-50"></i>
                                Social links
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex" id="account-pill-connections" data-toggle="pill" href="#account-vertical-connections" aria-expanded="false">
                                <i class="ft-feather mr-50"></i>
                                Connections
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex" id="account-pill-notifications" data-toggle="pill" href="#account-vertical-notifications" aria-expanded="false">
                                <i class="ft-message-square mr-50"></i>
                                Notifications
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- right content section -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                        @if(session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                        @endif
                                        <form action="{{ route('form.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-username">Nama Lengkap</label>
                                                            <input type="text" name="nama_lengkap" class="form-control"  id="account-username" 
                                                            placeholder="Username" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required data-validation-required-message="This username field is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-e-mail">E-mail</label>
                                                            <input type="email" name="email" class="form-control" id="account-e-mail" 
                                                            placeholder="Email" value="{{ old('email', $user->email) }}" required data-validation-required-message="This email field is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        <p class="mb-0">
                                                            Your email is not confirmed. Please check your inbox.
                                                        </p>
                                                        <a href="javascript: void(0);">Resend confirmation</a>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                        changes</button>
                                                    <button type="reset" class="btn btn-light">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                        <form novalidate>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-old-password">Old Password</label>
                                                            <input type="password" class="form-control" id="account-old-password" required placeholder="Old Password" data-validation-required-message="This old password field is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-new-password">New Password</label>
                                                            <input type="password" name="password" id="account-new-password" class="form-control" placeholder="New Password" required data-validation-required-message="The password field is required" minlength="6">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-retype-new-password">Retype New
                                                                Password</label>
                                                            <input type="password" name="con-password" class="form-control" required id="account-retype-new-password" data-validation-match-match="password" placeholder="New Password" data-validation-required-message="The Confirm password field is required" minlength="6">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                        changes</button>
                                                    <button type="reset" class="btn btn-light">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                        <form novalidate>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="account-website">Tempat Lahir</label>
                                                        <input type="text" name="tempat_lahir" class="form-control" id="account-website" 
                                                        placeholder="Masukkan tempat lahir" value="{{ old('tempat_lahir', $user->tempat_lahir) }}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-birth-date">Tanggal Lahir</label>
                                                            <input type="date" name="tanggal_lahir" class="form-control birthdate-picker" 
                                                            required placeholder="Birth date" id="account-birth-date" 
                                                            data-validation-required-message="This birthdate field is required" value="{{ old('tgl_lahir', $user->tgl_lahir) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-phone">Nomer HP</label>
                                                            <input type="number" name="no_hp" class="form-control" id="account-phone" 
                                                            required placeholder="Masukkan Nomer HP" value="{{ old('no_hp', $user->no_hp) }}" 
                                                            data-validation-required-message="This phone number field is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="accountTextarea">Alamat</label>
                                                        <textarea class="form-control" name="alamat" id="accountTextarea" rows="3" 
                                                        placeholder="Masukkan Alamat Disini..." value="{{ old('alamat', $user->alamat) }}"></textarea>

                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="accountSelect">Negara</label>
                                                        <select class="form-control" name="negara" id="accountSelect">
                                                            <option value="">Pilih Negara</option>
                                                            <option value="Australia" {{ old('negara', $user->negara) == 'Australia' ? 'selected' : '' }}>Australia</option>
                                                            <option value="Brunei Darussalam" {{ old('negara', $user->negara) == 'Brunei Darussalam' ? 'selected' : '' }}>Brunei Darussalam</option>
                                                            <option value="China" {{ old('negara', $user->negara) == 'China' ? 'selected' : '' }}>China</option>
                                                            <option value="Canada" {{ old('negara', $user->negara) == 'Canada' ? 'selected' : '' }}>Canada</option>
                                                            <option value="Denmark" {{ old('negara', $user->negara) == 'Denmark' ? 'selected' : '' }}>Denmark</option>
                                                            <option value="Indonesia" {{ old('negara', $user->negara) == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                                            <option value="Malaysia" {{ old('negara', $user->negara) == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                                            <option value="Singapura" {{ old('negara', $user->negara) == 'Singapura' ? 'selected' : '' }}>Singapura</option>
                                                            <option value="Timor Leste" {{ old('negara', $user->negara) == 'Timor Leste' ? 'selected' : '' }}>Timor Leste</option>
                                                        </select>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-phone">Profesi</label>
                                                            <input type="text" name="profesi" class="form-control" id="account-phone"
                                                            required placeholder="Masukkan profesi"  data-validation-required-message="This phone number field is required" 
                                                            value="{{ old('profesi', $user->profesi) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="accountTextarea">Tentang</label>
                                                        <textarea class="form-control" name="tentang" id="accountTextarea" rows="3" 
                                                        placeholder="Masukkan tentang kamu disini... " value="{{ old('tentang', $user->tentang) }}">
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="accountTextarea">Quotes</label>
                                                        <textarea class="form-control" name="quote" id="accountTextarea" rows="3" placeholder="Masukkan quotes terbaik kamu disini...">{{ old('quote', $user->quote) }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-phone">Foto Profil</label>
                                                            <input type="file" name="foto_profil" class="form-control" id="foto_profil" required placeholder="Masukkan foto profil" 
                                                            data-validation-required-message="This foto profil field is required" value="{{ old('foto_profil', $user->foto_profil) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-phone">Foto Sampul</label>
                                                            <input type="file" name="foto_sampul" class="form-control" id="foto_sampul" required placeholder=""  data-validation-required-message="This foto profil field is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                        changes</button>
                                                    <button type="reset" class="btn btn-light">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade " id="account-vertical-social" role="tabpanel" aria-labelledby="account-pill-social" aria-expanded="false">
                                        <form>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="account-twitter">Twitter</label>
                                                        <input type="text" id="account-twitter" class="form-control" placeholder="Add link" value="https://www.twitter.com">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="account-facebook">Facebook</label>
                                                        <input type="text" id="account-facebook" class="form-control" placeholder="Add link">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="account-google">Google+</label>
                                                        <input type="text" id="account-google" class="form-control" placeholder="Add link">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="account-linkedin">LinkedIn</label>
                                                        <input type="text" id="account-linkedin" class="form-control" placeholder="Add link" value="https://www.linkedin.com">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="account-instagram">Instagram</label>
                                                        <input type="text" id="account-instagram" class="form-control" placeholder="Add link">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="account-quora">Quora</label>
                                                        <input type="text" id="account-quora" class="form-control" placeholder="Add link">
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                        changes</button>
                                                    <button type="reset" class="btn btn-light">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="account-vertical-connections" role="tabpanel" aria-labelledby="account-pill-connections" aria-expanded="false">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <a href="javascript: void(0);" class="btn btn-info">Connect to
                                                    <strong>Twitter</strong></a>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <button class=" btn btn-sm btn-secondary float-right">edit</button>
                                                <h6>You are connected to facebook.</h6>
                                                <span>Johndoe@gmail.com</span>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <a href="javascript: void(0);" class="btn btn-danger">Connect to
                                                    <strong>Google</strong>
                                                </a>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <button class=" btn btn-sm btn-secondary float-right">edit</button>
                                                <h6>You are connected to Instagram.</h6>
                                                <span>Johndoe@gmail.com</span>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                    changes</button>
                                                <button type="reset" class="btn btn-light">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="account-vertical-notifications" role="tabpanel" aria-labelledby="account-pill-notifications" aria-expanded="false">
                                        <div class="row">
                                            <h6 class="ml-1 mb-2">Activity</h6>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="checkbox" class="switchery" data-size="sm" checked id="accountSwitch1">
                                                    <label class="ml-50" for="accountSwitch1">Email me when someone comments
                                                        onmy
                                                        article</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="checkbox" class="switchery" data-size="sm" checked id="accountSwitch2">
                                                    <label for="accountSwitch2" class="ml-50">Email me when someone answers on
                                                        my
                                                        form</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="checkbox" class="switchery" data-size="sm" id="accountSwitch3">
                                                    <label for="accountSwitch3" class="ml-50">Email me hen someone follows
                                                        me</label>
                                                </div>
                                            </div>
                                            <h6 class="ml-1 my-2">Application</h6>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="checkbox" class="switchery" data-size="sm" checked id="accountSwitch4">
                                                    <label for="accountSwitch4" class="ml-50">News and announcements</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="checkbox" class="switchery" data-size="sm" id="accountSwitch5">
                                                    <label for="accountSwitch5" class="ml-50">Weekly product updates</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="checkbox" class="switchery" data-size="sm" checked id="accountSwitch6">
                                                    <label for="accountSwitch6" class="ml-50">Weekly blog digest</label>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                    changes</button>
                                                <button type="reset" class="btn btn-light">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- account setting page end -->
    </div>
</div>
@endsection