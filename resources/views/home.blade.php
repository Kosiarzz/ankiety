@extends('layouts.app')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between">
            <span><i class="fa fa-align-justify"></i> Ankiety</span>

            <a href="{{ route('poll.create') }}" role="button" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> &nbsp;Dodaj ankietę
            </a>
        </div> 
        <div class="card-body">
            <form>
                <div class="row justify-content-md-between">
                    <div class="col col-lg-7 col-xl-5 form-group">
                        <div class="input-group">
                            <input wire:model="search" placeholder="Szukaj" class="form-control"> 
                            <span class="input-group-append"><button type="button" class="btn btn-primary btn-primary-search"><i class="fa fa-search"></i>&nbsp; Szukaj</button></span>
                        </div>
                    </div> 
                </div>
            </form> 
            <div class="user-detail-tooltips-list">
            </div>

            <table class="table table-hover table-listing">
                <thead>
                    <tr>
                        <th class="text-center"><span class=""></span> Tytuł ankiety</th> 
                        <th class="text-center"><span class="fa"></span> Data opublikowania</th> 
                        <th class="text-center"><span class="fa"></span> Status</th> 
                        <th class="text-center"><span class="fa"></span></th>
                    </tr> 
                </thead> 
                <tbody>
                    @forelse($polls as $poll)
                        <tr id="poll{{ $poll->id }}">
                            <td>{{ $poll->title }}</td> 
                            <td class="text-center text-nowrap time{{ $poll->id }}">
                                @if($poll->status)
                                    {{ date('d-m-Y H:i:s', strtotime($poll->updated_at)) }}
                                @else
                                    -
                                @endif
                            </td> 
                            <td class="">
                                <div class="row form-check form-switch poll-list">
                                    @if($poll->status)
                                        <input class="form-check-input statusPoll" title="włączona" type="checkbox" role="switch" id="flexSwitchCheckDefault" data-route="{{route('poll.status', ['id' => $poll->id, 'status' => 'on'])}}" data-id="{{ $poll->id }}" data-status="on" checked>
                                    @else
                                        <input class="form-check-input statusPoll" title="wyłączona" type="checkbox" role="switch" id="flexSwitchCheckDefault" data-route="{{route('poll.status', ['id' => $poll->id, 'status' => 'off'])}}" data-id="{{ $poll->id }}" data-status="off">
                                    @endif
                                </div>
                            </td>  
                            <td class="">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <a href="{{route('poll.edit', $poll->id)}}" title="Edytuj" role="button" class="btn btn-sm btn-spinner btn-primary"><i class="fa fa-edit"></i></a>
                                    </div> 
                                    <div class="col-auto">
                                        <a href="{{route('poll.stats', $poll->id)}}" title="Statystyki" role="button" class="btn btn-sm btn-spinner btn-warning"><i class="fa fa-chart-line"></i></a>
                                    </div> 
                                    <form class="col">
                                        <button type="button" class="btn btn-sm btn-danger deletePoll" data-route="{{route('poll.destroy', $poll->id)}}" data-id="{{ $poll->id }}"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        Brak ankiet
                    @endforelse
                        </tbody>
                </table>    
            <div class="row">
                <div class="col-sm"></div> 
                <div class="col-sm-auto">
                    {{ $polls->withQueryString()->links("pagination::bootstrap-4") }}
                </div>
            </div>
        </div>
    </div>
</div>
<script>

</script>
@endsection
