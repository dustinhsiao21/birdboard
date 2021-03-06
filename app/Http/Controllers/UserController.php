<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\UpdateRequest;

class UserController extends Controller
{
    /**
     * index view.
     *
     * @return view
     */
    public function index()
    {
        $user = auth()->user();

        return view('user.index', compact('user'));
    }

    /**
     * Update User informations.
     *
     * @param UpdateRequest $request
     * @return view
     */
    public function update(UpdateRequest $request) : RedirectResponse
    {
        $user = auth()->user();
        if ($name = $request->name) {
            $user->name = $name;
        }

        if ($password = $request->password) {
            $user->password = Hash::make($password);
        }

        $user->save();

        return redirect(route('project.index'));
    }
}
