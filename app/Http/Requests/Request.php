<?php

namespace farmacia\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    public function autorize(){
    	retutn true;
    }

    public function rules(){
    	//
    }
}
