@extends('layouts.app')

@section('title', 'Add Organisation')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">
                        <form action="{{ route('organisations.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h4 class="fw-bold"><span class="text-muted fw-light"></span> Add Organisation</h4>
                                <button type="submit" class="btn btn-primary">Add organisation</button>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('code') is-invalid @enderror"
                                            id="basic-default-company" placeholder="ORG-#####" name="code"
                                            value="{{ old('code') }}" />
                                        @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Company</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="basic-default-company" placeholder="Name" name="name"
                                            value="{{ old('name') }}" />
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="html5-date-input" class="col-md-2 col-form-label">First activation
                                        date</label>
                                    <div class="col-md-10">
                                        <input class="form-control @error('first_activation_date') is-invalid @enderror"
                                            type="date" name="first_activation_date" id="html5-date-input"
                                            value="{{ old('first_activation_date') }}" />
                                        @error('first_activation_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="html5-date-input" class="col-md-2 col-form-label">Expiration date</label>
                                    <div class="col-md-10">
                                        <input class="form-control @error('expiration_date') is-invalid @enderror"
                                            type="date" name="expiration_date" id="html5-date-input"
                                            value="{{ old('expiration_date') }}" />
                                        @error('expiration_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="visible3" name="active" />
                                            <label class="form-check-label fw-bold" for="visible3">
                                                active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Basic with Icons -->
            </div>
        </div>
        <!-- / Content -->
    @endsection
