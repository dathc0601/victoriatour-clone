<?php

namespace App\Livewire\Admin;

use App\Models\FooterColumn;
use Livewire\Component;

class FooterColumnManager extends Component
{
    public $columns = [];
    public $editingColumn = null;
    public $showModal = false;
    public $isEditing = false;

    // Form data
    public $formData = [
        'title_en' => '',
        'title_vi' => '',
        'type' => 'menu_links',
        'width' => 1,
        'is_active' => true,
        'settings' => [],
    ];

    protected $rules = [
        'formData.title_en' => 'required|string|max:255',
        'formData.title_vi' => 'nullable|string|max:255',
        'formData.type' => 'required|string',
        'formData.width' => 'required|integer|min:1|max:4',
        'formData.is_active' => 'boolean',
    ];

    public function mount()
    {
        $this->loadColumns();
    }

    public function loadColumns()
    {
        $this->columns = FooterColumn::ordered()->get()->toArray();
    }

    public function updateOrder($orderedIds)
    {
        foreach ($orderedIds as $index => $item) {
            FooterColumn::where('id', $item['value'])->update(['order' => $index]);
        }
        $this->loadColumns();
    }

    public function openCreateModal()
    {
        $this->resetFormData();
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function openEditModal($columnId)
    {
        $column = FooterColumn::find($columnId);
        if ($column) {
            $this->editingColumn = $column;
            $this->formData = [
                'title_en' => $column->getTranslation('title', 'en'),
                'title_vi' => $column->getTranslation('title', 'vi'),
                'type' => $column->type,
                'width' => $column->width,
                'is_active' => $column->is_active,
                'settings' => $column->settings ?? [],
            ];
            $this->isEditing = true;
            $this->showModal = true;
        }
    }

    public function saveColumn()
    {
        $this->validate();

        $data = [
            'title' => [
                'en' => $this->formData['title_en'],
                'vi' => $this->formData['title_vi'] ?: $this->formData['title_en'],
            ],
            'type' => $this->formData['type'],
            'width' => $this->formData['width'],
            'is_active' => $this->formData['is_active'],
            'settings' => $this->formData['settings'],
        ];

        if ($this->isEditing && $this->editingColumn) {
            $this->editingColumn->update($data);
            session()->flash('message', 'Column updated successfully.');
        } else {
            $data['order'] = FooterColumn::max('order') + 1;
            FooterColumn::create($data);
            session()->flash('message', 'Column created successfully.');
        }

        $this->closeModal();
        $this->loadColumns();
    }

    public function deleteColumn($columnId)
    {
        FooterColumn::destroy($columnId);
        $this->loadColumns();
        session()->flash('message', 'Column deleted.');
    }

    public function toggleActive($columnId)
    {
        $column = FooterColumn::find($columnId);
        if ($column) {
            $column->update(['is_active' => !$column->is_active]);
            $this->loadColumns();
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->isEditing = false;
        $this->editingColumn = null;
        $this->resetFormData();
    }

    private function resetFormData()
    {
        $this->formData = [
            'title_en' => '',
            'title_vi' => '',
            'type' => 'menu_links',
            'width' => 1,
            'is_active' => true,
            'settings' => [],
        ];
    }

    public function render()
    {
        return view('livewire.admin.footer-column-manager', [
            'columnTypes' => FooterColumn::getTypes(),
        ]);
    }
}
