@if(isset($media) && $media->count())
<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>Uploaded Images (<span id="galleryCounter">{{$media->count()}}</span>)</h2>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="input-field" id="gallery">
            <div class="row">
                @foreach ($media as $gallery)
                    <div class="col-lg-3 p-2" id="Div_{{ $gallery->id }}">
                        <div class="card border-gray-300 border-dotted">
                            <img class="lozad card-rounded w-100" src="{{ asset($gallery->file) }}" alt="G{{ $gallery->id }}" width="150" height="150">
                            <div class="form-check form-check-custom form-check-solid mt-2 p-1">
                                <input type="checkbox" name="delete_gallery_id[]" value="{{ $gallery->id }}" class="form-check-input category">
                                <label class="form-check-label" for="flexCheckDefault">
                                   Delete
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div id="EmptygalleryMsg" class="text-danger"></div>
    </div>
 </div>
@endif



<div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>{{ __('site.gallery') }}</h2>
            <small class="p-2">You can only upload 5 files <b>'.jpg', '.jpeg', '.png', '.gif', '.svg' </b> <i>Max File Size 200 KB</i></small>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="input-field">
            <div class="gallery" style="padding-top: .5rem;"></div>
            <div class="uppy uppy-Informer" id="galleryMessageJsResponse"></div>
        </div>
    </div>
 </div>

