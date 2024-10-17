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

        <div class="input-group mb-3" style="width:50%">
            <input type="text" wire:model="search" class="form-control" placeholder="Search...">
            <div class="input-group-append align-items-center">
                <button wire:click="performSearch" class="btn btn-primary">Search</button>
            </div>
        </div>

        <table class="table mt-4 text-center">
            <thead>
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
                        <a href="#" wire:click.prevent="sortBy('deleted_at')">
                            Deleted At
                            @if ($sortField === 'deleted_at')
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
                @foreach($recycleBinDocuments as $document)
                    <tr>
                        <td>{{ $document->id }}</td>
                        <td>{{ $document->document }}</td>
                        <td>{{ $document->filetype }}</td>
                        <td>{{ $document->deleted_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <!-- Restore Button -->
                            <button wire:click="confirmRestore({{ $document->id }})" class="btn btn-success btn-sm">Restore</button>

                            <!-- Delete Permanently Button -->
                            <button wire:click="confirmDelete({{ $document->id }})" class="btn btn-danger btn-sm">Delete Permanently</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $recycleBinDocuments->links() }}

    </div>

    <!-- Restore Confirmation Modal -->
    <div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-labelledby="restoreModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="restoreModalLabel">Restore Document</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to restore this document?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" wire:click="restoreConfirmed" class="btn btn-success">Continue</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Permanently Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Permanently</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to permanently delete this document?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" wire:click="deleteConfirmed" class="btn btn-danger">Continue</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    Livewire.on('confirmRestore', () => {
        $('#restoreModal').modal('show');
    });

    Livewire.on('confirmDelete', () => {
        $('#deleteModal').modal('show');
    });
</script>
@endpush
