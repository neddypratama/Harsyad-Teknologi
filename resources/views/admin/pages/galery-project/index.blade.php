@extends('admin.layouts.app')

@section('breadcrump')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Portofolio Pages</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Galery Project</h6>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @include('admin.alerts.success')
        @include('admin.alerts.error')
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between pb-0">
                <h6>Galery Table</h6>
                <!-- Button trigger modal -->
                {{-- <button type="button" class="btn bg-gradient-primary btn-block mb-3" data-bs-toggle="modal" data-bs-target="#addgalery">
                    Add Galery
                </button> --}}
            </div>
            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('galery.index') }}" class="d-flex flex-wrap ms-4">
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Galery Project</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="{{ asset('storage/'. $d->galery_name ) }}" class="avatar avatar-sm me-3" alt="user1">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            @foreach ($project as $p)
                                                @if ($p->project_id === $d->project_id)
                                                    <h6 class="mb-0 text-sm">{{ $p->project_name }}</h6>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          action
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="dropdown-item show-button" data-bs-toggle="modal"
                                                data-bs-target="#showModal" data-name="{{ $d->galery_name }}" >
                                                Show
                                            </button>
                                            <button type="button" class="dropdown-item edit-button" data-bs-toggle="modal"
                                                data-bs-target="#editgalery" data-id="{{ $d->galery_id }}" data-name="{{ $d->galery_name }}" 
                                                data-project="{{ $d->project_id }}" data-url="{{ url('galery/'. $d->galery_id) }}">
                                                Edit
                                            </button>
                                            <button type="button" class="dropdown-item delete-button" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $d->galery_id }}" data-url="{{ url('galery/'. $d->galery_id) }}">
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

    <!-- Modal Add galery-->
    <div class="modal fade" id="addgalery" tabindex="-1" aria-labelledby="addgaleryTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Galery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('galery.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Project Galery -->
                        <div class="form-group{{ $errors->has('galery_name') ? ' has-danger' : '' }}">
                            <label for="galery_name" class="col-form-label">Project Image: </label>
                            <input type="file" name="galery_name[]" id="galery_name"
                                class="form-control{{ $errors->has('galery_name[]') ? ' is-invalid' : '' }}"
                                placeholder="Project Image" value="{{ old('galery_name[]') }}">
                            @if ($errors->has('galery_name[]'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('galery_name[]') }}
                                </span>
                            @endif
                        </div>

                        <!-- Project Name -->
                        <div class="form-group">
                            <label for="project_id" class="col-form-label">Project Name: </label>
                            <select name="project_id" class="form-control {{ $errors->has('project_id') ? ' is-invalid' : '' }}" id="project_id">
                                <option value="">- Project -</option>
                                @foreach ($project as $p)
                                    <option value="{{ $p->project_id }}" {{ old('project_id') == $p->project_id ? 'selected' : '' }}>
                                        {{ $p->project_name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('project_id'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('project_id') }}
                                </span>
                            @endif
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Add Galery</button>
                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Edit galery -->
    <div class="modal fade" id="editgalery" tabindex="-1" aria-labelledby="editgaleryTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editgaleryTitle">Edit Galery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="" id="editgaleryForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Project Galery -->
                        <div class="form-group{{ $errors->has('edit_galery_name') ? ' has-danger' : '' }}">
                            <label for="edit-galery-name" class="col-form-label">Project Image: </label>
                            <input type="file" name="edit_galery_name" id="edit-galery-name"
                                class="form-control{{ $errors->has('edit_galery_name') ? ' is-invalid' : '' }}"
                                placeholder="Project Image" value="{{ old('edit_galery_name') }}">
                                <img id="current-icon" src="" alt="Current Icon" style="max-width: 100px; margin-top: 10px; display: none;">
                            @if ($errors->has('edit_galery_name'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_galery_name') }}
                                </span>
                            @endif
                        </div>

                        <!-- Project Name -->
                        <div class="form-group">
                            <label for="edit-project-id" class="col-form-label">Project Name: </label>
                            <select name="edit_project_id" class="form-control {{ $errors->has('edit_project_id') ? ' is-invalid' : '' }}" id="edit-project-id">
                                <option value="">- Project -</option>
                                @foreach ($project as $p)
                                    <option value="{{ $p->project_id }}" {{ old('edit_project_id') == $p->project_id ? 'selected' : '' }}>
                                        {{ $p->project_name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('edit_project_id'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_project_id') }}
                                </span>
                            @endif
                        </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Update Galery</button>
                </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete galery -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete Galery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deletegaleryForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Show galery -->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModal" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="modal-title-default">Show Image Project</h6>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body text-center">
                <img id="current-image" src="" alt="Current Image" class="img-fluid rounded">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
@endsection

@stack('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check and show the addgalery modal if there are errors for add galery
        if ({{ $errors->has('galery_name') || $errors->has('project_id') ? 'true' : 'false' }}) {
            var addgaleryModal = new bootstrap.Modal(document.getElementById('addgalery'));
            addgaleryModal.show();
            console.log(@json($errors->all()));
        }

        // Check and show the editgalery modal if there are errors for edit galery
        if ({{ $errors->has('edit_galery_name') || $errors->has('edit_project_id') ? 'true' : 'false' }}) {
            var editgaleryModal = new bootstrap.Modal(document.getElementById('editgalery'));
            var url = localStorage.getItem('Url');
            var image = localStorage.getItem('Image');

            editgaleryModal.show();

            $('#editgaleryForm').attr('action', url);
            var iconImage = $('#current-icon');
            iconImage.attr('src', 'storage/' + image);
            iconImage.show();

            console.log(url);
            console.log(image);
            console.log(@json($errors->all()));
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var galeryId = this.getAttribute('data-id');
                var galeryName = this.getAttribute('data-name');
                var galeryDetail = this.getAttribute('data-project');
                var actionUrl = this.getAttribute('data-url');
                localStorage.setItem('Url', actionUrl);
                localStorage.setItem('Image', galeryName);

                console.log(actionUrl);

                $('#edit-galery-id').val(galeryId);
                $('#edit-project-id').val(galeryDetail);

                // Update gambar ikon jika ada
                var iconImage = $('#current-icon');
                if (galeryName) {
                    iconImage.attr('src', 'storage/' + galeryName); // Menggabungkan string dengan benar
                    iconImage.show(); // Menampilkan gambar jika ada
                } else {
                    iconImage.hide(); // Menyembunyikan gambar jika tidak ada
                }

                // Atur action form untuk update
                $('#editgaleryForm').attr('action', actionUrl);
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var showButtons = document.querySelectorAll('.show-button');

        showButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var galeryName = this.getAttribute('data-name');

                // Update gambar ikon jika ada
                var iconImage = $('#current-image');
                if (galeryName) {
                    iconImage.attr('src', 'storage/' + galeryName); // Menggabungkan string dengan benar
                    iconImage.show(); // Menampilkan gambar jika ada
                } else {
                    iconImage.hide(); // Menyembunyikan gambar jika tidak ada
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Ketika tombol delete diklik
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                // Ambil data dari atribut data-*
                var galeryId = this.getAttribute('data-id');
                var galeryDeleteUrl = this.getAttribute('data-url');

                // Atur action form untuk delete
                document.getElementById('deletegaleryForm').setAttribute('action', galeryDeleteUrl);
            });
        });
    });

</script>


