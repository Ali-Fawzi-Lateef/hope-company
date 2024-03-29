<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\IReportsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    private IReportsRepository $report;
    public function __construct(IReportsRepository $report)
    {
        $this->report = $report;
    }
    public function index():View
    {
        return view('pages.manager.reports.reports',['reports'=>$this->report->index()]);
    }
    public function destroy(Request $request)
    {
        return $this->report->destroy($request);
    }
    public function create():View
    {
        return view('pages.supervisor.reports.fillReport');
    }
    public function store(Request $request):RedirectResponse
    {
        return $this->report->store($request);
    }
}
