@extends('admin.layouts.app')

@section('breadcrump')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Home Pages</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Form</h6>
    @endsection

    @section('content')
        <div class="row">
            <div class="col-12">
                @include('admin.alerts.success')
                @include('admin.alerts.error')
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h6>Form Table</h6>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn bg-gradient-primary btn-block mb-3" data-bs-toggle="modal"
                            data-bs-target="#addForm">
                            Add Form
                        </button>
                    </div>
                    <!-- Form Pencarian -->
                    <form method="GET" action="{{ route('form.index') }}" class="d-flex flex-wrap ms-4">
                        <div class="form-group me-2 flex-grow-1">
                            <input type="text" name="search" class="form-control form-control-sm"
                                placeholder="Search by name or email" value="{{ request()->get('search') }}">
                        </div>

                        <div class="form-group me-2 flex-grow-1 ">
                            <select name="view" class="form-select form-control-sm">
                                <option value="paginated" {{ request()->get('view') === 'paginated' ? 'selected' : '' }}>
                                    Pages</option>
                                <option value="all" {{ request()->get('view') === 'all' ? 'selected' : '' }}>All</option>
                            </select>
                        </div>

                        <div class="form-group me-2 flex-grow-1">
                            <select name="perPage" class="form-select form-control-sm"
                                {{ request()->get('view') === 'all' ? 'disabled' : '' }}>
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Author</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            No Telepon</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            form Description</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $d->form_name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $d->email }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs text-dark mb-0">{{ $d->no_telp }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 text-wrap">
                                                    {{ $d->form_description }}</p>
                                            </td>
                                            <td>
                                                <div class="btn-group dropend">
                                                    <button type="button" class="btn btn-sm dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item edit-button"
                                                            data-bs-toggle="modal" data-bs-target="#editform"
                                                            data-id="{{ $d->form_id }}" data-name="{{ $d->form_name }}"
                                                            data-email="{{ $d->email }}"
                                                            data-telp="{{ $d->no_telp }}"
                                                            data-description="{{ $d->form_description }}"
                                                            data-url="{{ url('form/' . $d->form_id) }}">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="dropdown-item delete-button"
                                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                            data-id="{{ $d->form_id }}"
                                                            data-url="{{ url('form/' . $d->form_id) }}">
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
                                            <a class="page-link" href="{{ $data->previousPageUrl() }}" rel="prev"><i
                                                    class="ni ni-bold-left"></i></a>
                                        </li>
                                    @endif

                                    @foreach ($data->links()->elements[0] as $page => $url)
                                        @if ($page == $data->currentPage())
                                            <li class="page-item active"><span
                                                    class="page-link text-light fw-bold">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link text-light fw-bold"
                                                    href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach

                                    @if ($data->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $data->nextPageUrl() }}" rel="next"><i
                                                    class="ni ni-bold-right"></i></a>
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

        <!-- Modal Add form-->
        <div class="modal fade" id="addForm" tabindex="-1" aria-labelledby="addFormTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="POST" action="{{ route('form.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Name Author -->
                            <div class="form-group{{ $errors->has('form_name') ? ' has-danger' : '' }}">
                                <label for="form_name" class="col-form-label">Name: </label>
                                <input type="text" name="form_name" id="form_name"
                                    class="form-control{{ $errors->has('form_name') ? ' is-invalid' : '' }}"
                                    placeholder="Name" value="{{ old('form_name') }}">
                                @if ($errors->has('form_name'))
                                    <span class="invalid-form" role="alert">
                                        {{ $errors->first('form_name') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Email -->
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label for="email" class="col-form-label">Email: </label>
                                <input type="email" name="email" id="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    placeholder="Email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="invalid-company" role="alert">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Description -->
                            <div class="form-group{{ $errors->has('form_description') ? ' has-danger' : '' }}">
                                <label for="form_description" class="col-form-label">Description: </label>
                                <textarea type="text" name="form_description" id="form_description"
                                    class="form-control{{ $errors->has('form_description') ? ' is-invalid' : '' }}" placeholder="Description">{{ old('form_description') }}</textarea>
                                @if ($errors->has('form_description'))
                                    <span class="invalid-form" role="alert">
                                        {{ $errors->first('form_description') }}
                                    </span>
                                @endif
                            </div>

                            <!-- No Telepon -->
                            <div class="form-group{{ $errors->has('no_telp') ? ' has-danger' : '' }}">
                                <label for="no_telp" class="col-form-label">No Telepon: </label>
                                <input type="tel" name="no_telp" id="no_telp"
                                    class="form-control{{ $errors->has('no_telp') ? ' is-invalid' : '' }}"
                                    placeholder="No. Telepon"  value="{{ old('no_telp') }}"
                                    pattern="[0-9]{12,13}"  required>
                                @if ($errors->has('no_telp'))
                                    <span class="invalid-company" role="alert">
                                        {{ $errors->first('no_telp') }}
                                    </span>
                                @endif
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Add form</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit form -->
        <div class="modal fade" id="editform" tabindex="-1" aria-labelledby="editformTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editformTitle">Edit form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="POST" action="" id="editformForm"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div class="form-group{{ $errors->has('edit_form_name') ? ' has-danger' : '' }}">
                                <label for="edit-form-name" class="col-form-label">Name: </label>
                                <input type="text" name="edit_form_name" id="edit-form-name"
                                    class="form-control{{ $errors->has('edit_form_name') ? ' is-invalid' : '' }}"
                                    placeholder="Name Author" value="{{ old('edit_form_name') }}">
                                @if ($errors->has('edit_form_name'))
                                    <span class="invalid-form" role="alert">
                                        {{ $errors->first('edit_form_name') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Email -->
                            <div class="form-group{{ $errors->has('edit_email') ? ' has-danger' : '' }}">
                                <label for="edit-form-name" class="col-form-label">Email: </label>
                                <input type="email" name="edit_email" id="edit-email"
                                    class="form-control{{ $errors->has('edit_email') ? ' is-invalid' : '' }}"
                                    placeholder="Email" value="{{ old('edit_email') }}">
                                @if ($errors->has('edit_email'))
                                    <span class="invalid-form" role="alert">
                                        {{ $errors->first('edit_email') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Description -->
                            <div class="form-group{{ $errors->has('edit_form_description') ? ' has-danger' : '' }}">
                                <label for="edit-form-description" class="col-form-label">Description: </label>
                                <textarea type="text" name="edit_form_description" id="edit-form-description"
                                    class="form-control{{ $errors->has('edit_form_description') ? ' is-invalid' : '' }}" placeholder="Description">{{ old('edit_form_description') }}</textarea>
                                @if ($errors->has('edit_form_description'))
                                    <span class="invalid-form" role="alert">
                                        {{ $errors->first('edit_form_description') }}
                                    </span>
                                @endif
                            </div>


                            <!-- No Telepon -->
                            <div class="form-group{{ $errors->has('edit_no_telp') ? ' has-danger' : '' }}">
                                <label for="edit-no-telp" class="col-form-label">No Telepon: </label>
                                <input type="text" name="edit_no_telp" id="edit-no-telp"
                                    class="form-control{{ $errors->has('edit_no_telp') ? ' is-invalid' : '' }}"
                                    placeholder="No Telepon" value="{{ old('edit_no_telp') }}" pattern="[0-9]{12,13}">
                                @if ($errors->has('edit_no_telp'))
                                    <span class="invalid-form" role="alert">
                                        {{ $errors->first('edit_no_telp') }}
                                    </span>
                                @endif
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Update form</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Delete form -->
        <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Delete form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure to delete data?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form id="deleteformForm" method="POST">
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
            // Check and show the addForm modal if there are errors for add form
            if (
                {{ $errors->has('form_name') || $errors->has('form_description') || $errors->has('no_telp') || $errors->has('email') ? 'true' : 'false' }}) {
                var addFormModal = new bootstrap.Modal(document.getElementById('addForm'));
                addFormModal.show();
            }

            // Check and show the editform modal if there are errors for edit form
            if (
                {{ $errors->has('edit_form_name') || $errors->has('edit_form_description') || $errors->has('edit_no_telp') || $errors->has('edit_email') ? 'true' : 'false' }}) {
                var editformModal = new bootstrap.Modal(document.getElementById('editform'));
                var url = localStorage.getItem('Url');
                editformModal.show();
                $('#editformForm').attr('action', url);
                console.log(@json($errors->all()));
                console.log(url);
            }
        });


        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.edit-button');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var formId = this.getAttribute('data-id');
                    var formName = this.getAttribute('data-name');
                    var formEmail = this.getAttribute('data-email');
                    var formDetail = this.getAttribute('data-description');
                    var formno_telp = this.getAttribute('data-telp');
                    var actionUrl = this.getAttribute('data-url');
                    localStorage.setItem('Url', actionUrl);

                    console.log(actionUrl);

                    $('#edit-form-id').val(formId);
                    $('#edit-form-name').val(formName);
                    $('#edit-form-description').val(formDetail);
                    $('#edit-email').val(formEmail);
                    $('#edit-no-telp').val(formno_telp);

                    // Atur action form untuk update
                    $('#editformForm').attr('action', actionUrl);
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Ketika tombol delete diklik
            document.querySelectorAll('.delete-button').forEach(function(button) {
                button.addEventListener('click', function() {
                    // Ambil data dari atribut data-*
                    var formId = this.getAttribute('data-id');
                    var formDeleteUrl = this.getAttribute('data-url');

                    // Atur action form untuk delete
                    document.getElementById('deleteformForm').setAttribute('action', formDeleteUrl);
                });
            });
        });
    </script>
