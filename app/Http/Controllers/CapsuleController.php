<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StorecapsuleRequest;
use App\Http\Requests\UpdatecapsuleRequest;
use App\Models\Capsule;
use App\Services\User\CapsuleService;

class CapsuleController extends Controller

{


    public function getAllCapsules(){
        $capsules = CapsuleService::getAllCapsules();
        return $this->responseJSON($capsules);
    }
    /**
     * Display a listing of the resource.
     */

    // public function getPublicWallCapsules(){
    //     $capsules = CapsuleService::getPublicWallCapsules();
    //     return $this->responseJSON($capsules);
    // }



    public function getPublicWallCapsules(Request $request) {
        // Pass the whole request object or just the needed data to the service
        $capsules = CapsuleService::getPublicWallCapsules($request);
        return $this->responseJSON($capsules);
    }


    public function getCapsuleById(Request $request){
        $capsule = $request->id;
        $capsule = CapsuleService::getCapsuleById( $capsule);
        return $this->responseJSON($capsule);
    }


    public function getUserWallCapsules(Request $request) {
        $user_id = $request->user_id;
        $capsules = CapsuleService::getUserWallCapsules($user_id);
        return $this->responseJSON($capsules);
    }


    public function createCapsule(Request $request)
    {
        $result = CapsuleService::createCapsule($request);
        return $this->responseJSON($result);
    }









    public function index()
    {
        $capsules = Capsule::all();

        return response()->json([
            'status' => 200,
            'capsules' => $capsules
        ]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecapsuleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(capsule $capsule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(capsule $capsule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecapsuleRequest $request, capsule $capsule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(capsule $capsule)
    {
        //
    }
}
