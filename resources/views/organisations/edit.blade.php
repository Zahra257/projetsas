@extends('layouts.app')

@section('title', 'Edit Organisation')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">

            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">
                        <form action="{{ route('organisation.update', $organisation->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h4 class="fw-bold"><span class="text-muted fw-light"></span> Edit organisation</h4>
                                <button type="submit" class="btn btn-primary">Edit organisation</button>

                            </div>
                            <div class="card-body">



                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Company</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="basic-default-company" placeholder=""
                                            name="name" value="{{ $organisation->name }}" />
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('code') is-invalid @enderror"
                                            id="basic-default-company" name="code" value="{{ $organisation->code }}" />
                                        @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="html5-date-input" class="col-md-2 col-form-label">Activation date</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="date" name="activation_date" id=""
                                            value="{{ $organisation->activation_date }}" />
                                        @error('activation_date')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="html5-date-input" class="col-md-2 col-form-label">Expiration date</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="date" name="expiration_date" id=""
                                            value="{{ $organisation->expiration_date }}" />
                                        @error('expiration_date')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="visible3" name="active"
                                                {{ $organisation->active ? 'checked' : '' }} />
                                            <label class="form-check-label fw-bold" for="visible3">
                                                active
                                            </label>
                                        </div>
                                    </div>

                                </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- Basic with Icons -->

        </div>
    </div>
    <!-- / Content -->
@endsection
