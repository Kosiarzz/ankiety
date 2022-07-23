<?php

namespace App\Http\Controllers;

use App\Models\{Poll, Question};
use App\Http\Requests\{StorePollRequest, UpdatePollRequest};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;
use Barryvdh\Debugbar\Facades\Debugbar;

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
     * @param  \App\Http\Requests\StorePollRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePollRequest $request)
    {
        $data = $request->validated();

        $poll = Poll::create([
            'title' => $data['title'],
            'status' => isset($data['status']) ? true : false,
            'slug' => Str::slug($data['slug'], '-'),
            'user_id' => Auth::id(),
        ]);

        foreach($data['question'] as $key=>$question)
        {
            Question::create([
                'question' => $question,
                'type' => $data['type'][$key],
                'poll_id' => $poll->id,
            ]);
        }

        return redirect(route('poll.index'));
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
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePollRequest $request)
    {
        $data = $request->validated();

        $current_slug = Poll::where('user_id', Auth::id())->where('id', session('currentPoll'))->get('slug');
        $new_slug = Poll::where('slug', $data['slug'])->exists();
        
        if(isset($current_slug[0]->slug) && $new_slug)
        {
            if($current_slug[0]->slug != $data['slug'])
            {
                //error
                return redirect()->back()
                        ->withErrors(['error' => 'Taki adres już istnieje!'])
                        ->withInput();
            }
        }

        Poll::where('user_id', Auth::id())->where('id', session('currentPoll'))->update([
            'title' => $data['title'],
            'status' => isset($data['status']) ? true : false,
            'slug' => Str::slug($data['slug'], '-'),
        ]);

        Question::where('poll_id', session('currentPoll'))->delete();

        foreach($data['question'] as $key=>$question)
        {
            Question::create([
                'question' => $question,
                'type' => $data['type'][$key],
                'poll_id' => session('currentPoll'),
            ]);
        }

        session()->forget('currentPoll');

        return redirect(route('poll.index'));
    }

    /**
     * Show the stats poll.
     *
     * @param int $id - id poll
     * @return \Illuminate\Http\Response
     */
    public function stats(int $id)
    {
        $poll = Poll::where('user_id', Auth::id())->where('id', $id)->with('questions.answers')->get();
        
        return view('poll.stats', [
            'poll' => $poll
        ]);
    }

    /**
     * Changing the poll status
     *
     * @param  int $id - id poll
     * @param  string $status - new status poll
     * @return \Illuminate\Http\Response
     */
    public function status(int $id, string $status)
    {
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
        try {
            $poll = Poll::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
            $poll->delete();

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
