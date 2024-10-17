<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Client;

class BeneficiaryTable extends Component
{
    use WithPagination;

    public $search = ''; // Add a public property for the search term

    protected $queryString = ['search']; // Add this to sync search to URL
    public $sortField = 'client_no'; // Default sort field
    public $sortDirection = 'asc'; // Default sort direction

    // Method to update sort direction
    public function updateSort($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination when search term changes
    }

   
    public function render()
    {
        $clients = Client::where('client_no', 'like', '%' . $this->search . '%')
            ->orWhere('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')

            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(15);

        return view('livewire.user.beneficiary-table', ['clients' => $clients])
            ->layout('layouts.user-app');
    }
}