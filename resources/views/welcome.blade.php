<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Asteroid - Neo Stats</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/vendor.min.css">
    <link rel="stylesheet" href="./assets/vendor/icon-set/style.css">
    <link rel="stylesheet" href="./assets/css/theme.min.css?v=1.0">
</head>

<body class="footer-offset">

    <script src="./assets/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js"></script>

    <main id="content" role="main" class="main pointer-event">
        <div class="card">
            <div class="card-header">
                <h2 class="card-header-title">Asteroid - Neo Stats</h2>
                <small class="text-muted">Filter </small>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3 ">
                        <label class="input-label" for="exampleFormControlInput1">Filter Neo State in Date Range</label>
                        <div class="d-flex">
                            <input type="text" class="js-daterangepicker form-control daterangepicker-custom-input">
                            @csrf
                            <button type="button" class="btn btn-primary ml-2" onclick="asteroidFilter()">
                                Filter</button>
                        </div>
                        <span>Default Date is Today</span>

                    </div>
                </div>
                <hr>
                <div class="container">
                    <div class="d-flex justify-content-center text-primary loaderErr">
                        <div class="spinner-border" role="status" id="loader" style="none">
                            <span class="visually-hidden"></span>
                        </div>
                    </div>
                    <div class="row gx-2 gx-lg-3">
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <a class="card card-hover-shadow h-100" href="#">
                                <div class="card-body">
                                    <h5 class="card-subtitle text-success">Fastest Asteroid in km/h</h5>

                                    <div class="row align-items-center gx-2 mb-1">
                                        <div class="col-6">
                                            <span class="card-title h4" id="fastAsteroidspeed">It's Speed </span>
                                        </div>
                                    </div>
                                    <span class="text-body font-size-sm ml-1" id="fastAsteroidId">Asteroid ID</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <a class="card card-hover-shadow h-100" href="#">
                                <div class="card-body">
                                    <h5 class="card-subtitle text-success">Closest Asteroid</h5>

                                    <div class="row align-items-center gx-2 mb-1">
                                        <div class="col-6">
                                            <span class="card-title h4" id="closeAsteroidDistance">It's Distance </span>
                                        </div>
                                    </div>
                                    <span class="text-body font-size-sm ml-1" id="closeAsteroidId">Asteroid ID </span>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <a class="card card-hover-shadow h-100" href="#">
                                <div class="card-body">
                                    <h5 class="card-subtitle text-success">Average Size of the Asteroids in kilometer
                                    </h5>

                                    <div class="row align-items-center gx-2 mb-1">
                                        <div class="col-6">
                                            <span class="card-title h4" id="averageSize">Average Size </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <h2>Asteroids Chart Total </h2>
                    <div class="chartjs-custom" class="updatingChart">
                        <canvas id="updatingChart" class="js-chart" style="height:20rem"
                            data-hs-chartjs-options='{
                            "type": "bar",
                            "data": {
                              "labels": [],
                              "datasets": [{
                                "data": [],
                                "backgroundColor": "#377dff",
                                "hoverBackgroundColor": "#377dff",
                                "borderColor": "#377dff"
                              }]
                            },
                            "options": {
                              "scales": {
                                "yAxes": [{
                                  "gridLines": {
                                    "color": "#e7eaf3",
                                    "drawBorder": false,
                                    "zeroLineColor": "#e7eaf3"
                                  },
                                  "ticks": {
                                    "beginAtZero": true,
                                    "min": 0,
                                    "stepSize":2 ,
                                    "fontSize": 12,
                                    "fontColor": "#97a4af",
                                    "fontFamily": "Open Sans, sans-serif",
                                    "padding": 10,
                                    "postfix": ""
                                  }
                                }],
                                "xAxes": [{
                                  "gridLines": {
                                    "display": false,
                                    "drawBorder": false
                                  },
                                  "ticks": {
                                    "fontSize": 12,
                                    "fontColor": "#97a4af",
                                    "fontFamily": "Open Sans, sans-serif",
                                    "padding": 5
                                  },
                                  "categoryPercentage": 0.5,
                                  "maxBarThickness": "10"
                                }]
                              },
                              "cornerRadius": 2,
                              "tooltips": {
                                "prefix": "Total Asteroids ",
                                "hasIndicator": true,
                                "mode": "index",
                                "intersect": false,
                                "yearStamp": false
                              },
                              "hover": {
                                "mode": "nearest",
                                "intersect": true
                              }
                            }
                          }'></canvas>
                    </div>
                </div>

            </div>
        </div>

    </main>
    <script src="./assets/js/vendor.min.js"></script>
    <script src="./assets/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="./assets/vendor/chart.js.extensions/chartjs-extensions.js"></script>
    <script src="./assets/vendor/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js"></script>
    <script src="./assets/js/theme.min.js"></script>
    <script>
        $(document).on('ready', function() {

            Chart.plugins.unregister(ChartDataLabels);
            $('.js-chart').each(function() {
                $.HSCore.components.HSChartJS.init($(this));
            });
            $('.js-daterangepicker').daterangepicker();
            asteroidFilter();
        });


        function asteroidFilter() {
            $(".loaderError").remove();
            $("#loader").show();
            var dateRange = $('.js-daterangepicker').val();
            if (dateRange != '') dateRange = dateRange.replaceAll(' ', '').split('-');

            $.ajax({
                url: "{{ route('filter') }}",
                type: 'post',
                dataType: 'json',
                data: {
                    '_token': $("input[name='_token']").val(),
                    start: dateRange[0],
                    end: dateRange[1],
                },
                success: (response) => {
                    $("#loader").hide();
                    
                    if (response.status == 0) {
                        $(".loaderErr").append(`<span class="text-danger h2 loaderError">Please Select 7 Days Range</span>`);
                        return false;
                    }
                    $("#fastAsteroidId").text(`Astroid Id ${response.fastestAstroid.id}`);
                    $("#fastAsteroidspeed").text(
                        `It's Speed ${response.fastestAstroid.speed} km/h`);

                    $("#closeAsteroidId").text(`Astroid Id ${response.closestAstroid.id}`);
                    $("#closeAsteroidDistance").text(
                        `It's Distance ${response.closestAstroid.distance} km/h`);
                    $("#averageSize").text(`Average Size ${response.closestAstroid.distance} km/h`);
                    $(".updatingChart").html(`<canvas id="updatingChart" class="js-chart" style="height:20rem"
                            data-hs-chartjs-options='{
                            "type": "bar",
                            "data": {
                              "labels": [],
                              "datasets": [{
                                "data": [],
                                "backgroundColor": "#377dff",
                                "hoverBackgroundColor": "#377dff",
                                "borderColor": "#377dff"
                              }]
                            },
                            "options": {
                              "scales": {
                                "yAxes": [{
                                  "gridLines": {
                                    "color": "#e7eaf3",
                                    "drawBorder": false,
                                    "zeroLineColor": "#e7eaf3"
                                  },
                                  "ticks": {
                                    "beginAtZero": true,
                                    "min": 0,
                                    "stepSize":2 ,
                                    "fontSize": 12,
                                    "fontColor": "#97a4af",
                                    "fontFamily": "Open Sans, sans-serif",
                                    "padding": 10,
                                    "postfix": ""
                                  }
                                }],
                                "xAxes": [{
                                  "gridLines": {
                                    "display": false,
                                    "drawBorder": false
                                  },
                                  "ticks": {
                                    "fontSize": 12,
                                    "fontColor": "#97a4af",
                                    "fontFamily": "Open Sans, sans-serif",
                                    "padding": 5
                                  },
                                  "categoryPercentage": 0.5,
                                  "maxBarThickness": "10"
                                }]
                              },
                              "cornerRadius": 2,
                              "tooltips": {
                                "prefix": "Total Asteroids ",
                                "hasIndicator": true,
                                "mode": "index",
                                "intersect": false,
                                "yearStamp": false
                              },
                              "hover": {
                                "mode": "nearest",
                                "intersect": true
                              }
                            }
                          }'></canvas>`);
                    var updatingBarChart = $.HSCore.components.HSChartJS.init($('#updatingChart'));
                    updatingBarChart.data.labels = response.chart.labels;
                    updatingBarChart.data.datasets = [{
                        "backgroundColor": "#377dff",
                        "hoverBackgroundColor": "#377dff",
                        "borderColor": "#377dff",
                        "data": response.chart.data,
                    }];
                    updatingBarChart.update();

                }
            });
        }
    </script>
</body>

</html>
