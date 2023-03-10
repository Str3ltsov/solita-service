@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('menu.analysisChart') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <h3 class="my-4">{{__('menu.analysisChart')}}</h3>
                <div class="row bg-white p-3 pb-4 pe-4 pe-md-4 mx-0 border-around">
                    <div class="d-flex flex-column flex-md-row gap-2">
                        <div class="form-group col-md-4 col-12">
                            {!! Form::label('role', __('table.userType')) !!}
                            {!! Form::select('role', $roles, null, ['class' => 'form-select', 'style' => 'padding: 15px;', 'id' => 'role']) !!}
                        </div>
                        <div class="form-group col-md-4 col-12">
                            {!! Form::label('dataType', __('table.dataType')) !!}
                            {!! Form::select('dataType', $dataTypes, null, ['class' => 'form-select', 'style' => 'padding: 15px;', 'id' => 'dataType']) !!}
                        </div>
                        <div class="form-group col-md-4 col-12">
                            {!! Form::label('chartType', __('table.chartType')) !!}
                            {!! Form::select('chartType', $chartTypes, null, ['class' => 'form-select', 'style' => 'padding: 15px;', 'id' => 'chartType']) !!}
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-center align-items-end gap-3">
                        <div class="form-group col-md-4 col-12 mt-2 mt-md-0" id="orderStatusContainer">
                            {!! Form::label('orderStatus', __('table.status')) !!}
                            {!! Form::select('orderStatus', $orderStatuses, 10, ['class' => 'form-select', 'style' => 'padding: 15px;', 'id' => 'orderStatuses']) !!}
                        </div>
{{--                        <div class="form-group col-md-4 col-12" id="returnStatusContainer">--}}
{{--                            {!! Form::label('returnStatus', __('table.status')) !!}--}}
{{--                            {!! Form::select('returnStatus', $returnStatuses, 4, ['class' => 'form-select', 'style' => 'padding: 15px;', 'id' => 'returnStatuses']) !!}--}}
{{--                        </div>--}}
                        <button type="button" class="category-return-button col-xl-3 col-lg-5 col-md-6 col-12 mt-4" id="chart_submit">
                            {{ __('buttons.submit') }}
                        </button>
                    </div>
                </div>
                <div class="bg-white p-3 pb-4 pe-4 pe-md-4 mx-0 my-4 border-around" style="height: clamp(200px, 75%, 600px) !important;">
                    <canvas id="analysis_chart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.0.1/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.1.0"></script>
    <script>
        $(document).ready(() => {
            const ctx = document.getElementById('analysis_chart').getContext('2d')

            const {data, labels, type, label} = {{ Js::from($initialChart) }};

            let colors = [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ];

            let options = {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 2,
                scales: {
                    x: {
                        grid : {
                            display : true
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: Math.round(1),
                        font: {
                            weight: 'bold'
                        }
                    },
                    title: {
                        display: true,
                        position: 'top',
                        text: '',
                        fontColor: '#222',
                        padding: 10,
                    },
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            fontSize: 16
                        }
                    },
                },

            };

            const chartConfig = {
                type: type,
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        borderColor:  colors,
                        backgroundColor: colors,
                        data: data
                    }]
                },
                options: options,
                plugins: [ChartDataLabels]
            };

            let myChart = new Chart(ctx, chartConfig);

            const showFilters = () => {
                const dataType = $('#dataType').val();
                const orderStatus = document.getElementById('orderStatusContainer');
                // const returnStatus = document.getElementById('returnStatusContainer');

                if (dataType === '2') {
                    orderStatus.classList.remove('d-none');
                    // returnStatus.classList.add('d-none');
                }
                // else if (dataType === '3') {
                //     orderStatus.classList.add('d-none');
                //     returnStatus.classList.remove('d-none');
                // }
                else {
                    orderStatus.classList.add('d-none');
                    // returnStatus.classList.add('d-none');
                }
            }

            showFilters();

            const getAnalysisChartData = ({ data, labels, type, label }) => {
                const chartConfig = {
                    type: type,
                    data: {
                        labels: labels,
                        datasets: [{
                            label: label,
                            borderColor: type === 'line' ? colors[0] : colors,
                            backgroundColor: type === 'line' ? colors[0] : colors,
                            data: data
                        }]
                    },
                    options: type !== 'bar' && options,
                    plugins: [ChartDataLabels]
                }

                myChart.destroy()
                myChart = new Chart(ctx, chartConfig)
            };

            $('#chart_submit').on('click', event => {
                event.preventDefault();
                let data = {
                    'role': $('#role').val(),
                    'dataType': $('#dataType').val(),
                    'chartType': $('#chartType').val(),
                    'orderStatus': $('#orderStatuses').val(),
                    // 'returnStatus': $('#returnStatuses').val()
                };

                $.ajax({
                    url: '{{ route('getAnalysisChartData', $prefix) }}',
                    type: 'GET',
                    data: data,
                    success: res => {
                        showFilters();
                        getAnalysisChartData(res);
                    },
                    error: res => console.log(res.message)
                });
            });
        });
    </script>
@endpush
