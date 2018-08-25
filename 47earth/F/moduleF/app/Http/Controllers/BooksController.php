<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function reset()
    {
        Book::truncate();
        return response()->json(['status' => 'success', 'data' => 'OK']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($message = $this->check(new Book, $request)) {
            return response()->json(['status' => 'fail', 'data' => $message['data']], $message['status']);
        }
        $book = Book::create($request->all());
        return response()->json(['status' => 'success', 'data' => $book->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!is_numeric($id)) {
            return response()->json(['status' => 'fail', 'data' => '403 Forbidden'], 403);
        }
        $book = Book::findOrFail($id);
        return response()->json($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        if ($message = $this->check($book, $request)) {
            return response()->json(['status' => 'fail', 'data' => $message['data']], $message['status']);
        }
        $book->update($request->all());
        return response()->json(['status' => 'success', 'data' => 'OK']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(['status' => 'success', 'data' => 'OK']);
    }
    
    private function check(Book $book, Request $request)
    {
        if ($this->isDuplicate($book, $request)) {
            return ['data' => 'ISBN duplicate', 'status' => 409];
        }
        if ($request->isbn || !$book->id) {            
            if ($this->wrongISBN($request->isbn)) {
                return ['data' => 'ISBN error', 'status' => 400];
            }
        }
        if ($this->wrongInput($request->all())) {
            return ['data' => 'input error', 'status' => 400];
        }
        return;
    }
    
    private function isDuplicate(Book $book, Request $request)
    {
        if ($book->isbn != $request->isbn && Book::where('isbn', $request->isbn)->first()) {
            return true;
        }
        return false;
    }
    
    private function wrongInput($request)
    {
        if (count(array_diff_key($request, ['name' => '', 'isbn' => '']))) {
            return true;
        }
        return false;
    }
    
    private function wrongISBN($isbn)
    {
        if (strlen($isbn) != 13 || !is_numeric($isbn)) {
            return true;
        }
        $s = 0;
        for ($i = 0; $i < 12; $i++) {
            $s += substr($isbn, $i, 1);
            if ($i % 2 != 0) {
                $s += substr($isbn, $i, 1) * 2;
            }
        }
        $r = $s % 10;
        $n = 10 - $r;
        if (substr($isbn, 12, 1) == $n % 10) {
            return false;
        }
        return true;
    }
}
