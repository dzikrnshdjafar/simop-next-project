<?php

namespace App\Mail;

use App\Models\Activity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifyPicMail extends Mailable
{
    use Queueable, SerializesModels;

    public $activity;

    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pemberitahuan untuk melengkapi data',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.notify-pic',
            with: [
                'activity' => $this->activity,
                'url' => route('dashboard.activities.show', $this->activity->uuid),
            ]
        );
    }
    public function attachments(): array
    {
        return [];
    }
}
