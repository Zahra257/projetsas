<?php
namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ServiceRequest;
use App\Models\Account;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'main_admin') {
            $services = Service::orderBy('created_at', 'DESC')->get();
        } elseif ($user->role === 'super_admin') {

            $organisationIds = Organisation::where('created_by', $user->id)->pluck('id');

            $services = Service::whereIn('organisationId', $organisationIds)
                            ->orderBy('created_at', 'DESC')
                            ->get();
        }

        return view('services.index', compact('services'));
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
        } else {
            $organisations = collect(); 
        }

        $accounts = Account::orderBy('created_at', 'DESC')->get();
        return view('services.create', compact('organisations','accounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();
        $data['updated_by'] = Auth::id();
        $data['expired'] = $request->has('expired') ? 1 : 0;

        Service::create($data);

        return redirect()->route('services')->with('success', 'Service added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::findOrFail($id);

        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);

        $user = Auth::user();
        
        if ($user->role === 'main_admin') {
            $organisations = Organisation::orderBy('created_at', 'DESC')->get();
        } elseif ($user->role === 'super_admin') {
            $organisations = Organisation::where('created_by', $user->id)->orderBy('created_at', 'DESC')->get();
        } else {
            $organisations = collect(); 
        }

        $accounts = Account::orderBy('created_at', 'DESC')->get();
        return view('services.edit', compact('service', 'organisations','accounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, string $id)
    {
        $data = $request->validated();
        $service = Service::findOrFail($id);

        $data['expired'] = $request->has('expired') ? 1 : 0;

        $service->update($data);

        return redirect()->route('services')->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('services')->with('success', 'Service deleted successfully');
    }
}
