<?php

namespace App\Http\Controllers;
use App\Models\Todo; // kene use models untuk guna dalam method
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TodoController extends Controller
{
   //index
    public function index(){
        $todo = Todo::all();
        return view('index') -> with('todos',$todo);
     }

     //create
     public function create(){
        return view('create');
     }

     //details
     public function details(Todo $todo){
        return view('details') -> with('todos',$todo);
     }

     //edit
     public function edit(Todo $todo){
        return view('edit') -> with('todos',$todo);;
     }

     //update
     public function update(Todo $todo){
      try {
         $this->validate(request(), [
             'name' => ['required'],
             'description' => ['required'],
        
         ]);
     } catch (ValidationException $e) {
     }

     $data = request()->all();

    
     $todo->name = $data['name'];
     $todo->description = $data['description'];
     $todo->save();

     session()->flash('success', 'Todo updated successfully');

     return redirect('/');
     }

     //delete
     public function delete(Todo $todo){

      $todo->delete();
      return redirect('/');
     }

     //store data
     public function store(){

      try{
         $this->validate(request(),[
            'name' => ['required'],
            'description' => ['required']
         ]);
      }

      catch(ValidationException $e){

      }

      $data = request()->all();
      $todo = new Todo();

      $todo->name = $data['name'];
      $todo->description = $data['description'];
      $todo->save();

      session()->flash('success','Todo created sueccessfully');
      return redirect('/');
     }

     //latest
     public function latest(){

      // Retrieve the first record from the database
      $firstData = Todo::first();

      // Pass the data to the view
      return view('latest', ['firstData' => $firstData]);
   }

}
