@extends('admin.layouts.app')

@section('breadcrump')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Company Description</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Detail Company</h6>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @include('admin.alerts.success')
        @include('admin.alerts.error')
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between pb-0">
                <h6>Detail Table</h6>
                <!-- Button trigger modal -->
                {{-- <button type="button" class="btn bg-gradient-primary btn-block mb-3" data-bs-toggle="modal" data-bs-target="#adddetail">
                    Add Detail 
                </button> --}}
            </div>
            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('detail.index') }}" class="d-flex flex-wrap ms-4">
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Company Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="{{ asset('storage/'. $d->detail_logo ) }}" class="img-fluid me-3" alt="user1">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $d->detail_name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0 text-wrap">{{ $d->address }}</p>
                                </td>
                                <td>
                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          action
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="dropdown-item edit-button" data-bs-toggle="modal"
                                                data-bs-target="#editDetail" data-id="{{ $d->detail_id }}" data-logo="{{ $d->detail_logo }}"
                                                data-name="{{ $d->detail_name }}" data-address="{{ $d->address }}" data-url="{{ url('detail/'. $d->detail_id) }}">
                                                Edit
                                            </button>
                                            {{-- <button type="button" class="dropdown-item delete-button" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $d->detail_id }}" data-url="{{ url('detail/'. $d->detail_id) }}">
                                                Delete
                                            </button> --}}
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

    {{-- <!-- Modal Add detail-->
    <div class="modal fade" id="adddetail" tabindex="-1" aria-labelledby="adddetailTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('detail.store') }}" enctype="multipart/form-data">
                    @csrf
                            <!-- logo detail -->
                            <div class="form-group{{ $errors->has('detail_logo') ? ' has-danger' : '' }}">
                                <label for="detail_logo" class="col-form-label">logo detail: </label>
                                <input type="file" name="detail_logo" id="detail_logo"
                                    class="form-control{{ $errors->has('detail_logo') ? ' is-invalid' : '' }}"
                                    placeholder="logo detail" value="{{ old('detail_logo') }}">
                                @if ($errors->has('detail_logo'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('detail_logo') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Name detail -->
                            <div class="form-group{{ $errors->has('detail_name') ? ' has-danger' : '' }}">
                                <label for="detail_name" class="col-form-label">Name detail: </label>
                                <input type="text" name="detail_name" id="detail_name"
                                    class="form-control{{ $errors->has('detail_name') ? ' is-invalid' : '' }}"
                                    placeholder="Name detail" value="{{ old('detail_name') }}">
                                @if ($errors->has('detail_name'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('detail_name') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Detail detail -->
                            <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                <label for="address" class="col-form-label">Detail detail: </label>
                                <input type="text" name="address" id="address"
                                    class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                    placeholder="Detail detail" value="{{ old('address') }}">
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('address') }}
                                    </span>
                                @endif
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Add detail</button>
                </div>
                </form>
            </div>
        </div>
    </div> --}}

    <!-- Modal Edit detail -->
    <div class="modal fade" id="editDetail" tabindex="-1" aria-labelledby="editDetailTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDetailTitle">Edit Detail Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="" id="editDetailForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Logo Detail -->
                        <div class="form-group{{ $errors->has('edit_detail_logo') ? ' has-danger' : '' }}">
                            <label for="edit-detail-logo" class="col-form-label">Logo Company: </label>
                            <input type="file" name="edit_detail_logo" id="edit-detail-logo"
                                class="form-control{{ $errors->has('edit_detail_logo') ? ' is-invalid' : '' }}"
                                placeholder="logo detail" value="{{ old('edit_detail_logo') }}">
                            <img id="current-logo" src="" alt="Current logo" style="max-width: 100px; margin-top: 10px; display: none;">
                            @if ($errors->has('edit_detail_logo'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_detail_logo') }}
                                </span>
                            @endif
                        </div>

                        <!-- Name Detail -->
                        <div class="form-group{{ $errors->has('edit_detail_name') ? ' has-danger' : '' }}">
                            <label for="edit-detail-name" class="col-form-label">Name Company: </label>
                            <input type="text" name="edit_detail_name" id="edit-detail-name"
                                class="form-control{{ $errors->has('edit_detail_name') ? ' is-invalid' : '' }}"
                                placeholder="Name detail" value="{{ old('edit_detail_name') }}">
                            @if ($errors->has('edit_detail_name'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_detail_name') }}
                                </span>
                            @endif
                        </div>

                        <!-- Address Company -->
                        <div class="form-group{{ $errors->has('edit_address') ? ' has-danger' : '' }}">
                            <label for="edit-address" class="col-form-label">Address Company: </label>
                            <textarea name="edit_address" id="edit-address" 
                                class="form-control{{ $errors->has('edit_address') ? ' is-invalid' : '' }}"
                                placeholder="Address Company" value="{{ old('edit_address') }}">
                            </textarea>
                            @if ($errors->has('edit_address'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_address') }}
                                </span>
                            @endif
                        </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Update Company</button>
                </div>
                    </form>
            </div>
        </div>
    </div>

    {{-- <!-- Modal Delete detail -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deletedetailForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@stack('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check and show the adddetail modal if there are errors for add detail
        if ({{ $errors->has('detail_name') || $errors->has('detail_logo') || $errors->has('address') ? 'true' : 'false' }}) {
            var adddetailModal = new bootstrap.Modal(document.getElementById('adddetail'));
            adddetailModal.show();
        }

        // Check and show the editDetail modal if there are errors for edit detail
        if ({{ $errors->has('edit_detail_name') || $errors->has('edit_detail_logo') || $errors->has('edit_address') ? 'true' : 'false' }}) {
            var editDetailModal = new bootstrap.Modal(document.getElementById('editDetail'));
            var url = localStorage.getItem('Url');
            var logo = localStorage.getItem('Logo');

            editDetailyModal.show();
            $('#editDetailyForm').attr('action', url);

            var Logo = $('#current-Logo');
            Logo.attr('src', 'storage/' + logo);
            Logo.show();
            
            console.log(@json($errors->all()));
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var detailId = this.getAttribute('data-id');
                var detaillogo = this.getAttribute('data-logo');
                var detailName = this.getAttribute('data-name');
                var detailAddress = this.getAttribute('data-address');
                var actionUrl = this.getAttribute('data-url');
                localStorage.setItem('Url', actionUrl);
                localStorage.setItem('Logo', detaillogo);

                console.log(actionUrl);

                $('#edit-detail-id').val(detailId);
                $('#edit-detail-name').val(detailName);
                $('#edit-address').val(detailAddress);

                // Update gambar ikon jika ada
                var logoImage = $('#current-logo');
                if (detaillogo) {
                    logoImage.attr('src', 'storage/' + detaillogo); // Menggabungkan string dengan benar
                    logoImage.show(); // Menampilkan gambar jika ada
                } else {
                    logoImage.hide(); // Menyembunyikan gambar jika tidak ada
                }

                // Atur action form untuk update
                $('#editDetailForm').attr('action', actionUrl);
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Ketika tombol delete diklik
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                // Ambil data dari atribut data-*
                var detailId = this.getAttribute('data-id');
                var detailDeleteUrl = this.getAttribute('data-url');

                // Atur action form untuk delete
                document.getElementById('deletedetailForm').setAttribute('action', detailDeleteUrl);
            });
        });
    });

</script>


