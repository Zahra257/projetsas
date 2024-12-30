@extends('layouts.app')

@section('title', 'User Details')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col">
                    @foreach ($ticketdetailslist as $ticket)
                        <div class="card mb-3">
                            <div class="card-body">
                                <ul class="list-unstyled" style="background-color: #eee;">
                                    <li class="d-flex justify-content-between container py-5">
                                        <img src="{{ asset('storage/' . $ticket->creator->imageUrl ?? '/storage/users/profile.png') }}"
                                            alt="avatar"
                                            class="rounded-circle d-flex align-self-start me-3 shadow-1-strong"
                                            width="60">
                                        <div class="card w-100">
                                            <div class="card-header d-flex justify-content-between p-3">
                                                <p class="fw-bold mb-0">{{ $ticket->creator->lastname }}</p>
                                                <p class="text-muted small mb-0"><i class="far fa-clock"></i>
                                                    {{ $ticket->created_at }}</p>
                                            </div>
                                            <div class="card-body">
                                                <p class="mb-0">
                                                    {{ $ticket->description }}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    @foreach ($ticket->listdetailsticket as $ticketdetails)
                                        <section style="background-color: #eee;">
                                            <div class="container py-5">
                                                <div class="row">
                                                    @if ($ticketdetails->creatormsg->role == 'operator')
                                                        <li class="d-flex justify-content-between mb-4">
                                                            <div class="card w-100">
                                                                <div class="card-header d-flex justify-content-between p-3">
                                                                    <p class="fw-bold mb-0">
                                                                        {{ $ticketdetails->creatormsg->firstname }}</p>
                                                                    <p class="text-muted small mb-0"><i
                                                                            class="far fa-clock"></i>
                                                                        {{ $ticketdetails->created_at }}</p>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="mb-0"> {{ $ticketdetails->message }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <img src="{{ asset('storage/' . $ticketdetails->creatormsg->imageUrl ?? '/storage/users/profile.png') }}"
                                                                alt="avatar"
                                                                class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong"
                                                                width="60">
                                                        </li>
                                                    @endif
                                                    @if ($ticketdetails->creatormsg->role == 'user')
                                                        <li class="d-flex justify-content-between mb-4">
                                                            <img src="{{ asset('storage/' . ($ticketdetails->creatormsg->imageUrl ?? 'avatars/default.png')) }}"
                                                                alt="avatar"
                                                                class="rounded-circle d-flex align-self-start me-3 shadow-1-strong"
                                                                width="60">
                                                            <div class="card w-100">
                                                                <div class="card-header d-flex justify-content-between p-3">
                                                                    <p class="fw-bold mb-0">
                                                                        {{ $ticketdetails->creatormsg->firstname }}</p>
                                                                    <p class="text-muted small mb-0"><i
                                                                            class="far fa-clock"></i>
                                                                        {{ $ticketdetails->created_at }}</p>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="mb-0">{{ $ticketdetails->message }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endif
                                                </div>
                                            </div>
                                        </section>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
