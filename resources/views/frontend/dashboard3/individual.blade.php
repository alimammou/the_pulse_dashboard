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
                        <span class="breadcrumb-item active">Political Views Individual</span>
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
                        <div class="col-xl-12">

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-4">
                                        <h5 class="card-title">Civil Society organization Details</h5>
                                    </div>
                                    <div class="col-xl-4">
                                        <div style="
    text-align: -webkit-center;
    padding: 20px; ">
                                            <a class="arrow-nav"  @if($organization->id>1)href="{{Route('frontend.dashboard3.individual',\App\Models\Organization\Organization::where('id', '<',$organization->id)->orderBy('id','desc')->value('slug'))}}" @endif>
                                                <i class="fas fa-arrow-alt-circle-left fa-5x" style=" display: inline-block;padding-right: 20px"></i>
                                            </a>
                                            <a class="arrow-nav"  @if($organization->id<\App\Models\Organization\Organization::latest('id')->first()->id) href="{{Route('frontend.dashboard3.individual',\App\Models\Organization\Organization::where('id', '>',$organization->id)->orderBy('id','asc')->value('slug'))}}" @endif>
                                                <i class="fas fa-arrow-alt-circle-right fa-5x" style=" display: inline-block; "></i>
                                            </a>
                                        </div>                                </div>

                                    <div class="col-xl-4">
                                        <select id="select-state" placeholder="Pick a state..." onchange="location = this.value;">
                                            @foreach($list as $item)
                                                @if($item->slug==$organization->slug)
                                                    <option selected  value="{{$item->slug}}">{{$item->name}}</option>
                                                @else
                                                    <option   value="{{$item->slug}}">{{$item->name}}</option>

                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-8 ">

                                        <div class="table-responsive">
                                            <table class="table table-no-border">
                                                <tbody>
                                                <tr>
                                                    <td>Name of Organization
                                                    </td>
                                                    <td>{{$organization->name}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Official Status
                                                    </td>
                                                    <td>{{$organization->official_status}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Address
                                                    </td>
                                                    <td>{{$organization->address}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Website
                                                    </td>
                                                    <td><a href="//{{$organization->website}}">{{$organization->website}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Date Started work

                                                    </td>
                                                    <td>{{$organization->starting_date}}
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /basic gauge chart -->

                            </div>
                        </div>
                        </div>
                        <div class="col-xl-4">

                            <!-- Gauge styling options -->
                            <div class="card">
                                <div   class="card-body">
                                    <div style="height: 254px;" class="chart-container">
                                        <h5 class="mb-0">Standpoint on Weapons possession outside State Jurisdiction
                                        </h5>

                                        <div class="chart has-fixed-height" id="weapons-chart"></div>

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div   class="card-body">
                                        <div>
                                            <h5 class="mb-0">Standpoint on Civil State</h5>
                                            @if($organization->opinion_civil_state=='with')
                                                <h1 class="mb-0 font-weight-bold text-success">In Favour</h1>
                                            @elseif($organization->opinion_civil_state=='against')
                                                <h1 class="mb-0 font-weight-bold text-danger">Not In Favour</h1>
                                            @else
                                                <h1 class="mb-0 font-weight-bold">No Opinion</h1>

                                            @endif
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">

                            <!-- Gauge styling options -->
                            <div class="card">
                                <div class="card-body">
                                    <div style="
    height: 254px;" class="chart-container">
                                        <h5 class="mb-0">Standpoint on Neutrality and Border Demarcation
                                        </h5>
                                        <div class="chart has-fixed-height" id="neutrality-chart"></div>
                                    </div>
                                </div>
                            </div>                            <div class="card">
                                <div class="card-body">
                                    <div class="chart-container">
                                        <div>
                                            <h5 class="mb-0">Standpoint on Expanded Administrative Decentralization</h5>

                                            @if($organization->decentralization=='with')
                                                <h1 class="mb-0 font-weight-bold text-success">In Favour</h1>
                                            @elseif($organization->decentralization=='against')
                                                <h1 class="mb-0 font-weight-bold text-danger">Not In Favour</h1>
                                            @else
                                                <h1 class="mb-0 font-weight-bold">No Opinion</h1>

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="chart-container">

                                <h5 class="mb-0">Percentage of CSOs that share
                                    the same opinions</h5>
                            </div>

                                    <div class="chart svg-center"  id="same-opinion-chart"></div>
                                </div>
                            </div></div>

                    </div>
                    <!-- /gauge styling options -->

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12 row">
                                    <h5 class="card-title">Economic Plan:      </h5>
                                    @if(!$organization->economic_plan_url)
                                        <h5 class="mb-0">This organization <span class="mb-0 text-danger"> Doesn't </span> have an economic plan</h5>
                                    @else
                                        <h5 class="mb-0">Economic Plan Link <a href="{{$organization->economic_plan_url}}">Click Here </a> </h5>
                                        @if($organization->economic_plan_title)
                                            <h5 class="mb-0">Economic Plan Title: <span  class="mb-0 font-weight-bold">{{$organization->economic_plan_title}} </span> </h5>
                                        @endif
                                    @endif
                                </div>

                                <!--										<div class="col-xl-12">-->
                                <!--											<h5 class="mb-0">Link to plan : <span>Click Here</span></h5>-->
                                <!--											<h5 class="mb-0">Title of Economic Plan-->
                                <!--											</h5>-->
                                <!--										</div>-->
                            </div>
                        </div>
                    </div>
                    <!-- Basic gauge chart -->


                </div>
                <!-- /gauges -->
            </div>
            <!-- /content area -->
            <div class="row ">
            </div>
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
                           <a style="color:#000;" href="/storage/downloads/The_State_of_Civil_Society_in_Lebanon.pdf" >            Download the pdf</a></div></span>

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
            XonBoard.ThirdDashboardIndividual.list.init("{{$organization->slug}}");
        });
    </script>



@stop
