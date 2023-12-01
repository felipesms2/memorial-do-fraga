<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\Video;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function store(StoreVideoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoRequest $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        //
    }
}
