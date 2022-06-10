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
                        <span class="breadcrumb-item active">Political Views Overall</span>
                    </div>

                </div>


            </div>
        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-6">

                            <!-- Gauge styling options -->
                            <div class="card" style="height: 510px;">
                                <div class="card-header">
                                    <h5 class="card-title">Standpoint on Neutrality and Border Demarcation</h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <div class="chart has-fixed-height" id="neutrality-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">

                            <!-- Gauge styling options -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Standpoint on Weapons possession outside State Jurisdiction</h5>
                                </div>
                                <div class="card-body" style="height: 440px;">
                                    <div class="chart-container">
                                        <div class="chart has-fixed-height" id="weapons-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /gauge styling options -->
                </div>

                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Standpoint on Civil State</h5>
                        </div>

                        <div class="card-body">
                            <div class="chart-container">
                                <div class="chart has-fixed-height" id="civil-state-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Standpoint On Economic Reform Programs</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <div class="chart has-fixed-height" id="economic_plan1"></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Standpoint on Expanded Administrative Decentralization</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <div class="chart has-fixed-height" id="decetralization_plan"></div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /gauges -->
            </div>
            <!-- /content area -->

        </div>

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
     <a style="color:#000;" href="/storage/downloads/The_State_of_Civil_Society_in_Lebanon.pdf" >           Download the pdf</a></div>
                        </span>

                <ul class="navbar-nav ml-lg-auto">
                </ul>
            </div>
        </div>
        <!-- /footer -->

    </div>	</div>
@endsection
@section('page-script')
    <script>
        XonBoard.Utils.documentReady(function() {
            XonBoard.ThirdDashboard.list.init();
        });
    </script>



@stop
