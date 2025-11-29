<?php

namespace App\Livewire;

use App\Models\Inquiry;
use Livewire\Component;

class NewsletterForm extends Component
{
    public string $email = '';
    public bool $success = false;
    public string $error = '';

    protected $rules = [
        'email' => 'required|email',
    ];

    public function subscribe(): void
    {
        $this->validate();

        // Check if already subscribed
        $exists = Inquiry::where('type', 'newsletter')
            ->where('email', $this->email)
            ->exists();

        if ($exists) {
            $this->error = 'This email is already subscribed.';
            return;
        }

        Inquiry::create([
            'type' => 'newsletter',
            'name' => 'Newsletter Subscriber',
            'email' => $this->email,
            'status' => 'new',
        ]);

        $this->success = true;
        $this->email = '';
        $this->error = '';
    }

    public function render()
    {
        return view('livewire.newsletter-form');
    }
}
