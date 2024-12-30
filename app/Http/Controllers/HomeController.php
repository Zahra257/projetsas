<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Account;
use App\Models\Department;
use App\Models\Service;
use App\Models\Organisation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();



        // $organisations = Organisation::orderBy('created_at', 'DESC')->get();
        // $accounts = Account::orderBy('created_at', 'DESC')->get();
        // $tickets = Ticket::with(['organization', 'operator', 'creator'])->orderBy('created_at', 'DESC')->get();
        // $opentickets = Ticket::where('status', 'open')->get();
        // $users = User::with('organization')->orderBy('created_at', 'DESC')->get();
        // $services = Service::orderBy('created_at', 'DESC')->get();// For main_admin, show all data

        if ($user->role === 'main_admin') {
            $organisations = Organisation::orderBy('created_at', 'DESC')->get();
            $accounts = Account::orderBy('created_at', 'DESC')->get();
            $tickets = Ticket::with(['organization', 'operator', 'creator'])->orderBy('created_at', 'DESC')->get();
            $opentickets = Ticket::where('status', 'open')->get();
            $users = User::with('organization')->orderBy('created_at', 'DESC')->get();
            $services = Service::orderBy('created_at', 'DESC')->get();
            $departments = Department::orderBy('created_at', 'DESC')->get();
        } 
        
        elseif ($user->role === 'super_admin') {
            $organisationIds = Organisation::where('created_by', $user->id)->pluck('id');
            
            $organisations = Organisation::where('created_by', $user->id)->get();

            $accounts = Account::whereIn('organisationId', $organisationIds)
                        ->get();
            
            $services = Service::whereIn('organisationId', $organisationIds)
                            ->get();
            $tickets = Ticket::with(['organization', 'operator', 'creator'])
                        ->whereIn('organisationId', $organisationIds)
                        ->get();
            $opentickets = Ticket::where('status', 'open')
                        ->whereIn('organisationId', $organisationIds)
                        ->get();
            $users = User::with('organization')
                        ->whereIn('organisationId', $organisationIds)
                        ->get();
            $departments = Department::whereIn('organisationId', $organisationIds)
            ->get();
        } 
        $organisationsCount = $organisations->count();
        $accountsCount = $accounts->count();
        $ticketsCount = $tickets->count();
        $userCount = $users->count();
        $servicesCount = $services->count();
        $departmentsCount = $departments->count();
        $openticketsCount = $opentickets->count();
        return view('dashboard', compact('organisationsCount','accountsCount','ticketsCount','userCount','servicesCount','departmentsCount','openticketsCount'));
    }
}
