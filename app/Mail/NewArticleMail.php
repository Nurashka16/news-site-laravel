<?php

namespace App\Mail;

use App\Models\Article;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewArticleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $article;
    public $moderator;

    public function __construct(Article $article, User $moderator)
    {
        $this->article = $article;
        $this->moderator = $moderator;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Новая статья: ' . $this->article->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-article',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}