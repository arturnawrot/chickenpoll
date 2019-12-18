<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\PollRepositoryInterface as Poll;
use App\Repositories\Contracts\ReportRepositoryInterface as Report;

class ReportController extends Controller
{
    private $poll;
    private $report;

    function __construct(Poll $poll, Report $report)
    {
        $this->poll = $poll;
        $this->report = $report;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware(['permission:report.view']);
        $polls = $this->poll->makeModel()
            ->whereHas('reports')
            ->withCount('votes')
            ->sortable()
            ->paginate(50);
        return view('admin.reports.index', ['polls' => $polls]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->middleware(['permission:report.view']);
        return view('admin.reports.show', ['poll' => $this->poll->find($id)]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->middleware(['permission:report.delete']);
        foreach($request->reports as $id)
        {
            $this->report->find($id)->delete();
        }

        return redirect()->route('admin.reports.index')->with('alert-success', 'Report has been trashed!');
    }
}
