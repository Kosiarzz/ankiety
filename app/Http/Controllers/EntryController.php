<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Entry, Poll, Answer};
use Illuminate\Support\Facades\Auth;
use Exception;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = Entry::whereHas('poll', function($query){
            $query->where('user_id', Auth::id());
        })->orderBy('id', 'desc')->paginate(10);

        return view('entries.index', ['entries' => $entries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entry = Entry::create([
            'created_at' => now(),
            'poll_id' => $request->poll_id,
        ]);

        foreach($request->answerId as $key => $answer)
        {
            $answer = Answer::create([
                'answer' => $request['answer'.$key],
                'question_id' => $answer,
                'entry_id' => $entry->id,
            ]);
        }

        return view('slug.endpoll', ['url' => url()->full()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        $poll = Poll::where('slug', $slug)->with('questions')->get();

        if($poll[0]->status)
        {
            return view('slug.poll', compact('poll'));
        }

        return view('slug.poll', ['status' => false]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Entry::destroy($id);
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wystąpił błąd!'
            ])->setStatusCode(500);
        }
    }
}
