<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceStoreRequest;
use Illuminate\Http\Request;
use App\Invoice;

class InvoicesController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('customer')->get(); //pobiera wszystkie faktury z informacją o kliencie
        return view('invoices.index', ['invoices' => $invoices]); //przekazanie danych z mysql do widoku
    }
    
    public function create()
    {
        return view('invoices.create');
    }
    
    public function edit($id)
    {
        $invoice = Invoice::find($id); //Proste wyszykanie rekordu w bazie po id
        
        return view('invoices.edit', ['invoice' => $invoice]);
    }
    
    public function store(InvoiceStoreRequest $request)
    {
        //Przeniesienie walidacji do app/Http/Request/InvoiceStoreRequest

        $invoice = new Invoice(); //do zmiennej $invoice przypisz nowy "Model Invoice" - tabela invoices i jej pola zdefiniowana w migracjach
        //Klasa Invoice dziedziczy po klasie Model, która jest częścią Eloquent ORM

        $invoice->number = $request->number; //$invoice->numbers - nazwa pola taka ja w bazie Mysql
        $invoice->date = $request->date;
        $invoice->total = $request->total;
        $invoice->customer_id = $request->customer;
        
        $invoice->save(); //Metoda save() jest jedną z metod zdefiniowanych w klasie Model. Służy do zapisywania obiektu (rekordu) do bazy danych.        
        //Eloquent ORM wykorzystuje Active Record – wzorzec projektowy, który mapuje obiekt PHP na tabelę w bazie danych.
        //Laravel automatycznie:
        //Dopasowuje tabelę do modelu (np. model Invoice jest powiązany z tabelą invoices).
        //Mapuje kolumny tabeli na atrybuty obiektu (np. kolumny numbers, date, total są przypisane do $invoice->numbers, $invoice->date, $invoice->total).


        return redirect()->route('invoices.index')->with('message', 'Faktura dodana poprawnie.');
    }
    
    public function update($id, Request $request)
    {
        $invoice = Invoice::find($id);//Wyszykanie rekordu w bazie po id w celu update
        
        $invoice->number = $request->number;
        $invoice->date = $request->date;
        $invoice->total = $request->total;
        
        $invoice->save();
        
        return redirect()->route('invoices.index')->with('message', 'Faktura zmieniona poprawnie.');
    }
    
    public function delete($id)
    {
        Invoice::destroy($id);//Usunięcie rekordu z bazy danych
        
        return redirect()->route('invoices.index')->with('message', 'Faktura została usunięta.');
    }
}
