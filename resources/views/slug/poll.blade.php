@extends('layouts.slug')

@section('content')
<div class="col-8">
    @if(!isset($status))
    <div class="card">
        <div class="card-header bg-white" style="font-size:30px;">
            {{ $poll[0]->title }}
        </div> 
    </div>
    <form method="POST" action="{{ route('entry.submit') }}">
        @csrf
        <input type="hidden" name="poll_id" value="{{ $poll[0]->id }}">
        <ul class="p-0 m-0">
            @foreach($poll[0]->questions as $question)
                <li class="card mt-3 border">
                    <div class="card-body">
                        <div class="form-group row align-items-center mb-3" style="font-size:22px; font-weight:600; padding:0px 10px;">
                            {{ $question->question }}
                        </div> 
                        @if ($question->type == "radio")
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer{{ $loop->index }}" value="Tak" id="yesRadio{{ $loop->index }}" required>
                                <label class="form-check-label" for="yesRadio{{ $loop->index }}" required>
                                Tak
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer{{ $loop->index }}" value="Nie" id="noRadio{{ $loop->index }}" required>
                                <label class="form-check-label" for="noRadio{{ $loop->index }}" required>
                                Nie
                                </label>
                            </div>
                        @else
                            <div class="col-8 input-group mb-2">
                                <input type="text" maxlength="100" class="form-control" placeholder="Odpowiedź" name="answer{{ $loop->index }}" required>
                            </div>
                        @endif
                    </div>
                    <input type="hidden" name="answerId[]" value="{{ $question->id }}">
                </li>
            @endforeach
        </ul>
    
        <div class="row mt-3">
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary btn-sm" type="submit">Prześlij ankietę</button>
            </div>
        </div>
    </form>
    @else
        <span class="col-12 empty-text text-center"> Ta ankieta jest obecnie niedostępna </span>
    @endif
</div>

@endsection

