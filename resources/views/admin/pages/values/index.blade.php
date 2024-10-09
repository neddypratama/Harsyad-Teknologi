@extends('admin.layouts.app')

@section('breadcrump')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">About Pages</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Values</h6>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @include('admin.alerts.success')
        @include('admin.alerts.error')
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between pb-0">
                <h6>Values Table</h6>
                <!-- Button trigger modal -->
                <button type="button" class="btn bg-gradient-primary btn-block mb-3" data-bs-toggle="modal" data-bs-target="#addvalues">
                    Add Values
                </button>
            </div>
            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('values.index') }}" class="d-flex flex-wrap ms-4">
                <div class="form-group me-2 flex-grow-1">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by name or email" value="{{ request()->get('search') }}">
                </div>
                
                <div class="form-group me-2 flex-grow-1 ">
                    <select name="view" class="form-select form-control-sm">
                        <option value="paginated" {{ request()->get('view') === 'paginated' ? 'selected' : '' }}>Pages</option>
                        <option value="all" {{ request()->get('view') === 'all' ? 'selected' : '' }}>All</option>
                    </select>
                </div>

                <div class="form-group me-2 flex-grow-1">
                    <select name="perPage" class="form-select form-control-sm" {{ request()->get('view') === 'all' ? 'disabled' : '' }}>
                        <option value="2" {{ request()->get('perPage') == 5 ? 'selected' : '' }}>5</option>
                        <option value="25" {{ request()->get('perPage') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request()->get('perPage') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </div>

                <div class="form-group me-2">
                    <button type="submit" class="btn btn-sm btn-secondary">Apply</button>
                </div>
            </form>

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Values Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Values Detail</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                            <tr>
                                <td>
                                    <p class="mb-0 ms-3 text-sm text-wrap">{{ $d->short_name }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0 text-wrap">{{ $d->values_name }}</p>
                                    <p class="text-xs font-weight-bold mb-0 text-wrap">{{ $d->values_description }}</p>
                                </td>
                                <td>
                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          action
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="dropdown-item edit-button" data-bs-toggle="modal"
                                                data-bs-target="#editvalues" data-id="{{ $d->values_id }}" data-name="{{ $d->values_name }}" data-short="{{ $d->short_name }}" 
                                                data-description="{{ $d->values_description }}" data-url="{{ url('values/'. $d->values_id) }}">
                                                Edit
                                            </button>
                                            <button type="button" class="dropdown-item delete-button" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $d->values_id }}" data-url="{{ url('values/'. $d->values_id) }}">
                                                Delete
                                            </button>
                                          </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer py-4">
                <nav aria-label="Page navigation">
                    @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <ul class="pagination justify-content-center">
                            @if ($data->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="ni ni-bold-left"></i></span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $data->previousPageUrl() }}" rel="prev"><i class="ni ni-bold-left"></i></a>
                                </li>
                            @endif
            
                            @foreach ($data->links()->elements[0] as $page => $url)
                                @if ($page == $data->currentPage())
                                    <li class="page-item active"><span class="page-link text-light fw-bold">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link text-light fw-bold" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
            
                            @if ($data->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $data->nextPageUrl() }}" rel="next"><i class="ni ni-bold-right"></i></a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="ni ni-bold-right"></i></span>
                                </li>
                            @endif
                        </ul>
                    @endif
                </nav>
            </div>
        </div>
    </div>
