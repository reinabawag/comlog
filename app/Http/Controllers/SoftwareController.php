<?php

namespace App\Http\Controllers;

use App\Software;
use App\Computer;
use App\License;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $softwares = Software::all();

        return view('software.index', compact('softwares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($computerID)
    {

        $computer = Computer::findOrFail($computerID);
        // $licenses = License::where('licenseType', 'VL')->get();
        $licenses = License::orderBy('licenseType', 'asc')->get();
        return view('software.create', ['computer' => $computer, 'licenses' => $licenses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'computer_id' => 'required|integer',
            'description' => 'required',
            'type' => 'required',
            'license_type' => 'required'
        ]);

        $software = new Software;

        $software->computer_id = $request->computer_id;
        $software->description = $request->description;
        $software->type = $request->type;
        $software->licenseType = $request->license_type;
        if ($request->license_type == 'OEM') {
            // $software->licenseKey = $request->license_key;
            $software->license_id = $request->sel_license_key;
        }
        else {
            // $software->licenseKey = $request->sel_license_key;
            $license = License::findOrFail($request->sel_license_key);
            if ($license->license_count > 0) {
                $license->license_count = $license->license_count - 1;
                $software->license_id = $request->sel_license_key;
                $license->save();
            } else {
                return redirect()->back()->withMessage('Volume Licensing Reached The Maximum Allowed Use');
            }
        }
        
        $software->save();

        return redirect()->route('computer.show', ['computer' => $request->computer_id])->withMessage('Software Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function show(Software $software)
    {
        return view('software.show')->withSoftware($software);  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function edit(Software $software)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Software $software)
    {
        $this->validate($request, [
            'description' => 'required'
        ]);

        $software->description = $request->description;
        $software->save();

        return redirect()->route('computer.show', $request->computer_id)->withMessage('Software Information Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function destroy(Software $software)
    {
        $software->delete();
        return redirect()->back()->withMessage('Software Removed');
    }
}
