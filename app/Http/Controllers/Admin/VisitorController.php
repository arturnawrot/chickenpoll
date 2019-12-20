<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;

class VisitorController extends Controller
{
    private $visitor;

    function __construct(Visitor $visitor)
    {
        $this->visitor = $visitor;
    }

    public function index()
    {
        $this->middleware(['permission:visitor.view']);
        $visitors = $this->visitor;
        $stats = [
            'total' => $visitors->count(),
            'unique' => $visitors->get()->unique('ip')->count()
        ];
        $data = [
            'visitors' => $visitors->sortable()->paginate(50),
            'stats' => $stats
        ];

        return view('admin.visitor.index', compact('data'));
    }
}
