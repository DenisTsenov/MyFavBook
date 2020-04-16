<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('books.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(BookRequest $request)
    {
        $image = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('book_images', $image);

        Book::create([
            'name'        => $request->input('name'),
            'isbn'        => $request->input('isbn'),
            'description' => $request->input('description'),
            'image'       => $image,
        ]);

        session()->flash('success', 'Book added successfully.');

        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Book $book)
    {
        $isFavorite = User::find(Auth::user()->id)->books->contains($book->id);

        return view('books.show', compact('book', 'isFavorite'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Book $book
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Book                     $book
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Book $book)
    {
        Storage::delete('books_images' . DIRECTORY_SEPARATOR . $book->image);

        $image = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('book_images', $image);

        $book->update([
            'name'        => $request->input('name'),
            'isbn'        => $request->input('isbn'),
            'description' => $request->input('description'),
            'image'       => $image,
        ]);

        session()->flash('success', 'Book updated successfully.');

        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        dd($book);
    }

    public function showFavorite()
    {
        $user = User::where('id', Auth::user()->id)
                    ->with('books')
                    ->first();

        return view('auth.my_favorite_books', compact('user'));
    }

    public function toggleFavorite(Book $book, $remove = false)
    {
        $user = User::find(Auth::user()->id);

        if ($remove) {
            $user->books()->detach($book->id);
        } else {
            $user->books()->attach($book->id);
        }
    }
}
