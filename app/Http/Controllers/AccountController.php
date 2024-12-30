<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AccountRequest;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'main_admin') {
            $accounts = Account::orderBy('created_at', 'DESC')->get();
        } elseif ($user->role === 'super_admin') {
            $organisationIds = Organisation::where('created_by', $user->id)->pluck('id');

            $accounts = Account::whereIn('organisationId', $organisationIds)
                ->orderBy('created_at', 'DESC')
                ->get();
        }
        return view('accounts.index', compact('accounts'));
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
        return view('accounts.create', compact('organisations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();
        $data['updated_by'] = Auth::id();
        $data['active'] = $request->has('active') ? 1 : 0;

        Account::create($data);

        return redirect()->route('accounts')->with('success', 'Account added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $account = Account::findOrFail($id);

        return view('accounts.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $account = Account::findOrFail($id);
        $user = Auth::user();

        if ($user->role === 'main_admin') {
            $organisations = Organisation::orderBy('created_at', 'DESC')->get();
        } elseif ($user->role === 'super_admin') {
            $organisations = Organisation::where('created_by', $user->id)->orderBy('created_at', 'DESC')->get();
        }
        return view('accounts.edit', compact('account', 'organisations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountRequest $request, string $id)
    {
        $data = $request->validated();
        $account = Account::findOrFail($id);

        $data['active'] = $request->has('active') ? 1 : 0;

        $account->update($data);

        return redirect()->route('accounts')->with('success', 'Account updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        return redirect()->route('accounts')->with('success', 'Account deleted successfully');
    }

    public function getAccountsByOrganisation($organisationId)
    {
        // Retrieve the organisation
        $organisation = Organisation::findOrFail($organisationId);

        // Fetch accounts related to the organisation
        $accounts = $organisation->accounts()->select('id', 'name')->get();

        // Return the accounts as JSON response
        return response()->json($accounts);
    }
}
