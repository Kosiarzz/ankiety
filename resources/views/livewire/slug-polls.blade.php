<div>
    <div class="form-group row align-items-center mb-3">
        <label for="title" class="col-form-label text-md-right col-md-3">Tytuł ankiety</label> 
        <div class="col-md-6 col-xl-5">
            <input wire:model="title" maxlength="100" type="text" id="title" name="title" placeholder="Tytuł ankiety" class="form-control" aria-required="true" aria-invalid="false" required>
        </div>
    </div> 
    <div class="form-group row align-items-center">
        <label for="slug" class="col-form-label text-md-right col-md-3">Adres ankiety(slug)</label> 
        <div class="col-md-6 col-xl-5">
            <input wire:model="slug" maxlength="200" type="text" id="slug" name="slug" value="" placeholder="Adres ankiety" class="form-control" aria-required="true" aria-invalid="false" required>
            <span class="error">{{ $error }}</span>
        </div>
    </div> 
    <div class="form-check row has-success mt-3">
        <div class="ml-md-auto col-md-5">
            <input id="enabled" type="checkbox" name="status" class="form-check-input" aria-required="false" aria-invalid="false" @if($status) checked @endif>  
            <label for="enabled" class="form-check-label">Opublikuj</label>
        </div>
    </div> 
</div>
