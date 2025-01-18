@extends('layouts.aside')
@section('content')
<style>
	.dataTables_length {
		display: none;
		/* Hides the entries dropdown */
	}

	.dataTables_filter {
		display: none;
		/* Hides the search bar */
	}

	.fs-16 {
		font-size: 16px;
		/* Change font size */
	}

	.color-dark {
		color: #333;
		/* Change text color */
	}

	.fw-500 {
		font-weight: 500;
		/* Change font weight */
	}

	/* Pagination container */
	.dataTables_wrapper .dataTables_paginate {
		text-align: center;
		margin: 10px 0;
	}

	/* Pagination buttons */
	.dataTables_wrapper .dataTables_paginate .pagination-prev,
	.dataTables_wrapper .dataTables_paginate .pagination-next {
		display: inline-block;
		padding: 5px 10px;
		margin: 0 5px;
		cursor: pointer;
		border: 1px solid #ddd;
		border-radius: 3px;
		background-color: #f8f9fa;
	}

	/* Pagination container */
	.dataTables_wrapper .dataTables_paginate {
		text-align: center;
		margin: 10px 0;
	}

	/* Pagination buttons */
	.dataTables_wrapper .dataTables_paginate .paginate_button {
		display: inline-block;
		padding: 5px 15px;
		margin: 0 3px;
		cursor: pointer;
		border: none;
		border-radius: 25px;
		/* Rounded corners */
		background-color: #000;
		/* Black background */
		color: #fff;
		/* White text */
		font-size: 14px;
		/* Adjust font size as needed */
		text-align: center;
		line-height: 1.5;
	}

	/* Pagination active */
	.dataTables_wrapper .dataTables_paginate .paginate_button.current {
		background-color: black;
		/* Darker background for the active page */
		color: white;
		/* White text */
		border-radius: 50%;
	}

	/* Pagination hover */
	.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
		background-color: #555;
		/* Dark gray on hover */
	}

	/* Pagination disabled */
	.dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
		cursor: not-allowed;
		opacity: 0.5;
		background-color: #000;
		/* Black background for disabled buttons */
		color: #fff;
		/* White text for disabled buttons */
	}

	/* Center-align the Action column */
	.table.property-list-table td:last-child,
	/* Targeting the last column in the table */
	.table.property-list-table th:last-child {
		/* Targeting the header of the last column */
		text-align: center;
		/* Center-align text */
	}

	/* Center-align the Action column */
	.table.property-list-table td:first-child,
	/* Targeting the last column in the table */
	.table.property-list-table th:first-child {
		/* Targeting the header of the last column */
		text-align: center;
		/* Center-align text */
	}

	/* Additional styling if needed */
	.table.property-list-table .action-dots {
		display: flex;
		justify-content: center;
		/* Center horizontally within the cell */
	}

	.table.dataTable.no-footer {
		border: none !important;
	}

	.table.dataTable thead .sorting,
	table.dataTable thead .sorting_asc,
	table.dataTable thead .sorting_desc,
	table.dataTable thead .sorting_asc_disabled,
	table.dataTable thead .sorting_desc_disabled {
		background-color: #A020F0;
	}


	.table {
		width: 100% !important;
	}
</style>


<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">



<div class="bg-white card-box p0 border-20 mt-20 mb-50 show-file-area ">
	<div class="table-responsive pt-25 pb-25 pe-4 ps-4">
		<table class="table property-list-table sampleTable justify-content-center">
			<thead>
				<tr>
					<th scope="col">Amount</th>
					<th scope="col">Credits</th>
					<th scope="col">Payment Status</th>
					<th scope="col">Monthly Subscription</th>
					<!-- <th scope="col">Coupon</th> -->
					<th scope="col">Created At</th>
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
		var user_data=localStorage.getItem('user_details')
        if(!user_data)
    {
        window.location.href = '{{ route('welcome') }}';
    }
	user_data = JSON.parse(user_data);
        var user_email=user_data.email
		const newUrl = `getTransactionData/${user_email}`; 
		$('.sampleTable').DataTable({
			processing: true,
			serverSide: true,
			ajax: newUrl,
			columns: [
				{
					data: 'amount',
					name: 'amount',
					render: function (data, type, row) {
						return '$ ' + parseFloat(data).toFixed(0); // Format as currency
					}
				},
				{
					data: 'obtained_credits',
					name: 'obtained_credits',
					render: function (data, type, row) {
						return data + ' Credits'; // Format as currency
					}
				},
				{
					data: 'transaction_status',
					name: 'transaction_status',
					render: function (data, type, row) {
						if (data == 1) {
							return '<div class="property-status">Success</div>';
						} else if (data == 0) {
							return '<div class="property-status pending">Pending</div>';
						}
					}
				},
				{
					data: 'subscription_status',
					name: 'subscription_status',
					render: function (data, type, row) {
						if (data == 1) {
							return '<div class="property-status">Active</div>';
						} else if (data == 0) {
							return '<div class="property-status pending" style="background-color:#e2dee5;">Canceled</div>';
						}
					}
				},
				{ data: 'created_at', name: 'created_at' },
			],
			pageLength: 10,  // Set the number of records per page
			language: {
				info: "Showing <span class='color-dark fw-500'>_START_–_END_</span> of <span class='color-dark fw-500'>_TOTAL_</span> results",
				paginate: {
					previous: '<span class="pagination-prev">Previous</span>',
					next: '<span class="pagination-next">Next</span>'
				},
				emptyTable: "No data available"
			},
			initComplete: function (settings, json) {
				$(".loading-screen").addClass("d-none");

				// Apply custom styling for the info text
				$('.dataTables_info').addClass('fs-16'); // Adding the custom font-size class
			}
		});
	});

</script>



</body>

</html>

@stop