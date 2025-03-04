<?php

namespace App\Http\Controllers;

use App\Models\Contract;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Contract::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        return response()->json($contract);
    }
}
