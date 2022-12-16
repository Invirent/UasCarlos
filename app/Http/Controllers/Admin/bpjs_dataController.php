<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\bpjs_datum;
use Illuminate\Http\Request;

class bpjs_dataController extends Controller
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
            $bpjs_data = bpjs_datum::where('nama', 'LIKE', "%$keyword%")
                ->orWhere('expiration_date', 'LIKE', "%$keyword%")
                ->orWhere('cost', 'LIKE', "%$keyword%")
                ->orWhere('active', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $bpjs_data = bpjs_datum::latest()->paginate($perPage);
        }

        return view('admin.bpjs_data.index', compact('bpjs_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.bpjs_data.create');
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
        
        bpjs_datum::create($requestData);

        return redirect('admin/bpjs_data')->with('flash_message', 'bpjs_datum added!');
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
        $bpjs_datum = bpjs_datum::findOrFail($id);

        return view('admin.bpjs_data.show', compact('bpjs_datum'));
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
        $bpjs_datum = bpjs_datum::findOrFail($id);

        return view('admin.bpjs_data.edit', compact('bpjs_datum'));
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
        
        $bpjs_datum = bpjs_datum::findOrFail($id);
        $bpjs_datum->update($requestData);

        return redirect('admin/bpjs_data')->with('flash_message', 'bpjs_datum updated!');
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
        bpjs_datum::destroy($id);

        return redirect('admin/bpjs_data')->with('flash_message', 'bpjs_datum deleted!');
    }
}
