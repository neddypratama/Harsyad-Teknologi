@extends('admin.layouts.app')

@section('breadcrump')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">About Pages</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Visi Misi</h6>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @include('admin.alerts.success')
        @include('admin.alerts.error')
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between pb-0">
                <h6>Visi Misi table</h6>
                <!-- Button trigger modal -->
                <button type="button" class="btn bg-gradient-primary btn-block mb-3" data-bs-toggle="modal" data-bs-target="#addvisimisi">
                    Add Visi Misi
                </button>
            </div>
            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('visimisi.index') }}" class="d-flex flex-wrap ms-4">
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Visi Misi Type</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Visi Misi Description</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                            <tr>
                                <td>
                                    <p class="mb-0 text-sm text-wrap">{{ $d->visimisi_type }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0 text-wrap">{{ $d->visimisi_description }}</p>
                                </td>
                                <td>
                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          action
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="dropdown-item edit-button" data-bs-toggle="modal"
                                                data-bs-target="#editvisimisi" data-id="{{ $d->visimisi_id }}" data-type="{{ $d->visimisi_type }}" 
                                                data-description="{{ $d->visimisi_description }}" data-url="{{ url('visimisi/'. $d->visimisi_id) }}">
                                                Edit
                                            </button>
                                            <button type="button" class="dropdown-item delete-button" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $d->visimisi_id }}" data-url="{{ url('visimisi/'. $d->visimisi_id) }}">
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

    <!-- Modal Add visimisi-->
    <div class="modal fade" id="addvisimisi" tabindex="-1" aria-labelledby="addvisimisiTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Visi Misi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('visimisi.store') }}" enctype="multipart/form-data">
                    @csrf

                            <!-- Name visimisi -->
                            <div class="form-group">
                                <label class="col-form-label">Type Visi Misi:</label>
                                <div class="d-flex">
                                    <!-- Visi Radio Button -->
                                    <div class="form-check align-middle me-3">
                                        <input class="form-check-input{{ $errors->has('visimisi_type') ? ' is-invalid' : '' }}" 
                                               type="radio" name="visimisi_type" id="customRadio1" value="Visi"
                                               {{ old('visimisi_type') == 'Visi' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="customRadio1">Visi</label>
                                        @if ($errors->has('visimisi_type'))
                                        <span class="invalid-feedback" role="alert">
                                            {{ $errors->first('visimisi_type') }}
                                        </span>
                                    @endif
                                    </div>
                                    <!-- Misi Radio Button -->
                                    <div class="form-check align-middle">
                                        <input class="form-check-input{{ $errors->has('visimisi_type') ? ' is-invalid' : '' }}" 
                                               type="radio" name="visimisi_type" id="customRadio2" value="Misi"
                                               {{ old('visimisi_type') == 'Misi' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="customRadio2">Misi</label>
                                        @if ($errors->has('visimisi_type'))
                                        <span class="invalid-feedback" role="alert">
                                            {{ $errors->first('visimisi_type') }}
                                        </span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Detail visimisi -->
                            <div class="form-group{{ $errors->has('visimisi_description') ? ' has-danger' : '' }}">
                                <label for="visimisi_description" class="col-form-label">Description Visi Misi: </label>
                                <textarea name="visimisi_description" id="visimisi_description" 
                                    class="form-control{{ $errors->has('visimisi_description') ? ' is-invalid' : '' }}"
                                    placeholder="Description Visi Misi">{{ old('visimisi_description') }}</textarea>
                                @if ($errors->has('visimisi_description'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('visimisi_description') }}
                                    </span>
                                @endif
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Add Visi Misi</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit visimisi -->
    <div class="modal fade" id="editvisimisi" tabindex="-1" aria-labelledby="editvisimisiTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editvisimisiTitle">Edit visimisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="" id="editvisimisiForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name visimisi -->
                        <div class="form-group">
                            <label class="col-form-label">Type Visi Misi:</label>
                            <div class="d-flex">
                                <div class="form-check align-middle me-3">
                                    <input class="form-check-input{{ $errors->has('edit_visimisi_type') ? ' is-invalid' : '' }}" 
                                           type="radio" name="edit_visimisi_type" id="edit-visimisi-type-visi" value="Visi">
                                    <label class="form-check-label" for="edit-visimisi-type-visi">Visi</label>
                                    @if ($errors->has('edit_visimisi_type'))
                                        <span class="invalid-feedback" role="alert">
                                            {{ $errors->first('edit_visimisi_type') }}
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-check align-middle">
                                    <input class="form-check-input{{ $errors->has('edit_visimisi_type') ? ' is-invalid' : '' }}" 
                                           type="radio" name="edit_visimisi_type" id="edit-visimisi-type-misi" value="Misi">
                                    <label class="form-check-label" for="edit-visimisi-type-misi">Misi</label>
                                    @if ($errors->has('edit_visimisi_type'))
                                        <span class="invalid-feedback" role="alert">
                                            {{ $errors->first('edit_visimisi_type') }}
                                        </span>
                                    @endif
                                </div>                                
                            </div>
                        </div>

                        <!-- Description visimisi -->
                        <div class="form-group{{ $errors->has('edit_visimisi_description') ? ' has-danger' : '' }}">
                            <label for="edit-visimisi-description" class="col-form-label">Description Visi Misi: </label>
                            <textarea name="edit_visimisi_description" id="edit-visimisi-description" 
                                class="form-control{{ $errors->has('edit_visimisi_description') ? ' is-invalid' : '' }}"
                                placeholder="Description Visi Misi">{{ old('edit_visimisi_description') }}</textarea>
                            @if ($errors->has('edit_edit_visimisi_description'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_edit_visimisi_description') }}
                                </span>
                            @endif
                        </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Update Visi Misi</button>
                </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete visimisi -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete Visi Misi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deletevisimisiForm" method="POST">
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
        // Check and show the addvisimisi modal if there are errors for add visimisi
        if ({{ $errors->has('visimisi_type') || $errors->has('visimisi_description') ? 'true' : 'false' }}) {
            var addvisimisiModal = new bootstrap.Modal(document.getElementById('addvisimisi'));
            addvisimisiModal.show();
            console.log(@json($errors->all()));
        }

        // Check and show the editvisimisi modal if there are errors for edit visimisi
        if ({{ $errors->has('edit_visimisi_type') || $errors->has('edit_visimisi_description') ? 'true' : 'false' }}) {
            var editvisimisiModal = new bootstrap.Modal(document.getElementById('editvisimisi'));
            var url = localStorage.getItem('Url');
            editvisimisiModal.show();
            $('#editvisimisiForm').attr('action', url);
            
            console.log(@json($errors->all()));
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var visimisiId = this.getAttribute('data-id');
                var visimisitype = this.getAttribute('data-type');
                var visimisiDetail = this.getAttribute('data-description');
                var actionUrl = this.getAttribute('data-url');
                localStorage.setItem('Url', actionUrl);

                console.log(actionUrl);

                $('#edit-visimisi-id').val(visimisiId);
                $('#edit-visimisi-description').val(visimisiDetail);

                $// Check radio button berdasarkan nilai dari 'data-type'
                if (visimisitype === 'Visi') {
                    $('#edit-visimisi-type-visi').prop('checked', true);
                } else if (visimisitype === 'Misi') {
                    $('#edit-visimisi-type-misi').prop('checked', true);
                }

                // Atur action form untuk update
                $('#editvisimisiForm').attr('action', actionUrl);
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Ketika tombol delete diklik
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                // Ambil data dari atribut data-*
                var visimisiId = this.getAttribute('data-id');
                var visimisiDeleteUrl = this.getAttribute('data-url');

                // Atur action form untuk delete
                document.getElementById('deletevisimisiForm').setAttribute('action', visimisiDeleteUrl);
            });
        });
    });

</script>


