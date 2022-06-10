@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.notifications.management'))

@section('breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Update Request Management <small class="text-muted">{{ __('labels.backend.organizations.active') }}</small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="notifications-table" class="table" data-ajax_url="{{ route("admin.notifications.get") }}">
                        <thead>
                            <tr>
                                <th>{{ trans('labels.backend.organizations.table.created_by') }}</th>
                                <th>{{ trans('labels.backend.organizations.table.created_at') }}</th>
                                <th>{{ trans('labels.general.actions') }}</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
            <!--col-->
        </div>
        <!--row-->


    </div>
    <!--card-body-->
</div>
<!--card-->
@endsection

@section('page-script')
<script>
    XonBoard.Utils.documentReady(function() {
        XonBoard.Notifications.list.init();
    });
</script>
@stop
