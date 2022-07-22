@extends('layouts.app')

@section('content')
<div class="col-8">
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
            <tr id="">
                <td>{{ $entry->poll->title }}</td> 
                <td class="text-center text-nowrap">
                    {{ $entry->created_at }}
                </td>  
                <td>
                    <div class="row no-gutters">
                        <div class="col-auto">
                            <a href="#" title="Edytuj" role="button" class="btn btn-sm btn-spinner btn-primary"><i class="fa fa-edit"></i></a>
                        </div> 
                        <form class="col">
                            <button type="button" class="btn btn-sm btn-danger deletePoll" data-route="#"><i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            Brak ankiet
        @endforelse
            </tbody>
    </table>   
</div>

@endsection

