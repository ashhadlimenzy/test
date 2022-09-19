<?php

namespace App\Listeners;

use App\Http\Constants\AuthConstants;
use App\Http\Helpers\Core\Server;

use App\Models\AdminLoginLog;
use App\Models\DoctorLoginLog;
use App\Models\UserLoginLog;
use Illuminate\Auth\Events\Lockout;
use Carbon\Carbon;
use Route;

class LogLockoutLogin
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
     * @param  Lockout  $event
     * @return void
     */
    public function handle(Lockout $event)
    {
        $logData = [
            'status' => AuthConstants::LOGIN_LOCKOUT,
            'logged_at' => Carbon::now()->toDateTimeString(),
            'remote_address' => Server::remoteAddress(),
            'note' => serialize($event->credentials),
            'header' => Server::userAgent(),
        ];

        switch (Route::currentRouteName()) {
            case 'admin':
                $logData['admin_id'] = $event->user->id;
                AdminLoginLog::create($logData);
                break;
            case 'doctor':
                $logData['doctor_id'] = $event->user->id;
                DoctorLoginLog::create($logData);
                break;

            default:
                $logData['user_id'] = $event->user->id;
                UserLoginLog::create($logData);
                break;
        }
    }
}
