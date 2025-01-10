<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', ['customers' => $customers]);
        //return view('customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        //Laravel.com => The basics => Validation => Available Validation Rules - wszystkie dostępne reguły walidacji
        $request->validate([
            'name' => 'required|min:5',//create.blade.php: <input id="name" value="{{ old('name') }}" - old wyciąga wartość z poprzedniej sesji przed submitem
            'address' => 'required|max:30',
            'nip' => 'required|digits:10'
        ]);
        /*Funkcja $request->validate() w Laravelu zakończy wykonywanie metody store() (lub innej, w której jest wywoływana), 
        jeśli walidacja wykryje nieprawidłowości.Jeśli dane wejściowe nie spełniają reguł walidacji, Laravel automatycznie:
        - Przekieruje użytkownika z powrotem na poprzednią stronę.
        - Dołączy do odpowiedzi komunikaty o błędach walidacji.
        - Zachowa dane formularza w sesji (tzw. "old input"), dzięki czemu można je ponownie wyświetlić w formularzu.
        Nie musisz więc samodzielnie przerywać funkcji ani obsługiwać błędów — Laravel robi to za Ciebie.*/
        $customer = new Customer();
        
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->nip = $request->nip;
        
        $customer->save();
        
        return redirect()->route('customers.index')->with('message', 'Dodano klienta');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::with('invoices')->where('id', $id)->firstOrFail();

        return view('customers.single', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->nip = $request->nip;
        
        $customer->save();
        
        return redirect()->route('customers.index')->with('message', 'Nadpisano dane klienta');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::destroy($id);
        
        return redirect()->route('customers.index')->with('message', 'Usunięto klienta');
    }
}
