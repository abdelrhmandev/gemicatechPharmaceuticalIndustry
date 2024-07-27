<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>{{ __('industry.plural') }}</h2>
        </div>
    </div>
    <div class="card-body pt-0 fv-row fl">
        <label for="brand_id" class="form-label">{{ __('industry.select')}}</label>
                @foreach ($industries as $industry)
                    <div class="form-check form-check-custom form-check-solid mt-2">
                        <input class="form-check-input" type="checkbox" name="industry_id[]" value="{{ $industry->id }}"
                        @if(isset($row) && in_array($industry->id,$row->industries->pluck('id')->toArray())) checked @endif
                        />
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ $industry->title }}
                        </label>
                    </div>
                @endforeach
        </div>
</div>
