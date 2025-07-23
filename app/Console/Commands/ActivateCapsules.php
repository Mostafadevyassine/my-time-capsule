<?php

namespace App\Console\Commands;

use App\Models\Capsule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\CapsuleActivatedMail;

class ActivateCapsules extends Command
{
    protected $signature = 'app:activate-capsules';
    protected $description = 'Activate capsules and notify users by email';

    public function handle()
    {
        $capsules = Capsule::where('is_revealed', false)
            ->whereDate('reveal_date', '<=', Carbon::today())
            ->get();

        foreach ($capsules as $capsule) {
            $user = User::find($capsule->user_id);

            if ($user && $user->email) {
                Mail::to($user->email)->send(new CapsuleActivatedMail($capsule, $user));
            }

            $capsule->is_revealed = true;
            $capsule->save();
        }

        $this->info('Capsules activated and emails sent successfully.');
    }
}