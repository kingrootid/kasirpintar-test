<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function dashboard()
    {
        return view('dashboard');
    }
    public function reqreimbursement()
    {
        return view('reimbursement.req');
    }
    public function reimbursement()
    {
        return view('reimbursement.data');
    }
    public function user()
    {
        return view('users');
    }
}
