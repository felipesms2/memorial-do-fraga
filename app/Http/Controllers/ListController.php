<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fileToRead  =__DIR__ . "../../../../resources/video_list.csv";
        $file = fopen($fileToRead,"r");
        var_dump(fgetcsv($file));
        while(! feof($file))
  {
   dd(fgetcsv($file));
  }
  // Endpoint
    /*   https://www.googleapis.com/youtube/v3/videos?part=id%2C+snippet&id=fL5cWD84mYw&
        id=XYe94GtMkJQ&
        id=qzq2lJZBtCs&
        id=lHlH94GklAE&
        id=Mc4ByWixwdw&
    key=AIzaSyBB93pQFssH3DTGXfROEojYCJARPOzQj04&id=GOuSNVTKfRs */
fclose($file);
        die;
        return ".." . __DIR__;
        return [1,2,3];
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
