<div class="form-group">
    <label for="icon-picker" class="form-label">Choose icon</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1"><i class="{{ $icon ?? ''}}"></i></span>
        <input type="text" id="icon-picker" class="form-control" name="icon" value="{{ $icon ?? ''}}">
    </div>
</div>
