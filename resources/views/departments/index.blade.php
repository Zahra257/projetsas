@extends('layouts.app')

@section('title', 'Departments')
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
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Departments</h4>
                <a href="{{ route('departments.create') }}" class="btn btn-primary">
                    Add Department
                </a>
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

                <!-- Error Toast -->
                @if (session('error'))
                    <div class="bs-toast toast toast-placement-ex m-2 fade bg-danger bottom-0 end-0 show" role="alert"
                        aria-live="assertive" aria-atomic="true" id="errorToast">
                        <div class="toast-header">
                            <i class="bx bx-bell me-2"></i>
                            <div class="me-auto fw-semibold">Error</div>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">{{ session('error') }}</div>
                    </div>
                @endif
                <!-- End Error Toast -->
            </div>

            <!-- Hoverable Table rows -->
            <div class="card p-3 ">
                <div class="table-responsive-sm table-responsive-md table-responsive-lg" style="" id="tablediv">
                    <table id="dataTable"class="table p-3 table-hover" style="width:100%">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Department Name</th>
                                <th>Organisation Name</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if ($departments->count() > 0)
                                @foreach ($departments as $department)
                                    <tr>
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td><strong>{{ $department->name }}</strong></td>
                                        <td>{{ $department->organisation->name }}</td>
                                        <td>{{ $department->creator->firstname . ' ' . $department->creator->lastname }}</td>
                                        <td>{{ $department->updater->firstname . ' ' . $department->updater->lastname }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('departments.edit', $department->id) }}">
                                                        <i class="bx bx-edit-alt me-1"></i>Edit
                                                    </a>
                                                    <form action="{{ route('departments.destroy', $department->id) }}"
                                                        class="dropdown-item" method="POST"
                                                        id="deleteform_{{ $department->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div onclick="if (confirm('Delete?')) { document.getElementById('deleteform_{{ $department->id }}').submit(); }"
                                                            style="cursor: pointer;" class="text-danger">
                                                            <i class="bx bx-trash me-1"></i>Delete
                                                        </div>
                                                    </form>
                                                    <a class="dropdown-item"
                                                        href="{{ route('departments.show', $department->id) }}">
                                                        <i class='bx bx-detail'></i> Details
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- @else
                                <tr>
                                    <td colspan="6" class="text-center">No departments found</td>
                                </tr> --}}
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
