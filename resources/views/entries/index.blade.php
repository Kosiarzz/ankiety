@extends('layouts.app')

@section('content')
<div class="col-8">
    <div class="card">
        <div class="card-header bg-white">
            <span><i class="fa fa-align-justify"></i> Wpisy</span>
        </div> 
        <div class="card-body">
            <table class="table table-hover table-listing">
                <thead>
                    <tr>
                        <th><span class=""></span> Tytuł ankiety</th> 
                        <th class="text-center"><a><span class="fa"></span> Data przesłania</a></th> 
                        <th></th>
                    </tr> 
                </thead> 
                <tbody>
                    @forelse($entries as $entry)
                        <tr id="entry{{ $entry->id }}">
                            <td>{{ $entry->poll->title }}</td> 
                            <td class="text-center text-nowrap">
                                {{ date('d/m/Y H:i:s', strtotime($entry->created_at)) }}
                            </td>  
                            <td>
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <a href="{{route('poll.edit', $entry->poll->id)}}" title="Edytuj" role="button" class="btn btn-sm btn-spinner btn-primary"><i class="fa fa-edit"></i></a>
                                    </div> 
                                    <form class="col">
                                        <button type="button" class="btn btn-sm btn-danger deleteEntry" data-route="{{route('entries.destroy', $entry->id)}}" data-id="{{ $entry->id }}"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                    <span class="empty-text"> Brak wpisów </span>
                    @endforelse
                </tbody>
            </table> 
            <div class="row">
                <div class="col-sm"></div> 
                <div class="col-sm-auto">
                    {{ $entries->links("pagination::bootstrap-4") }}
                </div>
            </div>
        </div>
    </div>  
</div>
<div id="scrap-box-alert" class="box-error-alert"></div>
@endsection

