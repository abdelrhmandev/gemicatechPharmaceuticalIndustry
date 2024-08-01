<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>Icon</h2>
        </div>
    </div>
    <div class="card-body pt-0 fv-row fl">
        <label for="icon" class="form-label">Pick Icon</label>
        <input placeholder="{{ __('site.icon') }}" type="text" id="icon" name="icon"
        class="form-control mb-2 iconpicker" aria-label="Icone Picker" value="{{ $icon ?? ''}}"
        aria-describedby="basic-addon1" readonly />
    </div>
</div>
