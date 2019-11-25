<?php

namespace App\Http\Controllers;

use App\Campaign;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Campaign::Where('status', 'finished')->get();

        return view('reports.index', compact('reports'));
    }

    public function show(Campaign $campaign)
    {
        // @tood implement report view
        return $campaign->linksTracking()->count();
    }
}
