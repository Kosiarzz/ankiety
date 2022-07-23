<div>
    <ul wire:sortable="reorder" class="p-0 m-0">
        @foreach($questionsArray as $question)
            <li wire:sortable.item="{{ $question['id'] }}" draggable="true" wire:key="{{ $question['id'] }}" class="card mt-3 border">
                <div class="card-header d-flex justify-content-between bg-white h-20">
                    <div wire:sortable.handle><i class="fa fa-align-justify drag-drop"></i></div>
                    <button wire:click="questionRemove({{ $question['id'] }})" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                </div> 
                <div class="card-body">
                    <div class="form-group row align-items-center mb-3">
                        <div class="col-md-7 col-xl-7">
                            <input type="text" name="question[]" maxlength="100" placeholder="Pytanie" value="{{ $question['question'] }}" class="form-control" aria-required="true" aria-invalid="false" required>
                        </div>
                        <div class="col-md-5 col-xl-5">
                            <select class="form-select" name="type[]" aria-label="Default select example" required>
                                <option value="radio" @if($question['type'] == 'radio') selected @endif>Jednokrotny wybór (Tak/Nie)</option>
                                <option value="text" @if($question['type'] == 'text') selected @endif>Odpowiedź tekstowa</option>
                            </select>
                            @error('type') <span class="error">{{ $message }}</span> <br>@enderror
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
