<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\User;
use App\Mail\NewArticleMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewArticleNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $article;
    public $moderator;

    public function __construct(Article $article, User $moderator)
    {
        $this->article = $article;
        $this->moderator = $moderator;
    }

    public function handle(): void
    {
        Mail::to($this->moderator->email)
            ->send(new NewArticleMail($this->article, $this->moderator));
    }
}