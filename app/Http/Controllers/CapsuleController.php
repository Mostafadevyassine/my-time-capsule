<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecapsuleRequest;
use App\Http\Requests\UpdatecapsuleRequest;
use App\Models\capsule;

class CapsuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
