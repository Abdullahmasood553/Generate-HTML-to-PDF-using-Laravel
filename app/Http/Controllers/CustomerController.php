<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use PDF;
use Illuminate\Support\Facades\Storage;


class CustomerController extends Controller
{
    public function index() {
        return view('pages.customers');
    }

    public function save_customer(Request $request)
    {
            $customer = new Customer;
            $customer->fname = $request['fname'];
            $customer->lname = $request['lname'];
            $customer->email = $request['email'];
            if($customer->save()) {
                Customer::sendCustomerEmail($customer);
            }

            $pdf = PDF::loadView('download-pdf.customers-pdf', [
                'fname' => $request->input('fname'),
                'lname' => $request->input('lname'),
                'email' => $request->input('email'),
            ]);
             Storage::put('public/storage/uploads/customers.pdf', $pdf->output());
             return response()->json(['success' => 'Data Submitted Successfully']);
    }
}
