<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        DB::table('users')
          ->where('id', $user->id)
          ->update([
              'first_name' => $request->input('first_name'),
              'last_name'  => $request->input('last_name'),
              'email'      => $request->input('email'),
              'password'   => Hash::make($request->input('password')),
          ]);

        session()->flash('Profile updated successfully');

        return redirect('home');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function approve(User $user)
    {
        $user->active = true;
        $user->save();

        return response()->json(['success' => true]);
    }
}