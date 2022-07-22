@extends('layouts.app')

@section('content')
<div class="col-8">
    <form method="POST" action="{{ route('poll.store') }}">
        @csrf
        <div class="card">
            <div class="card-header bg-white">
                <i class="fa fa-plus"></i> Nowa ankieta
            </div> 
            <div class="card-body">
                @livewire('slug-polls')
            </div>
        </div>
        @livewire('things') 
        <div class="row text-center mt-3 mb-4">
            <div>
                <button class="btn btn-primary btn-sm" type="submit">Zapisz ankietę</button>
            </div>
        </div>
    </form>
</div>

@endsection

