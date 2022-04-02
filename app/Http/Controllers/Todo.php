<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Resource_;

class Todo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = DB::table('todos')->where('status', '=' ,0)->get();
        $todosComplete = DB::table('todos')->where('status', '=', 1)->get();
        return view('app', ['todos' => $todos, 'todosComplete' => $todosComplete]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the form
        $request->validate([
            'task' => 'required|max:200'
        ]);

        // store the data
        DB::table('todos')->insert([
            'task' => $request->task,
            'title' => $request->title,
            'dueDateTime' => $request->dueDate


        ]);

        // redirect
        return redirect('/')->with('status', 'Task added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        // validate the form
        $request->validate([
            'task' => 'required|max:200'
        ]);

        // update the data
        DB::table('todos')->where('id', $id)->update([
            'task' => $request->task,
            'title' => $request->title,
            'dueDateTime' => $request->dueDate
        ]);

        $this->complete($request, $id);
        // redirect
        return redirect('/')->with('status', 'Task updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function destroy($id)
    {
        DB::table('todos')->where('id', $id)->delete();

        // redirect
        return redirect('/')->with('status', 'Task removed!');
    }

    public function complete(Request $request, $id)
    {
        if ($request->has('checkStatus'))
        {
            DB::table('todos')->where('id', $id)->update(['status' => 1]);

        }
        return redirect('/')->with('status', 'Task marked as complete');


    }

}
