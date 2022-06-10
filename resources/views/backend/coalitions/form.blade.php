<div class="card-body">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="card-title mb-0">
                {{ __('labels.backend.coalitions.management') }}
                <small
                    class="text-muted">{{ (isset($coalition)) ? __('labels.backend.coalitions.edit') : __('labels.backend.coalitions.create') }}</small>
            </h4>
        </div>
        <!--col-->
    </div>
    <!--row-->

    <hr>

    <div class="">
        <div class="col">

            <x-admin.fields.text-field
                name="name"
                placeholder="Name"
                required="true"
            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="description"
                placeholder="Description"
                required="true"
            ></x-admin.fields.text-field>


            <!--form-group-->
        </div>
        <!--col-->
    </div>
    <!--row-->
</div>
<!--card-body-->

@section('page-script')
    <script type="text/javascript">
        XonBoard.Utils.documentReady(function () {
            XonBoard.Coalitions.edit.init("{{ config('locale.languages.' . app()->getLocale())[1] }}");
        });
    </script>
@stop
