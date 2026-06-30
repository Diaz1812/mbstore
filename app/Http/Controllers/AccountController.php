<?php

namespace App\Http\Controllers;

use App\Services\AccountService;

class AccountController extends Controller
{
    public function show($id, AccountService $service)
    {
        $accounts = collect($service->all());

        $account = $accounts->firstWhere('id', (int) $id);

        if (!$account) {
            abort(404);
        }

        return view('pages.account.detail', compact('account'));
    }
}