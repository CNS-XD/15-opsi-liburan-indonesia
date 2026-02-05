@extends('layouts.backsite')

@section('title', 'Custom Itinerary Request #' . str_pad($customItinerary->id, 6, '0', STR_PAD_LEFT))
@section('activeMenuCustomItinerary', 'active')

@section('content-body1')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Custom Itinerary Request #{{ str_pad($customItinerary->id, 6, '0', STR_PAD_LEFT) }}</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backsite.custom-itinerary.index') }}">Custom Itinerary Requests</a></li>
                            <li class="breadcrumb-item active">Request #{{ str_pad($customItinerary->id, 6, '0', STR_PAD_LEFT) }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrum-right">
                <a href="{{ route('backsite.custom-itinerary.index') }}" class="btn btn-primary btn-sm">
                    <i class="feather icon-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>

    <div class="content-body">
        <div class="row">
            <!-- Request Details -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Request Details</h4>
                        <div class="card-header-toolbar">
                            @switch($customItinerary->status)
                                @case('pending')
                                    <span class="badge badge-warning badge-pill">{{ $customItinerary->status_label }}</span>
                                    @break
                                @case('quoted')
                                    <span class="badge badge-info badge-pill">{{ $customItinerary->status_label }}</span>
                                    @break
                                @case('confirmed')
                                    <span class="badge badge-success badge-pill">{{ $customItinerary->status_label }}</span>
                                    @break
                                @case('cancelled')
                                    <span class="badge badge-danger badge-pill">{{ $customItinerary->status_label }}</span>
                                    @break
                                @default
                                    <span class="badge badge-secondary badge-pill">{{ $customItinerary->status_label }}</span>
                            @endswitch
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Contact Information -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h5 class="mb-2"><i class="feather icon-user text-primary"></i> Contact Information</h5>
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td width="150"><strong>Name:</strong></td>
                                                <td>{{ $customItinerary->customer_name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email:</strong></td>
                                                <td><a href="mailto:{{ $customItinerary->email }}">{{ $customItinerary->email }}</a></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Phone:</strong></td>
                                                <td><a href="tel:{{ $customItinerary->phone }}">{{ $customItinerary->phone }}</a></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Participants:</strong></td>
                                                <td>{{ $customItinerary->total_participants }} People ({{ $customItinerary->participants_adult }} Adults, {{ $customItinerary->participants_child }} Children)</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Trip Details -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h5 class="mb-2"><i class="feather icon-calendar text-primary"></i> Trip Details</h5>
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td width="150"><strong>Duration:</strong></td>
                                                <td>{{ $customItinerary->duration_days }} Days</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Travel Dates:</strong></td>
                                                <td>{{ $customItinerary->travel_dates }}</td>
                                            </tr>
                                            @if($customItinerary->budget_min || $customItinerary->budget_max)
                                            <tr>
                                                <td><strong>Budget Range:</strong></td>
                                                <td>${{ $customItinerary->budget_range }}</td>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Destinations -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h5 class="mb-2"><i class="feather icon-map-pin text-primary"></i> Selected Destinations</h5>
                                    <div class="row">
                                        @foreach($customItinerary->destinations as $destination)
                                            <div class="col-md-6 mb-2">
                                                <div class="card border-left-primary">
                                                    <div class="card-body py-2">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <h6 class="mb-0">{{ $destination->destination->title }}</h6>
                                                                <small class="text-muted">{{ $destination->destination->subtitle ?? 'Indonesia' }}</small>
                                                            </div>
                                                            <span class="badge badge-primary">{{ $destination->sequence_order }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Travel Preferences -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h5 class="mb-2"><i class="feather icon-settings text-primary"></i> Travel Preferences</h5>
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td width="150"><strong>Tour Type:</strong></td>
                                                <td>{{ $customItinerary->tour_type_label }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Accommodation:</strong></td>
                                                <td>{{ $customItinerary->accommodation_level_label }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Transportation:</strong></td>
                                                <td>{{ $customItinerary->transportation_type_label }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Activities -->
                            @if($customItinerary->activities->count() > 0)
                            <hr>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h5 class="mb-2"><i class="feather icon-activity text-primary"></i> Preferred Activities</h5>
                                    <div class="d-flex flex-wrap">
                                        @foreach($customItinerary->activities as $activity)
                                            <span class="badge badge-light-primary mr-1 mb-1">{{ $activity->activity_name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Special Requirements -->
                            @if($customItinerary->special_requirements)
                            <hr>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h5 class="mb-2"><i class="feather icon-info text-primary"></i> Special Requirements</h5>
                                    <div class="alert alert-light-warning">
                                        <p class="mb-0">{{ $customItinerary->special_requirements }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Admin Notes -->
                            @if($customItinerary->admin_notes)
                            <hr>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h5 class="mb-2"><i class="feather icon-file-text text-primary"></i> Admin Notes</h5>
                                    <div class="alert alert-light-info">
                                        <p class="mb-0">{{ $customItinerary->admin_notes }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Management -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Status Management</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('backsite.custom-itinerary.update-status', $customItinerary->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="pending" {{ $customItinerary->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="quoted" {{ $customItinerary->status == 'quoted' ? 'selected' : '' }}>Quoted</option>
                                        <option value="confirmed" {{ $customItinerary->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="cancelled" {{ $customItinerary->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="estimated_price">Estimated Price (USD)</label>
                                    <input type="number" name="estimated_price" id="estimated_price" class="form-control" 
                                           value="{{ $customItinerary->estimated_price }}" step="0.01" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="final_price">Final Price (USD)</label>
                                    <input type="number" name="final_price" id="final_price" class="form-control" 
                                           value="{{ $customItinerary->final_price }}" step="0.01" min="0">
                                </div>

                                <div class="form-group">
                                    <label for="admin_notes">Admin Notes</label>
                                    <textarea name="admin_notes" id="admin_notes" class="form-control" rows="4" 
                                              placeholder="Add notes for internal use or customer communication">{{ $customItinerary->admin_notes }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="feather icon-save"></i> Update Status
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Request Information -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Request Information</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Request ID:</strong></td>
                                        <td>#{{ str_pad($customItinerary->id, 6, '0', STR_PAD_LEFT) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Submitted:</strong></td>
                                        <td>{{ $customItinerary->created_at->format('M d, Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Last Updated:</strong></td>
                                        <td>{{ $customItinerary->updated_at->format('M d, Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Quick Actions</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="mailto:{{ $customItinerary->email }}?subject=Custom Itinerary Request #{{ str_pad($customItinerary->id, 6, '0', STR_PAD_LEFT) }}" 
                                   class="btn btn-outline-primary btn-block mb-1">
                                    <i class="feather icon-mail"></i> Send Email
                                </a>
                                <a href="tel:{{ $customItinerary->phone }}" class="btn btn-outline-success btn-block mb-1">
                                    <i class="feather icon-phone"></i> Call Customer
                                </a>
                                <a href="{{ route('frontsite.custom-itinerary.show', $customItinerary->id) }}" 
                                   class="btn btn-outline-info btn-block mb-1" target="_blank">
                                    <i class="feather icon-external-link"></i> View Frontend
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-block" onclick="confirmDelete({{ $customItinerary->id }})">
                                    <i class="feather icon-trash-2"></i> Delete Request
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
</script>
@endpush