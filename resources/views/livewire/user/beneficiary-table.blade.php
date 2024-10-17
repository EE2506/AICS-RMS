<div> <!-- Added wrapper div to resolve Livewire multiple root element issue -->
    <div class="container-fluid">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <!-- Header Section with Search Input -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="h4 text-gray-700 font-weight-bold">Beneficiaries</h1>

                    <!-- Search Input and Button -->
                    <div class="input-group w-50">
                        <input type="text" class="form-control" placeholder="Search by name or client no..." wire:model.live.debounce.500ms="search" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card Section for Table -->
                <div class="card shadow-sm">
                    <div class="table-responsive">
                        <table class="table mt-4 text-center table table-bordered">
                            <thead class="table-header">
                                <tr>
                                    <th>ID</th>
                                    <th>Field Office</th>
                                    <th>Entered by</th>
                                    <th>Client No (date encoded)</th>
                                    <th>Date Accomplished</th>
                                    <th>Region</th>
                                    <th>Province</th>
                                    <th>City/Municipality</th>
                                    <th>Barangay</th>
                                    <th>District</th>
                                    <th>Lastname</th>
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>Extra name</th>
                                    <th>Sex</th>
                                    <th>Civil Status</th>
                                    <th>DOB</th>
                                    <th>Age</th>
                                    <th>Mode Of Admission</th>
                                    <th>Type of Assistance 1</th>
                                    <th>Amount 1</th>
                                    <th>Source of Fund 1</th>
                                    <th>Client Category</th>
                                    <th>Subcategory</th>
                                    <th>Through</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                <tr>
                                    <td>{{ $client->id }}</td>
                                    <td>{{ $client->field_office }}</td>
                                    <td>{{ $client->entered_by }}</td>
                                    <td>{{ $client->client_no }}</td>
                                    <td>{{ $client->date_accomplished }}</td>
                                    <td>{{ $client->region }}</td>
                                    <td>{{ $client->province }}</td>
                                    <td>{{ $client->city_municipality }}</td>
                                    <td>{{ $client->barangay }}</td>
                                    <td>{{ $client->district }}</td>
                                    <td>{{ $client->last_name }}</td>
                                    <td>{{ $client->first_name }}</td>
                                    <td>{{ $client->middle_name }}</td>
                                    <td>{{ $client->extra_name }}</td>
                                    <td>{{ $client->sex }}</td>
                                    <td>{{ $client->civil_status }}</td>
                                    <td>{{ $client->dob }}</td>
                                    <td>{{ $client->age }}</td>
                                    <td>{{ $client->mode_of_admission }}</td>
                                    <td>{{ $client->type_of_assistance1 }}</td>
                                    <td>{{ $client->amount1 }}</td>
                                    <td>{{ $client->source_of_fund1 }}</td>
                                    <td>{{ $client->client_category }}</td>
                                    <td>{{ $client->subcategory }}</td>
                                    <td>{{ $client->through }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Center the pagination -->
                        <div class="pagination-container">
                            {{ $clients->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Center the pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }

        /* Style the input and button for better UI */
        .input-group .form-control {
            border-top-left-radius: 25px;
            border-bottom-left-radius: 25px;
        }

        .input-group .btn-primary {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .input-group .btn-primary i {
            margin-right: 5px;
        }
        
            /* Custom header styling to make it blue */
            .table-header {
            background-color: #0654a8; /* Blue background for header */
            color: #fff; /* White text color */
            text-align: center; /* Center-align header text */
            }

            /* Styling for the table to adjust row height and text alignment */
            .table th, .table td {
            padding: 10px 140px; /* Adjust padding to make the table more compact */
            vertical-align: middle; /* Center-align vertically */
            text-align: center; /* Center-align text */
            white-space: nowrap; /* Prevent text from wrapping */
            }
            .table th a {
                color: #fff; /* White text color */
                text-align: center; 
            }/* Center-align header text */
    </style>
</div>
