<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\contract;
use Illuminate\Http\Request;

class contractController extends Controller
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
            $contract = contract::where('contract_name', 'LIKE', "%$keyword%")
                ->orWhere('currency', 'LIKE', "%$keyword%")
                ->orWhere('date_start', 'LIKE', "%$keyword%")
                ->orWhere('date_end', 'LIKE', "%$keyword%")
                ->orWhere('wages', 'LIKE', "%$keyword%")
                ->orWhere('pph21', 'LIKE', "%$keyword%")
                ->orWhere('food', 'LIKE', "%$keyword%")
                ->orWhere('transport', 'LIKE', "%$keyword%")
                ->orWhere('active', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $contract = contract::latest()->paginate($perPage);
        }

        return view('admin.contract.index', compact('contract'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.contract.create');
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
        
        contract::create($requestData);

        return redirect('admin/contract')->with('flash_message', 'contract added!');
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
        $contract = contract::findOrFail($id);

        return view('admin.contract.show', compact('contract'));
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
        $contract = contract::findOrFail($id);

        return view('admin.contract.edit', compact('contract'));
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
        
        $contract = contract::findOrFail($id);
        $contract->update($requestData);

        return redirect('admin/contract')->with('flash_message', 'contract updated!');
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
        contract::destroy($id);

        return redirect('admin/contract')->with('flash_message', 'contract deleted!');
    }
}
