<?php

namespace App\Livewire;

use App\Models\Inquiry;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $message = '';
    public string $honeypot = ''; // Spam protection
    public bool $success = false;

    // Tour inquiry properties
    public ?int $tourId = null;
    public ?string $tourName = null;

    protected $rules = [
        'name' => 'required|min:2|max:100',
        'email' => 'required|email',
        'phone' => 'nullable|max:20',
        'message' => 'required|min:10|max:2000',
    ];

    protected $messages = [
        'name.required' => 'Please enter your name.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'message.required' => 'Please enter your message.',
        'message.min' => 'Your message must be at least 10 characters.',
    ];

    public function mount(?int $tourId = null, ?string $tourName = null): void
    {
        $this->tourId = $tourId;
        $this->tourName = $tourName;

        // Pre-fill message if this is a tour inquiry
        if ($this->tourName) {
            $this->message = "I'm interested in the tour: {$this->tourName}\n\nPlease provide more information about availability and pricing.";
        }
    }

    public function submit(): void
    {
        // Honeypot check - if filled, it's a bot
        if (!empty($this->honeypot)) {
            return;
        }

        $this->validate();

        Inquiry::create([
            'type' => $this->tourId ? 'tour_booking' : 'contact',
            'tour_id' => $this->tourId,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone ?: null,
            'message' => $this->message,
            'status' => 'new',
        ]);

        $this->success = true;
        $this->reset(['name', 'email', 'phone', 'message']);

        // Dispatch toast notification
        $this->dispatch('toast', [
            'type' => 'success',
            'title' => 'Message Sent!',
            'message' => 'Thank you for contacting us. We\'ll get back to you soon.',
        ]);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
