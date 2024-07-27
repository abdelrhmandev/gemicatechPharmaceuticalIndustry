<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>{{ __('brand.plural')}}</h2>
        </div>
    </div>
    <div class="card-body pt-0 fv-row fl">
        <label for="brand_id" class="form-label">{{ __('brand.select')}}</label>
        <select name="brand_id" id="brand_id" class="form-select form-select-solid"
        data-hide-search="false"
        data-control="select2"
        data-close-on-select="true"
        data-placeholder="{{ __('brand.select')}}"
        data-allow-clear="true"
        required data-fv-not-empty___message="
        {{ __('validation.required', ['attribute' => 'brand']) }}">
        <option></option>
        @foreach($brands as $brand)
        <option value="{{ $brand->id }}" {{ isset($id) && $id == $brand->id ? 'selected':'' }}>
            {{  $brand->title }}
        </option>
        @endforeach
    </select>
    </div>
</div>
