<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAcountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        if ($user->role === 'admin') {
            $accounts = Account::where('created_by', $user->id)->orderBy('created_at', 'DESC')->get();
        return view('admin.accounts.index', compact('accounts'));
    }  }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.accounts.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user(); // Retrieve the authenticated user
        $organisationId = $user->organisationId; 

        $data = $request->validated();
        $data['created_by'] = Auth::id();
        $data['updated_by'] = Auth::id();
        $data['organisationId'] = $organisationId;
        $data['active'] = $request->has('active') ? 1 : 0;

        Account::create($data);

        return redirect()->route('accounts_admin')->with('success', 'Account added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
