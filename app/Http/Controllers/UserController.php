<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Storage;
use PDF;

class UserController extends Controller
{
    
    public function index() {
        
        return view('pages.users');
        // $pdf = PDF::loadView('pages.users');
        // $pdf->save(storage_path().'users.pdf');
        // return $pdf->stream();
        // Storage::put('public/storage/documents/users.pdf', $pdf->output());
    }

            public function save_user(Request $request) {
            $user = new User;
            $user->fname = $request['fname'];
            $user->lname = $request['lname'];
            $user->email = $request['email'];
            $user->phone = $request['phone'];

            if($user->save()) {
                return response()->json(['success' => 'Data Submitted Successfully']);
            } else {
                return response()->json(['error' => 'Something Went Wrong']);
            }
        }

            public function userFetchList() {
                $users = User::all();        
                echo json_encode($users);
            }

            public function totalUsers() {
                $total_users = User::all();
                echo json_encode($total_users);
            }

            public function pdf() {
                $data['users'] = User::all();
                $pdf = PDF::loadView('download-pdf.users-pdf', $data);
                Storage::put('public/storage/users/users.pdf', $pdf->output());
                return $pdf->download('users.pdf');
            }
}
