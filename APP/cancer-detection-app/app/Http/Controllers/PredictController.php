<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PredictController extends Controller
{
    public function predict(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            // 'type' => 'required|string|in:colon,lung'
        ]);
        
        $image = $request->file('image');
        $storedPath = $image->store('uploads', 'public');
        
        // dd($storedPath);
        // Determine which Flask model to call
        $endpoint = $request->input('type') === 'lung'
        ? 'http://127.0.0.1:5000/lung/predict'
        : 'http://127.0.0.1:5000/colon/predict';
        
        // Send image to Flask
        $response = Http::attach(
            'image',
            file_get_contents($image),
            $image->getClientOriginalName(),
            ['Content-Type' => $image->getClientMimeType()]
        )->post($endpoint);

        return view('result', [
            'result' => $response->json(),
            'imagePath' => $storedPath,
            'type' => $request->input('type')
        ]);
    }
}
