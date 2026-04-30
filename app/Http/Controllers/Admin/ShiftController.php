<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Models\Employee;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::all();
        $tables = Table::all();

        $startOfWeek = Carbon::parse(
            $request->get('week_start', now()->startOfWeek())
        );

        $days = collect(range(0, 6))->map(fn ($i) =>
            $startOfWeek->copy()->addDays($i)
        );

        $shifts = Shift::with(['employee', 'tables'])
            ->whereBetween('date', [
                $startOfWeek->toDateString(),
                $startOfWeek->copy()->endOfWeek()->toDateString(),
            ])
            ->get()
            ->groupBy(fn ($shift) => $shift->date->format('Y-m-d'));

        return view('admin.schedule.index', compact(
            'employees',
            'tables',
            'days',
            'shifts',
            'startOfWeek'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'tables' => 'array',
            'tables.*' => 'exists:tables,id',
        ]);

        $shift = Shift::create([
            'employee_id' => $data['employee_id'],
            'date' => $data['date'],
            'start_time' => $data['start_time'] ?? null,
            'end_time' => $data['end_time'] ?? null,
        ]);

        if (!empty($data['tables'])) {
            $shift->tables()->sync($data['tables']);
        }

        return back();
    }

    public function update(Request $request, Shift $shift)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'tables' => 'array',
            'tables.*' => 'exists:tables,id',
        ]);

        $shift->update([
            'employee_id' => $data['employee_id'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
        ]);

        $shift->tables()->sync($data['tables'] ?? []);

        return back();
    }
}
