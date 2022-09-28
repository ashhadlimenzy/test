<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Constants\FileDestinations;

use App\Http\Helpers\Doctor\DoctorHelper;
use App\Http\Helpers\Core\ImageUpload;

use App\Http\Requests\Doctor\PasswordUpdateURequest;
use App\Http\Requests\Doctor\ProfileImageUpdateRequest;
use App\Http\Requests\Doctor\ProfileUpdateRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Toastr;


class ProfileController extends BaseController
{

    /**
     * ProfileController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->addBaseView('profile');
        $this->addBaseRoute('profile');
    }

    /**
     * Show profile edit page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return $this->renderView($this->getView('profile'), [], 'Edit Profile');
    }

    /**
     * Show form to change password
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewChangePassword()
    {
        return $this->renderView($this->getView('change-password'), [], 'Change Password');
    }

    /**
     * Update profile
     *
     * @param ProfileUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $admin = Auth::user();
        $admin->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);
        Toastr::success('profile updated successfully');
        return redirect()->route($this->getRoute('index'));
    }

    /**
     * Update password
     *
     * @param PasswordUpdateURequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(PasswordUpdateURequest $request)
    {
        $user = Auth::user();
        if (Hash::check($request['current_password'],$user->password)) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            Toastr::success('Password updated  successfully');
        } else {
            Toastr::error('You entered wrong password!!');
        }
        return redirect()->back();
    }

    /**
     * Update profile image
     *
     * @param ProfileImageUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateImage(ProfileImageUpdateRequest $request)
    {
        $response = DoctorHelper::uploadBase64ProfileImage( 'profile_image', $this->getLoggedUserId());
        if ($response['status']) {
            $admin = Auth::user();
            $admin->update([
                'profile_image' => $response['data']['fileName']
            ]);
            Toastr::success('Profile image updated successfully');
        } else {
            Toastr::error('Image upload error');
        }
        return redirect()->route($this->getRoute('index'));
    }

}
