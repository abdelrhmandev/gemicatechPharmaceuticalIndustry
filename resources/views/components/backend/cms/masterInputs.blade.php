
                <div class="fv-row fl">
                    <label class="required form-label"
                        for="title">{{ __('site.title') }}</label>
                    <input placeholder="{{ __('site.title') }}" type="text" id="title"
                        name="title" class="form-control mb-2" required
                        data-fv-not-empty___message="{{ __('validation.required', ['attribute' => 'title']) }}"
                        value="{{ $row->title ?? '' }}" />
                </div>
                @if ($showSlug == 1)
                <div class="fv-row fl">
                    <label class="required form-label"
                        for="slug">{{ __('site.slug') }}</label>
                    <input placeholder="{{ __('site.slug') }}" type="text" id="slug"
                        name="slug" class="form-control mb-2" required
                        data-fv-not-empty___message="{{ __('validation.required', ['attribute' => 'slug']) }}"
                        value="{{ $row->slug ?? '' }}" />
                </div>
                @endif
                @if ($showDescription)
                <div class="fv-row">
                    <!--begin::Label-->
                    <label class="form-label"
                        for="description">{{ __('site.description') }}</label>
                    <textarea placeholder="{{ __('site.description') }}" rows="4" cols="30" id="description" name="description" class="form-control form-control-solid {{ $richTextArea == 1 ? 'tinyEditor':'' }} @error('description') is-invalid @enderror">{{ $row->description ?? '' }}</textarea>
                </div>
                @endif



