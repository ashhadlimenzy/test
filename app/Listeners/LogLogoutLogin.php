<?php

namespace App\Listeners;

use App\Http\Constants\AuthConstants;
use App\Http\Helpers\Core\Server;

use App\Models\AdminLoginLog;
use App\Models\DoctorLoginLog;
use App\Models\UserLoginLog;
use Illuminate\Auth\Events\Logout;
use Carbon\Carbon;


class LogLogoutLogin
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
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        $logData = [
            'status' => AuthConstants::LOGIN_LOGOUT,
            'logged_at' => Carbon::now()->toDateTimeString(),
            'remote_address' => Server::remoteAddress(),
//            'note' => serialize($event->user->email),
            'header' => Server::userAgent(),
        ];

        $eventTable  = new $event->user();
        switch ($eventTable->getTableName()) {
            case 'admins':
                $logData['admin_id'] = $event->user->id;
                AdminLoginLog::create($logData);
                break;
            case 'doctors':
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
