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
                <div class="form-check row has-success">
                    <div class="ml-md-auto col-md-10">
                        <input id="enabled" type="checkbox" name="status" class="form-check-input" aria-required="false" aria-invalid="false"> 
                        <label for="enabled" class="form-check-label">Opublikuj</label>
                    </div>
                </div>  
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

