<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Customer;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeNewUser;

class CustomersController extends Controller
{
    public function index(){

        $customers = Customer::all();
        //dd($activeCustomers);
        //$custumers = Customer::all();
        //dd($custumers);
        return view('customers.index', compact('customers'));

    }

    public function create()
    {
        $customer = new Customer();
        $companies = Company::all();
        return view('customers.create', compact('companies','customer'));
    }
    
    public function store()
    {
        
        $customer = Customer::create($this->validateRequest());

        Mail::to($customer->email)->send(new WelcomeNewUser());
        dump('Mensaje de exito?');

        return redirect('customers')->with('message', 'exito');
    }
    public function show(Customer $customer)
    {
        //$customer = Customer::where('id', $customer)->firstOrFail();
        //dd($customer);
        return view('customers.show',compact('customer'));
    }

    public function edit(Customer $customer)
    {
        $companies = Company::all();
        return view('customers.edit', compact('customer', 'companies'));
    }

    public function update(Customer $customer)
    {

        $customer->update($this->validateRequest());
        return redirect('customers/' . $customer->id);
    }
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect('customers');
    }
    public function validateRequest()
    {
        return request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email', 
            'active' => 'required',
            'company_id' => 'required',    
        ]);
    }
}
