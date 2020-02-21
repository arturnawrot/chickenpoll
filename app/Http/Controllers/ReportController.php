<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Poll;
use App\Http\Requests\StoreReport;

class ReportController extends Controller
{
    private $report;
    private $poll;

    function __construct(Report $report, Poll $poll)
    {
        $this->report = $report;
        $this->poll = $poll;
    }

    public function index($id = 0)
    {
        return view('report', ['id' => $id]);
    }

    public function store($id = 0, StoreReport $request)
    {
        $validated = $request->validated();

        $this->report->create([
            'poll_id' => $id,
            'content' => $request->content,
            'email' => $request->email,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'agent' => $_SERVER['HTTP_USER_AGENT']
        ]);

        return redirect()->back()->with('alert-success', 'Thank you for your report.');
    }
}
