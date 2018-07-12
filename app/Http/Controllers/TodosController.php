<?php

namespace App\Http\Controllers;

use Session;
use App\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    public function index()
    {
        $todos = Todo::all();

        return view ('todos')->with('todos', $todos);
        //all() gets all the Todo in the database
        // view 'todos' is balde template
        //with('todos') is the name of the variable used to access the data in the view
        //$todos is data passed in the 
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $todo = new Todo;

        $todo->todo = $request->todo;
        $todo->save();

        Session::flash('success', 'Your ToDo was created.');

        return redirect()->back();
    }

    public function delete($id)
    {
        //dd($id);

        $todo = Todo::find($id);

        $todo->delete();

        Session::flash('success', 'Your ToDo was deleted.');

        return redirect()->back();

    }

    public function update($id)
    {
        $todo = Todo::find($id);

        

        return view('update')->with('todo', $todo);
    }

    public function save(Request $request, $id)
    {
        //dd($request->all());
        $todo = Todo::find($id);

        $todo->todo = $request->todo;

        $todo->save();

        Session::flash('success', 'Your ToDo was updated.');

        return redirect()->route('todos');
    }

    public function completed($id)
    {
        $todo = Todo::find($id);

        $todo->completed = 1;

        $todo->save();

        Session::flash('success', 'Your ToDo was marked as complete.');

        return redirect()->back();


    }
}
