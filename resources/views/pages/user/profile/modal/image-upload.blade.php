<div id="upload-image" class="modal fade" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>CHANGE PROFILE PICTURE</strong></h4>
                <button type="button" class="close" data-dismiss="modal" style="outline: none;">×</button>
            </div>
            <form class="m-form m-form--fit m-form--label-align-right" action="{{ route('user.profile.update-image') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group m-form__group row">
                    <div class="col-10 ml-auto"></div>
                </div>
                <div class="image-showing-box">
                    <div>
                        <div class="col-12">
                            <input type="file" class="drag_drop" id="profile_image_input_data" autofocus required="required" accept="image/png, image/jpeg, image/jpg, image/svg">
                        </div>
                        <input type="hidden" class="d-none" id="profile_image_input"  name="profile_image" autofocus>
                        <p class="drag_drop_p" id="upload-profilepic-placeholder" ></p>
                        <div class="row d-none" id="upload-profile-pic-container">
                            <div class="col-md-12 text-center">
                                <span  style="width:460px;float: left">Double click to change image</span>
                                <div id="upload-profile-pic">
                                </div>
                                <div style="width:460px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="uploadButton">
                        Save changes
                    </button>
                    &nbsp;&nbsp;
                    <button type="button" class="btn btn-secondary m-btn m-btn--air m-btn--custom" data-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
