<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use DataTables;

class AjaxdataController extends Controller
{
    function index()
    {
        return view('student.ajaxdata');
        //http://127.0.0:80/ajaxdata
    }
    
    function getdata()
    {
        $students = Student::select('first_name','last_name');
        return DataTables::of($students)->make(true);
    }
}
