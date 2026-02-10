<?php

namespace App\Http\Controllers;

use App\Models\ErrorLog;
use Illuminate\Http\Request;

class ErrorLogController extends Controller
{
    public function index()
    {
        $logs = ErrorLog::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.logs.index', compact('logs'));
    }
}
