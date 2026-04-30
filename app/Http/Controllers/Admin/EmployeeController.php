<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->get();

        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Employee::create($data);

        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Employee created');
    }

    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $employee->update($data);

        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Employee updated');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return back()->with('success', 'Employee deleted');
    }
}
