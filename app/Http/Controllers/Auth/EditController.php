<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();

        return view('auth.edit', compact('user'));
    }


    /**
     *  Update the specified resource in storage.
     *
     * @param EditUserRequest $request
     * @param User            $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(EditUserRequest $request, User $user)
    {
        $user->update($request->validated());

        session()->flash('Profile updated successfully');

        return redirect('home');
    }
}