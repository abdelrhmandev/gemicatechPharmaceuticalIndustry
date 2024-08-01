{{-- <div class="card card-flush py-4">
    <div class="card-header">
        <div class="card-title">
            <h2>Icon</h2>
        </div>
    </div>
    <div class="card-body pt-0 fv-row fl">
        <label for="icon" class="form-label">Pick Icon</label>
        <div id="target" name="icon" data-arrow-class="btn-success"
            data-arrow-prev-icon-class="fas fa-angle-left btn-sm" data-arrow-next-icon-class="fas fa-angle-right btn-sm"
            role="iconpicker" data-icon = "{{  $icon ?? ''}}"></div>
    </div>
</div> --}}

<main>
    <div class="container">
        <h1>Icon Picker</h1>

        <div class="row">
            <div class="col-12 col-md-6">
                <h2>Input</h2>
                <p class="lead">Bootstrap theme</p>

                <div class="form-group">
                    <label for="icon-picker" class="form-label">Choose icon</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"></span>
                        <input type="text" id="icon-picker" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <h2>Button</h2>
                <p class="lead">Default theme</p>

                <button class="btn btn-primary">Choose icon</button>
                <p class="lead icon-selected-text"></p>
            </div>
        </div>
    </div>
</main>
