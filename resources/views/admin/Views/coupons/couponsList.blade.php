@extends('admin.layouts.aside')
@section('content')
<style>
    .height-680 {
        height: 680px;
    }

    .dataTables_filter {
        display: flex;
        margin-bottom: 10px;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-bottom: 2px solid #A020F0;
        border-top: 0px;
        border-left: 0px solid #A020F0;
        border-right: 0px solid #A020F0;
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

<div class="bg-white card-box p0 border-20 mt-20 mb-50 show-file-area">
    <div class="table-responsive pt-25 pb-25 pe-4 ps-4">
        <table id="websitesTable" class="table property-list-table sampleTable justify-content-center">
            <thead>
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Status</th>
                    <th scope="col"> Action</th>
                </tr>
            </thead>
            <tbody class="border-0">
                <!-- DataTables will populate this section -->
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="couponModalLabel">Add Coupon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add your form or content here -->
                <span class="fields-required text-danger d-none">
                    Fields are required
                </span>
                <span class="success-msg text-success d-none">
                </span>
                <div class="mb-3">
                    <label for="couponCode" class="form-label">Coupon Code</label>
                    <input type="text" class="form-control" id="couponCode">
                </div>
                <div class="mb-3">
                    <label for="couponDiscount" class="form-label">Discount</label>
                    <input type="number" class="form-control" id="couponDiscount">
                </div>
                <button type="submit" class="btn btn-one-sm save-coupon">Generate</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close srapper-error-x-btn" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body text-center mb-20">
                <i class="fa-solid fa-circle-check" style="font-size:60px;color:#29D259"></i>
                <br>
                <span style="font-size:35px;">Success!</span><br>
                <span>Coupon Add Successfuly</span>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="coupon-error-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close srapper-error-x-btn" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body text-center mb-20">
                <i class="fa-solid fa-triangle-exclamation" style="font-size:60px;color:#d9534f"></i>
                <br>
                <span style="font-size:35px;">Alert!</span><br>
                <span>Coupon Inactive</span>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="coupon-active-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close srapper-error-x-btn" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body text-center mb-20">
                <i class="fa-solid fa-circle-check" style="font-size:60px;color:#29D259"></i>
                <br>
                <span style="font-size:35px;">Alert!</span><br>
                <span>Coupon Activate</span>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {

        getAllCoupons();

        $(".save-coupon").click(function (event) {
            event.preventDefault(); // Prevents form submission if inside a form

            var couponCode = $("#couponCode").val();
            var couponDiscount = $("#couponDiscount").val();
            var token = $('meta[name="csrf-token"]').attr('content');

            // Validate inputs
            if (couponCode === "" || couponDiscount === "") {
                $(".fields-required").removeClass('d-none')
                $(".fields-required").text('Fields Are Required')
                setTimeout(function () {
                    $(".fields-required").addClass('d-none');
                }, 5000);
            } else if (couponDiscount > 100) {
                $(".fields-required").removeClass('d-none')
                $(".fields-required").text('Discount Should Less then 100 % ')
                setTimeout(function () {
                    $(".fields-required").addClass('d-none');
                }, 5000);
            } else {

                $.ajax({
                    url: '{{route('admin.save-coupon')}}', // Your endpoint URL here
                    method: 'POST',
                    data: {
                        code: couponCode,
                        discount: couponDiscount
                    },
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function (response) {
                        $(".success-msg").removeClass('d-none')
                        $(".success-msg").text('Coupon Saved !')
                        setTimeout(function () {
                            $(".success-msg").addClass('d-none');
                        }, 5000);
                        // Optionally, close modal or clear inputs
                        $("#couponModal").modal('hide');
                        $("#couponCode").val('');
                        $("#couponDiscount").val('');
                        $('#successModal').modal('show')
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                        }, 2000);
                        getAllCoupons();
                    },
                    error: function (error) {
                        alert("Error saving coupon.");
                    }
                });
            }
        });



    });

    function getAllCoupons() {

        if ($.fn.DataTable.isDataTable('#websitesTable')) {
            $('#websitesTable').DataTable().clear().destroy();
        }

        $('#websitesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('get-coupons-data') }}',
            columns: [

                {
                    data: 'code',
                    name: 'code',
                    render: function (data, type, row) {
                        return data ? data : 'N/A';
                    }
                },
                {
                    data: 'discount',
                    name: 'discount',
                    render: function (data, type, row) {
                        return data ? data + ' %' : 'N/A';
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function (data, type, row) {
                        if (data == 1) {
                            return '<i  style="color:#29D259" class="fa-solid fa-eye"></i>';
                        } else {
                            return '<i style="color:#D9534F" class="fa-solid fa-eye-slash"></i>';
                        }
                    }
                },
                {
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        let actionText = row.status;
                        if (actionText == 1) {
                            return '<div class="action-dots float-center">' +
                                '<button class="action-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">' +
                                '<span></span>' +
                                '</button>' +
                                '<ul class="dropdown-menu dropdown-menu-end">' +
                                '<li><a class="dropdown-item hide-coupon" href="#" data-id="' + row.id + '">' +
                                '<img src="{{url('web/assets/dashboard/images/icon/icon_21.svg')}}" alt="" class="lazy-img"> Inactive </a></li>' +
                                '</ul>' +
                                '</div>';
                        } else {
                            return '<div class="action-dots float-center">' +
                                '<button class="action-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">' +
                                '<span></span>' +
                                '</button>' +
                                '<ul class="dropdown-menu dropdown-menu-end">' +
                                '<li><a class="dropdown-item show-coupon" href="#" data-id="' + row.id + '">' +
                                '<img src="{{url('web/assets/dashboard/images/icon/icon_18.svg')}}" alt="" class="lazy-img"> Active</a></li>' +
                                '</ul>' +
                                '</div>';
                        }


                    }
                }
            ]
        });
    }

    $(document).on('click', '.hide-coupon', function (e) {
        e.preventDefault();
        var couponId = $(this).data('id');
        $.ajax({
            url: "{{ route('hide-coupon', ['coupon_id' => ':couponId']) }}".replace(':couponId', couponId),
            method: 'GET',
            success: function (response) {
                // alert("Coupon inactive");
                $('#coupon-error-modal').modal('show')
                setTimeout(function () {
                    $('#coupon-error-modal').modal('hide');
                }, 2000);
                getAllCoupons();
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    });
    $(document).on('click', '.show-coupon', function (e) {
        e.preventDefault();
        var couponId = $(this).data('id');
        $.ajax({
            url: "{{ route('show-coupon', ['coupon_id' => ':couponId']) }}".replace(':couponId', couponId),
            method: 'GET',
            success: function (response) {
                $('#coupon-active-modal').modal('show')
                setTimeout(function () {
                    $('#coupon-active-modal').modal('hide');
                }, 2000);
                getAllCoupons();
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    });




</script>


@stop