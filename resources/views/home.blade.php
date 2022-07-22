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
                        <th></th> 
                        <th><span class="fa"></span> Tytuł ankiety</th> 
                        <th class="text-center"><a><span class="fa"></span> Data opublikowania</a></th> 
                        <th><a><span class="fa"></span> Status</a></th> 
                        <th></th>
                    </tr> 
                </thead> 
                <tbody>
                    @forelse($polls as $poll)
                        <tr class="">
                            <td>{{ $loop->index+1 }}</td> 
                            <td>{{ $poll->title }}</td> 
                            <td class="text-center text-nowrap">
                                @if($poll->status)
                                    {{ $poll->updated_at }}
                                @else
                                    -
                                @endif
                            </td> 
                            <td>
                                <div class="form-check form-switch poll-list">
                                    @if($poll->status)
                                        <input class="form-check-input" title="włączona" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
                                    @else
                                        <input class="form-check-input" title="wyłączona" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                    @endif
                                </div>
                            </td>  
                            <td>
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <a href="#" title="Edytuj" role="button" class="btn btn-sm btn-spinner btn-primary"><i class="fa fa-edit"></i></a>
                                    </div> 
                                    <div class="col-auto">
                                        <a href="#" title="Statystyki" role="button" class="btn btn-sm btn-spinner btn-warning"><i class="fa fa-chart-line"></i></a>
                                    </div> 
                                    <div class="col-auto">
                                        <a href="#" title="Pytania" role="button" class="btn btn-sm btn-spinner btn-info"><i class="fa fa-question"></i></a>
                                    </div>
                                    <form class="col">
                                        <button type="submit" title="Usuń" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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
@endsection
