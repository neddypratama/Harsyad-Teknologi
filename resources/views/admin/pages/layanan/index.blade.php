@extends('admin.layouts.app')

@section('breadcrump')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Service Pages</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Detail Service</h6>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @include('admin.alerts.success')
        @include('admin.alerts.error')
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between pb-0">
                <h6>Detail Service Table</h6>
                <!-- Button trigger modal -->
                <button type="button" class="btn bg-gradient-primary btn-block mb-3" data-bs-toggle="modal" data-bs-target="#addlayanan">
                    Add Detail Service
                </button>
            </div>
            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('layanan.index') }}" class="d-flex flex-wrap ms-4">
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Detail Service Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Detail Service Description</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                            <tr>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $d->layanan_name }}</h6>
                                        @foreach ($service as $p)
                                            @if ($p->service_id === $d->service_id)
                                            <p class="text-xs text-secondary mb-0">{{ $p->service_name }}</p>
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0 text-wrap">{{ $d->layanan_description }}</p>
                                </td>
                                <td>
                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          action
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="dropdown-item edit-button" data-bs-toggle="modal"
                                                data-bs-target="#editlayanan" data-id="{{ $d->layanan_id }}" data-name="{{ $d->layanan_name }}"
                                                data-service="{{ $d->service_id }}" data-description="{{ $d->layanan_description }}" 
                                                data-url="{{ url('layanan/'. $d->layanan_id) }}">
                                                Edit
                                            </button>
                                            <button type="button" class="dropdown-item delete-button" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $d->layanan_id }}" data-url="{{ url('layanan/'. $d->layanan_id) }}">
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

    <!-- Modal Add layanan-->
    <div class="modal fade" id="addlayanan" tabindex="-1" aria-labelledby="addlayananTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Detail Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('layanan.store') }}" enctype="multipart/form-data">
                    @csrf

                            <!-- Name layanan -->
                            <div class="form-group{{ $errors->has('layanan_name') ? ' has-danger' : '' }}">
                                <label for="layanan_name" class="col-form-label">Name Detail Service: </label>
                                <input type="text" name="layanan_name" id="layanan_name"
                                    class="form-control{{ $errors->has('layanan_name') ? ' is-invalid' : '' }}"
                                    placeholder="Name layanan" value="{{ old('layanan_name') }}">
                                @if ($errors->has('layanan_name'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('layanan_name') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Description layanan -->
                            <div class="form-group{{ $errors->has('layanan_description') ? ' has-danger' : '' }}">
                                <label for="layanan_description" class="col-form-label">Description Detail Service: </label>
                                <textarea type="text" name="layanan_description" id="layanan_description"
                                    class="form-control{{ $errors->has('layanan_description') ? ' is-invalid' : '' }}"
                                    placeholder="Description layanan" >{{ old('layanan_description') }}</textarea>
                                @if ($errors->has('layanan_description'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('layanan_description') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Service Name -->
                            <div class="form-group">
                                <label for="service_id" class="col-form-label">Service Name: </label>
                                <select name="service_id" class="form-control {{ $errors->has('service_id') ? ' is-invalid' : '' }}" id="service_id">
                                    <option value="">- Service -</option>
                                    @foreach ($service as $p)
                                        <option value="{{ $p->service_id }}" {{ old('service_id') == $p->service_id ? 'selected' : '' }}>
                                            {{ $p->service_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('service_id'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('service_id') }}
                                    </span>
                                @endif
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Add Detail Service</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit layanan -->
    <div class="modal fade" id="editlayanan" tabindex="-1" aria-labelledby="editlayananTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editlayananTitle">Edit Detail Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="" id="editlayananForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name layanan -->
                        <div class="form-group{{ $errors->has('edit_layanan_name') ? ' has-danger' : '' }}">
                            <label for="edit-layanan-name" class="col-form-label">Name Detail Service: </label>
                            <input type="text" name="edit_layanan_name" id="edit-layanan-name"
                                class="form-control{{ $errors->has('edit_layanan_name') ? ' is-invalid' : '' }}"
                                placeholder="Name layanan" value="{{ old('edit_layanan_name') }}">
                            @if ($errors->has('edit_layanan_name'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_layanan_name') }}
                                </span>
                            @endif
                        </div>
                        
                        <!-- Description layanan -->
                        <div class="form-group{{ $errors->has('edit_layanan_description') ? ' has-danger' : '' }}">
                            <label for="edit-layanan-description" class="col-form-label">Description Detail Service: </label>
                            <textarea type="text" name="edit_layanan_description" id="edit-layanan-description"
                                    class="form-control{{ $errors->has('edit_layanan_description') ? ' is-invalid' : '' }}"
                                    placeholder="Description layanan" >{{ old('edit_layanan_description') }}</textarea>
                            @if ($errors->has('edit_layanan_description'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_layanan_description') }}
                                </span>
                            @endif
                        </div>


                        <!-- Project Name -->
                        <div class="form-group">
                            <label for="edit-service-id" class="col-form-label">Service Name: </label>
                            <select name="edit_service_id" class="form-control {{ $errors->has('edit_service_id') ? ' is-invalid' : '' }}" id="edit-service-id">
                                <option value="">- Project -</option>
                                @foreach ($service as $p)
                                    <option value="{{ $p->service_id }}" {{ old('edit_service_id') == $p->service_id ? 'selected' : '' }}>
                                        {{ $p->service_name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('edit_service_id'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_service_id') }}
                                </span>
                            @endif
                        </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Update Detail Service</button>
                </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete layanan -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete Detail Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deletelayananForm" method="POST">
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
        // Check and show the addlayanan modal if there are errors for add layanan
        if ({{ $errors->has('layanan_name') || $errors->has('layanan_description') || $errors->has('service_id') ? 'true' : 'false' }}) {
            var addlayananModal = new bootstrap.Modal(document.getElementById('addlayanan'));
            addlayananModal.show();
        }

        // Check and show the editlayanan modal if there are errors for edit layanan
        if ({{ $errors->has('edit_layanan_name') || $errors->has('edit_layanan_description') || $errors->has('edit_service_id') ? 'true' : 'false' }}) {
            var editlayananModal = new bootstrap.Modal(document.getElementById('editlayanan'));
            var url = localStorage.getItem('Url');
            editlayananModal.show();
            $('#editlayananForm').attr('action', url);
            
            console.log(@json($errors->all()));
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var layananId = this.getAttribute('data-id');
                var layananName = this.getAttribute('data-name');
                var layananDetail = this.getAttribute('data-description');
                var layananService = this.getAttribute('data-service');
                var actionUrl = this.getAttribute('data-url');
                localStorage.setItem('Url', actionUrl);
                
                console.log(actionUrl);

                $('#edit-layanan-id').val(layananId);
                $('#edit-layanan-name').val(layananName);
                $('#edit-layanan-description').val(layananDetail);
                $('#edit-service-id').val(layananService);

                // Atur action form untuk update
                $('#editlayananForm').attr('action', actionUrl);
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Ketika tombol delete diklik
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                // Ambil data dari atribut data-*
                var layananId = this.getAttribute('data-id');
                var layananDeleteUrl = this.getAttribute('data-url');

                // Atur action form untuk delete
                document.getElementById('deletelayananForm').setAttribute('action', layananDeleteUrl);
            });
        });
    });

</script>


