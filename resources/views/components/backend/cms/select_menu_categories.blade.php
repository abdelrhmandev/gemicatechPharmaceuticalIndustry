<div class="card card-flush">
    <div class="card-header">
        <div class="card-title">
            <h2>{{ __('category.parent') }}</h2>
        </div>
    </div>
    <div class="card-body pt-0">
        @if (!empty($parentcategories))
            <div class="row row-cols-1 row-cols-md-0 row-cols-lg-1 row-cols-xl-3 g-2" data-kt-buttons="true"
                data-kt-buttons-target="[data-kt-button='true']">

                <select name="parent_id" id="parent_id" class="form-select form-select-solid" data-hide-search="false"
                    data-control="select2" data-close-on-select="true" data-placeholder="Parent Category"
                    data-allow-clear="true">
                    <option value=""></option>
                    @foreach ($parentcategories as $category)
                        <option value="{{ $category->id }}"
                            {{ isset($parentid) && $parentid == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach

                </select>

            </div>
        @endif
    </div>
</div>
