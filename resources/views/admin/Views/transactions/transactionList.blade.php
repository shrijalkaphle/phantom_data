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
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Credits</th>
                    <th scope="col">Coupon Code</th>
                    <th scope="col">Status</th>
                    <th scope="col">Payment Type</th>
                </tr>
            </thead>
            <tbody class="border-0">
                <!-- DataTables will populate this section -->
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {

        getAllTransactions();

    });

    function getAllTransactions() {

        if ($.fn.DataTable.isDataTable('#websitesTable')) {
            $('#websitesTable').DataTable().clear().destroy();
        }

        $('#websitesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('get-transactions-data') }}',
            columns: [


                {
                    data: 'username',
                    name: 'username',
                    render: function (data, type, row) {
                        return data ? data : 'N/A';
                    }
                },
                {
                    data: 'email',
                    name: 'email',
                    render: function (data, type, row) {
                        return data ? data : 'N/A';
                    }
                },
                {
                    data: 'amount',
                    name: 'amount',
                    render: function (data, type, row) {
                        return data ? data : 'N/A';
                    }
                },
                {
                    data: 'obtained_credits',
                    name: 'obtained_credits',
                    render: function (data, type, row) {
                        return data ? data : 'N/A';
                    }
                },
                {
                    data: 'code',
                    name: 'code',
                    render: function (data, type, row) {
                        return data ? data : 'N/A';
                    }
                },
                {
                    data: 'transaction_status',
                    name: 'transaction_status',
                    render: function (data, type, row) {
                        if (data == 1) {
                            return '<i style="font-size:25px;color:#5CB85C" class="fa-solid fa-circle-check"></i>';
                        } else {
                            return '<i style="font-size:25px;color:#D9534F" class="fa-solid fa-circle-xmark"></i>';
                        }
                    }
                },
                {
                    data: 'payment_type',
                    name: 'payment_type',
                    render: function (data, type, row) {
                        if (data == 'Online') {
                            return '<div style="background-color:#5CB85C;width: 65px;padding: 0px 5px 0px 5px;border: 1px solid #069b06;border-radius: 20px;color:white"> Online <div>';
                        } else {
                            return '<div style="background-color:#F0AD4E;width: 85px;padding: 0px 5px 0px 5px;border: 1px solid #ad690a;border-radius: 20px;color:white">Manually<div>';  
                        }
                    }
                },
                
            ]
        });
    }


</script>


@stop