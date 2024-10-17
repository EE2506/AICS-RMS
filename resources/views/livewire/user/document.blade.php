<div>
    <div class="container-fluid">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($showModal)
            <div class="modal fade show d-block" style="background-color: rgba(0,0,0,0.5);" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fas fa-exclamation-triangle text-warning"></i> File Exists
                            </h5>
                            <button type="button" class="close" aria-label="Close" wire:click="closeModal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>File already exists. Please rename the file and try again.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (!$createForm)
            <div class="card my-2">
                <div class="card-body">
                    <button class="btn btn-success" wire:click='showForm'>
                        <i class="fas fa-arrow-up"></i>
                        <span wire:loading.remove wire:target='showForm'>Import File</span>
                        <span wire:loading wire:target='showForm'><i class="fas fa-spinner fa-spin"></i></span>
                    </button>
                </div>
            </div>
        @endif

        @if ($createForm)
            <div class="card-body">
                <button class="btn btn-outline-secondary mb-3" wire:click='resetForm'>
                    <i class="fas fa-arrow-left"></i>
                </button>

                <div class="input-group mb-3" style="width:50%">
                    <input type="text" wire:model="search" class="form-control" placeholder="Search...">
                    <div class="input-group-append align-items-center">
                        <button wire:click="performSearch" class="btn btn-primary">Search</button>
                    </div>
                </div>

                <div class="form-group my-1" wire:ignore.self>
                    <label for="form-label d-block">Upload Document</label>
                    <input type="file" wire:model='document' class="form-control short-file-input" accept=".csv, .xlsx, .xls">
                    @error('document')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type='button' class="btn btn-success" wire:click="save">Save</button>
                </div>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
            <table class="table mt-4 text-center table table-bordered table-responsive">
                <thead class="table-header">
                <tr>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('id')">
                            ID
                            @if ($sortField === 'id')
                                <i class="fas fa-sort-{{ $sortDirection }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('document')">
                            Filename
                            @if ($sortField === 'document')
                                <i class="fas fa-sort-{{ $sortDirection }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('filetype')">
                            File Type
                            @if ($sortField === 'filetype')
                                <i class="fas fa-sort-{{ $sortDirection }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click.prevent="sortBy('created_at')">
                            Uploaded At
                            @if ($sortField === 'created_at')
                                <i class="fas fa-sort-{{ $sortDirection }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </a>
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $document)
                    <tr>
                        <td>{{ $document->id }}</td>
                        <td>{{ $document->document }}</td>
                        <td>{{ $document->filetype }}</td>
                        <td>{{ $document->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>
           <!-- View Button -->
<a href="javascript:void(0)" wire:click="openPreviewModal({{ $document->id }})" class="btn btn-view btn-sm">View</a>

<!-- Modal for Document Preview -->
<div class="modal fade" id="filePreviewModal" tabindex="-1" aria-labelledby="filePreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filePreviewModalLabel">Document Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead style="background-color: skyblue; font-size: 12px;">
                        <tr>
                            <th>Field Office</th>
                            <th>Entered By</th>
                            <th>Client No</th>
                            <th>Date Accomplished</th>
                            <th>Region</th>
                            <th>Province</th>
                            <th>City/Municipality</th>
                            <th>Barangay</th>
                            <th>District</th>
                            <th>LastName</th>
                            <th>FirstName</th>
                            <th>MiddleName</th>
                            <th>ExtraName</th>
                            <th>Sex</th>
                            <th>CivilStatus</th>
                            <th>DOB</th>
                            <th>Age</th>
                            <th>Mode Of Admission</th>
                            <th>Type of Assistance1</th>
                            <th>Amount1</th>
                            <th>Source of Fund1</th>
                            <th>Type of Assistance2</th>
                            <th>Amount2</th>
                            <th>Source of Fund2</th>
                            <th>Type of Assistance3</th>
                            <th>Amount3</th>
                            <th>Source of Fund3</th>
                            <th>Type of Assistance4</th>
                            <th>Amount4</th>
                            <th>Source of Fund4</th>
                            <th>Client Category</th>
                            <th>Subcategory</th>
                            <th>Through</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 12px;">
                        @foreach($fileContent as $row)
                            <tr>
                                @foreach($row as $column)
                                    <td>{{ $column }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('openFilePreviewModal', event => {
        $('#filePreviewModal').modal('show');
    });
</script>


                            <!-- Archive Button -->

                            <button wire:click="archive({{ $document->id }})" class="btn btn-warning">
                                Archive
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $documents->links() }}

        <!-- Archive Confirmation Modal -->
        <div class="modal fade" id="archiveModal" tabindex="-1" aria-labelledby="archiveModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="archiveModalLabel">Confirm Archive</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to archive this document?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" wire:click="archive">Archive</button>
                    </div>
                </div>
            </div>
        </div>


        <style>
            .btn-view, .btn-warning {
                color: white;
                border: none;
                margin-right: 3px;
                transition: background-color 0.3s ease;
                padding: 10px 20px; /* Same padding for both buttons */
                font-size: 16px;    /* Same font size for consistency */
                width: 90px;       /* Fixed width to make buttons the same size */
                height: 50px;       /* Fixed height for uniformity */
                text-align: center;
                display: inline-block;
            }

            /* Specific styles for .btn-view */
            .btn-view {
                background-color: rgb(4, 4, 146);
            }

            .btn-view:hover {
                background-color: rgb(14, 14, 193);
            }

            /* Specific styles for .btn-warning */
            .btn-warning {
                background-color: #f3c075;
            }

            .btn-warning:hover {
                background-color: #e0bd87;
            }


            /* Container styling for spacing and responsiveness */
            .table-container {
            margin: 20px;
            overflow-x: auto; /* Allows scrolling for smaller screens */
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
                text-align: center; /* Center-align header text */
            }
            /* Adjust modal for landscape style */
            .modal-xl {
                max-width: 90vw;
            }
            /* Smaller font size for table content */
            .modal-body table {
                font-size: 12px;
            }
            /* Adjust modal header to be landscape-friendly */
            .modal-header {
                justify-content: space-between;
            }
                </style>
    </div>
</div>
