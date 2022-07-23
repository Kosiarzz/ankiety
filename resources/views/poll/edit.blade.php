@extends('layouts.app')

@section('content')
<div class="col-8">
    <form method="POST" action="{{ route('poll.update') }}">
        @csrf
        <div class="card">
            <div class="card-header bg-white">
                <i class="fa fa-plus"></i> Edycja ankiety
            </div> 
            <div class="card-body">
                @livewire('slug-polls') 
            </div>
        </div>
        @livewire('questions') 
        <div class="row text-center mt-3 mb-4">
            <div>
                <button class="btn btn-primary btn-sm" type="submit">Zapisz zmiany</button>
            </div>
        </div>
    </form>
</div>
<div id="scrap-box-alert" class="box-error-alert">
    @foreach ($errors->all() as $error)
      <div class="scrap-alert-message error">{{ $error }}</div>
    @endforeach
</div>
@endsection

