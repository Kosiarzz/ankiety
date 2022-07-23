<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Entry, Poll, Answer};
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Auth;

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

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $poll = Poll::where('slug', $slug)->with('questions')->get();

        return view('slug.poll', compact('poll'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Debugbar::info($id);
        Entry::destroy($id);
    }
}
