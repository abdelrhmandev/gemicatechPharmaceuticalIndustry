<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>Sub Categories </h2>

            <small class="p-2"><i>select category first to show sub categories</i></small>

        </div>
    </div>
    <div class="card-body pt-0">
        <div class="row row-cols-1 row-cols-mt-5 row-cols-lg-1 row-cols-xl-3 g-2" data-kt-buttons="true"
            data-kt-buttons-target="[data-kt-button='true']" id="sub_categories_div">
            @if (isset($childcategories))
                @foreach ($childcategories as $category)
                    <div id="child_div{{ $category->parent_id }}" class="form-check form-check-custom form-check-solid mb-2">
                        <input type="checkbox" name="sub_category_id[]" class="form-check-input category"
                            value="{{ $category->id }}" @if (in_array($category->id, $cids)) {{ 'checked' }} @endif>
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ $category->title }}
                        </label>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</div>
