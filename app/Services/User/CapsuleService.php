<?php

namespace App\Services\User;

use Carbon\Carbon;

use App\Models\capsule;

class CapsuleService
{
    static function getAllCapsules(){
        return Capsule::all();
    }


    // static function getPublicWallCapsules(){
    //     return Capsule::where('reveal_date','<=', now())
    //         ->where('privacy', 'public')
    //         ->get();
    // }

    static function getPublicWallCapsules($mood = null, $country = null, $sort = 'asc') {
        $query = Capsule::where('reveal_date', '<=', now())
            ->where('privacy', 'public');
    
        if ($mood) {
            $query->where('mood', $mood);
        }
    
        if ($country) {
            $query->where('country', $country);
        }
    
        $query->orderBy('reveal_date', $sort);
    
        return $query->get();
    }






    static function getUserWallCapsules($user_id) {
        return Capsule::where('user_id', $user_id)
            ->where(function ($query) {
                $query->where('is_surprise', 0)
                      ->orWhere('reveal_date', '<=', now());
            })
            ->get();
    }







    // static function autoRevealCapsules()
    // {
    //     $now = Carbon::now();

    //     $capsules = Capsule::where('is_revealed', 0)
    //         ->where('reveal_date', '<=', $now)
    //         ->get();

    //     foreach ($capsules as $capsule) {
    //         $capsule->is_revealed = true;
    //         $capsule->save(); // will trigger 'updated' model event
    //     }

    //     return $capsules->count(); // return how many were revealed
    // }
    









    /**
     * Create a new class instance.
     */
    // public function __construct()
    // {
    //     //
    // }
}
