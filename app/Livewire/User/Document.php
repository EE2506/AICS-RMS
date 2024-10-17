<?php

namespace App\Livewire\User;

use App\Models\Document as ModelsDocument;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ClientsImport;
use Maatwebsite\Excel\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use App\Imports\PreviewImport;

class Document extends Component
{
    public $document;
    public $showTable = false;
    public $createForm = false;
    public $perPage = 15;
    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $totalDocuments;
    public $path;
    public $showModal = false;
    public $recycleBin = []; // Array to store archived documents


    public $fileContent = [];  // For storing file preview content
    public $fileHeaders = [];  // For storing file headers


    use WithFileUploads;
    use WithPagination;

    public function mount()
    {
        $this->totalDocuments = ModelsDocument::count();
        $this->loadRecycleBin();
    }

     // Re-render the Livewire component to perform a search
     public function performSearch()
     {
         $this->render();
     }

     // Handle updates to the search property
     public function updatedSearch()
{
    $this->resetPage(); // Reset pagination on search
}
    protected $rules = [
        'document' => 'required|file|mimes:csv,xls,xlsx|max:1024000000000',
    ];

    public function save()
    {
        $this->validate();

    $existingDocument = ModelsDocument::where('document', $this->document->getClientOriginalName())->first();

    if ($existingDocument) {
        $this->showModal = true;
        return;
    }

    $currentDate = Carbon::now()->format('Y-m-d');
    $this->path = $this->document->store("Documents/{$currentDate}");

    // Save the document details to the database
    $document = new ModelsDocument([
        'filetype' => $this->document->getClientOriginalExtension(),
        'path' => $this->path,
        'document' => $this->document->getClientOriginalName(),
    ]);

    if ($document->save()) {
        // Process the uploaded Excel file
        Excel::import(new ClientsImport, $this->document);

        session()->flash('success', 'Document saved and data imported successfully');
        $this->deleteLivewireTmp();
        $this->resetForm();
    } else {
        session()->flash('status', 'Error uploading file');
    }
}

    public function archive($documentId)
    {
        $document = ModelsDocument::findOrFail($documentId);

        if ($document) {
            // Soft delete the document and move it to the recycle bin
            $document->delete();
            session()->flash('success', 'Document archived successfully!');

            // Reload the list and recycle bin
            $this->resetPage();
            $this->loadRecycleBin();
        } else {
            session()->flash('error', 'Document not found!');
        }
    }


    protected function loadRecycleBin()
    {
        $this->recycleBin = ModelsDocument::onlyTrashed()->get()->toArray(); // Load archived documents
    }

    protected function deleteLivewireTmp()
    {
        $livewireTmpPath = storage_path('app/livewire-tmp');

        if (File::exists($livewireTmpPath)) {
            File::deleteDirectory($livewireTmpPath);
        }
    }

    public function resetForm()
    {
        $this->document = null;
        $this->showTable = true;
        $this->createForm = false;
    }

    public function showForm()
    {
        $this->showTable = false;
        $this->createForm = true;
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

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        $query = ModelsDocument::orderBy($this->sortField, $this->sortDirection);

        if ($this->search) {
            $query->where('document', 'LIKE', '%' . $this->search . '%');
        }

        $documents = $query->paginate($this->perPage);

        return view('livewire.user.document', [
            'documents' => $documents,
            'recycleBin' => $this->recycleBin, // Pass recycle bin to the view
        ])->layout('layouts.user-app');
    }

    public function openPreviewModal($documentId)
    {
        $document = ModelsDocument::findOrFail($documentId);
        $path = storage_path("app/{$document->path}");

        // Load the file and preview content
        $data = Excel::toArray(new PreviewImport, $path);

        // Define the maximum number of rows to display
        $maxRows = 100; // Adjust this number as needed

        // Get the total number of rows
        $totalRows = count($data[0]);

        // Determine the number of rows to display
        $rowsToDisplay = min($totalRows, $maxRows);

        // Extract headers and limited rows
        $this->fileHeaders = array_keys($data[0][0]); // First row headers
        $this->fileContent = array_slice($data[0], 0, $rowsToDisplay); // Limit rows

        // Trigger the modal display
        $this->dispatch('openFilePreviewModal');
    }

}

