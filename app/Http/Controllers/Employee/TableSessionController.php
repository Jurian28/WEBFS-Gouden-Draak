<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Table;
use Illuminate\Http\Request;

class TableSessionController extends Controller
{
    // Show all tables
    public function index()
    {
        $tables = Table::all();

        return view('employee.tables.index', compact('tables'));
    }

    // Start a group for a table
    public function startTable(Request $request)
    {
        $table = Table::findOrFail($request->table_id);

        Group::where('table_id', $table->id)
            ->where('active', true)
            ->update(['active' => false]);

        $group = Group::create([
            'table_id' => $table->id,
            'active' => true,
            'deluxe' => $request->has('deluxe')
        ]);

        return redirect()->route('table.show', $group->id);
    }

    // Show group + guests
    public function show(Group $group)
    {
        $group->load('guests', 'table');

        return view('employee.tables.show', compact('group'));
    }

    // Add guest
    public function addGuest(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|string',
            'age' => 'required|integer|min:0'
        ]);

        // BUSINESS RULE: max 8 guests
        if ($group->guests()->count() >= 8) {
            return back()->withErrors([
                'limit' => 'Maximaal 8 personen per tafel toegestaan.'
            ]);
        }

        $group->guests()->create([
            'name' => $request->name,
            'age' => $request->age
        ]);

        return back();
    }

    // Finish table session
    public function finish(Group $group)
    {
        $group->update(['active' => false]);

        return redirect()->route('employee.tables');
    }
}
