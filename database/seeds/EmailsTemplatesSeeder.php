<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailsTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\EmailTemplates::truncate();
        DB::table('email_templates')->insert([
            [
                'name'                  =>  'New User Created',
                'slug'                  =>  'new-user-created',
                'subject'               =>  'Your account has been created successfully' ,
                'message'               =>  '<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                                                <tbody>
                                                <tr>
                                                    <td bgcolor="#1fa8d7" height="128">&nbsp;</td>
                                                    <td bgcolor="#1fa8d7">
                                                        <div style="text-align: center;"><span style="font-size: 26px; color: #fff; font-family: tahoma, Helvetica, sans-serif;">SPA</span></div>
                                                    </td>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                    <td bgcolor="#FFFFFF" style="text-align: center;"><span style="font-size: 26px; color: #062e57; font-family: tahoma, Helvetica, sans-serif;"><br>&nbsp;Welcome [name] &nbsp;</span><span style="font-size: 26px; color: #062e57; font-family: tahoma, Helvetica, sans-serif;"><br></span>
                                        
                                                        <p style="font-family: tahoma;">&nbsp;Your Account has been created at [site_url] . To complete your profile click the link below.&nbsp;</p>
                                        
                                                        <p style="font-family: tahoma;"> [url] </p>
                                        
                                                        <p style="font-family: tahoma;">
                                                            <br>
                                                        </p>
                                        
                                                        <p>
                                                            <br>
                                                        </p>
                                                    </td>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                    <td bgcolor="#1fa8d7">
                                        
                                                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="mcnFollowContent" style="min-width: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" width="100%">
                                                            <tbody>
                                                            <tr>
                                                                <td align="center" style="padding-top: 9px; padding-right: 9px; padding-left: 9px; mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" height="88" style="padding-top: 9px; padding-right: 9px; padding-left: 9px; mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #fff;" valign="top">
                                        
                                                                    <table border="0" cellpadding="0" cellspacing="0" style="margin-left: calc(3%); width: 97%;" width="100%">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td align="center" style="text-align: left; color: #fff; font-size: 15px;" valign="top" width="69%">
                                                                                <div style="text-align: center;">Copyright &copy; &nbsp;All rights reserved.</div>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                </tr>
                                                </tbody>
                                            </table>',
                'variables'             =>  'name, site_url, url',
                'publish'               =>  1,
                'deleted_at'            =>  null,
                'created_at'            =>  \Carbon\Carbon::now(),
                'updated_at'            =>  null,
                'type'                  =>  'system_mail',
            ],

            [
                'name'                  =>  'Holiday Wishes',
                'slug'                  =>  'holiday-wishes',
                'subject'               =>  'Happy Holidays' ,
                'message'               =>  '<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                                                <tbody>
                                                <tr>
                                                    <td bgcolor="#1fa8d7" height="128">&nbsp;</td>
                                                    <td bgcolor="#1fa8d7">
                                                        <div style="text-align: center;"><span style="font-size: 26px; color: #fff; font-family: tahoma, Helvetica, sans-serif;">SPA</span></div>
                                                    </td>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                    <td bgcolor="#FFFFFF" style="text-align: center;"><span style="font-size: 26px; color: #062e57; font-family: tahoma, Helvetica, sans-serif;"><br>&nbsp;Hi [name] &nbsp;</span><span style="font-size: 26px; color: #062e57; font-family: tahoma, Helvetica, sans-serif;"><br></span>
                                        
                                                        <p style="font-family: tahoma;">&nbsp; Happy Holidays.&nbsp;</p>
                                        
                                                        <p style="font-family: tahoma;">
                                                            <br>
                                                        </p>
                                        
                                                        <p>
                                                            <br>
                                                        </p>
                                                    </td>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                    <td bgcolor="#1fa8d7">
                                        
                                                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="mcnFollowContent" style="min-width: 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" width="100%">
                                                            <tbody>
                                                            <tr>
                                                                <td align="center" style="padding-top: 9px; padding-right: 9px; padding-left: 9px; mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" height="88" style="padding-top: 9px; padding-right: 9px; padding-left: 9px; mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #fff;" valign="top">
                                        
                                                                    <table border="0" cellpadding="0" cellspacing="0" style="margin-left: calc(3%); width: 97%;" width="100%">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td align="center" style="text-align: left; color: #fff; font-size: 15px;" valign="top" width="69%">
                                                                                <div style="text-align: center;">Copyright &copy; &nbsp;All rights reserved.</div>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td bgcolor="#1fa8d7">&nbsp;</td>
                                                </tr>
                                                </tbody>
                                            </table>',
                'variables'             =>  'name',
                'publish'               =>  1,
                'deleted_at'            =>  null,
                'created_at'            =>  \Carbon\Carbon::now(),
                'updated_at'            =>  null,
                'type'                  =>  'bulk_mail',
            ],
        ]);
    }
}
