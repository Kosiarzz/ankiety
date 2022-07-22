<div>
    <div class="form-group row align-items-center mb-3">
        <label for="title" class="col-form-label text-md-right col-md-3">Tytuł ankiety</label> 
        <div class="col-md-6 col-xl-5">
            <input wire:model="title" type="text" id="title" name="title" placeholder="Tytuł ankiety" class="form-control" aria-required="true" aria-invalid="false">
        </div>
    </div> 
    <div class="form-group row align-items-center">
        <label for="slug" class="col-form-label text-md-right col-md-3">Adres ankiety(slug)</label> 
        <div class="col-md-6 col-xl-5">
            <input wire:model="slug" type="text" id="slug" name="slug" placeholder="Adres ankiety" class="form-control" aria-required="true" aria-invalid="false">
            {{ $error }}
        </div>
    </div> 
</div>
