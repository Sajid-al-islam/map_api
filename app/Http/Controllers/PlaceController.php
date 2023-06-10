<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;

class PlaceController extends Controller
{
    public function place_info(Request $request) {
        $request->validate([
            'lat' => 'required',
            'long' => 'required',
        ]);

        $client = new Client();
        $response = $client->get('https://maps.googleapis.com/maps/api/place/nearbysearch/json', [
            'query' => [
                'location' => $request->lat . ',' . $request->long,
                'radius' => 5000,
                'key' => env('GOOGLE_MAPS_API_KEY'),
            ],
        ]);

        $responseData = json_decode($response->getBody(), true);

        return response()->json($responseData['results']);

        
    }
}
