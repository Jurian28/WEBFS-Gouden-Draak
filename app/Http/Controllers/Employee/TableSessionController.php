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

        // close old active group if exists
        Group::where('table_id', $table->id)
            ->where('active', true)
            ->update(['active' => false]);

        $group = Group::create([
            'table_id' => $table->id,
            'active' => true
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
            'name' => 'nullable|string',
            'age' => 'nullable|integer|min:0'
        ]);

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
