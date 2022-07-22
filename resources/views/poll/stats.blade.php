@extends('layouts.app')

@section('content')
<div class="col-8">

    <div class="card">
        <div class="card-header border-none bg-white" style="font-size:30px;">
            {{ $poll[0]->title }}
        </div> 
    </div>
    <ul class="p-0 m-0">
        @foreach($poll[0]->questions as $question)
            <li class="card mt-3 border">
                <div class="card-body">
                    <div class="form-group row align-items-center mb-3" style="font-size:22px; font-weight:600; padding:0px 10px;">
                        {{ $question->question }}
                    </div> 
                    @if($question->type == 'radio')
                    TAK[{{ $question->answers->where('answer', 'Tak')->count() }}] NIE [{{ $question->answers->where('answer', 'Nie')->count() }}]
                    @else
                    @php $data = $question->answers->groupBy('answer')->map->count() @endphp
                    @foreach($question->answers as $answer)
                            {{ $answer->answer }} @if($question->type == 'text')({{ $data[$answer->answer.''] }})@endif<br>
                    @endforeach
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
</div>

@endsection

