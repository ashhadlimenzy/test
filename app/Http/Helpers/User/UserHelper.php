<?php

namespace App\Http\Helpers\User;

use App\Http\Constants\FileDestinations;
use App\Http\Constants\UserConstants;

use App\Models\User;

use App\Http\Helpers\Core\DateHelper;
use App\Http\Helpers\Core\FileManager;
use App\Http\Helpers\Core\ImageUpload;

use Illuminate\Support\Facades\Auth;

class UserHelper
{

    public static function getProfileImage($userId, $image = null)
    {
        $profileImageUrl = asset('images/default-user.png');
        if (! is_null($image)) {
            $destination = FileDestinations::USER . $userId . '/profile/';
            if (FileManager::checkFileExist($image, $destination)) {
                $profileImageUrl = FileManager::getFileUrl($image, $destination);
            }
        }
        return $profileImageUrl;
    }

    public static function uploadProfileImage($userId, $imageAttributeName)
    {
        $destination = FileDestinations::USER . $userId. '/profile/';
//        return ImageUpload::upload($destination, $imageAttributeName);
        return ImageUpload::uploadBase64($imageAttributeName,$destination);
    }


    public static function uploadProfileImageApi($userId, $imageAttributeName)
    {
        $destination = FileDestinations::USER . $userId. '/profile/';
        return ImageUpload::upload($destination, $imageAttributeName);
//        return ImageUpload::uploadBase64($imageAttributeName,$destination);
    }

    public static function getVerificationDocument($userId, $image = null)
    {
        $fileUrl = '';
        if (! is_null($image)) {
            $destination = FileDestinations::USER . $userId . '/verification/';
            if (FileManager::checkFileExist($image, $destination)) {
                $fileUrl = FileManager::getFileUrl($image, $destination);
            }
        }
        return $fileUrl;
    }

    public static function getPortfolioUrl($userId, $image = null)
    {
        $fileUrl = asset('images/default-user.png');
        if (! is_null($image)) {
            $destination = FileDestinations::USER . $userId . '/portfolio/';
            if (FileManager::checkFileExist($image, $destination)) {
                $fileUrl = FileManager::getFileUrl($image, $destination);
            }
        }
        return $fileUrl;
    }


//    public static function getProfileImage($userId, $image = null)
//    {
//        $profileImageUrl = asset('images/default-user.png');
//        if (! is_null($image)) {
//            $destination = FileDestinations::USER . $userId . '/profile/';
//            if (FileManager::checkFileExist($image, $destination)) {
//                $profileImageUrl = FileManager::getFileUrl($image, $destination);
//            }
//        }
//        return $profileImageUrl;
//    }

    public static function getCertificateUrl($userId, $image = null)
    {
        $fileUrl = asset('images/default-user.png');
        if (! is_null($image)) {
            $destination = FileDestinations::USER . $userId . '/certificate/';
            if (FileManager::checkFileExist($image, $destination)) {
                $fileUrl = FileManager::getFileUrl($image, $destination);
            }
        }
        return $fileUrl;
    }


    public static function isUserVerified($userId, $type)
    {
        $verificationRequest = UserVerificationRequest::where('user_id',$userId)->where('verification_type',$type)->orderBy('created_at','desc')->first();

        return $verificationRequest;
    }

    public static function getVerificationStatus($status = UserConstants::USER_VERIFICATION_PENDING)
    {
        $format = '<p>%s</p>';
        $message = '';
        switch ($status) {

            case UserConstants::USER_VERIFICATION_PENDING:
                $message = sprintf($format, 'You have submitted request for verification');
                break;

            case UserConstants::USER_VERIFICATION_APPROVED:
                $message .= '<div class="payment">';
                $message .= sprintf($format, 'Verified');
                $message .= '</div>';
                break;

            case UserConstants::USER_VERIFICATION_REJECTED:
                $message = sprintf($format, 'Rejected');
                break;

            case UserConstants::USER_VERIFICATION_CANCEL:
                $message = sprintf($format, 'Cancelled');
                break;

            default:
                break;
        }
        return $message;
    }

    public static function uploadPortfolioImage($userId, $imageAttributeName)
    {
        $destination = FileDestinations::USER . $userId. '/portfolio/';
        return ImageUpload::upload($destination, $imageAttributeName);
    }

    public static function uploadUserCertificate($userId, $imageAttributeName)
    {
        $destination = FileDestinations::USER . $userId. '/certificate/';
        return ImageUpload::upload($destination, $imageAttributeName);
    }

    public static function userCertificateUpload($userId, $imageAttributeName)
    {
        $destination = FileDestinations::USER . $userId. '/certificate/';
        return ImageUpload::uploadBase64($imageAttributeName, $destination);
    }

    public static function userPortfolioUpload($userId, $imageAttributeName)
    {
        $destination = FileDestinations::USER . $userId. '/portfolio/';
        return ImageUpload::uploadBase64($imageAttributeName, $destination);
    }

    public static function getMemberSince()
    {
        $user = Auth::guard('user')->user();
        return DateHelper::getCurrentHumanReadableTimeFromDate($user->created_at);
    }

    public static function uploadBase64ProfileImage($imageAttributeName, $userId)
    {
        $destination = FileDestinations::USER . $userId. '/profile/';
        return ImageUpload::uploadBase64($imageAttributeName, $destination);
    }
}

