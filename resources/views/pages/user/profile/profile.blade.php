@push('styles')
    <style>
        .btn.btn-link.pr-edit-btn {
            position: relative;
            top: 35px;
            right: 35px;
            background: #fff;
            border-radius: 50px;
            padding: 3px 5px;
        }
    </style>
@endpush

@extends('layouts.user-dashboard')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Profile Image -->
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ UserHelper::getProfileImage(Auth::guard('user')->user()->id, Auth::guard('user')->user()->profile_image) }}"
                                     alt="User profile picture">
                                <button type="button" class="btn btn-link pr-edit-btn" title="Edit Image" data-toggle="modal" data-target="#upload-image"><i class="fa fa-edit"></i></button>
                            </div>

                            <h3 class="profile-username text-center">{{ ProfileHelper::getFullName(AuthConstants::GUARD_USER) }}</h3>
                        </div>
                    </div>
                </div>
                <!--End Profile Image -->

                <!-- Update Profile -->
                <div class="col-md-9">
                    <form class="form-horizontal" action="{{ route('user.profile.update') }}" method="POST" role="form" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a class="nav-link active" href="{{route('user.profile.index')}}">Update Profile</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{route('user.profile.change-password')}}">Change Password</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="profile">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="first_name" class="col-form-label">First Name<span class="required"> *</span></label>

                                                <input type="text" name="first_name" class="form-control" required="" id="first_name" placeholder="First Name" value="{{old('first_name', Auth::user()->first_name)}}">
                                                @error('first_name')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="last_name" class="col-form-label">Last Name</label>

                                                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" value="{{old('last_name', Auth::user()->last_name)}}">
                                                @error('last_name')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="inputEmail" class="col-form-label">Email<span class="required"> *</span></label></label>

                                                <input type="email" name="email" class="form-control" required="" id="inputEmail" placeholder="Email" value="{{old('email', Auth::user()->email)}}">
                                                @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="mobile" class="col-form-label">Mobile</label>

                                                <input type="text" name="mobile" class="form-control numeric" id="mobile" placeholder="Phone Number" value="{{old('mobile', Auth::user()->mobile)}}">
                                                @error('mobile')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!--End Update Profile -->
            </div>
        </div>
    </section>
    @include('pages.user.profile.modal.image-upload')
@endsection
@push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
    <script>
        $uploadCrop = $('#upload-profile-pic').croppie({
            enableExif: true,
            viewport: {
                width: 350,
                height:350,
                type: 'circle'
            },
            boundary: {
                width: 400,
                height: 400
            }
        });

        $uploadCrop.on('update.croppie', function(ev, cropData) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                $('#profile_image_input').val(resp);
            });
        });


        $('#upload-profile-pic').on('dblclick','.cr-boundary',function (e) {
            e.preventDefault();
            $('#profile_image_input_data').trigger('click');
        });

        $('#profile_image_input_data').on('change', function (event) {
            $('#upload-profile-pic-container').removeClass('d-none');
            $("#upload-profilepic-placeholder").addClass('d-none');
            if(this.value == '')
            {
                $('.cr-image').attr('src','');
            }
            else{
                var ext = this.value.match(/\.(.+)$/)[1];
                switch (ext) {
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'svg':
                        $('#uploadButton').attr('disabled', false);
                        break;
                    default:
                        alert('This is not an allowed file type.');
                        this.value = '';
                }
                if(this.value == '')
                {
                    $('.cr-image').attr('src','');
                }


                var reader = new FileReader();
                reader.onload = function (e) {
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    }).then(function(){
                    });
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

    </script>
@endpush
