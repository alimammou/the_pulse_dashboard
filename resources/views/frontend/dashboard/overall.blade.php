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
                        <span class="breadcrumb-item active">General Information Overall</span>
                    </div>


                </div>


            </div>
        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content">
            <div class="row">
                <div class="col-xl-6">

                    <!-- Basic columns -->
                    <div class="card" style="height: 485px;     background-color: white!important;color: black!important;">
                        <div class="card-header">
                            <h5 class="card-title">Type of Civil Society Organizations</h5>
                        </div>

                        <div class="card-body">
                            <div class="chart-container">
                                <div class="chart has-fixed-height" id="columns_basic"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /basic columns -->
                <div class="col-xl-6">

                    <!-- Basic scatter -->
                    <div class="card" id="test" style="background-color: white!important;    max-width: 800px;
    overflow-x: scroll; height:485px; ">
                        <div class="card-header">
                            <h5 class="card-title">Starting Date</h5>
                        </div>

                        <div class="card-body">
                            <div class="chart-container">
                                <div class="chart has-fixed-height" id="scatter_category"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /basic scatter -->

                </div>
            </div>
            <div class="row">
                <div class="col-xl-4">

                    <!-- Basic columns -->
                    <div class="card" style="background-color: white!important;">
                        <div class="card-header">
                            <h5 class="card-title">Registration Status</h5>
                        </div>

                        <div class="card-body">
                            <div class="chart-container">
                                <div class="chart has-fixed-height" id="registration-status"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /basic columns -->
                <div class="col-xl-8">
                    <div class="row">

                        <!-- Basic donut -->
                        <div class="col-xl-6">
                            <div class="card" style="height: 455px;background-color: white!important;">
                                <div class="card-header">
                                    <h5 class="card-title">Website Availability</h5>
                                </div>

                                <div class="card-body">
                                    <div class="chart-container">
                                        <div class="chart svg-center has-fixed-height" id="website-chart"></div>
                                    </div>
                                </div></div>
                        </div>
                        <div class="col-xl-6">

                            <!-- Basic bars -->
                            <div class="card " style="height: 455px;background-color: white!important;">
                                <div class="card-header">
                                    <h5 class="card-title">Financial Support</h5>
                                </div>

                                <div class="card-body">
                                    <div class="chart-container">
                                        <div class="chart has-fixed-height" id="financing-chart"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- /basic bars -->

                        </div>
                    </div>
                </div>
                <!-- /basic donut -->
            </div>

            <!-- Gauges -->
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
                        <a style="color:#000;" href="/storage/downloads/The_State_of_Civil_Society_in_Lebanon.pdf" >          Download the pdf</a> </div></span>

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

    <script>
        XonBoard.Utils.documentReady(function() {
            XonBoard.Dashboard1Overall.list.init();

        var item=document.getElementById('test')
            var status=0;
        setInterval(
            function(){
                if(status==0) {
                    item.scrollTo(15000, 3000);
                    status=1;
                }
                },
            3505
        );
        item.addEventListener("wheel", function (e) {
            e.preventDefault();
            if (e.deltaY > 0) item.scrollLeft += 100;
            else item.scrollLeft -= 100;
        });
        });
    </script>



@stop
