<?php

namespace App\Http\Controllers;

use App\Hardware;
use App\Computer;
use App\AuditTrail;
use Auth;
use Illuminate\Http\Request;

class HardwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hardwares = Hardware::with('computer')->get();

        return view('hardware.index', compact('hardwares'));
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
    public function store(Request $request, Computer $computer)
    {
        $this->validate($request, [
            'description' => 'required',
            'category' => 'required',
            'status' => 'required',
            'quantity' => 'required|integer',
            'uom' => 'required'
        ]);

        $hardware = new Hardware;

        $hardware->description = $request->description;
        $hardware->category = $request->category;
        $hardware->sn = $request->sn;
        $hardware->status = $request->status;
        $hardware->uom = $request->uom;
        $hardware->quantity = $request->quantity;
        $hardware->remarks = $request->remarks;

        $hardware->computer()->associate($computer);

        $hardware->save();

        $audit = new AuditTrail;
        $audit->name = Auth::user()->name;
        $audit->activity = 'Hardware added';
        $audit->hardware_id = $hardware->id;
        $audit->computer_id = $hardware->computer_id;

        $audit->save();

        return redirect()->route('computer.show', $computer)->withMessage('Hardware Added')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hardware  $hardware
     * @return \Illuminate\Http\Response
     */
    public function show(Hardware $hardware)
    {
        return $hardware;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hardware  $hardware
     * @return \Illuminate\Http\Response
     */
    public function edit(Hardware $hardware)
    {
        $hardware = $hardware;
        $computers = Computer::all();
        return view('hardware.edit', ['hardware' => $hardware, 'computers' => $computers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hardware  $hardware
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hardware $hardware)
    {
        $this->validate($request, [
            'computer_id' => 'nullable|integer',
            'description' => 'required',
            'category' => 'required',
            'sn' => 'nullable',
            'status' => 'required',
            'quantity' => 'required|integer',
            'uom' => 'required'
        ]);

        $message = '';
        if ($request->computer_id == '')
            $message = 'Hardware Remove From '.$hardware->computer->hostname;
        else
            $message = 'Hardware Transfer Successful';

        $hardware->computer_id = $request->computer_id;
        $hardware->description = $request->description;
        $hardware->category = $request->category;
        $hardware->sn = $request->sn;
        $hardware->status = $request->status;
        $hardware->quantity = $request->quantity;
        $hardware->uom = $request->uom;
        $hardware->remarks = $request->remarks;

        $hardware->save();

        $audit = new AuditTrail;
        $audit->name = Auth::user()->name;
        $audit->activity = $message;
        $audit->hardware_id = $hardware->id;
        $audit->computer_id = $hardware->computer_id;

        $audit->save();

        return redirect()->back()->withMessage($message)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hardware  $hardware
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hardware $hardware)
    {
        // temporary remove of hardware
        $hardware->computer_id = null;
        $hardware->save();
        return redirect()->back()->withMessage('Harware Removed');
    }

    public function add_hardware($computer)
    {
        $computer = Computer::findOrFail($computer);
        return view('hardware.add_hardware', ['computer' => $computer]);
    }
}
