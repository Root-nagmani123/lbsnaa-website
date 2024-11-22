<?php

namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use App\Models\Admin\Micro\MicroManageAudit;
use Illuminate\Http\Request;

class MicroManageAuditController extends Controller
{
    public function index()
    {
        // Fetch data from the manage_audit table, ordered by timestamp
        $audits = MicroManageAudit::orderBy('Time_Stamp', 'desc')->get();

        // Pass data to the view
        return view('admin.micro.manage_audit.index', compact('audits'));
    }
}
