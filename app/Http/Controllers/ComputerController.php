<?php

namespace App\Http\Controllers;

use App\Computer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Department;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $computers = Computer::all();

        return view('main.index')->with('info', $computers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::orderBy('name', 'asc')->get();
        return view('main.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'hostname' => 'required|unique:computers|max:255',
            'user' => 'required|max:255',
            'department_id' => 'required|integer',
            'syteline' => 'ip|nullable',
            'internet' => 'ip|nullable',
            'macAddress' => 'required'
        ]);

        dd($request->request);

        $computer = new Computer;

        $computer->hostname = $request->hostname;
        $computer->user = $request->user;
        $computer->department_id = $request->department_id;
        $computer->syteline = $request->syteline;
        $computer->internet = $request->internet;
        $computer->macAddress = $request->macAddress;

        $computer->save();

        // return redirect()->back()->withMessage('Computer Information Saved')->withInput();
        return redirect()->route('computer.show', [$computer->id])->withMessage('Computer Information Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function show(Computer $computer)
    {        
        return view('main.show', ['computer' => $computer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function edit(Computer $computer)
    {

        return view('main.edit')->withComputer($computer)->withDepartments(Department::orderBy('name', 'asc')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Computer $computer)
    {
        $this->validate($request, [
            'hostname' => 'required|unique:computers,id,'.$computer->id,
            'user' => 'required',
            'department_id' => 'required|integer',
            'syteline' => 'ip|nullable',
            'internet' => 'ip|nullable',
            'macAddress' => 'required'
        ]);

        $computer->hostname = $request->hostname;
        $computer->user = $request->user;
        $computer->department_id = $request->department_id;
        $computer->syteline = $request->syteline;
        $computer->internet = $request->internet;
        $computer->macAddress = $request->macAddress;
        $computer->save();

        return redirect()->route('computer.show', ['computer' => $computer->id])->withMessage('Computer Information Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Computer $computer)
    {
        //
    }
}
