@extends('base.app')

@section('content')
    <div class="card card-plain mb-4">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-lg-6">
                    <div class="d-flex flex-column h-100">
                        <h2 class="font-weight-bolder mb-0">@lang('messages.school_show_title', [$school->name])</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">@lang('messages.school_show_stats_games')</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $stats['games_played'] }}
                                    @if($stats['games_played_percentage'] != 0)
                                        <span class="text-{{ $stats['games_played_percentage'] > 0 ? 'success' : 'danger' }} text-sm font-weight-bolder">{{ $stats['games_played_percentage'] }}%</span>
                                    @endif
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-gamepad"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">@lang('messages.school_show_stats_users')</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $stats['users_count'] }}
                                    @if($stats['users_count_percentage'] != 0)
                                        <span class="text-{{ $stats['users_count_percentage'] > 0 ? 'success' : 'danger' }} text-sm font-weight-bolder">{{ $stats['users_count_percentage'] }}%</span>
                                    @endif
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">@lang('messages.school_show_stats_schools')</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $stats['schools_count'] }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa-solid fa-school"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">@lang('messages.school_show_stats_classrooms')</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $stats['classrooms_count'] }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-5 mb-lg-0 mb-4">
            <div class="card z-index-2">
                <div class="card-body p-3">
                    <h6 class="ms-2 mb-4 mb-0"> @lang('messages.school_show_chart_games_per_day') </h6>
                    <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                        <div class="chart">
                            <canvas id="chart-games_per_day" class="chart-canvas" height="170" width="586" style="display: block; box-sizing: border-box; height: 170px; width: 586px;"></canvas>
                            @push('scripts')
                                <script>
                                    var ctx = document.getElementById('chart-games_per_day').getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: {!! json_encode($stats['games_per_day']['labels']) !!},
                                            datasets: [{
                                                label: '@lang('messages.school_show_chart_games_per_day')',
                                                data: {!! json_encode($stats['games_per_day']['data']) !!},
                                                tension: 0.4,
                                                borderWidth: 0,
                                                borderRadius: 4,
                                                borderSkipped: false,
                                                backgroundColor: "#fff",
                                                maxBarThickness: 6
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            plugins: {
                                                legend: {
                                                    display: false,
                                                }
                                            },
                                            interaction: {
                                                intersect: false,
                                                mode: 'index',
                                            },
                                            scales: {
                                                y: {
                                                    grid: {
                                                        drawBorder: false,
                                                        display: false,
                                                        drawOnChartArea: false,
                                                        drawTicks: false,
                                                    },
                                                    ticks: {
                                                        suggestedMin: 0,
                                                        suggestedMax: 500,
                                                        beginAtZero: true,
                                                        padding: 15,
                                                        font: {
                                                            size: 14,
                                                            family: "Open Sans",
                                                            style: 'normal',
                                                            lineHeight: 2
                                                        },
                                                        color: "#fff"
                                                    },
                                                },
                                                x: {
                                                    grid: {
                                                        drawBorder: false,
                                                        display: false,
                                                        drawOnChartArea: false,
                                                        drawTicks: false
                                                    },
                                                    ticks: {
                                                        display: false
                                                    },
                                                },
                                            },
                                        }
                                    });
                                </script>
                            @endpush
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>@lang('messages.school_show_chart_users_per_day')</h6>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-users_per_day" class="chart-canvas" height="300" width="590" style="display: block; box-sizing: border-box; height: 300px; width: 590px;"></canvas>
                        @push('scripts')
                            <script>
                                var ctx2 = document.getElementById('chart-users_per_day').getContext('2d');
                                var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

                                gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
                                gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
                                gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

                                var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

                                gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
                                gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
                                gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors
                                new Chart(ctx2, {
                                    type: "line",
                                    data: {
                                        labels: @json($stats['users_per_day']['labels']),
                                        datasets: [{
                                            label: "Mobile apps",
                                            tension: 0.4,
                                            borderWidth: 0,
                                            pointRadius: 0,
                                            borderColor: "#cb0c9f",
                                            borderWidth: 3,
                                            backgroundColor: gradientStroke1,
                                            fill: true,
                                            data: @json($stats['users_per_day']['data']),
                                            maxBarThickness: 6

                                        },
                                        ],
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        plugins: {
                                            legend: {
                                                display: false,
                                            }
                                        },
                                        interaction: {
                                            intersect: false,
                                            mode: 'index',
                                        },
                                        scales: {
                                            y: {
                                                grid: {
                                                    drawBorder: false,
                                                    display: true,
                                                    drawOnChartArea: true,
                                                    drawTicks: false,
                                                    borderDash: [5, 5]
                                                },
                                                ticks: {
                                                    display: true,
                                                    padding: 10,
                                                    color: '#b2b9bf',
                                                    font: {
                                                        size: 11,
                                                        family: "Open Sans",
                                                        style: 'normal',
                                                        lineHeight: 2
                                                    },
                                                }
                                            },
                                            x: {
                                                grid: {
                                                    drawBorder: false,
                                                    display: false,
                                                    drawOnChartArea: false,
                                                    drawTicks: false,
                                                    borderDash: [5, 5]
                                                },
                                                ticks: {
                                                    display: true,
                                                    color: '#b2b9bf',
                                                    padding: 20,
                                                    font: {
                                                        size: 11,
                                                        family: "Open Sans",
                                                        style: 'normal',
                                                        lineHeight: 2
                                                    },
                                                }
                                            },
                                        },
                                    },
                                });
                            </script>
                        @endpush
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
