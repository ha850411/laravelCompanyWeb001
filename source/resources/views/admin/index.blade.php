@extends('admin.layout.layout')

@section('style')
@endsection


@section('content')
<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    @include('admin.include.header')
    <!-- /header -->
    <!-- Header-->

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>首頁總覽</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">首頁總覽</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-1">
                <div class="card-body pb-0">
                    <!-- <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton1"
                            data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <div class="dropdown-menu-content">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div> -->
                    <h4 class="mb-0">
                        <span class="count">10468</span>
                    </h4>
                    <p class="text-light">入倉</p>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart1"></canvas>
                    </div>

                </div>

            </div>
        </div>
        <!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-2">
                <div class="card-body pb-0">
                    <!-- <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton2"
                            data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <div class="dropdown-menu-content">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div> -->
                    <h4 class="mb-0">
                        <span class="count">10468</span>
                    </h4>
                    <p class="text-light">出倉</p>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart2"></canvas>
                    </div>

                </div>
            </div>
        </div>
        <!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-3">
                <div class="card-body pb-0">
                    <!-- <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton3"
                            data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                            <div class="dropdown-menu-content">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div> -->
                    <h4 class="mb-0">
                        <span class="count">10468</span>
                    </h4>
                    <p class="text-light">員工</p>

                </div>

                <div class="chart-wrapper px-0" style="height:70px;" height="70">
                    <canvas id="widgetChart3"></canvas>
                </div>
            </div>
        </div>
        <!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-4">
                <div class="card-body pb-0">
                    <!-- <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4"
                            data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                            <div class="dropdown-menu-content">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div> -->
                    <h4 class="mb-0">
                        <span class="count">10468</span>
                    </h4>
                    <p class="text-light">客戶</p>

                    <div class="chart-wrapper px-3" style="height:70px;" height="70">
                        <canvas id="widgetChart4"></canvas>
                    </div>

                </div>
            </div>
        </div>
        <!--/.col-->



        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <h4 class="card-title mb-0">流量分析</h4>
                            <div class="small text-muted">April 2019</div>
                        </div>
                        <!--/.col-->
                        <div class="col-sm-8 hidden-sm-down">
                            <!-- <button type="button" class="btn btn-primary float-right bg-flat-color-1"><i class="fa fa-cloud-download"></i></button> -->
                            <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="btn-group mr-3" data-toggle="buttons" aria-label="First group">
                                    <label class="btn btn-outline-secondary">
                                        <input type="radio" name="options" id="option1"> 日
                                    </label>
                                    <label class="btn btn-outline-secondary active">
                                        <input type="radio" name="options" id="option2" checked=""> 月
                                    </label>
                                    <label class="btn btn-outline-secondary">
                                        <input type="radio" name="options" id="option3"> 年
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--/.col-->


                    </div>
                    <!--/.row-->
                    <div class="chart-wrapper mt-4">
                        <canvas id="trafficChart" style="height:200px;" height="200"></canvas>
                    </div>

                </div>
                <div class="card-footer">
                    <ul>
                        <li>
                            <div class="text-muted">訪問者</div>
                            <strong>29.703 用戶 (40%)</strong>
                            <div class="progress progress-xs mt-2" style="height: 5px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 40%;"
                                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                        <li class="hidden-sm-down">
                            <div class="text-muted">單次</div>
                            <strong>24.093 用戶 (20%)</strong>
                            <div class="progress progress-xs mt-2" style="height: 5px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 20%;" aria-valuenow="20"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                        <li>
                            <div class="text-muted">瀏覽量</div>
                            <strong>78.706 觀看 (60%)</strong>
                            <div class="progress progress-xs mt-2" style="height: 5px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 60%;"
                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                        <li class="hidden-sm-down">
                            <div class="text-muted">新用戶</div>
                            <strong>22.123 用戶 (80%)</strong>
                            <div class="progress progress-xs mt-2" style="height: 5px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 80%;"
                                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                        <li class="hidden-sm-down">
                            <div class="text-muted">跳出率</div>
                            <strong>40.15%</strong>
                            <div class="progress progress-xs mt-2" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow="40"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


    </div> <!-- .content -->
</div>

<!-- /#right-panel -->

@endsection

@section('javascript')
<script src="{{ asset('/admin/vendors/chart.js/dist/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('/admin/assets/js/dashboard.js') }}"></script>
<script src="{{ asset('/admin/assets/js/widgets.js') }}"></script>
<script src="{{ asset('/admin/vendors/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('/admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
<script src="{{ asset('/admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>

<script>

        (function ($) {
            "use strict";

            $('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);

</script>
@endsection