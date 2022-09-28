<?php

namespace App\Http\Helpers\Doctor;

use App\Http\Constants\FileDestinations;
use App\Http\Constants\DoctorConstants;

use App\Http\Helpers\Core\DateHelper;
use App\Http\Helpers\Core\FileManager;
use App\Http\Helpers\Core\ImageUpload;

use App\Models\Doctor;
use App\Models\DoctorCardDetail;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DoctorHelper
{

    public static function getProfileImage($doctorId, $image = null)
    {
        $profileImageUrl = asset('images/default-user.png');
        if (! is_null($image)) {
            $destination = FileDestinations::DOCTOR . $doctorId . '/profile/';
            if (FileManager::checkFileExist($image, $destination)) {
                $profileImageUrl = FileManager::getFileUrl($image, $destination);
            }
        }
        return $profileImageUrl;
    }

    public static function uploadProfileImage($doctorId, $imageAttributeName)
    {
        $destination = FileDestinations::DOCTOR . $doctorId. '/profile/';
        return ImageUpload::upload($destination, $imageAttributeName);
    }

    public static function getCompanyLogo($doctorId, $image = null)
    {
        $companyLogoUrl = asset('images/default-user.png');
        if (! is_null($image)) {
            $destination = FileDestinations::DOCTOR . $doctorId . '/company-logo/';
            if (FileManager::checkFileExist($image, $destination)) {
                $companyLogoUrl = FileManager::getFileUrl($image, $destination);
            }
        }
        return $companyLogoUrl;
    }

    public static function uploadCompanyLogo($doctorId, $imageAttributeName)
    {
        $destination = FileDestinations::DOCTOR . $doctorId. '/company-logo/';
        return ImageUpload::upload($destination, $imageAttributeName);
    }

    public static function uploadBase64CompanyLogo($doctorId, $imageAttributeName)
    {
        $destination = FileDestinations::DOCTOR . $doctorId. '/company-logo/';
        return ImageUpload::uploadBase64($imageAttributeName,$destination);
    }

    public static function uploadBase64ProfileImage($imageAttributeName, $doctorId)
    {
        $destination = FileDestinations::DOCTOR . $doctorId. '/profile/';
        return ImageUpload::uploadBase64($imageAttributeName, $destination);
    }

    public static function uploadJobPost($imageAttributeName, $doctorId, $jobId)
    {
        $destination = FileDestinations::DOCTOR . $doctorId . '/job/' . $jobId . '/post/';
        return FileManager::multiUpload($destination, $imageAttributeName);
    }

    public static function getVerificationStatus($status = DoctorConstants::DOCTOR_VERIFICATION_PENDING)
    {
        $format = '<p>%s</p>';
        $message = '';
        switch ($status) {

            case DoctorConstants::DOCTOR_VERIFICATION_PENDING:
                $message = sprintf($format, 'You have submitted request for verification');
                break;

            case DoctorConstants::DOCTOR_VERIFICATION_APPROVED:
                $message .= '<div class="payment">';
                $message .= sprintf($format, 'Verified');
                $message .= '</div>';
                break;

            case DoctorConstants::DOCTOR_VERIFICATION_REJECTED:
                $message = sprintf($format, 'Rejected');
                break;

            case DoctorConstants::DOCTOR_VERIFICATION_CANCEL:
                $message = sprintf($format, 'Cancelled');
                break;

            default:
                break;
        }
        return $message;
    }

    public static function getMemberSince()
    {
        $doctor = Auth::guard('doctor')->user();
        return DateHelper::getCurrentHumanReadableTimeFromDate($doctor->created_at);
    }

    public static function getDoctorDefaultPaymentCardDetails($doctorId)
    {
        return DB::table(Doctor::getTableName() . ' as c')
                ->leftjoin(DoctorCardDetail::getTableName() . ' as ccd','ccd.id','c.default_card_id')
                ->where('c.id',$doctorId)
                ->select('c.first_name','c.last_name','c.id as doctor_id','c.payment_customer_id as customer_id','ccd.card_id')
                ->first();
    }
}

