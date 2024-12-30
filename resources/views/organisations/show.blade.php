@extends('layouts.app')

@section('title', 'Edit Organisation')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> </h4>

            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Organisation Details</h4>
                            <a href="{{ route('organisations') }}" class="btn btn-primary float-end">Back</a>
                        </div>
                        <div class="card-body">

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Company</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-company" placeholder=""
                                        value="{{ $organisation->name }}"readonly />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Code</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-company" name="code"
                                        value="{{ $organisation->code }}"readonly />

                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-date-input" class="col-md-2 col-form-label">First activation date</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="date" name="first_activation_date"
                                        id="html5-date-input" value="{{ $organisation->first_activation_date }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-date-input" class="col-md-2 col-form-label">Activation date</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="date" name="activation_date" id=""
                                        value="{{ $organisation->activation_date }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-date-input" class="col-md-2 col-form-label">Expiration date</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="date" name="expiration_date" id=""
                                        value="{{ $organisation->expiration_date }}" readonly />
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="visible3" name="active"
                                            disabled {{ $organisation->active ? 'checked' : '' }} />
                                        <label class="form-check-label fw-bold" for="visible3">
                                            active
                                        </label>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
                <!-- Basic with Icons -->

            </div>
        </div>
        <!-- / Content -->
    @endsection
