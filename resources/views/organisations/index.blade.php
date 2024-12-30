@extends('layouts.app')

@section('title', 'Organisation')
<style>
    /* Custom styling for the search input */
    #dt-search-0 {

        margin-bottom: 10px;
        /* Add some space below the search input */


    }

    #tablediv .pagination {
        margin: 10
    }

    #tablediv th {
        text-align: left;
        vertical-align: top
    }
</style>
@section('content')
    <!-- Layout wrapper -->

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">


            <div class="col-12 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Organisations</h4>
                <a href="{{ route('organisations.create') }}" class="btn btn-primary">
                    Add Organisation
                </a>
                <!-- <button type="button" class="btn btn-primary"></button> -->
                <!-- Message Toast -->
                @if (session('success'))
                    <div class="bs-toast toast toast-placement-ex m-2 fade bg-success bottom-0 end-0 show" role="alert"
                        aria-live="assertive" aria-atomic="true" id="messageToast">
                        <div class="toast-header">
                            <i class="bx bx-bell me-2"></i>
                            <div class="me-auto fw-semibold">Status</div>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">{{ session('success') }}</div>
                    </div>
                @endif
                <!-- End Message Toast -->
            </div>
            <!-- Hoverable Table rows -->
            <div class="card p-3 ">
                <div class="table-responsive-sm table-responsive-md table-responsive-lg" style="" id="tablediv">
                    <table id="dataTable"class="table p-3 table-hover" style="width:100%">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>First activation date</th>
                                <th>Activation date</th>
                                <th>Expiration date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @if ($organisations->count() > 0)
                                @foreach ($organisations as $rs)
                                    <tr>
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $rs->code }}</td>
                                        <td><i class="fab fa-angular fa-lg text-danger"></i>
                                            <strong>{{ $rs->name }}</strong></td>
                                        <td>{{ $rs->first_activation_date }}</td>
                                        <td>
                                            {{ $rs->activation_date }}
                                        </td>
                                        <td>{{ $rs->expiration_date }}</td>
                                        <td>
                                            <span
                                                class="badge bg-label-{{ $rs->active ? 'success' : 'danger' }} me-1">{{ $rs->active ? 'Active' : 'Inactive ' }}</span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('organisation.edit', $rs->id) }}"><i
                                                            class="bx bx-edit-alt me-1"></i>Edit</a>
                                                    <form action="{{ route('organisation.destroy', $rs->id) }}"
                                                        class="dropdown-item" method="POST"
                                                        id="deleteform_{{ $rs->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div onclick="if (confirm('Delete?')) { document.getElementById('deleteform_{{ $rs->id }}').submit(); }"
                                                            style="cursor: pointer;" class="text-danger">
                                                            <i class="bx bx-trash me-1"></i>Delete
                                                        </div>
                                                    </form>
                                                    <a class="dropdown-item"
                                                        href="{{ route('organisation.show', $rs->id) }}"><i
                                                            class='bx bx-detail'></i> Details</a>
                                                </div>

                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Hoverable Table rows -->
        </div>
    </div>
    @include('layouts.table')

@endsection
