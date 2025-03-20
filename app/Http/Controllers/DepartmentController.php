<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        return view('department.index', compact('departments'));
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
        $this->validate($request, [
            'name' => 'required'
        ]);

        $department = new Department;
        $department->name = $request->name;
        $department->save();

        return redirect()->back()->withMessage('Department Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::with('computers')->findOrFail($id);

        return view('department.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return $department;
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
        $this->validate($request, [
            'name' => 'required|unique:departments,id,'.$id,
        ]);

        $department = Department::findOrFail($id);
        $department->name = $request->name;

        if ($department->save())
            return response()->json(['status' => TRUE, 'msg' => 'Department updated']);
        else
            return response()->json(['status' => FALSE, 'msg' => 'Error updating department']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDepartments(Request $request)
    {
        $draw = $request->draw;
        $start = $request->start;
        $length = $request->length;

        $departments = Department::where('name', 'like', $request->search['value'].'%')->skip($start)->take($length)->get();
        $tmp = [];

        foreach ($departments as $key => $value) {
            $tmp[] = [$value->name, '<a href="'.route('department.show', $value->id).'">View</a>&nbsp;|&nbsp;<a href="'.route('department.edit', ['department' => $value->id]).'" id="a-department-update">Update</a>'];
        }

        return response()->json(['draw' => $draw, 'recordsTotal' => count($departments), 'recordsFiltered' => count($departments), 'data' => $tmp]);
    }
}
