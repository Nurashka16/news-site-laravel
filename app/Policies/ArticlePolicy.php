<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    // Хук: модератор может ВСЁ
    public function before(User $user, $ability)
    {
        return $user->isModerator() ? true : null;
    }

    // Просмотр — всегда разрешён
    public function viewAny(?User $user): bool { return true; }
    public function view(?User $user, Article $article): bool { return true; }

    // Остальные методы — только для модератора
    public function create(User $user): bool { return $user->isModerator(); }
    public function update(User $user, Article $article): bool { return $user->isModerator(); }
    public function delete(User $user, Article $article): bool { return $user->isModerator(); }
}