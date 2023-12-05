<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;
class PizzaController extends Controller
{

  public function index() {
    // get data from a database
//    $pizzas = Pizza::all();
//    $pizzas = Pizza::orderBy("name")->get();
//    $pizzas = Pizza::where("name","ayman")->get();
    $pizzas = Pizza::latest()->get();


    return view('pizzas.index', [
      'pizzas' => $pizzas,
    ]);
  }
  public function store() {
    error_log(request('name'));
    error_log(request('type'));
    error_log(request('base'));
    $pizza = new Pizza();
    $pizza->name = request('name');
    $pizza->type = request('type');
    $pizza->base = request('base');
    $pizza->toppings = request('toppings');
    $pizza->save();
    return redirect('/')->with('mssg','Thank you For Ordering');
  }

  public function show($id) {
    $pizza = Pizza::findOrFail($id);
    // use the $id variable to query the db for a record
    return view('pizzas.show', ['pizza' => $pizza]);
  }
  public function create() {
    return view('pizzas.create');
  }
  public function destroy($id) {
    $pizza = Pizza::findOrFail($id);
    $pizza->delete();
    return redirect('/pizzas');
  }

}