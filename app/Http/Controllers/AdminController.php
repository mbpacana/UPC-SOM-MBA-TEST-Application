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
    public function instructions(){
        return view('pages.instructions');
    }
    public function stashes(){
        return view('admin.stashes');
    }
    public function exam(){
        return view('pages.exam');
    }
    public function questionnaire(){
        return view('admin.questionnaire');
    }
}
