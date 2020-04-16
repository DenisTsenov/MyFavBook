<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = DB::table('books')->simplePaginate(2);

        return view('home', compact('books'));
    }

    public function main()
    {
        $unapprovedUsers = User::where('id', '<>', Auth::id())->where('active', false)->get();

        return view('welcome', compact('unapprovedUsers'));
    }

    /**
     * @param Request $request
     * @return array|string
     * @throws \Throwable
     */
    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $books = DB::table('books')->simplePaginate(2);

            return view('partials._books_table', compact('books'))->render();
        }
    }
}
