<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //use HasFactory; - fabryki używane są do generowania przykładowych danych - nie jest to powiązane z pozostałym kodem tutaj
    //HasFactory to trait dostarczony przez Laravel. Jest używany, aby włączyć nowy system fabryk 
    //oparty na klasach (class-based factories) dla modelu Eloquent. Dzięki niemu model wie, że ma 
    //powiązaną fabrykę, i umożliwia łatwe generowanie przykładowych danych dla tego modelu.

    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
}
