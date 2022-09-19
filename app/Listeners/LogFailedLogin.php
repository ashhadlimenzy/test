<?php

namespace App\Listeners;


use App\Http\Constants\AuthConstants;
use App\Http\Helpers\Core\Server;

use App\Models\AdminLoginLog;
use App\Models\DoctorLoginLog;
use App\Models\UserLoginLog;
use Illuminate\Auth\Events\Failed;
use Carbon\Carbon;
use Route;

class LogFailedLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Failed $event
     * @return void
     */
    public function handle(Failed $event)
    {
        $logData = [
            'status' => AuthConstants::LOGIN_FAILED,
            'logged_at' => Carbon::now()->toDateTimeString(),
            'remote_address' => Server::remoteAddress(),
            'note' => serialize($event->credentials),
            'header' => Server::userAgent(),
        ];
        switch (Route::currentRouteName()) {
            case 'admin.':
                AdminLoginLog::create($logData);
                break;

            case 'doctor.':
                DoctorLoginLog::create($logData);
                break;

            default:
                UserLoginLog::create($logData);
                break;
        }
    }

}
