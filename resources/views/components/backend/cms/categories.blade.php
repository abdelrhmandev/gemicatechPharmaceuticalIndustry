<div class="card card-flush">
    <div class="card-header">
        <div class="card-title">
            <h2>{{ __('category.plural')}}</h2>
        </div>
    </div>
    <div class="card-body pt-0">
            @if(!(empty($categories)))
            <div class="row row-cols-1 row-cols-md-0 row-cols-lg-1 row-cols-xl-3 g-2" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
                @foreach ($categories as $category)
                <div class="form-check form-check-custom form-check-solid mb-2">
                    <input type="checkbox" name="category_id[]" class="form-check-input category" value="{{ $category->id }}"
                    @if(isset($row) && in_array($category->id,$row->categories->pluck('id')->toArray()))
                    {{ "checked" }}
                    @endif>
                    <label class="form-check-label" for="flexCheckDefault">
                        {{ $category->title }} ({{ $category->children_count }})
                    </label>
                </div>
                @endforeach
            </div>
            @endif
    </div>
</div>
