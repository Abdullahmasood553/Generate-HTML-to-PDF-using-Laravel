<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mail;
class Customer extends Model
{
    public static function sendCustomerEmail($customer)
    {
     
        $viewData['fname']              = $customer->fname;
        $viewData['lname']              = $customer->lname;
        $viewData['email']              = $customer->email;
        Mail::send('email_templates.email_customer_detail', $viewData, function ($m) use ($customer) {
            $m->from('abnation553@gmail.com', env('APP_NAME'));
            $m->to('abnation553@gmail.com', $customer->email)->subject('Customer Details');
        });
    }
}
