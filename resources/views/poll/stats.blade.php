@extends('layouts.app')

@section('content')
<div class="col-8">

    <div class="card">
        <div class="card-header border-none bg-white" style="font-size:30px;">
            {{ $poll[0]->title }}
        </div> 
        <div class="p-2">Wypełniono {{ $poll[0]->questions[0]->answers->count() }} razy</div>
    </div>
    <ul class="p-0 m-0">
        @foreach($poll[0]->questions as $question)
            <li class="card mt-3 border">
                <div class="card-body">
                    <div class="form-group row align-items-center mb-3" style="font-size:22px; font-weight:600; padding:0px 10px;">
                        {{ $question->question }}
                    </div> 
                    @if($question->type == 'radio')
                        <span class="radio-answer-count">{{ $question->answers->where('answer', 'Tak')->count() }}</span> <span class="radio-answer">Tak</span><br>
                        <span class="radio-answer-count">{{ $question->answers->where('answer', 'Nie')->count() }}</span> <span class="radio-answer">Nie</span>
                    @else
                        @php $data = $question->answers->groupBy('answer')->map->count() @endphp
                           
                        @forelse($question->answers as $answer)
                            @if(isset($data[$answer->answer.'']))
                                <span class="text-answer-count">{{ $data[$answer->answer.''] }}</span> <span class="text-answer mb-3">{{ $answer->answer }}</span><br>
                                @unset($data[$answer->answer.''])
                            @endif
                        @empty
                            <span class="empty-text"> Brak statystyk</span>
                        @endforelse
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
</div>

@endsection

