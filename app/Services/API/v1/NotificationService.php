<?php


namespace App\Services\API\v1;


use App\Company;
use App\Contracts\API\v1\NotificationInterface;
use App\User;
use Illuminate\Support\Facades\Auth;

class NotificationService implements NotificationInterface
{
    public function getUnreadNotification()
    {
        // TODO: Implement getUnreadNotification() method.
        $user=User::where('id',Auth::user()->id)->first();
        return $user->unreadNotifications;
    }
    public function markAsRead($id)
    {
        // TODO: Implement markAsRead() method.
        $user=User::where('id',Auth::user()->id)->first();

        $read=$user->unreadNotifications()->find($id)->markAsRead();

        if($read   ==  null)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}
