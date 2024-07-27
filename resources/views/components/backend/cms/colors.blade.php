<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>Color</h2>
        </div>
    </div>
    <div class="card-body pt-0 fv-row fl">
        <label for="color" class="form-label">Pick Color</label>
        <input placeholder="{{ __('site.color') }}" type="color" id="color" name="color"
        value="{{ $color ?? '#F9CD62'}}" class="form-control mb-2" readonly />
    </div>
</div>

