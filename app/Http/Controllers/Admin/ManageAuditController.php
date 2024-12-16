<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageAudit;
use Illuminate\Http\Request;

class ManageAuditController extends Controller
{
    public function index()
    {
        // Fetch data from the manage_audit table, ordered by timestamp
        $audits = ManageAudit::orderBy('Time_Stamp', 'desc')->get();

        // Pass data to the view
        return view('admin.manage_audit.index', compact('audits'));
    }
}
  