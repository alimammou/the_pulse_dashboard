@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.coalitions.management'))

@section('breadcrumb-links')
    @include('backend.coalitions.includes.breadcrumb-links')
@endsection

@section('content')
    <form method="post" action="{{route('admin.organizations.create-coalitions',$organization->id)}}">
        @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="card-title mb-0">
                        add Coalitions
                    </h4>
                </div>
                <!--col-->
            </div>
            <!--row-->

            <hr>

            <div class="">
                <div class="col">

                    <div class="form-group row">
                        <label for="name" class="col-md-2 from-control-label required">Name</label>

                        <div class="col-md-10">
                            <select class="search-input-select form-control" required="required" name="coalition_id" type="text" id="coalition_id">
@foreach($coalitions as $coalition)
    <option value="{{$coalition->id}}">{{$coalition->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--col-->
                    </div>
                    <!--form-group-->


                    <!--form-group-->
                </div>
                <!--col-->
            </div>
            <!--row-->
        </div>
        <!--card-body-->

        <div class="card-footer">
            <div class="row">

                <div class="col text-right">
                    <input class="btn btn-success btn-sm pull-right" type="submit" value="Create">
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div>
    </form>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Coalitions management for {{$organization->name}} <small class="text-muted">{{ __('labels.backend.coalitions.active') }}</small>
                    </h4>
                </div>
                <!--col-->
            </div>
            <!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>{{ trans('labels.backend.coalitions.table.name') }}</th>
                                <th>{{ trans('labels.general.actions') }}</th>
                            </tr>
                            @foreach($data as $d)
                                <tr>
                                    <td>{{$d->coalition->name}}

                                    </td>
                                    <td><div class="btn-group" role="group" aria-label="User Actions"><a href="{{route('admin.organizations.delete-coalitions',$d->id)}}" class="btn btn-primary btn-danger btn-sm" data-trans-button-cancel="Cancel" data-trans-button-confirm="Delete" data-trans-title="Are you sure you want to do this?" style="cursor:pointer;">
                                                <i data-toggle="tooltip" data-placement="top" title="Delete" class="fa fa-trash"></i>
                                            </a></div></td>
                                </tr>
                            @endforeach

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

