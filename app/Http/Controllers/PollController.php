<?php

namespace App\Http\Controllers;

use App\Models\{Poll, Question, Entry, Answer};
use App\Http\Requests\UpsertPollRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Str;


class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polls = Poll::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(10);

        return view('home', compact('polls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('poll.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UpsertPollRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpsertPollRequest $request)
    {
        $data = $request->validated();

        $poll = Poll::create([
            'title' => $request->title,
            'status' => $request->status ? true : false,
            'slug' => Str::slug($request->slug, '-'),
            'user_id' => Auth::id(),
        ]);

        foreach($request->question as $key=>$question)
        {
            Question::create([
                'question' => $question,
                'type' => $request->type[$key],
                'order' => $key,
                'poll_id' => $poll->id,
            ]);
        }

        return redirect(route('poll.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        session(['currentPoll' => $id]);

        return view('poll.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePollRequest  $request
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $poll = Poll::where('user_id', Auth::id())->where('id', session('currentPoll'))->update([
            'title' => $request->title,
            'status' => $request->status ? true : false,
            'slug' => $request->slug,
        ]);

        Question::where('poll_id', session('currentPoll'))->delete();

        foreach($request->question as $key=>$question)
        {
            Question::create([
                'question' => $question,
                'type' => $request->type[$key],
                'order' => $key,
                'poll_id' => session('currentPoll'),
            ]);
        }

        session()->forget('currentPoll');

        return redirect(route('poll.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stats(int $id)
    {
        $poll = Poll::where('user_id', Auth::id())->where('id', $id)->with('questions.answers')->get();
        
        #$entries = Entry::where('poll_id', $id)->get('id');
        #$answers = Answer::whereIn('entry_id', $entries)->get();
        
        #$yes = Answer::whereIn('entry_id', $entries)->where('answer', 'Tak')->count ();
        
        #$text = $answers->whereNot(function ($query) {
        #    $query->where('answer', 'Yes')
        #          ->orWhere('answer', 'No');
        #});

       
        #$stats = $poll->questions->answers->groupBy('answer')->map->count();
        
   

        return view('poll.stats', [
            'poll' => $poll
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function status(int $id, string $status)
    {
        Debugbar::info($status);
        Debugbar::info($id);

        Poll::where('user_id', Auth::id())->where('id', $id)->update([
            'status' => $status == "on" ? false : true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Debugbar::info($id);
        Poll::destroy($id);
    }
}
