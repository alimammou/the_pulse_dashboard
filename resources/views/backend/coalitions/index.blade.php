@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.coalitions.management'))

@section('breadcrumb-links')
@include('backend.coalitions.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.coalitions.management') }} <small class="text-muted">{{ __('labels.backend.coalitions.active') }}</small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="coalitions-table" class="table" data-ajax_url="{{ route("admin.coalitions.get") }}">
                        <thead>
                            <tr>
                                <th>{{ trans('labels.backend.coalitions.table.name') }}</th>
                                <th>{{ trans('labels.backend.coalitions.table.created_by') }}</th>
                                <th>{{ trans('labels.backend.coalitions.table.created_at') }}</th>
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
        XonBoard.Coalitions.list.init();
    });
</script>
@stop
