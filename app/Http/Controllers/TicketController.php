<?php

namespace App\Http\Controllers;
use App\Models\Ticket;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $tickets = Ticket::with(['organization', 'operator', 'creator', 'service'])->orderBy('created_at', 'DESC')->get();

        return view('tickets.index' ,compact('tickets'));

    }

    /**
     * Show the form for creating a new resource.
     */
   
    public function show(string $id)
    {
        //
        $ticketdetailslist = Ticket::with(['listdetailsticket.creatormsg', 'creator'])->orderBy('created_at', 'DESC')->get();
        return view('tickets.show' ,compact('ticketdetailslist'));

    }
    public function destroy(string $id)
    {
        //
        $Ticket = Ticket::findOrFail($id);
        $Ticket->delete();
  
        return redirect()->route('tickets')->with('success', 'user deleted successfully');
    
    }

  
}
