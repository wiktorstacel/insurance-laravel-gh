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
            'name'  =>  'required|min:14',
            'address'   => 'required|max:34',
            'nip'   =>  'required|digits:14'
        ]);
        $invoice = new Invoice();
        
        $invoice->number = $request->number;
        $invoice->date = $request->date;
        $invoice->total = $request->total;
        
        $invoice->save();
        
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
