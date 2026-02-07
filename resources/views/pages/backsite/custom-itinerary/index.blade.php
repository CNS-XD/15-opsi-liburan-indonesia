@extends('layouts.backsite')

@section('title', 'Custom Itinerary Requests')
@section('activeMenuCustomItinerary', 'active')

@section('content-body1')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Custom Itinerary Requests</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Custom Itinerary Requests</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrum-right">
                <div class="dropdown">
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="feather icon-settings"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('backsite.custom-itinerary.export') }}">
                            <i class="feather icon-download"></i> Export CSV
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0">{{ $customItineraries->where('status', 'pending')->count() }}</h2>
                            <p class="mb-0">Pending Requests</p>
                        </div>
                        <div class="avatar bg-rgba-warning p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-clock text-warning font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0">{{ $customItineraries->where('status', 'quoted')->count() }}</h2>
                            <p class="mb-0">Quoted</p>
                        </div>
                        <div class="avatar bg-rgba-info p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-file-text text-info font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0">{{ $customItineraries->where('status', 'confirmed')->count() }}</h2>
                            <p class="mb-0">Confirmed</p>
                        </div>
                        <div class="avatar bg-rgba-success p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-check-circle text-success font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0">{{ $customItineraries->total() }}</h2>
                            <p class="mb-0">Total Requests</p>
                        </div>
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-users text-primary font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Custom Itinerary Requests Table -->
        <section id="basic-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Custom Itinerary Requests</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Request Code</th>
                                                <th>Customer</th>
                                                <th>Contact</th>
                                                <th>Trip Details</th>
                                                <th>Destinations</th>
                                                <th>Status</th>
                                                <th>Created</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($customItineraries as $itinerary)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $itinerary->request_code }}</strong>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <strong>{{ $itinerary->customer_name }}</strong><br>
                                                            <small class="text-muted">{{ $itinerary->total_participants }} participants</small>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <small>{{ $itinerary->email }}</small><br>
                                                            <small>{{ $itinerary->phone }}</small>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <strong>{{ $itinerary->duration_days }} Days</strong><br>
                                                            <small class="text-muted">{{ $itinerary->tour_type_label }}</small>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            @foreach($itinerary->destinations->take(2) as $destination)
                                                                <span class="badge badge-light-primary mb-1">{{ $destination->destination->title }}</span>
                                                            @endforeach
                                                            @if($itinerary->destinations->count() > 2)
                                                                <span class="badge badge-light-secondary">+{{ $itinerary->destinations->count() - 2 }} more</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @switch($itinerary->status)
                                                            @case('pending')
                                                                <span class="badge badge-warning">{{ $itinerary->status_label }}</span>
                                                                @break
                                                            @case('review')
                                                                <span class="badge badge-primary">{{ $itinerary->status_label }}</span>
                                                                @break
                                                            @case('quoted')
                                                                <span class="badge badge-info">{{ $itinerary->status_label }}</span>
                                                                @break
                                                            @case('confirmed')
                                                                <span class="badge badge-success">{{ $itinerary->status_label }}</span>
                                                                @break
                                                            @case('cancelled')
                                                                <span class="badge badge-danger">{{ $itinerary->status_label }}</span>
                                                                @break
                                                            @default
                                                                <span class="badge badge-secondary">{{ $itinerary->status_label }}</span>
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        <small>{{ $itinerary->created_at->format('M d, Y') }}</small><br>
                                                        <small class="text-muted">{{ $itinerary->created_at->format('H:i') }}</small>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                                <i class="feather icon-more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{ route('backsite.custom-itinerary.show', $itinerary->id) }}">
                                                                    <i class="feather icon-eye mr-1"></i> View Details
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $itinerary->id }})">
                                                                    <i class="feather icon-trash-2 mr-1"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">
                                                        <div class="py-3">
                                                            <i class="feather icon-inbox font-large-2 text-muted"></i>
                                                            <p class="text-muted mt-2">No custom itinerary requests found</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- Pagination -->
                                @if($customItineraries->hasPages())
                                    <div class="d-flex justify-content-center mt-3">
                                        {{ $customItineraries->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this custom itinerary request? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-script')
<script>
function confirmDelete(id) {
    $('#deleteForm').attr('action', '{{ route("backsite.custom-itinerary.destroy", ":id") }}'.replace(':id', id));
    $('#deleteModal').modal('show');
}

$(document).ready(function() {
    // Check if DataTable is already initialized and destroy it
    if ($.fn.DataTable.isDataTable('.zero-configuration')) {
        $('.zero-configuration').DataTable().destroy();
    }
    
    // Initialize DataTable
    $('.zero-configuration').DataTable({
        "order": [[ 6, "desc" ]], // Sort by created date
        "pageLength": 25,
        "responsive": true,
        "language": {
            "emptyTable": "No custom itinerary requests found"
        }
    });
});
</script>
@endpush