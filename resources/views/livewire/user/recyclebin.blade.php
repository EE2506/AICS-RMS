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

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <!-- Header Section -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="h4 text-gray-700 font-weight-bold">Recycle Bin</h1>
                </div>
        <table class="table mt-4 text-center table-bordered">
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
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('showRestoreModal', () => {
            $('#restoreModal').modal('show');
        });

        Livewire.on('documentRestored', () => {
            $('#restoreModal').modal('hide');
        });
    });
</script>

<style>
    .table-container {
        margin: 20px;
        overflow-x: auto;
    }

    .table-header {
        background-color: #0654a8;
        color: #fff;
        text-align: center;
    }

    .table th, .table td {
        padding: 10px 20px;
        vertical-align: middle;
        text-align: center;
        white-space: nowrap;
    }

    .table th a {
        color: #fff;
    }
    .btn-success, .btn-secondary{
        color: white;
                border: none;
                margin-right: 3px;
                transition: background-color 0.3s ease;
                padding: 10px 25px; /* Same padding for both buttons */
                font-size: 14px;    /* Same font size for consistency */
                width: 120px;       /* Fixed width to make buttons the same size */
                height: 50px;       /* Fixed height for uniformity */
                text-align: center;
                display: inline-block;
    }

</style>
