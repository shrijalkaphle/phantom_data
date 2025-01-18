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
                    <th scope="col">FIRST NAME</th>
                    <th scope="col">LAST NAME</th>
                    <th scope="col">PHONE</th>
                    <th scope="col">PROPERTY</th>
                    <th scope="col">CITY</th>
                    <th scope="col">STATE</th>
                    
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

        getAllProperties();

    });

    function getAllProperties() {

        if ($.fn.DataTable.isDataTable('#websitesTable')) {
            $('#websitesTable').DataTable().clear().destroy();
        }
        $.ajax({
            url: "{{ route('get-properties-data') }}",
            method: 'GET',
            success: function (response) {
                console.log(response);  
                $('#websitesTable').DataTable({
                    data: response.data,  
                    columns: [
                        { data: 'first_name' },
                        { data: 'last_name' },
                        { data: 'best_phone' },
                        { data: 'property_address' },
                        { data: 'property_city' },
                        { data: 'property_state' },
                       

                    ]
                });
            },
            error: function (xhr) {
                console.error(xhr.responseText); 
            }
        });
    }

</script>
@stop