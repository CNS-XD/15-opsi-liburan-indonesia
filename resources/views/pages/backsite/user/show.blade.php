{{-- Modal Detail --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table material-table table-hover table-striped table-bordered">
                        <tr>
                            <th><b>Photo Profile</b></th>
                            <td>
                                <img src="" class="photo" width="80px" id="photo" alt="Photo Pofile">
                            </td>
                        </tr>
                        <tr>
                            <th><b>Role</b></th>
                            <td>
                                <span id="role"></span>
                            </td>
                        </tr>
                        <tr>
                            <th><b>Full Name</b></th>
                            <td>
                                <span id="name"></span>
                            </td>
                        </tr>
                        <tr>
                            <th><b>Email</b></th>
                            <td>
                                <span id="email"></span>
                            </td>
                        </tr>
                        <tr>
                            <th><b>Plaintext</b></th>
                            <td>
                                <span id="plaintext"></span>
                            </td>
                        </tr>
                        <tr>
                            <th><b>Status</b></th>
                            <td>
                                <span id="status"></span>
                            </td>
                        </tr>
                        <tr>
                            <th><b>Phone</b></th>
                            <td>
                                <span id="phone"></span>
                            </td>
                        </tr>
                        <tr>
                            <th><b>Nationality</b></th>
                            <td>
                                <span id="nationality"></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white text-black" data-dismiss="modal">
                    <b>Tutup</b>
                </button>
            </div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    // Detail
    $(document).on('click', '.btn-detail', function() {
        let id = $(this).data('id');
        var urlShow = "{{ route('backsite.user.show', [':role', ':id']) }}";
        urlShow = urlShow.replace(':role', '{{ $role['index_role'] }}').replace(':id', id);

        $.ajax({
            type: "GET",
            url: urlShow,
            dataType: "json",
            statusCode: {
                500: function(xhr) {
                    Swal.hideLoading();
                    Swal.close();
                    let err = JSON.parse(xhr.responseText)
                    swal.fire('Failed!', err.data, 'error')
                }
            },
            beforeSend: function() {
                swal.fire({
                    title: 'Sending to server, please wait...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        swal.showLoading();
                    }
                })
            },

            success: function(res) {
                Swal.close();
                if (res.success) {
                    let data;
                    data = res.data
                    
                    $('#name').text(data.name)
                    $('#email').text(res.data.email)
                    $('#plaintext').text(res.data.plain_text)
                    $('#phone').text(data.phone)
                    $('#nationality').text(data.nationality)

                    if (res.data.role == 1) {
                        role = "Superadmin"
                    } else if (res.data.role == 2) {
                        role = "Client / Visitor / Traveler"
                    }
                    $('#role').text(role)

                    if (res.data.status == 0) {
                        status = "Pending"
                    } else if (res.data.status == 1) {
                        status = "Active"
                    } else {
                        status = "Non Active"
                    }
                    $('#status').text(status)

                    $('#photo').attr('src', `/storage/${data.photo}`)

                    $('#detailModal').modal('show')
                } else {
                    swal.fire('Failed!', res.message, 'error')
                }
            },
            error: function(xhr) {
                Swal.close();
                swal.fire('Failed!', xhr.responseJSON.message, 'error')
            }
        });
    })
</script>
@endpush
