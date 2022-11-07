@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    <div class="container">
        <div>
            <select name="chartType" id="chartType" onchange="updateChartType()">
                <option value="">{{__('names.selectChartType')}}</option>
                <option value="line">{{__('names.line')}}</option>
                <option value="bar">{{__('names.bar')}}</option>
                <option value="pie">{{__('names.pie')}}</option>
            </select>
            <select name="statisticType" id="statisticType" onchange="updateStatisticType()">
                <option value="">{{__('names.selectStatisticType')}}</option>
                <option value="registerPerMonth">{{__('names.monthlyRegistrations')}}</option>
                <option value="loginPerMonth">{{__('names.monthlyLogins')}}</option>
                <option value="userAdminCount">{{__('names.userAdminCount')}}</option>
                <option value="paidOrders">{{__('names.paidOrders')}}</option>
                <option value="unpaidOrders">{{__('names.unpaidOrders')}}</option>
                <option value="cancelledOrders">{{__('names.cancelledOrders')}}</option>
                <option value="returns">{{__('names.returns')}}</option>
                <option value="productOrders">{{__('names.productOrders')}}</option>
            </select>
        </div>
        <div>
            <canvas id="myChart" height="100"></canvas>
        </div>
        <div>
            <button type="button" class="btn btn-primary" onclick="downloadPDF()">{{__('buttons.downloadPDF')}}</button>
        </div>
    </div>
    <script>

        const ctx = document.getElementById('myChart').getContext('2d');

        let [data, labels, type, label] = {{Js::from($data)}};

        const borderColorArr = [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',]

        const backgroundColorArr = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)',]

        let datasets = [
            {
                label: label,
                data: data,
                borderColor: borderColorArr,
                backgroundColor: backgroundColorArr,
                borderWidth: 1,
            }
        ];
        const bgColor = {
            id: 'bgColor',
            beforeDraw: (chart,steps, opts) => {
                const {ctx, width, height} = chart;
                ctx.fillStyle = opts.backgroundColor;
                ctx.fillRect(0, 0, width, height)
                ctx.restore();
            }
        }
        let options = {
            responsive: true,
            maintainAspectRatio: true,
            aspectRatio: 3,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {precision: 0}
                }
            },
            plugins: {
                bgColor: {
                    backgroundColor: 'white'
                },
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    formatter: Math.round,
                    font: {
                        weight: 'bold'
                    }
                },
                title: {
                    display: true,
                    position: "top",
                    text: "",
                    fontColor: "#111",
                    padding: 10,
                },
                legend: {
                    display: true,
                    position: "bottom",
                    labels: {
                        fontSize: 16
                    }
                },
            },

        };

        let chartConfig = {
            type: type,
            data: {
                labels: labels,
                datasets: datasets,
            },
            options: options,
            plugins: [ChartDataLabels, bgColor],
        }

        let myChart = new Chart(ctx, chartConfig);

        const updateChartType = () => {
            if (document.getElementById("chartType").value === "") return;

            chartConfig.type = document.getElementById("chartType").value;
            myChart.destroy();
            myChart = new Chart(ctx, chartConfig);
        };

        const updateStatisticType = () => {
            if (document.getElementById("statisticType").value === "") return;

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "/admin/statistics",
                type: 'POST',
                data: $("#statisticType").serialize(),
                success: function (data) {
                    addData(data.data[0], data.data[1], data.data[2], data.data[3]);
                },
                error: function (data) {
                    // Dosomething on error
                }
            });
        }

        const addData = (data, labels, type, label) => {
            chartConfig = {
                type: type,
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        borderColor: borderColorArr,
                        backgroundColor: backgroundColorArr,
                        borderWidth: 1,
                    }],
                },
                options: options,
                plugins: [ChartDataLabels, bgColor],
            }
            myChart.destroy();
            myChart = new Chart(ctx, chartConfig);
        }

        function downloadPDF() {
            const canvas = document.getElementById('myChart');

            // Create Image and keep ratio
            const canvasImage = canvas.toDataURL('image/jpeg', 1.0);


            let pdf = new jsPDF('landscape');
            pdf.setFontSize(20);
            pdf.addImage(canvasImage, 'JPEG', 15, 15);
            let name = document.getElementById('statisticType').value ? document.getElementById('statisticType').value : 'data';
            pdf.save(`${name}.pdf`);
        }
    </script>
@endsection
