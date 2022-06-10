<div class="card-body">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="card-title mb-0">
                {{ __('labels.backend.organizations.management') }}
                <small
                    class="text-muted">{{ (isset($notification)) ? __('update request') : __('labels.backend.organizations.create') }}</small>
            </h4>
        </div>
        <!--col-->
    </div>
    <!--row-->

    <hr>

    <div class="">
        <div class="col">
            <div class="form-group row">
                <label for="creator" class="col-md-2 from-control-label required">created by</label>

                <div class="col-md-10">
                    <input class="form-control"  disabled type="text" id="creator" value="{{\App\Models\Auth\User::where('id',$notification->created_by)->first()->name}}">
                </div>
                <!--col-->
            </div>
            <div class="form-group row">
                <label for="creator" class="col-md-2 from-control-label required">Cso</label>

                <div class="col-md-10">
                    <input class="form-control"  disabled type="text" id="creator" value="{{\App\Models\Organization\Organization::where('id',$notification->id)->first()->name}}">
                </div>
                <!--col-->
            </div>
            <div class="form-group row">
                <label for="creator" class="col-md-2 from-control-label required">created at</label>

                <div class="col-md-10">
                    <input class="form-control"  disabled type="text" id="creator" value="{{$notification->created_at}}">
                </div>
                <!--col-->
            </div>
            <div class="form-group row">
                <label for="creator" class="col-md-2 from-control-label required">values</label>

                <div class="col-md-10">
                    <table style="border:1px solid black;">
                        <th style="border:1px solid black;">key</th>
                        <th style="border:1px solid black;">value</th>
                    @foreach(json_decode($notification->values) as$key => $value)
                            <tr>

                            <td style="border:1px solid black;">{{$key}}: </td>
                            <td style="border:1px solid black;">{{$value}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!--col-->
            </div>

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
            XonBoard.Organizations.edit.init("{{ config('locale.languages.' . app()->getLocale())[1] }}");
        });
    </script>
@stop
