<?php

namespace App\Livewire\User;

use App\Models\Document;
use App\Models\UserActivityLog;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RecycleBin extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'deleted_at';
    public $sortDirection = 'desc';
    public $documentId;
    public $confirmingAction = null;

    public function updatedSearch()
    {
        $this->resetPage(); // Reset pagination on search
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function confirmRestore($documentId)
    {
        $this->documentId = $documentId;
        $this->confirmingAction = 'restore';

        // Use `dispatchBrowserEvent` to trigger the modal
        $this->dispatch('showRestoreModal');
    }

    public function restoreConfirmed()
    {
        $document = Document::onlyTrashed()->findOrFail($this->documentId);
        $document->restore();

        // Log the document restoration activity

        $this->logActivity(Auth::user(), 'Restore', 'Restored document: ' . $document->document);


        session()->flash('success', 'Document restored successfully!');
        $this->resetModal();
        $this->dispatch('documentRestored'); // Emit an event to refresh the list or perform additional actions
    }

    private function resetModal()
    {
        $this->documentId = null;
        $this->confirmingAction = null;
    }

    public function render()
    {
        $query = Document::onlyTrashed()->orderBy($this->sortField, $this->sortDirection);

        if ($this->search) {
            $query->where('document', 'LIKE', '%' . $this->search . '%');
        }

        $recycleBinDocuments = $query->paginate($this->perPage);

        return view('livewire.user.recyclebin', [
            'recycleBinDocuments' => $recycleBinDocuments,
        ])->layout('layouts.user-app');
    }

    // Log activity method

    public function logActivity($user, $activityType, $description)
    {
        // Ensure $activityType is a string
        if (is_array($activityType) || is_object($activityType)) {
            $activityType = json_encode($activityType);
        }

        // Create the log entry
        $user->activityLogs()->create([
            'activity_type' => $activityType, // This should be a string like 'restore'
            'description' => $description, // This can be a message like "Restored document with ID: {document_id}"
        ]);
    }

}
