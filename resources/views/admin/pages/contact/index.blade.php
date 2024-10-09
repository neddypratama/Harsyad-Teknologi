@extends('admin.layouts.app')

@section('breadcrump')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Account Pages</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Profile</h6>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @include('admin.alerts.success')
        @include('admin.alerts.error')
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between pb-0">
                <h6>Contact Table</h6>
                <!-- Button trigger modal -->
                <button type="button" class="btn bg-gradient-primary btn-block mb-3" data-bs-toggle="modal" data-bs-target="#addContact">
                    Add Contact
                </button>
            </div>
            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('contact.index') }}" class="d-flex flex-wrap ms-4">
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Contact Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contact Detail</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="{{ asset('storage/'. $d->contact_icon ) }}" class="avatar avatar-sm me-3">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $d->contact_name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $d->contact_detail }}</p>
                                </td>
                                <td>
                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          action
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="dropdown-item edit-button" data-bs-toggle="modal"
                                                data-bs-target="#editContact" data-id="{{ $d->contact_id }}" data-icon="{{ $d->contact_icon }}"
                                                data-name="{{ $d->contact_name }}" data-detail="{{ $d->contact_detail }}" data-url="{{ url('contact/'. $d->contact_id) }}">
                                                Edit
                                            </button>
                                            <button type="button" class="dropdown-item delete-button" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $d->contact_id }}" data-url="{{ url('contact/'. $d->contact_id) }}">
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

    <!-- Modal Add Contact-->
    <div class="modal fade" id="addContact" tabindex="-1" aria-labelledby="addContactTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('contact.store') }}" enctype="multipart/form-data">
                    @csrf
                            <!-- Icon Contact -->
                            <div class="form-group{{ $errors->has('contact_icon') ? ' has-danger' : '' }}">
                                <label for="contact_icon" class="col-form-label">Icon Contact: </label>
                                <input type="file" name="contact_icon" id="contact_icon"
                                    class="form-control{{ $errors->has('contact_icon') ? ' is-invalid' : '' }}"
                                    placeholder="Icon Contact" value="">
                                @if ($errors->has('contact_icon'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('contact_icon') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Name Contact -->
                            <div class="form-group{{ $errors->has('contact_name') ? ' has-danger' : '' }}">
                                <label for="contact_name" class="col-form-label">Name Contact: </label>
                                <input type="text" name="contact_name" id="contact_name"
                                    class="form-control{{ $errors->has('contact_name') ? ' is-invalid' : '' }}"
                                    placeholder="Name Contact" value="{{ old('contact_name') }}">
                                @if ($errors->has('contact_name'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('contact_name') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Detail Contact -->
                            <div class="form-group{{ $errors->has('contact_detail') ? ' has-danger' : '' }}">
                                <label for="contact_detail" class="col-form-label">Detail Contact: </label>
                                <input type="text" name="contact_detail" id="contact_detail"
                                    class="form-control{{ $errors->has('contact_detail') ? ' is-invalid' : '' }}"
                                    placeholder="Detail Contact" value="{{ old('contact_detail') }}">
                                @if ($errors->has('contact_detail'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('contact_detail') }}
                                    </span>
                                @endif
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Add Contact</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Contact -->
    <div class="modal fade" id="editContact" tabindex="-1" aria-labelledby="editContactTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editContactTitle">Edit Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="" id="editContactForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Icon Contact -->
                        <div class="form-group{{ $errors->has('edit_contact_icon') ? ' has-danger' : '' }}">
                            <label for="edit-contact-icon" class="col-form-label">Icon Contact: </label>
                            <input type="file" name="edit_contact_icon" id="edit-contact-icon"
                                class="form-control{{ $errors->has('edit_contact_icon') ? ' is-invalid' : '' }}"
                                placeholder="Icon Contact" value="{{ old('edit_contact_icon') }}">
                            <img id="current-icon" src="" alt="Current Icon" style="max-width: 100px; margin-top: 10px; display: none;">
                            @if ($errors->has('edit_contact_icon'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_contact_icon') }}
                                </span>
                            @endif
                        </div>

                        <!-- Name Contact -->
                        <div class="form-group{{ $errors->has('edit_contact_name') ? ' has-danger' : '' }}">
                            <label for="edit-contact-name" class="col-form-label">Name Contact: </label>
                            <input type="text" name="edit_contact_name" id="edit-contact-name"
                                class="form-control{{ $errors->has('edit_contact_name') ? ' is-invalid' : '' }}"
                                placeholder="Name Contact" value="{{ old('edit_contact_name') }}">
                            @if ($errors->has('edit_contact_name'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_contact_name') }}
                                </span>
                            @endif
                        </div>

                        <!-- Detail Contact -->
                        <div class="form-group{{ $errors->has('edit_contact_detail') ? ' has-danger' : '' }}">
                            <label for="edit-contact-detail" class="col-form-label">Detail Contact: </label>
                            <input type="text" name="edit_contact_detail" id="edit-contact-detail"
                                class="form-control{{ $errors->has('edit_contact_detail') ? ' is-invalid' : '' }}"
                                placeholder="Detail Contact" value="{{ old('edit_contact_detail') }}">
                            @if ($errors->has('edit_contact_detail'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_contact_detail') }}
                                </span>
                            @endif
                        </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Update Contact</button>
                </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete Contact -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deleteContactForm" method="POST">
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
        // Check and show the addContact modal if there are errors for add contact
        if ({{ $errors->has('contact_name') || $errors->has('contact_icon') || $errors->has('contact_detail') ? 'true' : 'false' }}) {
            var addContactModal = new bootstrap.Modal(document.getElementById('addContact'));
            addContactModal.show();
        }

        // Check and show the editContact modal if there are errors for edit contact
        if ({{ $errors->has('edit_contact_name') || $errors->has('edit_contact_icon') || $errors->has('edit_contact_detail') ? 'true' : 'false' }}) {
            var editContactModal = new bootstrap.Modal(document.getElementById('editContact'));
            var url = localStorage.getItem('Url');
            var icon = localStorage.getItem('Icon');

            editContactModal.show();

            $('#editContactForm').attr('action', url);
            var Icon = $('#current-icon');
            Icon.attr('src', 'storage/' + icon);
            Icon.show();
            
            console.log(@json($errors->all()));
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var contactId = this.getAttribute('data-id');
                var contactIcon = this.getAttribute('data-icon');
                var contactName = this.getAttribute('data-name');
                var contactDetail = this.getAttribute('data-detail');
                var actionUrl = this.getAttribute('data-url');
                localStorage.setItem('Url', actionUrl);
                localStorage.setItem('Icon', contactIcon);

                console.log(actionUrl);

                $('#edit-contact-id').val(contactId);
                $('#edit-contact-name').val(contactName);
                $('#edit-contact-detail').val(contactDetail);

                // Update gambar ikon jika ada
                var iconImage = $('#current-icon');
                if (contactIcon) {
                    iconImage.attr('src', 'storage/' + contactIcon); // Menggabungkan string dengan benar
                    iconImage.show(); // Menampilkan gambar jika ada
                } else {
                    iconImage.hide(); // Menyembunyikan gambar jika tidak ada
                }

                // Atur action form untuk update
                $('#editContactForm').attr('action', actionUrl);
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Ketika tombol delete diklik
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                // Ambil data dari atribut data-*
                var contactId = this.getAttribute('data-id');
                var contactDeleteUrl = this.getAttribute('data-url');

                // Atur action form untuk delete
                document.getElementById('deleteContactForm').setAttribute('action', contactDeleteUrl);
            });
        });
    });

</script>


