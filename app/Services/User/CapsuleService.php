<?php

namespace App\Services\User;

use App\Models\capsule;

class CapsuleService
{
    static function getAllCapsules(){
        return Capsule::all();
    }


    static function getPublicWallCapsules(){
        return Capsule::where('is_revealed', 1)
            ->where('privacy', 'public')
            ->get();
    }
    









    /**
     * Create a new class instance.
     */
    // public function __construct()
    // {
    //     //
    // }
}
