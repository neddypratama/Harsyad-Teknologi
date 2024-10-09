@extends('admin.layouts.app')

@section('breadcrump')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Portofolio Pages</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Project</h6>
    @endsection

    @section('content')
        <div class="row">
            <div class="col-12">
                @include('admin.alerts.success')
                @include('admin.alerts.error')
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h6>Project Table</h6>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn bg-gradient-primary btn-block mb-3" data-bs-toggle="modal"
                            data-bs-target="#addproject">
                            Add Project
                        </button>
                    </div>
                    <!-- Form Pencarian -->
                    <form method="GET" action="{{ route('project.index') }}" class="d-flex flex-wrap ms-4">
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
                                            Project Detail</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Project Description</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $d->project_name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $d->project_type }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 text-wrap">
                                                    {{ $d->project_description }}</p>
                                            </td>
                                            <td>
                                                <div class="btn-group dropend">
                                                    <button type="button" class="btn btn-sm dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item edit-button"
                                                            data-bs-toggle="modal" data-bs-target="#editproject"
                                                            data-id="{{ $d->project_id }}"
                                                            data-name="{{ $d->project_name }}"
                                                            data-type="{{ $d->project_type }}"
                                                            data-description="{{ $d->project_description }}"
                                                            data-url="{{ url('project/' . $d->project_id) }}">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="dropdown-item galery-button"
                                                            data-bs-toggle="modal" data-bs-target="#addgalery"
                                                            data-id="{{ $d->project_id }}"
                                                            data-name="{{ $d->project_name }}">
                                                            Galery
                                                        </button>
                                                        <button type="button" class="dropdown-item delete-button"
                                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                            data-id="{{ $d->project_id }}"
                                                            data-url="{{ url('project/' . $d->project_id) }}">
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

        <!-- Modal Add project-->
        <div class="modal fade" id="addproject" tabindex="-1" aria-labelledby="addprojectTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="POST" action="{{ route('project.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Name project -->
                            <div class="form-group{{ $errors->has('project_name') ? ' has-danger' : '' }}">
                                <label for="project_name" class="col-form-label">Name Project: </label>
                                <input type="text" name="project_name" id="project_name"
                                    class="form-control{{ $errors->has('project_name') ? ' is-invalid' : '' }}"
                                    placeholder="Name Project" value="{{ old('project_name') }}">
                                @if ($errors->has('project_name'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('project_name') }}
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="project_type" class="col-form-label">Type Project: </label>
                                <select name="project_type"
                                    class="form-control {{ $errors->has('project_type') ? ' is-invalid' : '' }}"
                                    id="project_type">
                                    <option value="">- Type -</option>
                                    <option value="Website" {{ old('project_type') == 'Website' ? 'selected' : '' }}>
                                        Website</option>
                                    <option value="Mobile" {{ old('project_type') == 'Mobile' ? 'selected' : '' }}>Mobile
                                    </option>
                                    <option value="Game" {{ old('project_type') == 'Game' ? 'selected' : '' }}>Game
                                    </option>
                                    <option value="Desain" {{ old('project_type') == 'Desain' ? 'selected' : '' }}>Desain
                                    </option>
                                    <option value="IT Consultant"
                                        {{ old('project_type') == 'IT Consultant' ? 'selected' : '' }}>IT Consultant
                                    </option>
                                </select>
                                @if ($errors->has('project_type'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('project_type') }}
                                    </span>
                                @endif
                            </div>


                            <!-- Description project -->
                            <div class="form-group{{ $errors->has('project_description') ? ' has-danger' : '' }}">
                                <label for="project_description" class="col-form-label">Description Project: </label>
                                <textarea type="text" name="project_description" id="project_description"
                                    class="form-control{{ $errors->has('project_description') ? ' is-invalid' : '' }}"
                                    placeholder="Description Project">{{ old('project_description') }}</textarea>
                                @if ($errors->has('project_description'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('project_description') }}
                                    </span>
                                @endif
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Add Project</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit project -->
        <div class="modal fade" id="editproject" tabindex="-1" aria-labelledby="editprojectTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editprojectTitle">Edit Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="POST" action="" id="editprojectForm"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Name project -->
                            <div class="form-group{{ $errors->has('edit_project_name') ? ' has-danger' : '' }}">
                                <label for="edit-project-name" class="col-form-label">Name Project: </label>
                                <input type="text" name="edit_project_name" id="edit-project-name"
                                    class="form-control{{ $errors->has('edit_project_name') ? ' is-invalid' : '' }}"
                                    placeholder="Name Project" value="{{ old('edit_project_name') }}">
                                @if ($errors->has('edit_project_name'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('edit_project_name') }}
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="edit-project_type" class="col-form-label">Type Project: </label>
                                <select name="edit_project_type"
                                    class="form-control {{ $errors->has('edit_project_type') ? ' is-invalid' : '' }}"
                                    id="edit-project_type">
                                    {{-- <option value="">- Type -</option> --}}
                                    <option value="Website" {{ old('edit_project_type') == 'Website' ? 'selected' : '' }}>
                                        Website </option>
                                    <option value="Mobile" {{ old('edit_project_type') == 'Mobile' ? 'selected' : '' }}>
                                        Mobile </option>
                                    <option value="Game" {{ old('edit_project_type') == 'Game' ? 'selected' : '' }}>Game
                                    </option>
                                    <option value="Desain" {{ old('edit_project_type') == 'Desain' ? 'selected' : '' }}>
                                        Desain </option>
                                    <option value="IT Consultant"
                                        {{ old('edit_project_type') == 'IT Consultant' ? 'selected' : '' }}>IT Consultant
                                    </option>
                                </select>
                                @if ($errors->has('edit_project_type'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('edit_project_type') }}
                                    </span>
                                @endif
                            </div>


                            <!-- Description project -->
                            <div class="form-group{{ $errors->has('edit_project_description') ? ' has-danger' : '' }}">
                                <label for="edit-project-description" class="col-form-label">Description project: </label>
                                <textarea type="text" name="edit_project_description" id="edit-project-description"
                                    class="form-control{{ $errors->has('edit_project_description') ? ' is-invalid' : '' }}"
                                    placeholder="Description Project">{{ old('edit_project_description') }}</textarea>
                                @if ($errors->has('edit_project_description'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('edit_project_description') }}
                                    </span>
                                @endif
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Update Project</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Add gallery -->
        <div class="modal fade" id="addgalery" tabindex="-1" aria-labelledby="addgaleryTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addgaleryTitle">Add Gallery</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="POST" action="{{ route('galery.store') }}"
                            enctype="multipart/form-data" id="addFormGalery">
                            @csrf

                            <!-- Project Gallery -->
                            <div class="form-group">
                                <label for="galery_name" class="col-form-label">Project Image: </label>
                                <div id="galery-container">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->count() }} errors found:</strong>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="input-group mb-2 galery-input">
                                        <input type="file" name="galery_name[]" id="galery_name"
                                            class="form-control{{ $errors->has('galery_name.*') ? ' is-invalid' : '' }}"
                                            multiple required style="height: 39px">
                                        <button type="button" class="btn btn-outline-danger btn remove-input">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 mt-3">
                                    <button type="button" class="btn btn-block btn-success" id="add-input">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Project Name -->
                            <div class="form-group">
                                <label for="project_name" class="col-form-label">Project Name: </label>
                                <input type="text" name="project_name" id="project-name"
                                    class="form-control{{ $errors->has('project_name') ? ' is-invalid' : '' }}"
                                    placeholder="Name Project" value="{{ old('project_name') }}" readonly>
                            </div>

                            <!-- Project ID -->
                            <div class="form-group">
                                <input type="text" name="project_id" id="project_id" value="{{ old('project_id') }}"
                                    hidden>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Add Gallery</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Delete project -->
        <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Delete Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure to delete data?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form id="deleteprojectForm" method="POST">
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
            // Check and show the addproject modal if there are errors for add project
            if (@json($errors->has('project_name') || $errors->has('project_description') || $errors->has('project_type'))) {
                var addprojectModal = new bootstrap.Modal(document.getElementById('addproject'));
                addprojectModal.show();
            }

            // Check and show the addgalery modal if there are errors for add gallery
            if (@json($errors->has('galery_name.*') || $errors->has('project_id'))) {
                var addgaleryModal = new bootstrap.Modal(document.getElementById('addgalery'));
                addgaleryModal.show();
                const errors = @json($errors->all());
                if (errors.length > 0) {
                    console.log(`Found ${errors.length} errors:`);
                    console.log(errors);
                }
            }

            // Check and show the editproject modal if there are errors for edit project
            if (@json($errors->has('edit_project_name') || $errors->has('edit_project_description') || $errors->has('edit_project_type'))) {
                var editprojectModal = new bootstrap.Modal(document.getElementById('editproject'));
                var url = localStorage.getItem('Url');
                editprojectModal.show();
                $('#editprojectForm').attr('action', url);

                console.log(@json($errors->all()));
            }
        });


        document.addEventListener("DOMContentLoaded", function() {
            // Add input functionality
            document.getElementById('add-input').addEventListener('click', function() {
                let container = document.getElementById('galery-container');
                let newInput = document.querySelector('.galery-input').cloneNode(true);
                newInput.querySelector('input').value = ''; // Clear input value
                container.appendChild(newInput);
            });

            // Remove input functionality
            document.getElementById('galery-container').addEventListener('click', function(e) {
                if (e.target.closest('.remove-input')) {
                    let inputGroup = e.target.closest('.galery-input');
                    if (document.querySelectorAll('.galery-input').length > 1) {
                        inputGroup.remove(); // Remove only if there is more than one input
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.galery-button');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var projectId = this.getAttribute('data-id');
                    var projectName = this.getAttribute('data-name');
                    console.log(projectName);


                    $('#project_id').val(projectId);
                    $('#project-name').val(projectName);
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.edit-button');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var projectId = this.getAttribute('data-id');
                    var projectName = this.getAttribute('data-name');
                    var projectType = this.getAttribute('data-type');
                    var projectDetail = this.getAttribute('data-description');
                    var actionUrl = this.getAttribute('data-url');
                    localStorage.setItem('Url', actionUrl);

                    console.log(actionUrl);

                    $('#edit-project-id').val(projectId);
                    $('#edit-project-name').val(projectName);
                    $('#edit-project-description').val(projectDetail);
                    $('#edit-project-type').val(projectType);

                    // Atur action form untuk update
                    $('#editprojectForm').attr('action', actionUrl);
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Ketika tombol delete diklik
            document.querySelectorAll('.delete-button').forEach(function(button) {
                button.addEventListener('click', function() {
                    // Ambil data dari atribut data-*
                    var projectId = this.getAttribute('data-id');
                    var projectDeleteUrl = this.getAttribute('data-url');

                    // Atur action form untuk delete
                    document.getElementById('deleteprojectForm').setAttribute('action',
                        projectDeleteUrl);
                });
            });
        });
    </script>
