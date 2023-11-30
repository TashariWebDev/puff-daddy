<?php

namespace App\Livewire\Forms;

use App\Models\Customer;
use Livewire\Form;

class DocumentForm extends Form
{
    public Customer $customer;

    public $id_document;

    public $cipc_documents;

    public function rules(): array
    {
        return [
            'cipc_documents' => ['sometimes'],
            'id_document' => ['required'],

        ];
    }

    public function messages(): array
    {
        return [
            'id_document' => 'Your ID Document is required',
        ];
    }

    public function setCustomer(): void
    {
        $this->customer = auth()->user();

        $this->customer->makeVisible(['cipc_documents', 'id_document']);

        $this->cipc_documents = $this->customer->cipc_documents;
        $this->id_document = $this->customer->id_document;
    }

    public function update(): void
    {
        $this->validate();
        $this->customer->update([
            'id_document' => $this->id_document->store('uploads', 'public'),
            'cipc_documents' => $this->cipc_documents->store('uploads', 'public'),
        ]);
    }
}
