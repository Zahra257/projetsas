<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'main_admin') {
            $departments = Department::orderBy('created_at', 'DESC')->get();
        } elseif ($user->role === 'super_admin') {
            $organisationIds = Organisation::where('created_by', $user->id)->pluck('id');

            $departments = Department::whereIn('organisationId', $organisationIds)
                ->orderBy('created_at', 'DESC')
                ->get();
        }
        return view('departments.index', compact('departments'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->role === 'main_admin') {
            $organisations = Organisation::orderBy('created_at', 'DESC')->get();
        } elseif ($user->role === 'super_admin') {
            $organisations = Organisation::where('created_by', $user->id)->orderBy('created_at', 'DESC')->get();
        }
        return view('departments.create', compact('organisations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();
        $data['updated_by'] = Auth::id();

        Department::create($data);

        return redirect()->route('departments')->with('success', 'Department added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::findOrFail($id);

        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $department = Department::findOrFail($id);

        if ($user->role === 'main_admin') {
            $organisations = Organisation::orderBy('created_at', 'DESC')->get();
        } elseif ($user->role === 'super_admin') {
            $organisations = Organisation::where('created_by', $user->id)->orderBy('created_at', 'DESC')->get();
        }
        return view('departments.edit', compact('department', 'organisations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, string $id)
    {
        $data = $request->validated();
        $department = Department::findOrFail($id);

        $department->update($data);

        return redirect()->route('departments')->with('success', 'Department updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('departments')->with('success', 'Department deleted successfully');
    }
}
