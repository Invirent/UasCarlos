<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\bankAccount;
use Illuminate\Http\Request;

class bankAccountController extends Controller
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
            $bankaccount = bankAccount::where('account_number', 'LIKE', "%$keyword%")
                ->orWhere('bank_name', 'LIKE', "%$keyword%")
                ->orWhere('employee_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $bankaccount = bankAccount::latest()->paginate($perPage);
        }

        return view('admin.bank-account.index', compact('bankaccount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.bank-account.create');
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
        
        bankAccount::create($requestData);

        return redirect('admin/bank-account')->with('flash_message', 'bankAccount added!');
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
        $bankaccount = bankAccount::findOrFail($id);

        return view('admin.bank-account.show', compact('bankaccount'));
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
        $bankaccount = bankAccount::findOrFail($id);

        return view('admin.bank-account.edit', compact('bankaccount'));
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
        
        $bankaccount = bankAccount::findOrFail($id);
        $bankaccount->update($requestData);

        return redirect('admin/bank-account')->with('flash_message', 'bankAccount updated!');
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
        bankAccount::destroy($id);

        return redirect('admin/bank-account')->with('flash_message', 'bankAccount deleted!');
    }
}
