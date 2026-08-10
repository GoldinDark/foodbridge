<?php

namespace App\Notifications;

use App\Models\Claim;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewClaimNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected Claim $claim
    ) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'claim_id' => $this->claim->id,
            'food_name' => $this->claim->food->name,
            'claimant_name' => $this->claim->user->name,
            'message' => "{$this->claim->user->name} mengklaim makanan \"{$this->claim->food->name}\" milik Anda.",
        ];
    }
}