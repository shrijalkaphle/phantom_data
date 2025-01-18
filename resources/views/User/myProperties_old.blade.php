@extends('layouts.aside')
@section('content')



<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">



<div class="bg-white card-box p0 border-20 mt-20 mb-50 show-file-area">
	<div class="table-responsive pt-25 pb-25 pe-4 ps-4">
		<table class="table property-list-table sampleTable justify-content-center">
			<thead>
				<tr>
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">Address</th>
					<th scope="col"> City</th>
					<th scope="col"> State</th>
					<th scope="col"> Zip</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody class="border-0">
				<!-- DataTables will populate this section -->
			</tbody>
		</table>
	</div>
</div>


<!-- Modal Structure -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="detailsModalLabel">Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<!-- Mini table will be inserted here -->
				<div id="modalContent"></div>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>


<!-- Modal Structure -->
<div class="modal fade" id="exportCsvModal" tabindex="-1" aria-labelledby="exportCsvModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exportCsvModalLabel">Export CSV</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" style="height:600px;">
				<div style="height:550px;max-height: 100%; overflow-y: auto;border-radius:20px">

					<br>

					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Date</th>
								<th scope="col">Row(s)</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<tr class="table-primary">
								<th scope="row">1</th>
								<td>Total Properties List</td>
								<td>{{$totalProperties}}</td>
								<td><button class="btn btn-sm border-primary  export-all" >
										Export All
									</button>
								</td>
							</tr>
							@foreach($properties as $property)
								<tr>
									<th scope="row">{{ $loop->iteration +1}}</th>
									<td>{{ \Carbon\Carbon::parse($property->created_at)->format('d F Y | h:i A') }}</td>
									<td>{{$property->count}}</td>
									<td><button class="btn btn-sm border-primary export-csv-by-date" data-file-no="{{ $property->file_no }}">
											Export {{ $property->count }} Row(s) Csv
										</button>
									</td>
								</tr>

							@endforeach

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm border-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
	$(document).ready(function () {

		var table = $('.sampleTable').DataTable({
			processing: true,
			serverSide: false,
			ajax: {
				url: '{{ route('getPropertiesData') }}',
				type: 'GET',
				dataSrc: function (json) {
					let processedData = [];
					json.data.forEach(function (row) {
						var decodedData = decodeHtmlEntities(row.personal_details);
						var details = JSON.parse(decodedData);
						if (details.length > 0) {

							details.forEach(function (detail) {

								let newRow = Object.assign({}, row);
								newRow.first_name = detail.first_name;
								newRow.last_name = detail.last_name;
								processedData.push(newRow);
							});
						} else {

							let newRow = Object.assign({}, row);
							newRow.first_name = 'N/A';
							newRow.last_name = 'N/A';
							processedData.push(newRow);
						}
					});
					return processedData;
				},
				error: function (xhr, error, code) {
					console.log(xhr);
					console.log(code);
				}
			},
			columns: [
				{ data: 'first_name', title: 'First Name' },
				{ data: 'last_name', title: 'Last Name' },
				{ data: 'property_address', title: 'Address' },
				{ data: 'property_city', title: 'City' },
				{ data: 'mail_state', title: 'State' },
				{ data: 'mail_zip', title: 'Zip' },
				{
					data: null,
					orderable: false,
					searchable: false,
					className: 'text-center',
					render: function (data, type, row, meta) {
						return `
                    <a class="dropdown-item toggle-details-btn" data-index="${meta.row}" href="#"><span class="toggle-text"><i class="fa-solid fa-eye"></i> View</span></a>
                `;
					}
				}
			],
			pageLength: 10,
			lengthChange: false,
			scrollCollapse: true,
			paging: true, // Enable pagination
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
				$('.dataTables_info').addClass('fs-16');
			}
		});

		// Function to decode HTML entities
		function decodeHtmlEntities(text) {
			const textArea = document.createElement('textarea');
			textArea.innerHTML = text;
			return textArea.value;
		}




		// var table = $('.sampleTable').DataTable({
		// 	processing: true,
		// 	serverSide: true,
		// 	ajax: {
		// 		url: '{{ route('getPropertiesData') }}',
		// 		type: 'GET',
		// 		error: function (xhr, error, code) {
		// 			console.log(xhr); // Log the response to inspect the error
		// 			console.log(code); // Log the error code
		// 		}
		// 	},
		// 	columns: [
		// 		{ data: 'mail_address', name: 'mail_address' },
		// 		{ data: 'mail_city', name: 'mail_city' },
		// 		{ data: 'property_address', name: 'property_address' },
		// 		{ data: 'property_city', name: 'property_city' },
		// 		{ data: 'mail_state', name: 'mail_state' },
		// 		{ data: 'mail_zip', name: 'mail_zip' },
		// 		{
		// 			data: null,
		// 			name: 'action',
		// 			orderable: false,
		// 			searchable: false,
		// 			className: 'text-center',
		// 			render: function (data, type, row, meta) {
		// 				return `
		//                         <a class="dropdown-item toggle-details-btn" data-index="${meta.row}" href="#"><span class="toggle-text"><i class="fa-solid fa-eye"></i> View</span></a>
		//                         `;
		// 			}
		// 		}
		// 	],
		// 	pageLength: 10,
		// 	lengthChange: false,
		// 	scrollCollapse: true,
		// 	paging: true, // Enable pagination
		// 	language: {
		// 		info: "Showing <span class='color-dark fw-500'>_START_–_END_</span> of <span class='color-dark fw-500'>_TOTAL_</span> results",
		// 		paginate: {
		// 			previous: '<span class="pagination-prev">Previous</span>',
		// 			next: '<span class="pagination-next">Next</span>'
		// 		},
		// 		emptyTable: "No data available"
		// 	},
		// 	initComplete: function (settings, json) {
		// 		$(".loading-screen").addClass("d-none");
		// 		$('.dataTables_info').addClass('fs-16');
		// 	}
		// });

		// Event listener for the 'View' option in the dropdown menu
		$(document).on('click', '.toggle-details-btn', function (e) {
			e.preventDefault();
			var index = $(this).data('index');
			var row = table.row(index);
			var rowData = row.data();
			var $this = $(this);

			// Decode and parse personal details
			var personalDetails = decodeHtmlEntities(rowData.personal_details);
			var details = JSON.parse(personalDetails);

			// Generate the HTML for the mini-table
			var detailHtml = details.length > 0
				? `
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Best Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${details.map(detail => `
                            <tr>
                                <td>${detail.first_name} ${detail.last_name}</td>
                                <td>${detail.best_phone}</td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>`
				: '<p>No personal details available.</p>';

			// Insert the mini-table HTML into the modal content
			$('#modalContent').html(detailHtml);

			// Show the modal
			$('#detailsModal').modal('show');
		});




		$(document).on('click', '.export-all', function (e) {
			e.preventDefault();
			$.ajax({
				url: '{{route('export-properties-csv')}}',
				type: 'GET',
				success: function (response) {
					const blob = new Blob([response], { type: 'text/csv' });
					const url = window.URL.createObjectURL(blob);
					const a = document.createElement('a');
					a.href = url;
					a.download = 'properties_backup.csv';
					document.body.appendChild(a);
					a.click();
					window.URL.revokeObjectURL(url);
				},
				error: function (xhr, status, error) {
					console.error('Error exporting CSV:', error);
				}
			});
		});

		$(document).on('click', '.export-csv', function (e) {
			e.preventDefault();
			$('#exportCsvModal').modal('show');
		});

		$(document).on('click', '.export-csv-by-date', function (e) {
			e.preventDefault(); // Prevent the default action of the button
			var fileNo = $(this).data('file-no'); // Get the file_no from the data attribute
			console.log(fileNo); // Log it to the console

			// AJAX request
			$.ajax({
				url: '{{route('export-csv-by-date')}}',
				method: 'GET',
				data: {
					file_no: fileNo,
				},
				success: function (response) {
					const blob = new Blob([response.csv_content], { type: 'text/csv' });
					const url = window.URL.createObjectURL(blob);
					const a = document.createElement('a');
					a.href = url;
					a.download = response.filename;
					document.body.appendChild(a);
					a.click();
					document.body.removeChild(a);
					window.URL.revokeObjectURL(url);

				},
				error: function (xhr, status, error) {
					// Handle error response
					console.error('Error:', error);
				}
			});
		});

	});
</script>


</body>

</html>

@stop