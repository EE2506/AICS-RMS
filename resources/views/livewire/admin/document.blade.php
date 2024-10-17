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

        @if ($showTable == true)
            <div class="card my-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="m-0 font-weight-bold text-primary">Document ({{ $totalDocuments }})</h3>
                        <button class="btn btn-success" wire:click='showForm'>
                            <span wire:loading.remove wire:target='showForm'>File Upload</span>
                            <span wire:loading wire:target='showForm'><i class="fas fa-spinner fa-spin"></i></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="input-group mb-3" style="width:50%">
                    <input type="text" wire:model="search" class="form-control" placeholder="Search..." wire:keydown.enter="performSearch">
                    <div class="input-group-append align-items-center">
                        <button wire:click="performSearch" class="btn btn-primary">Search</button>
                        <!-- Notification button to open the modal -->
                        <button class="btn btn-success position-relative" data-toggle="modal" data-target="#notificationModal">
                            <i class="fas fa-bell"></i>
                            @if ($unreadAlertsCount > 0)
                                <span class="badge badge-danger badge-sm position-absolute top-0 end-0">{{ $unreadAlertsCount }}</span>
                            @endif
                        </button>
                        <!-- Generate Report button -->
                        <a wire:click.prevent="generateExcelReport" href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ml-2">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                        </a>
                    </div>
                </div>
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 13px;">
                            <thead>
                                <tr style="background-color: #4e73df; color: #ffffff;">
                                    <th class="align-middle" style="width: 12%;">
                                        <div style="display: flex; align-items: center;">
                                            <span style="margin-right: 5px;">File Count</span>
                                        </div>
                                    </th>
                                   
                                    <th class="align-middle" style="width: 15%;">Filename</th>
                                    <th class="align-middle" style="width: 15%;">
                                        <div wire:click="sortBy('inclusive_dates')" style="cursor: pointer; color: #ffffff; display: flex; align-items: center;">
                                            <span style="margin-right: 5px;">Period Covered Inclusive Date</span>
                                            @if ($sortField === 'inclusive_dates')
                                                <span>{!! $sortDirection === 'asc' ? '&#9650;' : '&#9660;' !!}</span>
                                            @else
                                                <span>&nbsp;</span>
                                            @endif
                                    </th>
                                
                                    <th class="align-middle" style="width: 10%;">Records Location</th>
                                    </th>

                                    <th class="align-middle" style="width: 9%;">Download</th>
                                    <th class="align-middle" style="width: 9%;">Delete</th>
                                    <th class="align-middle" style="width: 9%;">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($documents as $document)
                            <tr>
                                <td>{{ $document->file_num }}</td>{{--1 filenumber --}}
                                <td>{{ $document->filetype }}</td>{{--1 File Type --}}
                                <td>
                                    <a href="#" wire:click="showDocumentDetails({{ $document->id }})" style="text-decoration: underline; cursor: pointer;">
                                        {{ $document->document }}
                                    </a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($document->inclusive_dates)->toDateString() }}</td>
                                <td>{{ $document->records_location}}</td>{{--7 Documents Located --}}
                                <td>{{ $document->doctype }}</td>{{-- 3Document type --}}
                                <td class="text-center">
                                    <button wire:click="downloadfile({{ $document->id }})"
                                        class="btn btn-success btn-sm">Download</button>
                                </td>
                                <td class="text-center">
                                @if($document->doctype == 'Temporary')
                                    <button wire:click="deleteDocument({{ $document->id }})" class="btn btn-danger btn-sm">Delete</button>
                                @endif
                            </td>
                                <td class="text-center">
                                    <button wire:click="editReferenceNumber({{ $document->id }})" class="btn btn-info btn-sm">Edit</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="20" class="text-center">
                                    <h4 class="text-center">Document Not Found</h4>
                                </td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                    @if(count($documents))
                        {{ $documents->links('livewire-pagination-links') }}
                    @endif
                </div>
            </div>
        @endif
        @if ($createForm == true)
        <div class="container my-4">
            <button class="btn btn-success" wire:click='goBack'>
                <span wire:loading.remove wire:target='goBack'>
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span wire:loading wire:target='goBack'>
                    <i class="fas fa-spinner fa-spin"></i>
                </span>
            </button>
                <form wire:submit.prevent='save'>
                    <div class="form-group my-1">
                        <label for="volume">File Count</label>
                        <input type="number" wire:model='reference_num' class="form-control" id="filetype" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" required>
                        @error('reference_num')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group my-1">
                    <label for="records_location">Select Location Records</label>
                    <select wire:model='records_location' class="form-control" id="records_location" required>
                        <option value="">Select Location</option>
                        <option value="Warehouse">AICS | DSWD Field Office XI</option>
                        @foreach ($locationOptions as $location)
                            @if ($location)
                                <option value="{{ $location }}">{{ $location }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                

                    <div class="form-group my-1">
                        <label for="">Select Inclusive Dates</label>
                        <input type="date" wire:model='inclusive_dates' class="form-control" required>
                    </div>

            </div>

            <div class="col-md-6">
                    <div class="form-group my-1">
                        <label for="filetype">Select File Type</label>
                        <select wire:model="filetype" class="form-control" id="filetype" required>
                            <option value="">Select File Type</option>
                            <option value="Administrative">Administrative</option>
                            @foreach ($fileOptions as $file)
                            @if ($file)
                                <option value="{{ $file }}">{{ $file }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    @if ($filetype == 'Administrative')
                    <div class="form-group my-1">
                        <label for="administrativeType">Select Administrative Type</label>
                        <select wire:model='administrativeType' class="form-control selectpicker" id="administrativeType" data-live-search="true" required>
                            <option value="">Select Administrative Type</option>
                            <option value="Accommodation Billeting">Services Assistance</option>
                            

                    
                    <div class="form-group my-1">
                        <label for="form-label d-block">Upload Document</label>
                        <input type="file" wire:model='document' class="form-control" accept=".pdf" required>
                        @error('document')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end"> {{-- Add this container to align items to the end (right) --}}
                        <button type='submit' class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
        @endif
    </div>
    <div>
        @if ($selectedDocument)
            <!-- Blurred background overlay -->
            <div class="modal-backdrop fade show" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1050;"></div>
            <!-- Modal or details section -->
            <div class="modal fade show slide-down" id="detailsModal" tabindex="-1" role="dialog" style="display: block; z-index: 1051;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content slide-in">
                        <div class="modal-header" style="background-color: #4e73df; color: #ffffff;">
                            <h5 class="modal-title">Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeDetails" style="color: #000; border: none; outline: none;">
                                <span aria-hidden="true" style="color: #ffffff;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Display document details here -->
                            <p><strong>Records Filename:</strong> {{ $selectedDocument->document}}</p>
                            <p><strong>File Number:</strong> {{ $selectedDocument->file_num }}</p>
                            <p><strong>Record Series:</strong> {{ $selectedDocument->filetype }}</p>
                            <p><strong>Records Located:</strong> {{ $selectedDocument->records_location }}</p>
                            <!-- Display document content -->
                            <iframe src="{{ route('get.document.content', ['documentId' => $selectedDocument->id]) }}" width="100%" height="600px"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document" style="max-width: 570px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #000; border: none; outline: none;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
