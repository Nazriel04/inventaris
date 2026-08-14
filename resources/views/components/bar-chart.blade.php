<div>
    <div class="card">
        <div class="card-header">
            <h4>{{ $chartTitle }}</h4>
        </div>

        <div class="card-body pt-2 pb-2">
            <div id="{{ $chartID }}"></div>
        </div>
    </div>
</div>

@push('js')
<script>
$(function () {

    const chartID = "#{{ $chartID }}";
    const categories = @json($categories);
    const series = @json($series);
	const distributed = @json($distributed ?? true);
const showLegend = @json($showLegend ?? true);

    let options = {

        chart: {
            height: 300,
            type: "bar",
            toolbar: {
                show: false
            }
        },
		legend: {
    show: showLegend
},

        plotOptions: {
    bar: {
        distributed: distributed,
        columnWidth: '70%',
        borderRadius: 6
    }
},

        dataLabels: {
            enabled: true
        },

        grid: {
            padding: {
                top: -20,
                right: 10,
                left: 10,
                bottom: 0
            }
        },

        series: [{
            data: series
        }],

        yaxis: {
            labels: {
                formatter: function(val){
                    return val.toFixed(0);
                }
            }
        },

        xaxis: {
            categories: categories
        }

    };

    @isset($colors)
        options.colors = @json($colors)
    @endisset

    new ApexCharts(document.querySelector(chartID), options).render();

});
</script>
@endpush