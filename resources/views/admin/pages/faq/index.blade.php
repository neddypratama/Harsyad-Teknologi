@extends('admin.layouts.app')

@section('breadcrump')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Service Pages</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">FAQ</h6>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @include('admin.alerts.success')
        @include('admin.alerts.error')
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between pb-0">
                <h6>FAQ table</h6>
                <!-- Button trigger modal -->
                <button type="button" class="btn bg-gradient-primary btn-block mb-3" data-bs-toggle="modal" data-bs-target="#addFaq">
                    Add FAQ
                </button>
            </div>
            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('faq.index') }}" class="d-flex flex-wrap ms-4">
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">FAQ Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">FAQ Description</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                            <tr>
                                <td>
                                    <p class="mb-0 text-sm text-wrap">{{ $d->faq_name }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0 text-wrap">{{ $d->faq_description }}</p>
                                </td>
                                <td>
                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          action
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="dropdown-item edit-button" data-bs-toggle="modal"
                                                data-bs-target="#editFaq" data-id="{{ $d->faq_id }}" data-name="{{ $d->faq_name }}" 
                                                data-description="{{ $d->faq_description }}" data-url="{{ url('faq/'. $d->faq_id) }}">
                                                Edit
                                            </button>
                                            <button type="button" class="dropdown-item delete-button" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $d->faq_id }}" data-url="{{ url('faq/'. $d->faq_id) }}">
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

    <!-- Modal Add faq-->
    <div class="modal fade" id="addFaq" tabindex="-1" aria-labelledby="addFaqTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('faq.store') }}" enctype="multipart/form-data">
                    @csrf

                            <!-- Name faq -->
                            <div class="form-group{{ $errors->has('faq_name') ? ' has-danger' : '' }}">
                                <label for="faq_name" class="col-form-label">Name FAQ: </label>
                                <input type="text" name="faq_name" id="faq_name"
                                    class="form-control{{ $errors->has('faq_name') ? ' is-invalid' : '' }}"
                                    placeholder="Name faq" value="{{ old('faq_name') }}">
                                @if ($errors->has('faq_name'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('faq_name') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Detail faq -->
                            <div class="form-group{{ $errors->has('faq_description') ? ' has-danger' : '' }}">
                                <label for="faq_description" class="col-form-label">Description FAQ: </label>
                                <textarea name="faq_description" id="faq_description" 
                                    class="form-control{{ $errors->has('faq_description') ? ' is-invalid' : '' }}"
                                    placeholder="Description FAQ" >{{ old('faq_description') }}</textarea>
                                @if ($errors->has('faq_description'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('faq_description') }}
                                    </span>
                                @endif
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Add FAQ</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit faq -->
    <div class="modal fade" id="editFaq" tabindex="-1" aria-labelledby="editFaqTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFaqTitle">Edit faq</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="" id="editFaqForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Name faq -->
                        <div class="form-group{{ $errors->has('edit_faq_name') ? ' has-danger' : '' }}">
                            <label for="edit-faq-name" class="col-form-label">Name faq: </label>
                            <input type="text" name="edit_faq_name" id="edit-faq-name"
                                class="form-control{{ $errors->has('edit_faq_name') ? ' is-invalid' : '' }}"
                                placeholder="Name FAQ" value="{{ old('edit_faq_name') }}">
                            @if ($errors->has('edit_faq_name'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_faq_name') }}
                                </span>
                            @endif
                        </div>

                        <!-- Description FAQ -->
                        <div class="form-group{{ $errors->has('edit_faq_description') ? ' has-danger' : '' }}">
                            <label for="edit-faq-description" class="col-form-label">Description FAQ: </label>
                            <textarea name="edit_faq_description" id="edit-faq-description" 
                                    class="form-control{{ $errors->has('edit_faq_description') ? ' is-invalid' : '' }}"
                                    placeholder="Description FAQ" >{{ old('edit_faq_description') }}</textarea>
                            @if ($errors->has('edit_edit_faq_description'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_edit_faq_description') }}
                                </span>
                            @endif
                        </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Update FAQ</button>
                </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete faq -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete faq</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deleteFaqForm" method="POST">
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
        // Check and show the addFaq modal if there are errors for add faq
        if ({{ $errors->has('faq_name') || $errors->has('faq_description') ? 'true' : 'false' }}) {
            var addFaqModal = new bootstrap.Modal(document.getElementById('addFaq'));
            addFaqModal.show();
        }

        // Check and show the editFaq modal if there are errors for edit faq
        if ({{ $errors->has('edit_faq_name') || $errors->has('edit_faq_description') ? 'true' : 'false' }}) {
            var editFaqModal = new bootstrap.Modal(document.getElementById('editFaq'));
            var url = localStorage.getItem('Url');
            editFaqModal.show();
            $('#editFaqForm').attr('action', url);
            
            console.log(@json($errors->all()));
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var faqId = this.getAttribute('data-id');
                var faqName = this.getAttribute('data-name');
                var faqDetail = this.getAttribute('data-description');
                var actionUrl = this.getAttribute('data-url');
                localStorage.setItem('Url', actionUrl);

                console.log(actionUrl);

                $('#edit-faq-id').val(faqId);
                $('#edit-faq-name').val(faqName);
                $('#edit-faq-description').val(faqDetail);

                // Atur action form untuk update
                $('#editFaqForm').attr('action', actionUrl);
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Ketika tombol delete diklik
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                // Ambil data dari atribut data-*
                var faqId = this.getAttribute('data-id');
                var faqDeleteUrl = this.getAttribute('data-url');

                // Atur action form untuk delete
                document.getElementById('deleteFaqForm').setAttribute('action', faqDeleteUrl);
            });
        });
    });

</script>


