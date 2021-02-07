<?php

namespace App\Http\Controllers;

use App\Street;
use Illuminate\Http\Request;

class StreetController extends Controller
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
            'street' => 'required|unique:streets,route|max:30|min:3',
            'area_id' => 'required',
        ]);
        //save data after validation
        if ($validated) {
            $street = new Street();
            $street->country = "DE";
            $street->area_id = $request->area_id;
            $street->route = $request->street;
            $street->latitude = $request->latitude;
            $street->longitude = $request->longitude;
            $street->save();
        }
        return response()->json($street);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Street  $street
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->search;
        $street = Street::with('area')
            ->where('route', 'LIKE', "%{$search}%")
            ->get();
        return response()->json($street);
    }
}
