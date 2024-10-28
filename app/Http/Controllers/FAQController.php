<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index(){
        return view('faq.index');
    }

    public function edit(){
        return view('faq.edit');
    }

    public function update(){

    }

    public function store() {

    }

    public function destroy(){

    }
}
