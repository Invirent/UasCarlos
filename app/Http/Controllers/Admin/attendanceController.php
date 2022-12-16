<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\attendance;
use Illuminate\Http\Request;

class attendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $attendance = attendance::where('employee_id', 'LIKE', "%$keyword%")
                ->orWhere('in_time', 'LIKE', "%$keyword%")
                ->orWhere('out_time', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $attendance = attendance::latest()->paginate($perPage);
        }

        return view('admin.attendance.index', compact('attendance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.attendance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        attendance::create($requestData);

        return redirect('admin/attendance')->with('flash_message', 'attendance added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $attendance = attendance::findOrFail($id);

        return view('admin.attendance.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $attendance = attendance::findOrFail($id);

        return view('admin.attendance.edit', compact('attendance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $attendance = attendance::findOrFail($id);
        $attendance->update($requestData);

        return redirect('admin/attendance')->with('flash_message', 'attendance updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        attendance::destroy($id);

        return redirect('admin/attendance')->with('flash_message', 'attendance deleted!');
    }
}
