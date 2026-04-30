<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Table;
use App\Models\Roster;
use Carbon\Carbon;

class RosterController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $tables = Table::all();

        $start = Carbon::today();
        $days = collect();

        for ($i = 0; $i < 7; $i++) {
            $days->push($start->copy()->addDays($i));
        }

        $rosters = Roster::all()->keyBy(function ($item) {
            return $item->date . '-' . $item->table_id;
        });

        return view('admin.roster.index', compact(
            'employees',
            'tables',
            'days',
            'rosters'
        ));
    }

    public function assign(Request $request)
    {
        $request->validate([
            'employee_id' => 'nullable|exists:employees,id',
            'table_id' => 'required|exists:tables,id',
            'date' => 'required|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
        ]);

        $roster = Roster::where('table_id', $request->table_id)
            ->where('date', $request->date)
            ->first();

        if ($roster) {
            $roster->update([
                'employee_id' => $request->employee_id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);
        } else {
            Roster::create([
                'employee_id' => $request->employee_id,
                'table_id' => $request->table_id,
                'date' => $request->date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);
        }

        return back();
    }

    public function storeEmployee(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Employee::create([
            'name' => $request->name,
        ]);

        return back();
    }
}
