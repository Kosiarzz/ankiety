<div>
    @foreach($things as $thing)
        {{ $thing['id'] }}, {{ $thing['title'] }}
    @endforeach
    <ul wire:sortable="reorder" class="p-0 m-0">
        @foreach($things as $thing)
            <li wire:sortable.item="{{ $thing['id'] }}" draggable="true" wire:key="{{ $thing['id'] }}" class="card mt-3 border">
                <div class="card-header d-flex justify-content-between bg-white h-20">
                    <div wire:sortable.handle><i class="fa fa-arrow-up"></i></div>
                    <button wire:click="questionRemove({{ $thing['id'] }})" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                </div> 
                <div class="card-body">
                    <div class="form-group row align-items-center mb-3">
                        <div class="col-md-7 col-xl-7">
                            <input type="text" name="question[]" placeholder="Pytanie" class="form-control" aria-required="true" aria-invalid="false">
                        </div>
                        <div class="col-md-5 col-xl-5">
                            <select class="form-select" name="type[]" aria-label="Default select example">
                                <option value="radio" selected>Jednokrotny wybór (Tak/Nie)</option>
                                <option value="text">Odpowiedź tekstowa</option>
                            </select>
                        </div>
                    </div> 
                </div>
            </li>
        @endforeach
    </ul>
    <div class="row mt-3">
        <div class="d-flex justify-content-end">
            <button wire:click="$emit('questionAdded')" class="btn btn-primary btn-sm" type="button">Dodaj pytanie</button>
        </div>
    </div>
</div>