</div>

    <!-- Modal Add values-->
    <div class="modal fade" id="addvalues" tabindex="-1" aria-labelledby="addvaluesTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Values</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('values.store') }}" enctype="multipart/form-data">
                    @csrf

                            <!-- Name values -->
                            <div class="form-group{{ $errors->has('values_name') ? ' has-danger' : '' }}">
                                <label for="values_name" class="col-form-label">Name Values: </label>
                                <input type="text" name="values_name" id="values_name"
                                    class="form-control{{ $errors->has('values_name') ? ' is-invalid' : '' }}"
                                    placeholder="Name Values" value="{{ old('values_name') }}">
                                @if ($errors->has('values_name'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('values_name') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Name values -->
                            <div class="form-group{{ $errors->has('short_name') ? ' has-danger' : '' }}">
                                <label for="short_name" class="col-form-label">Short Name: </label>
                                <input type="text" name="short_name" id="short_name"
                                    class="form-control{{ $errors->has('short_name') ? ' is-invalid' : '' }}"
                                    placeholder="Short Name" value="{{ old('short_name') }}">
                                @if ($errors->has('short_name'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('short_name') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Detail values -->
                            <div class="form-group{{ $errors->has('values_description') ? ' has-danger' : '' }}">
                                <label for="values_description" class="col-form-label">Description Values: </label>
                                <textarea name="values_description" id="values_description" 
                                    class="form-control{{ $errors->has('values_description') ? ' is-invalid' : '' }}"
                                    placeholder="Description Values" >{{ old('values_description') }}</textarea>
                                @if ($errors->has('values_description'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('values_description') }}
                                    </span>
                                @endif
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Add Values</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit values -->
    <div class="modal fade" id="editvalues" tabindex="-1" aria-labelledby="editvaluesTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editvaluesTitle">Edit Values</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="" id="editvaluesForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name values -->
                        <div class="form-group{{ $errors->has('edit_values_name') ? ' has-danger' : '' }}">
                            <label for="edit-values-name" class="col-form-label">Name values: </label>
                            <input type="text" name="edit_values_name" id="edit-values-name"
                                class="form-control{{ $errors->has('edit_values_name') ? ' is-invalid' : '' }}"
                                placeholder="Name values" value="{{ old('edit_values_name') }}">
                            @if ($errors->has('edit_values_name'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_values_name') }}
                                </span>
                            @endif
                        </div>

                        <!-- Name values -->
                        <div class="form-group{{ $errors->has('edit_short_name') ? ' has-danger' : '' }}">
                            <label for="edit-short-name" class="col-form-label">Short Name: </label>
                            <input type="text" name="edit_short_name" id="edit-short-name"
                                class="form-control{{ $errors->has('edit_short_name') ? ' is-invalid' : '' }}"
                                placeholder="Short Name" value="{{ old('edit_short_name') }}">
                            @if ($errors->has('edit_short_name'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_short_name') }}
                                </span>
                            @endif
                        </div>

                        <!-- Description values -->
                        <div class="form-group{{ $errors->has('edit_values_description') ? ' has-danger' : '' }}">
                            <label for="edit-values-description" class="col-form-label">Description Values: </label>
                            <textarea name="edit_values_description" id="edit-values-description" 
                                    class="form-control{{ $errors->has('edit_values_description') ? ' is-invalid' : '' }}"
                                    placeholder="Description Values" >{{ old('edit_values_description') }}</textarea>
                            @if ($errors->has('edit_edit_values_description'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_edit_values_description') }}
                                </span>
                            @endif
                        </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Update Values</button>
                </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete values -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete Values</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deletevaluesForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@stack('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check and show the addvalues modal if there are errors for add values
        if ({{ $errors->has('values_name') || $errors->has('short_name') || $errors->has('values_description') ? 'true' : 'false' }}) {
            var addvaluesModal = new bootstrap.Modal(document.getElementById('addvalues'));
            addvaluesModal.show();
        }

        // Check and show the editvalues modal if there are errors for edit values
        if ({{ $errors->has('edit_values_name') || $errors->has('edit_short_name') || $errors->has('edit_values_description') ? 'true' : 'false' }}) {
            var editvaluesModal = new bootstrap.Modal(document.getElementById('editvalues'));
            var url = localStorage.getItem('Url');
            editvaluesModal.show();
            $('#editvaluesForm').attr('action', url);
            
            console.log(@json($errors->all()));
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var valuesId = this.getAttribute('data-id');
                var valuesName = this.getAttribute('data-name');
                var shortName = this.getAttribute('data-short');
                var valuesDescription = this.getAttribute('data-description');
                var actionUrl = this.getAttribute('data-url');
                localStorage.setItem('Url', actionUrl);

                console.log(actionUrl);

                $('#edit-values-id').val(valuesId);
                $('#edit-values-name').val(valuesName);
                $('#edit-short-name').val(valuesName);
                $('#edit-values-description').val(valuesDescription);

                // Atur action form untuk update
                $('#editvaluesForm').attr('action', actionUrl);
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Ketika tombol delete diklik
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                // Ambil data dari atribut data-*
                var valuesId = this.getAttribute('data-id');
                var valuesDeleteUrl = this.getAttribute('data-url');

                // Atur action form untuk delete
                document.getElementById('deletevaluesForm').setAttribute('action', valuesDeleteUrl);
            });
        });
    });

</script>


