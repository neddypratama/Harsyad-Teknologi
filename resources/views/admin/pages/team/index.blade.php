@extends('admin.layouts.app')

@section('breadcrump')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">About Us</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Team</h6>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @include('admin.alerts.success')
        @include('admin.alerts.error')
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between pb-0">
                <h6>Team Table</h6>
                <!-- Button trigger modal -->
                <button type="button" class="btn bg-gradient-primary btn-block mb-3" data-bs-toggle="modal" data-bs-target="#addteam">
                    Add Team
                </button>
            </div>
            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('team.index') }}" class="d-flex flex-wrap ms-4">
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Team Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">team Detail</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <img src="{{ asset('storage/'. $d->team_image ) }}" class="avatar avatar-sm me-3">
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $d->team_name }}</p>
                                    <p class="text-xs text-secondary mb-0">{{ $d->role }}</p>
                                </td>
                                <td>
                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                          action
                                        </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="dropdown-item edit-button" data-bs-toggle="modal"
                                                data-bs-target="#editteam" data-id="{{ $d->team_id }}" data-image="{{ $d->team_image }}"
                                                data-name="{{ $d->team_name }}" data-role="{{ $d->role }}" data-url="{{ url('team/'. $d->team_id) }}">
                                                Edit
                                            </button>
                                            <button type="button" class="dropdown-item delete-button" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $d->team_id }}" data-url="{{ url('team/'. $d->team_id) }}">
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

    <!-- Modal Add team-->
    <div class="modal fade" id="addteam" tabindex="-1" aria-labelledby="addteamTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Team</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{ route('team.store') }}" enctype="multipart/form-data">
                    @csrf
                            <!-- Icon team -->
                            <div class="form-group{{ $errors->has('team_image') ? ' has-danger' : '' }}">
                                <label for="team_image" class="col-form-label">Image Team: </label>
                                <input type="file" name="team_image" id="team_image"
                                    class="form-control{{ $errors->has('team_image') ? ' is-invalid' : '' }}"
                                    placeholder="Image Team" value="">
                                @if ($errors->has('team_image'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('team_image') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Name team -->
                            <div class="form-group{{ $errors->has('team_name') ? ' has-danger' : '' }}">
                                <label for="team_name" class="col-form-label">Name Team: </label>
                                <input type="text" name="team_name" id="team_name"
                                    class="form-control{{ $errors->has('team_name') ? ' is-invalid' : '' }}"
                                    placeholder="Name Team" value="{{ old('team_name') }}">
                                @if ($errors->has('team_name'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('team_name') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Detail team -->
                            <div class="form-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                                <label for="role" class="col-form-label">Role: </label>
                                <input type="text" name="role" id="role"
                                    class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}"
                                    placeholder="Role" value="{{ old('role') }}">
                                @if ($errors->has('role'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('role') }}
                                    </span>
                                @endif
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Add Team</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit team -->
    <div class="modal fade" id="editteam" tabindex="-1" aria-labelledby="editteamTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editteamTitle">Edit Team</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="" id="editteamForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Icon team -->
                        <div class="form-group{{ $errors->has('edit_team_image') ? ' has-danger' : '' }}">
                            <label for="edit-team-icon" class="col-form-label">Image Team: </label>
                            <input type="file" name="edit_team_image" id="edit-team-icon"
                                class="form-control{{ $errors->has('edit_team_image') ? ' is-invalid' : '' }}"
                                placeholder="Image Team" value="{{ old('edit_team_image') }}">
                            <img id="current-icon" src="" alt="Current Icon" style="max-width: 100px; margin-top: 10px; display: none;">
                            @if ($errors->has('edit_team_image'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_team_image') }}
                                </span>
                            @endif
                        </div>

                        <!-- Name team -->
                        <div class="form-group{{ $errors->has('edit_team_name') ? ' has-danger' : '' }}">
                            <label for="edit-team-name" class="col-form-label">Name team: </label>
                            <input type="text" name="edit_team_name" id="edit-team-name"
                                class="form-control{{ $errors->has('edit_team_name') ? ' is-invalid' : '' }}"
                                placeholder="Name team" value="{{ old('edit_team_name') }}">
                            @if ($errors->has('edit_team_name'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_team_name') }}
                                </span>
                            @endif
                        </div>

                        <!-- Detail team -->
                        <div class="form-group{{ $errors->has('edit_role') ? ' has-danger' : '' }}">
                            <label for="edit-role" class="col-form-label">Role: </label>
                            <input type="text" name="edit_role" id="edit-role"
                                class="form-control{{ $errors->has('edit_role') ? ' is-invalid' : '' }}"
                                placeholder="Role" value="{{ old('edit_role') }}">
                            @if ($errors->has('edit_role'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('edit_role') }}
                                </span>
                            @endif
                        </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-primary">Update Team</button>
                </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete team -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete Team</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="deleteteamForm" method="POST">
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
        // Check and show the addteam modal if there are errors for add team
        if ({{ $errors->has('team_name') || $errors->has('team_image') || $errors->has('role') ? 'true' : 'false' }}) {
            var addteamModal = new bootstrap.Modal(document.getElementById('addteam'));
            addteamModal.show();
        }

        // Check and show the editteam modal if there are errors for edit team
        if ({{ $errors->has('edit_team_name') || $errors->has('edit_team_image') || $errors->has('edit_role') ? 'true' : 'false' }}) {
            var editteamModal = new bootstrap.Modal(document.getElementById('editteam'));
            var url = localStorage.getItem('Url');
            var icon = localStorage.getItem('Icon');

            editteamModal.show();

            $('#editteamForm').attr('action', url);
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
                var teamId = this.getAttribute('data-id');
                var teamIcon = this.getAttribute('data-image');
                var teamName = this.getAttribute('data-name');
                var teamRole = this.getAttribute('data-role');
                var actionUrl = this.getAttribute('data-url');
                localStorage.setItem('Url', actionUrl);
                localStorage.setItem('Icon', teamIcon);

                console.log(actionUrl);

                $('#edit-team-id').val(teamId);
                $('#edit-team-name').val(teamName);
                $('#edit-role').val(teamRole);

                // Update gambar ikon jika ada
                var iconImage = $('#current-icon');
                if (teamIcon) {
                    iconImage.attr('src', 'storage/' + teamIcon); // Menggabungkan string dengan benar
                    iconImage.show(); // Menampilkan gambar jika ada
                } else {
                    iconImage.hide(); // Menyembunyikan gambar jika tidak ada
                }

                // Atur action form untuk update
                $('#editteamForm').attr('action', actionUrl);
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Ketika tombol delete diklik
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                // Ambil data dari atribut data-*
                var teamId = this.getAttribute('data-id');
                var teamDeleteUrl = this.getAttribute('data-url');

                // Atur action form untuk delete
                document.getElementById('deleteteamForm').setAttribute('action', teamDeleteUrl);
            });
        });
    });

</script>


