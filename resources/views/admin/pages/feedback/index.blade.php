@extends('admin.layouts.app')

@section('breadcrump')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Home Pages</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Feedback</h6>
    @endsection

    @section('content')
        <div class="row">
            <div class="col-12">
                @include('admin.alerts.success')
                @include('admin.alerts.error')
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h6>Feedback table</h6>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn bg-gradient-primary btn-block mb-3" data-bs-toggle="modal"
                            data-bs-target="#addFeedback">
                            Add Feedback
                        </button>
                    </div>
                    <!-- Form Pencarian -->
                    <form method="GET" action="{{ route('feedback.index') }}" class="d-flex flex-wrap ms-4">
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
                                            Feedback Description</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Rate</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $d->feedback_name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $d->company_name }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 text-wrap">
                                                    {{ $d->feedback_description }}</p>
                                            </td>
                                            <td>
                                                @for ($i = 0; $i < floor($d->rate); $i++)
                                                    <!-- Bintang Penuh -->
                                                    <i class="fas fa-star" style="color: #ffa620;"></i>
                                                @endfor

                                                @if ($d->rate - floor($d->rate) >= 0.5)
                                                    <!-- Bintang Setengah -->
                                                    <i class="fas fa-star-half-alt" style="color: #ffa620;"></i>
                                                @endif

                                                @for ($i = ceil($d->rate); $i < 5; $i++)
                                                    <!-- Bintang Kosong -->
                                                    <i class="far fa-star" style="color: #ffa620;"></i>
                                                @endfor
                                            </td>
                                            <td>
                                                <div class="btn-group dropend">
                                                    <button type="button" class="btn btn-sm dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item edit-button"
                                                            data-bs-toggle="modal" data-bs-target="#editFeedback"
                                                            data-id="{{ $d->feedback_id }}"
                                                            data-name="{{ $d->feedback_name }}"
                                                            data-company="{{ $d->company_name }}"
                                                            data-rate="{{ $d->rate }}"
                                                            data-description="{{ $d->feedback_description }}"
                                                            data-url="{{ url('feedback/' . $d->feedback_id) }}">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="dropdown-item delete-button"
                                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                            data-id="{{ $d->feedback_id }}"
                                                            data-url="{{ url('feedback/' . $d->feedback_id) }}">
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

        <!-- Modal Add Feedback-->
        <div class="modal fade" id="addFeedback" tabindex="-1" aria-labelledby="addFeedbackTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="POST" action="{{ route('feedback.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Name feedback -->
                            <div class="form-group{{ $errors->has('feedback_name') ? ' has-danger' : '' }}">
                                <label for="feedback_name" class="col-form-label">Name Feedback: </label>
                                <input type="text" name="feedback_name" id="feedback_name"
                                    class="form-control{{ $errors->has('feedback_name') ? ' is-invalid' : '' }}"
                                    placeholder="Name Feedback" value="{{ old('feedback_name') }}">
                                @if ($errors->has('feedback_name'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('feedback_name') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Name company -->
                            <div class="form-group{{ $errors->has('company_name') ? ' has-danger' : '' }}">
                                <label for="company_name" class="col-form-label">Name Company: </label>
                                <input type="text" name="company_name" id="company_name"
                                    class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}"
                                    placeholder="Name Company" value="{{ old('company_name') }}">
                                @if ($errors->has('company_name'))
                                    <span class="invalid-company" role="alert">
                                        {{ $errors->first('company_name') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Description feedback -->
                            <div class="form-group{{ $errors->has('feedback_description') ? ' has-danger' : '' }}">
                                <label for="feedback_description" class="col-form-label">Description Feedback: </label>
                                <textarea type="text" name="feedback_description" id="feedback_description"
                                    class="form-control{{ $errors->has('feedback_description') ? ' is-invalid' : '' }}"
                                    placeholder="Description Feedback">{{ old('feedback_description') }}</textarea>
                                @if ($errors->has('feedback_description'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('feedback_description') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Rate -->
                            <div class="form-group{{ $errors->has('rate') ? ' has-danger' : '' }}">
                                <label for="rate" class="col-form-label">Rate: </label>
                                <input type="number" name="rate" id="rate"
                                    class="form-control{{ $errors->has('rate') ? ' is-invalid' : '' }}"
                                    placeholder="Rate" value="{{ old('rate') }}" min="0" max="5"
                                    step="0.5">
                                @if ($errors->has('rate'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('rate') }}
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

        <!-- Modal Edit feedback -->
        <div class="modal fade" id="editFeedback" tabindex="-1" aria-labelledby="editFeedbackTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editFeedbackTitle">Edit feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="POST" action="" id="editFeedbackForm"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Name feedback -->
                            <div class="form-group{{ $errors->has('edit_feedback_name') ? ' has-danger' : '' }}">
                                <label for="edit-feedback-name" class="col-form-label">Name Feedback: </label>
                                <input type="text" name="edit_feedback_name" id="edit-feedback-name"
                                    class="form-control{{ $errors->has('edit_feedback_name') ? ' is-invalid' : '' }}"
                                    placeholder="Name Feedback" value="{{ old('edit_feedback_name') }}">
                                @if ($errors->has('edit_feedback_name'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('edit_feedback_name') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Name Company -->
                            <div class="form-group{{ $errors->has('edit_company_name') ? ' has-danger' : '' }}">
                                <label for="edit-feedback-name" class="col-form-label">Name Company: </label>
                                <input type="text" name="edit_company_name" id="edit-company-name"
                                    class="form-control{{ $errors->has('edit_company_name') ? ' is-invalid' : '' }}"
                                    placeholder="Name Company" value="{{ old('edit_company_name') }}">
                                @if ($errors->has('edit_company_name'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('edit_company_name') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Description Feedback -->
                            <div class="form-group{{ $errors->has('edit_feedback_description') ? ' has-danger' : '' }}">
                                <label for="edit-feedback-description" class="col-form-label">Description Feedback:
                                </label>
                                <textarea type="text" name="edit_feedback_description" id="edit-feedback-description"
                                    class="form-control{{ $errors->has('edit_feedback_description') ? ' is-invalid' : '' }}"
                                    placeholder="Description Feedback">{{ old('edit_feedback_description') }}</textarea>
                                @if ($errors->has('edit_feedback_description'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('edit_feedback_description') }}
                                    </span>
                                @endif
                            </div>


                            <!-- Rate Company -->
                            <div class="form-group{{ $errors->has('edit_rate') ? ' has-danger' : '' }}">
                                <label for="edit-rate" class="col-form-label">Rate Company: </label>
                                <input type="number" name="edit_rate" id="edit-rate"
                                    class="form-control{{ $errors->has('edit_rate') ? ' is-invalid' : '' }}"
                                    placeholder="Rate Company" value="{{ old('edit_rate') }}" min="0"
                                    max="5" step="0.5">
                                @if ($errors->has('edit_rate'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('edit_rate') }}
                                    </span>
                                @endif
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Update Feedback</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Delete feedback -->
        <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Delete feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure to delete data?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form id="deleteFeedbackForm" method="POST">
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
            // Check and show the addFeedback modal if there are errors for add feedback
            if (
                {{ $errors->has('feedback_name') || $errors->has('feedback_description') || $errors->has('rate') || $errors->has('company_name') ? 'true' : 'false' }}
            ) {
                var addFeedbackModal = new bootstrap.Modal(document.getElementById('addFeedback'));
                addFeedbackModal.show();
            }

            // Check and show the editFeedback modal if there are errors for edit feedback
            if (
                {{ $errors->has('edit_feedback_name') || $errors->has('edit_feedback_description') || $errors->has('edit_rate') || $errors->has('edit_company_name') ? 'true' : 'false' }}
            ) {
                var editFeedbackModal = new bootstrap.Modal(document.getElementById('editFeedback'));
                var url = localStorage.getItem('Url');
                editFeedbackModal.show();
                $('#editFeedbackForm').attr('action', url);

                console.log(@json($errors->all()));
            }
        });


        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.edit-button');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var feedbackId = this.getAttribute('data-id');
                    var feedbackName = this.getAttribute('data-name');
                    var feedbackCompany = this.getAttribute('data-company');
                    var feedbackDetail = this.getAttribute('data-description');
                    var feedbackRate = this.getAttribute('data-rate');
                    var actionUrl = this.getAttribute('data-url');
                    localStorage.setItem('Url', actionUrl);

                    console.log(actionUrl);

                    $('#edit-feedback-id').val(feedbackId);
                    $('#edit-feedback-name').val(feedbackName);
                    $('#edit-feedback-description').val(feedbackDetail);
                    $('#edit-company-name').val(feedbackCompany);
                    $('#edit-rate').val(feedbackRate);

                    // Atur action form untuk update
                    $('#editFeedbackForm').attr('action', actionUrl);
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Ketika tombol delete diklik
            document.querySelectorAll('.delete-button').forEach(function(button) {
                button.addEventListener('click', function() {
                    // Ambil data dari atribut data-*
                    var feedbackId = this.getAttribute('data-id');
                    var feedbackDeleteUrl = this.getAttribute('data-url');

                    // Atur action form untuk delete
                    document.getElementById('deleteFeedbackForm').setAttribute('action',
                        feedbackDeleteUrl);
                });
            });
        });
    </script>
