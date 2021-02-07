<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validate the request
        $validated = $request->validate([
            'locality' => 'required|max:255',
            'postal_code' => 'required|numeric|unique:areas|digits:5',
        ]);
        //save data after validation
        if ($validated) {
            $area = new Area();
            $area->country = "DE";
            $area->postal_code = $request->postal_code;
            $area->locality = $request->locality;
            $area->latitude = $request->latitude;
            $area->longitude = $request->longitude;
            $area->save();
        }
        return response()->json($area);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $area = Area::orderBy('created_at', 'desc')->get();
        return response()->json($area);
    }
}
