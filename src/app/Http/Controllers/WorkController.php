<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
//userは要らないかも//
use App\models\Work;
use App\models\Breaking;


class WorkController extends Controller
{
    public function attendance(){
        return view('attendance');
    }
    
}