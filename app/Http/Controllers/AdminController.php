<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('pages.home');
    }
    public function login(){
        return view('pages.login');
    }
    public function answers(){
        return view('admin.answers');
    }
    public function stashes(){
        return view('admin.stashes');
    }
    public function questionnaire(){
        return view('admin.questionnaire');
    }
}
