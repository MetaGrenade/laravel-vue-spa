<?php


namespace App\Contracts\API\v1;


interface EmailsInterface
{
    public function storeEmails($data);
    public function getEmailTemplates();
    public function editEmail($id);
    public function updateEmailTemplate($dataToUpdate);
    public function sendBulkEmails($data);
    public function sendTestEmails($data);
}
