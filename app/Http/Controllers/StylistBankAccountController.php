<?php

namespace App\Http\Controllers;

use App\Models\StylistBankAccount;
use App\Http\Requests\StylistBankAccountStoreRequest;
use App\Http\Requests\StylistBankAccountUpdateRequest;
use App\Http\Resources\StylistBankAccountCollection;
use App\Http\Resources\StylistBankAccountResource;
use Illuminate\Http\Request;

class StylistBankAccountController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\StylistBankAccountCollection
     */
    public function index(Request $request)
    {
        $stylistBankAccounts = StylistBankAccount::all();

        return new StylistBankAccountCollection($stylistBankAccounts);
    }

    /**
     * @param \App\Http\Requests\StylistBankAccountStoreRequest $request
     * @return \App\Http\Resources\StylistBankAccountResource
     */
    public function store(StylistBankAccountStoreRequest $request)
    {
        $stylistBankAccount = StylistBankAccount::create($request->validated());

        return new StylistBankAccountResource($stylistBankAccount);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\stylistBankAccount $stylistBankAccount
     * @return \App\Http\Resources\StylistBankAccountResource
     */
    public function show(Request $request, StylistBankAccount $stylistBankAccount)
    {
        return new StylistBankAccountResource($stylistBankAccount);
    }

    /**
     * @param \App\Http\Requests\StylistBankAccountUpdateRequest $request
     * @param \App\stylistBankAccount $stylistBankAccount
     * @return \App\Http\Resources\StylistBankAccountResource
     */
    public function update(StylistBankAccountUpdateRequest $request, StylistBankAccount $stylistBankAccount)
    {
        $stylistBankAccount->update($request->validated());

        return new StylistBankAccountResource($stylistBankAccount);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\stylistBankAccount $stylistBankAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, StylistBankAccount $stylistBankAccount)
    {
        $stylistBankAccount->delete();

        return response()->noContent();
    }
}
