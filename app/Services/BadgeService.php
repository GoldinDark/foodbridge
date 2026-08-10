<?php

namespace App\Services;

use App\Models\Badge;
use App\Models\User;

class BadgeService
{
    public function checkAndAwardBadges(User $user): void
    {
        $completedCount = $user->claims()->where('status', 'completed')->count();

        if ($completedCount >= 1) {
            $this->award($user, 'Penyelamat Pertama');
        }

        if ($completedCount >= 10) {
            $this->award($user, 'Pahlawan Pangan');
        }

        $hasFiveStarReview = $user->claims()
            ->whereHas('review', function ($query) {
                $query->where('rating', 5);
            })
            ->exists();

        if ($hasFiveStarReview) {
            $this->award($user, 'Bintang Lima');
        }
    }

    protected function award(User $user, string $badgeName): void
    {
        $badge = Badge::where('name', $badgeName)->first();

        if (! $badge) {
            return;
        }

        if (! $user->badges()->where('badge_id', $badge->id)->exists()) {
            $user->badges()->attach($badge->id, ['earned_at' => now()]);
        }
    }
}