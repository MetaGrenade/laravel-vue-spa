<?php


namespace App\Services\API\v1;


use App\Contracts\API\v1\EmailsInterface;
use App\EmailTemplates;
use App\Mail\HolidayWishes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailsService implements EmailsInterface
{
    public function storeEmails($data)
    {
        //$slug = $this->generateUniqueSlug($data['name']);
        $email  = new EmailTemplates();
        $email->name                = $data['title'];
        $email->slug                = $data['title'];;
        $email->subject             = $data['subject'];
        $email->variables           = $data['variables'];
        $email->message             = $data['message'];
        $email->save();
        return $email ? $email : false;
    }

    public function getEmailTemplates()
    {
        return $emails = EmailTemplates::all();
    }
    public function editEmail($id)
    {
        $email = EmailTemplates::where('publish', 1)
            ->where('id', $id)
            ->first();

        return $email;
    }
    public function updateEmailTemplate($dataToUpdate)
    {
        //dd($dataToUpdate['id']);
        $templateData =  EmailTemplates::find($dataToUpdate['id']);
        ///dd($abc);
        $templateData->name = $dataToUpdate['name'];
        $templateData->subject = $dataToUpdate['subject'];
        $templateData->variables = $dataToUpdate['variables'];
        $templateData->message = $dataToUpdate['message'];

        $templateData->save();


        //dd($templateData);
        return $templateData;
    }

    public function sendBulkEmails($bulkEmail)
    {

        $users = DB::table('user_role')
                    ->join('users', 'user_role.user_id', 'users.id')
                    ->select('user_role.*', 'users.*')
                    ->where('role_id', $bulkEmail['role'])
                    ->where('users.status', 1)
                    ->get();

        $emailTemplates = DB::table('email_templates')->where('id', $bulkEmail['template'])->first();

        if($emailTemplates && $emailTemplates->slug == 'holiday-wishes')
        {
            foreach ($users as $user)
            {
               $mailSend =  Mail::to($user->email)->send(new HolidayWishes($user));
            }
            return true;
        }
    }

    public function sendTestEmails($data)
    {
        $users = DB::table('users')
                    ->where('email', $data['email'])
                    ->get();
        if($users){
            $emailTemplates = DB::table('email_templates')->where('id', $data['template'])->first();
            if($emailTemplates && $emailTemplates->slug == 'holiday-wishes')
            {
                $mailSend =  Mail::to($users[0]->email)->send(new HolidayWishes($users[0]));
            }
            return true;
        }else{
            return false;
        }

    }

}
