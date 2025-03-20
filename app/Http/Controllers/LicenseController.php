<?php

namespace App\Http\Controllers;

use App\License;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $licenses = License::all();

        return view('license.index', compact('licenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('license.create');
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
            'productVersion' => 'required',
            'license_id' => 'nullable',
            'productKey' => 'required|unique:licenses',
            'licenseType' => 'required|in:OEM,VL',
            'license_count' => 'nullable:integer'
        ]);

        $license = new License;

        $license->productVersion = $request->productVersion;
        $license->license_id = $request->license_id;
        $license->productKey = $request->productKey;
        $license->licenseType = $request->licenseType;
        $license->license_count = $request->license_count;

        $license->save();

        return redirect()->back()->withMessage('License Added')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\License  $license
     * @return \Illuminate\Http\Response
     */
    public function show(License $license)
    {
        return view('license.show', ['license' => $license]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\License  $license
     * @return \Illuminate\Http\Response
     */
    public function edit(License $license)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\License  $license
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, License $license)
    {
        $this->validate($request, [
            'productVersion' => 'required',
            'license_id' => 'nullable',
            'productKey' => 'required|unique:licenses,id,'.$license->id,
            'licenseType' => 'required|in:OEM,VL',
            'license_count' => 'nullable:integer'
        ]);

        $license->productVersion = $request->productVersion;
        $license->license_id = $request->license_id;
        $license->productKey = $request->productKey;
        $license->licenseType = $request->licenseType;
        $license->license_count = $request->license_count;

        $license->save();

        return redirect()->back()->withMessage('License Updated')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\License  $license
     * @return \Illuminate\Http\Response
     */
    public function destroy(License $license)
    {
        //
    }

    public function get_license_by_type(Request $request)
    {
        $this->validate($request, [
            'license_type' => 'required'
        ]);

        $licenses = License::where('licenseType', $request->license_type)->get();

        foreach ($licenses as $key => $value) {
            $value->productVersion = str_limit($value->productVersion, 30);
        }

        return response()->json($licenses);
    }
}
