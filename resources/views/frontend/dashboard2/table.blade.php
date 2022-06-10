@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.organizations.management'))
@section('content')
    <div class="content-wrapper">

        <!-- Inner content -->
        <div class="content-inner">

            <!-- Page header -->
            <div class="page-header page-header-light">


                <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="/" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                            <span class="breadcrumb-item active">Coalitions Table</span>
                        </div>

                    </div>


                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">
                <div class="row">
                    <div class="card" style="width: 100%">
                        <div class="card-body" >
                            <div class="row">
                                <div class="col-xl-8">
                                    <h5 class="card-title">Coalitions Table</h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>
                                                    Name
                                                </th>
                                                <th>
                                                    Description
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($coalitions as $coalition)
                                            <tr>
                                                <td>{{$coalition->name}}
                                                </td>
                                                <td>{{$coalition->description}}
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /basic gauge chart -->

                        </div>
                    </div>

                    <!-- /gauges -->
                </div>
                <!-- /content area -->


                <!-- /content area -->


                <!-- Footer -->
                <div class="navbar navbar-expand-lg navbar-light border-bottom-0 border-top">
                    <div class="text-center d-lg-none w-100">
                        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                            <i class="icon-unfold mr-2"></i>
                            Footer
                        </button>
                    </div>

                    <div class="navbar-collapse collapse" id="navbar-footer">
						<span class="navbar-text">
    <div class="ml-auto">
        <a style="color:#000;" href="/storage/downloads/The_State_of_Civil_Society_in_Lebanon.pdf" >      Download the pdf</a></div>
						</span>

                        <ul class="navbar-nav ml-lg-auto">
                        </ul>
                    </div>
                </div>
                <!-- /footer -->

            </div>	</div>

        <!-- /inner content -->

    </div>
@endsection
@section('page-script')
{{--    <script>--}}
{{--        XonBoard.Utils.documentReady(function() {--}}
{{--            XonBoard.Dashboard1.list.init("{{$organization->location}}");--}}
{{--        });--}}
{{--    </script>--}}



@stop
