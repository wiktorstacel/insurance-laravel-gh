<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //use HasFactory; - fabryki używane są do generowania przykładowych danych - nie jest to powiązane z pozostałym kodem tutaj

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
