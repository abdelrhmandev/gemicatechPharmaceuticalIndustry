<div class="card card-flush">
    <div class="card-header">
        <div class="card-title">
            <h2>{{ __('block.plural')}}</h2>
        </div>
    </div>
    <div class="card-body pt-0">
        @foreach ($blocks as $block)
        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
            <!--begin::Label-->
            <div class="fs-5 fw-bold form-label mb-3">{{ $block->title }}</div>
            <!--end::Label-->
            <!--begin::Checkbox-->
            <label class="form-check form-check-custom form-check-solid">
                <input type="checkbox" name="block_id[]" class="form-check-input block" value="{{ $block->id }}"
                    @if(isset($row) && in_array($block->id,$row->block->pluck('id')->toArray()))
                    {{ "checked" }}
                    @endif>
                <span class="form-check-label text-gray-600">{{ $block->description }}</span>
            </label>

        </div>
        @endforeach

    </div>
</div>
