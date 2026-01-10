<?php

namespace App\Livewire\Admin;

use App\Models\SeoRedirect;
use Livewire\Component;
use Livewire\WithPagination;

class SeoRedirectsManager extends Component
{
    use WithPagination;

    public $showModal = false;
    public $isEditing = false;
    public $editingRedirect = null;
    public $search = '';

    public $formData = [
        'source_path' => '',
        'target_url' => '',
        'status_code' => 301,
        'is_active' => true,
    ];

    protected $rules = [
        'formData.source_path' => 'required|string|max:255',
        'formData.target_url' => 'required|string|max:255',
        'formData.status_code' => 'required|integer|in:301,302',
        'formData.is_active' => 'boolean',
    ];

    protected $messages = [
        'formData.source_path.required' => 'Vui lòng nhập đường dẫn nguồn.',
        'formData.target_url.required' => 'Vui lòng nhập URL đích.',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->resetFormData();
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function openEditModal($redirectId)
    {
        $redirect = SeoRedirect::find($redirectId);
        if ($redirect) {
            $this->editingRedirect = $redirect;
            $this->formData = [
                'source_path' => $redirect->source_path,
                'target_url' => $redirect->target_url,
                'status_code' => $redirect->status_code,
                'is_active' => $redirect->is_active,
            ];
            $this->isEditing = true;
            $this->showModal = true;
        }
    }

    public function saveRedirect()
    {
        $this->validate();

        // Ensure source path starts with /
        $sourcePath = '/' . ltrim($this->formData['source_path'], '/');

        $data = [
            'source_path' => $sourcePath,
            'target_url' => $this->formData['target_url'],
            'status_code' => $this->formData['status_code'],
            'is_active' => $this->formData['is_active'],
        ];

        if ($this->isEditing && $this->editingRedirect) {
            $this->editingRedirect->update($data);
            session()->flash('message', 'Đã cập nhật chuyển hướng thành công.');
        } else {
            // Check for duplicate source path
            if (SeoRedirect::where('source_path', $sourcePath)->exists()) {
                $this->addError('formData.source_path', 'Đường dẫn nguồn này đã tồn tại.');
                return;
            }
            SeoRedirect::create($data);
            session()->flash('message', 'Đã tạo chuyển hướng thành công.');
        }

        $this->closeModal();
    }

    public function deleteRedirect($redirectId)
    {
        SeoRedirect::destroy($redirectId);
        session()->flash('message', 'Đã xóa chuyển hướng.');
    }

    public function toggleActive($redirectId)
    {
        $redirect = SeoRedirect::find($redirectId);
        if ($redirect) {
            $redirect->update(['is_active' => !$redirect->is_active]);
        }
    }

    public function resetHitCount($redirectId)
    {
        $redirect = SeoRedirect::find($redirectId);
        if ($redirect) {
            $redirect->update(['hit_count' => 0, 'last_hit_at' => null]);
            session()->flash('message', 'Đã đặt lại lượt truy cập.');
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->isEditing = false;
        $this->editingRedirect = null;
        $this->resetFormData();
        $this->resetValidation();
    }

    private function resetFormData()
    {
        $this->formData = [
            'source_path' => '',
            'target_url' => '',
            'status_code' => 301,
            'is_active' => true,
        ];
    }

    public function render()
    {
        $redirects = SeoRedirect::query()
            ->when($this->search, function ($query) {
                $query->where('source_path', 'like', '%' . $this->search . '%')
                    ->orWhere('target_url', 'like', '%' . $this->search . '%');
            })
            ->orderByDesc('updated_at')
            ->paginate(10);

        return view('livewire.admin.seo-redirects-manager', [
            'redirects' => $redirects,
        ]);
    }
}
