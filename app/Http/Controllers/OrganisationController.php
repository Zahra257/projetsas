<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganisationRequest;
use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class OrganisationController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'main_admin') {
            $organisations = Organisation::orderBy('created_at', 'DESC')->get();
        } elseif ($user->role === 'super_admin') {
            $organisations = Organisation::where('created_by', $user->id)->orderBy('created_at', 'DESC')->get();
        } else {
            $organisations = collect();
        }

        return view('organisations.index', compact('organisations'));
    }


    public function create()
    {

        return view('organisations.create');
    }


    public function store(OrganisationRequest $request)
    {


        $validatedData = $request->validated();
        $userId = Auth::id();

        $validatedData['created_by'] = $userId;
        $validatedData['updated_by'] = $userId;
        $validatedData['active'] = $request->has('active') ? 1 : 0;
        $validatedData['activation_date'] = $validatedData['first_activation_date'];

        Organisation::create($validatedData);

        return redirect()->route('organisations')->with('success', 'Organisation added successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $organisation = Organisation::findOrFail($id);

        return view('organisations.show', compact('organisation'));
    }


    public function edit(string $id)
    {

        $organisation = Organisation::findOrFail($id);
        return view('organisations.edit', compact('organisation'));
    }

    public function update(OrganisationRequest $request, string $id)
    {

        $validatedData = $request->validated();
        $organisation = Organisation::findOrFail($id);
        $userId = Auth::id();
        $validatedData['updated_by'] = $userId;
        $validatedData['active'] = $request->has('active') ? 1 : 0;
        $organisation->update($validatedData);

        // Redirect with success message
        return redirect()->route('organisations')->with('success', 'organisation updated successfully');
    }


    public function destroy(string $id)
    {
        //
        //
        $organisation = Organisation::findOrFail($id);
        $organisation->delete();

        return redirect()->route('organisations')->with('success', 'Organisation deleted successfully');
    }
}
