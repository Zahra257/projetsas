<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organisation;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'main_admin') {
            $users = User::with('organization')->orderBy('created_at', 'DESC')->get();
        } elseif ($user->role === 'super_admin') {
            $organisationIds = Organisation::where('created_by', $user->id)->pluck('id');
            $users = User::with('organization')
                        ->whereIn('organisationId', $organisationIds)
                        ->get();
        }

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        
        if ($user->role === 'main_admin') {
            $org = Organisation::with('accounts')->orderBy('created_at', 'DESC')->get();
        } elseif ($user->role === 'super_admin') {
            $org = Organisation::with('accounts')->where('created_by', $user->id)->orderBy('created_at', 'DESC')->get();
        }
        return view('users.create', compact('org'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        if (Auth::check()) {
            $data = $request->validated();
            $userId = Auth::id();
            $active = $request->has('active') ? 1 : 0;
            $organisationId = $request->organisation ?? null;
            $accountId = $request->account_id ?? null;

            User::create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
                'organisationId' => $organisationId,
                'account_id' => $accountId,
                'active' => $active,
                'phone' => $data['phone'],
                'birthday' => $data['birthday'],
                'created_by' => $userId,
                'updated_by' => $userId,
                'imageUrl' => $data['imageUrl'] ?? null,
            ]);

            return redirect()->route('users')->with('success', 'User added successfully');
        } else {
            return redirect()->back()->with('error', 'User is not authenticated');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();

        if ($user->role === 'main_admin') {
            $org =  Organisation::with('accounts')->orderBy('created_at', 'DESC')->get();
        } elseif ($user->role === 'super_admin') {
            $org =  Organisation::with('accounts')->where('created_by', $user->id)->orderBy('created_at', 'DESC')->get();
        }
        $user = User::with('organization', 'accountId')->findOrFail($id);

        return view('users.edit', compact('user', 'org'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        if (Auth::check()) {
            $data = $request->validated();
            $userId = Auth::id();
            $active = $request->has('active') ? 1 : 0;
            $accountId = $request->account_id ?? null;

            $user = User::findOrFail($id);

            $updateData = [
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'role' => $data['role'],
                'organisationId' => $data['organisationId'],
                'account_id' => $accountId,
                'active' => $active,
                'phone' => $data['phone'],
                'birthday' => $data['birthday'],
                'updated_by' => $userId,
                'imageUrl' => $data['imageUrl'] ?? null,
            ];

            if (!empty($data['password'])) {
                $updateData['password'] = Hash::make($data['password']);
            }

            $user->update($updateData);

            return redirect()->route('users')->with('success', 'User updated successfully');
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users')->with('success', 'User deleted successfully');
    }
}
