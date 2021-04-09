<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class SearchController extends Controller
{
    public function index()
    {
        $students = Student::all()->toArray();
        return view('datab.search', compact('students'));
    }
}
