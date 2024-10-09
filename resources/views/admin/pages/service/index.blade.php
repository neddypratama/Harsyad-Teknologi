@extends('admin.layouts.app')

@section('breadcrump')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Company Description</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Service Company</h6>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @include('admin.alerts.success')
        @include('admin.alerts.error')
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between pb-0">
                <h6>Service Table</h6>
                <!-- Button trigger modal -->
                <button type="button" class="btn bg-gradient-primary btn-block mb-3" data-bs-toggle="modal" data-bs-target="#addservice">
                    Add Service
                </button>
            </div>
            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('service.index') }}" class="d-flex flex-wrap ms-4">
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Service short</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Service Description</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column me-3">
                                            <img src="{{ asset('storage/'. $d->service_icon ) }}" class="avatar avatar-sm mb-3" alt="user1">
                                            <img src="{{ asset('storage/'. $d->service_image ) }}" class="avatar avatar-sm mb-3" alt="user1">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $d->service_name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0 text-wrap">{{ $d->service_short }}</p>
                                    <p class="text-xs text-secondary mb-0 text-wrap">{{ $d->service_description }}</p>
                                </td>
                                <td>
                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          action
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="dropdown-item edit-button" data-bs-toggle="modal"
                                                data-bs-target="#editservice" data-id="{{ $d->service_id }}" 
                                                data-icon="{{ $d->service_icon }}" data-image="{{ $d->service_image }}"
                                                data-name="{{ $d->service_name }}" data-short="{{ $d->service_short }}" 
                                                data-description="{{ $d->service_description }}" data-url="{{ url('service/'. $d->service_id) }}">
                                                Edit
                                            </button>
                                            <button type="button" class="dropdown-item delete-button" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $d->service_id }}" data-url="{{ url('service/'. $d->service_id) }}">
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

    <!-- Modal Add service-->
    <div class="modal fade" id="addservice" tabindex="-1" aria-labelledby="addserviceTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('service.store') }}" enctype="multipart/form-data">
                    @csrf
                            <!-- Icon service -->
                            <div class="form-group{{ $errors->has('service_icon') ? ' has-danger' : '' }}">
                                <label for="service_icon" class="col-form-label">Icon Service: </label>
                                <input type="file" name="service_icon" id="service_icon"
                                    class="form-control{{ $errors->has('service_icon') ? ' is-invalid' : '' }}"
                                    placeholder="Icon service" value="">
                                @if ($errors->has('service_icon'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('service_icon') }}
                                    </span>
                                @endif
                            </div>

                            <!-- image service -->
                            <div class="form-group{{ $errors->has('service_image') ? ' has-danger' : '' }}">
                                <label for="service_image" class="col-form-label">Image Service: </label>
                                <input type="file" name="service_image" id="service_image"
                                    class="form-control{{ $errors->has('service_image') ? ' is-invalid' : '' }}"
                                    placeholder="Image service" value="">
                                @if ($errors->has('service_image'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('service_image') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Name service -->
                            <div class="form-group{{ $errors->has('service_name') ? ' has-danger' : '' }}">
                                <label for="service_name" class="col-form-label">Name Service: </label>
                                <input type="text" name="service_name" id="service_name"
                                    class="form-control{{ $errors->has('service_name') ? ' is-invalid' : '' }}"
                                    placeholder="Name Service" value="{{ old('service_name') }}">
                                @if ($errors->has('service_name'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('service_name') }}
                                    </span>
                                @endif
                            </div>

                            <!-- short service -->
                            <div class="form-group{{ $errors->has('service_short') ? ' has-danger' : '' }}">
                                <label for="service_short" class="col-form-label">Short Service: </label>
                                <input type="text" name="service_short" id="service_short"
                                    class="form-control{{ $errors->has('service_short') ? ' is-invalid' : '' }}"
                                    placeholder="Short Service" value="{{ old('service_short') }}">
                                @if ($errors->has('service_short'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('service_short') }}
                                    </span>
                                @endif
                            </div>

                            <!-- description service -->
                            <div class="form-group{{ $errors->has('service_description') ? ' has-danger' : '' }}">
                                <label for="service_description" class="col-form-label">Description Service: </label>
                                <textarea type="text" name="service_description" id="service_description"
                                class="form-control{{ $errors->has('service_description') ? ' is-invalid' : '' }}"
                                placeholder="Description Service" >{{ old('service_description') }}</textarea>
                                @if ($errors->has('service_description'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('service_description') }}
                                    </span>
                                @endif
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Add Service</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit service -->
    <div class="modal fade" id="editservice" tabindex="-1" aria-labelledby="editserviceTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editserviceTitle">Edit Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="" id="editserviceForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Icon service -->
                        <div class="form-group{{ $errors->has('edit_service_icon') ? ' has-danger' : '' }}">
                            <label for="edit-service-icon" class="col-form-label">Icon service: </label>
                            <input type="file" name="edit_service_icon" id="edit-service-icon"
                                class="form-control{{ $errors->has('edit_service_icon') ? ' is-invalid' : '' }}"
                                placeholder="Icon service" value="">
                                <img id="current-icon" src="" alt="Current Icon" style="max-width: 100px; margin-top: 10px; display: none;">
                            @if ($errors->has('edit_service_icon'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_service_icon') }}
                                </span>
                            @endif
                        </div>

                        <!-- image service -->
                        <div class="form-group{{ $errors->has('edit_service_image') ? ' has-danger' : '' }}">
                            <label for="edit-service-image" class="col-form-label">Image service: </label>
                            <input type="file" name="edit_service_image" id="edit-service-image"
                                class="form-control{{ $errors->has('edit_service_image') ? ' is-invalid' : '' }}"
                                placeholder="Image service" value="">
                                <img id="current-image" src="" alt="Current Image" style="max-width: 100px; margin-top: 10px; display: none;">
                            @if ($errors->has('edit_service_image'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_service_image') }}
                                </span>
                            @endif
                        </div>

                        <!-- Name service -->
                        <div class="form-group{{ $errors->has('edit_service_name') ? ' has-danger' : '' }}">
                            <label for="edit-service-name" class="col-form-label">Name Service: </label>
                            <input type="text" name="edit_service_name" id="edit-service-name"
                                class="form-control{{ $errors->has('edit_service_name') ? ' is-invalid' : '' }}"
                                placeholder="Name Service" value="{{ old('edit_service_name') }}">
                            @if ($errors->has('edit_service_name'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_service_name') }}
                                </span>
                            @endif
                        </div>

                        <!-- short service -->
                        <div class="form-group{{ $errors->has('edit_service_short') ? ' has-danger' : '' }}">
                            <label for="edit-service-short" class="col-form-label">Short Service: </label>
                            <input type="text" name="edit_service_short" id="edit-service-short"
                                class="form-control{{ $errors->has('edit_service_short') ? ' is-invalid' : '' }}"
                                placeholder="Short Service" value="{{ old('edit_service_short') }}">
                            @if ($errors->has('edit_service_short'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_service_short') }}
                                </span>
                            @endif
                        </div>

                        <!-- description service -->
                        <div class="form-group{{ $errors->has('edit_service_description') ? ' has-danger' : '' }}">
                            <label for="edit-service-description" class="col-form-label">Description Service: </label>
                            <textarea type="text" name="edit_service_description" id="edit-service-description"
                            class="form-control{{ $errors->has('edit_service_description') ? ' is-invalid' : '' }}"
                            placeholder="Description Service" >{{ old('edit_service_description') }}</textarea>
                            @if ($errors->has('edit_service_description'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_service_description') }}
                                </span>
                            @endif
                        </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Update Service</button>
                </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete service -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deleteserviceForm" method="POST">
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
        // Check and show the addservice modal if there are errors for add service
        if ({{ $errors->has('service_name') || $errors->has('service_icon') || $errors->has('service_image') || $errors->has('service_description') ||$errors->has('service_short') ? 'true' : 'false' }}) {
            var addserviceModal = new bootstrap.Modal(document.getElementById('addservice'));
            addserviceModal.show();
        }

        // Check and show the editservice modal if there are errors for edit service
        if ({{ $errors->has('edit_service_name') || $errors->has('edit_service_icon') || $errors->has('edit_service_short') || $errors->has('edit_service_image') || $errors->has('edit_service_description') ? 'true' : 'false' }}) {
            var editserviceModal = new bootstrap.Modal(document.getElementById('editservice'));
            var url = localStorage.getItem('Url');
            var image = localStorage.getItem('Image');
            var icon = localStorage.getItem('Icon');

            editgaleryModal.show();

            $('#editgaleryForm').attr('action', url);
            var Image = $('#current-image');
            Image.attr('src', 'storage/' + image);
            Image.show();

            var Icon = $('#current-icon');
            Icon.attr('src', 'storage/' + icon);
            Icon.show();

            console.log(url);
            console.log(image);
            console.log(@json($errors->all()));
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var serviceId = this.getAttribute('data-id');
                var serviceIcon = this.getAttribute('data-icon');
                var serviceName = this.getAttribute('data-name');
                var serviceImage = this.getAttribute('data-image');
                var serviceDescription = this.getAttribute('data-description');
                var serviceShort = this.getAttribute('data-short');
                var actionUrl = this.getAttribute('data-url');
                localStorage.setItem('Url', actionUrl);
                localStorage.setItem('Image', serviceImage);
                localStorage.setItem('Icon', serviceIcon);

                $('#edit-service-id').val(serviceId);
                $('#edit-service-name').val(serviceName);
                $('#edit-service-short').val(serviceShort);
                $('#edit-service-description').val(serviceDescription);

                // Update gambar ikon jika ada
                var Image = $('#current-image');
                if (serviceImage) {
                    Image.attr('src', 'storage/' + serviceImage); // Menggabungkan string dengan benar
                    Image.show(); // Menampilkan gambar jika ada
                } else {
                    Image.hide(); // Menyembunyikan gambar jika tidak ada
                }

                // Update gambar ikon jika ada
                var Icon = $('#current-icon');
                if (serviceIcon) {
                    Icon.attr('src', 'storage/' + serviceIcon); // Menggabungkan string dengan benar
                    Icon.show(); // Menampilkan gambar jika ada
                } else {
                    Icon.hide(); // Menyembunyikan gambar jika tidak ada
                }

                // Atur action form untuk update
                $('#editserviceForm').attr('action', actionUrl);
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Ketika tombol delete diklik
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                // Ambil data dari atribut data-*
                var serviceId = this.getAttribute('data-id');
                var serviceDeleteUrl = this.getAttribute('data-url');

                // Atur action form untuk delete
                document.getElementById('deleteserviceForm').setAttribute('action', serviceDeleteUrl);
            });
        });
    });

</script>


