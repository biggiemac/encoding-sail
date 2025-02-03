<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EncodingJob;

class EncodingJobController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'input' => 'required|url',
            'storage' => 'required|url',
            'outputs' => 'required|array',
            'outputs.*.format' => 'required|string',
            'outputs.*.resolution' => 'nullable|string',
            'outputs.*.bitrate' => 'nullable|string',
            'notification' => 'required|url',
        ]);

        $job = EncodingJob::create([
            'user_id' => $request->user()->id,
            'input' => $validated['input'],
            'storage' => $validated['storage'],
            'outputs' => json_encode($validated['outputs']),
            'notification' => $validated['notification'],
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Encoding job created successfully',
            'job_id' => $job->id,
        ], 201);
    }
}