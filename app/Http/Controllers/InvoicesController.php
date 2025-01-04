<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Invoice;

class InvoicesController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all(); //pobiera wszystkie rekordy z tabeli mysql - invoices
        return view('invoices.index', ['invoices' => $invoices]); //przekazanie danych z mysql do widoku
    }
    
    public function create()
    {
        return view('invoices.create');
    }
    
    public function edit($id)
    {
        $invoice = Invoice::find($id);
        
        return view('invoices.edit', ['invoice' => $invoice]);
    }
    
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'number'  =>  'required|string|min:3',
            'date'   => 'required|max:15',
            'total'   =>  'required|numeric|min:1'
        ]);
        $invoice = new Invoice(); //do zmiennej $invoice przypisz nowy "Model Invoice" - tabela invoices i jej pola zdefiniowana w migracjach
        //Klasa Invoice dziedziczy po klasie Model, która jest częścią Eloquent ORM

        $invoice->numbers = $request->number; //$invoice->numbers - nazwa pola taka ja w bazie Mysql
        $invoice->date = $request->date;
        $invoice->total = $request->total;
        
        $invoice->save(); //Metoda save() jest jedną z metod zdefiniowanych w klasie Model. Służy do zapisywania obiektu (rekordu) do bazy danych.        
        //Eloquent ORM wykorzystuje Active Record – wzorzec projektowy, który mapuje obiekt PHP na tabelę w bazie danych.
        //Laravel automatycznie:
        //Dopasowuje tabelę do modelu (np. model Invoice jest powiązany z tabelą invoices).
        //Mapuje kolumny tabeli na atrybuty obiektu (np. kolumny numbers, date, total są przypisane do $invoice->numbers, $invoice->date, $invoice->total).


        return redirect()->route('invoices.index')->with('message', 'Faktura dodana poprawnie.');
    }
    
    public function update($id, Request $request)
    {
        $invoice = Invoice::find($id);
        
        $invoice->number = $request->number;
        $invoice->date = $request->date;
        $invoice->total = $request->total;
        
        $invoice->save();
        
        return redirect()->route('invoices.index')->with('message', 'Faktura zmieniona poprawnie.');
    }
    
    public function delete($id)
    {
        Invoice::destroy($id);
        
        return redirect()->route('invoices.index')->with('message', 'Faktura została usunięta.');
    }
}
