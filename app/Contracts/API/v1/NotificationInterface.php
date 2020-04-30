<?php


namespace App\Contracts\API\v1;


interface NotificationInterface
{
   public function getUnreadNotification();
   public function markAsRead($id);
}
