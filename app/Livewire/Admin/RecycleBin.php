<?php

namespace App\Livewire\Admin;

use App\Models\Document as ModelsDocument;
use App\Models\Recycle;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class RecycleBin extends Component
{
    public $search = '';
    public $totalRecycles;
    public $recycleToDelete;
    public $recycleToRestore;
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $selectedDocument;

    protected $sortableFields = [
        'filetype', 'path', 'document','deleted_at','created_at', 'updated_at',
    ];

    public function sortBy($field)
    {
        if (in_array($field, $this->sortableFields)) {
            if ($field === $this->sortField) {
                $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                $this->sortDirection = 'asc';
                $this->sortField = $field;
            }
        }
    }

    public function render()
    {
        $recycles = Recycle::where('doctype', 'like', '%' . $this->search . '%')
            ->orWhere('document', 'LIKE', '%' . $this->search . '%')
            ->orWhere('reference_num', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        $this->totalRecycles = $recycles->total(); // Calculate the total number of recycles

        return view('livewire.admin.recyclebin', compact('recycles'))
            ->layout('layouts.admin-app');
    }

    public function performSearch()
    {
        $this->render();
    }

    public function updatedSearch()
    {
        // This method is automatically called when the $search property is updated.
    }

    public function restore($recycleId)
    {
        $recycle = Recycle::find($recycleId);

        if ($recycle) {
            $document = ModelsDocument::withTrashed()->where('document', $recycle->document)->first();

            if ($document) {
                $originalPath = $document->path;
                $result = $document->restore();

                if ($result) {
                    Storage::move($recycle->path, $originalPath);
                    $recycle->forceDelete();
                    session()->flash('status', 'Document and associated data restored successfully');
                    session()->flash('success', 'Document restored successfully');
                } else {
                    session()->flash('status', 'Error restoring document');
                }
            } else {
                session()->flash('status', 'Document not found in documents table');
            }
        } else {
            session()->flash('status', 'Document not found in recycle bin');
        }
    }

    public function delete($recycleId)
    {
        $recycle = Recycle::find($recycleId);

        if ($recycle) {
            $document = ModelsDocument::withTrashed()->where('document', $recycle->document)->first();

            if ($document) {
                $originalPath = $document->path;
                Storage::delete($originalPath);
                Storage::delete("RecycleBin/{$document->path}");
                $document->forceDelete();
                $recycle->forceDelete();
                session()->flash('success', 'Document permanently deleted successfully');
            } else {
                session()->flash('error', 'Document not found in documents table');
            }
        } else {
            session()->flash('error', 'Recycle record not found');
        }
    }

    public function deleteConfirmation($recycleId)
    {
        $this->recycleToDelete = $recycleId;
    }

    public function restoreConfirmation($recycleId)
    {
        $this->recycleToRestore = $recycleId;
    }
}
