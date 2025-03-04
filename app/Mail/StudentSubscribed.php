<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Student;
use App\Models\Group;
use App\Models\Course;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentSubscribed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Student $student,
        public Group $group,
        public Course $course,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Estudante inscrito!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.student.subscribed',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $pdf = PDF::loadView('contract', [
            "student" => $this->student,
            "group" => $this->group,
            "course" => $this->course,
        ]);

        return [
            \Illuminate\Mail\Mailables\Attachment::fromData(
                function () use ($pdf) {
                    return $pdf->output();
                },
                'contratooo.pdf',
                ['mime' => 'application/pdf']
            ),
        ];
    }
}
