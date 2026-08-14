<x-layout>
	<x-slot name="title">Dashboard</x-slot>
	<x-slot name="page_heading">Dashboard</x-slot>

	<div class="row">

    <!-- Total Barang -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-box-open"></i>
            </div>

            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Barang</h4>
                </div>

                <div class="card-body">
                    {{ $commodity_counts['commodity_in_total'] }}
                </div>
            </div>
        </div>
    </div>

    <!-- Baik -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-check-circle"></i>
            </div>

            <div class="card-wrap">
                <div class="card-header">
                    <h4>Kondisi Baik</h4>
                </div>

                <div class="card-body">
                    {{ $commodity_counts['commodity_in_good_condition'] }}
                </div>
            </div>
        </div>
    </div>

    <!-- Rusak Ringan -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fas fa-exclamation-circle"></i>
            </div>

            <div class="card-wrap">
                <div class="card-header">
                    <h4>Rusak Ringan</h4>
                </div>

                <div class="card-body">
                    {{ $commodity_counts['commodity_in_not_good_condition'] }}
                </div>
            </div>
        </div>
    </div>

    <!-- Rusak Berat -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fas fa-times-circle"></i>
            </div>

            <div class="card-wrap">
                <div class="card-header">
                    <h4>Rusak Berat</h4>
                </div>

                <div class="card-body">
                    {{ $commodity_counts['commodity_in_heavily_damage_condition'] }}
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row justify-content-center">

    <div class="col-lg-6 col-md-8 col-sm-12">

        <div class="card card-statistic-1">

            <div class="card-icon bg-info">
                <i class="fas fa-tools"></i>
            </div>

            <div class="card-wrap">

                <div class="card-header">
                    <h4>Dalam Perbaikan</h4>
                </div>

                <div class="card-body">
                    {{ $commodity_counts['commodity_in_repair'] }}
                </div>

            </div>

        </div>

    </div>

</div>
	
	<div class="row">
		<div class="col-md-6 col-lg-8">
			<div class="card">
				<x-bar-chart chartTitle="Grafik Barang Berdasarkan Kondisi" chartID="chartCommodityCondition"
					:series="$charts['commodity_condition_count']['series']"
					:categories="$charts['commodity_condition_count']['categories']" :colors="['#47C363', '#FFA426', '#3ABAF4', '#FC544B']">
				</x-bar-chart>
			</div>
		</div>

		<div class="col-md-6 col-lg-4">

    <div class="card">

        <div class="card-header">
            <h4>
                <i class="fas fa-history text-primary mr-2"></i>
                Aktivitas Terbaru
            </h4>
        </div>

        <div class="card-body" style="max-height: 360px; overflow-y: auto;">

            @forelse($recent_activities as $activity)

<div class="card shadow-sm border-0 mb-3">
    <div class="card-body p-3">

        <div class="d-flex">

            {{-- ICON --}}
            <div class="mr-3">

                @if($activity->activity == 'Tambah Barang')

                   <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center"
     style="width:40px;height:40px;min-width:40px;">
                        <i class="fas fa-plus"></i>
                    </div>

                @elseif($activity->activity == 'Update Barang')

                   <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center"
     style="width:40px;height:40px;min-width:40px;">
                        <i class="fas fa-edit"></i>
                    </div>

                @else

                    <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center"
     style="width:40px;height:40px;min-width:40px;">
                        <i class="fas fa-trash"></i>
                    </div>

                @endif

            </div>

            {{-- ISI --}}
            <div class="flex-grow-1">

                <div class="d-flex justify-content-between align-items-center mb-3">

    <h6 class="font-weight-bold text-dark mb-0"
    style="font-size:18px;">
        {{ $activity->activity }}
    </h6>

    @if($activity->activity == 'Tambah Barang')

        <span class="badge badge-success px-2 py-1">
            Tambah
        </span>

    @elseif($activity->activity == 'Update Barang')

        <span class="badge badge-warning text-white px-3 py-2">
            Update
        </span>

    @else

        <span class="badge badge-danger px-3 py-2">
            Hapus
        </span>

    @endif

</div>

                <div class="border-left border-success rounded p-3 mb-3"
                     style="background:#F8FFF8;">

                    {!! nl2br(e($activity->description)) !!}

                </div>

                <div class="d-flex justify-content-between">

                    <small class="text-primary font-weight-bold">
                        <i class="fas fa-user-circle"></i>
                        {{ $activity->user_name }}
                    </small>

                    <small class="text-secondary text-right">
                        <i class="fas fa-calendar-alt"></i>
                        {{ $activity->created_at->translatedFormat('d M Y') }}
                        <br>
                        <i class="far fa-clock"></i>
                        {{ $activity->created_at->format('H:i') }} WIB
                    </small>

                </div>

                <small class="text-muted">
                    {{ $activity->created_at->diffForHumans() }}
                </small>

            </div>

        </div>

    </div>
</div>

@if(!$loop->last)
<hr>
@endif

@empty

<div class="text-center text-muted py-4">
    <i class="fas fa-inbox fa-2x mb-2"></i><br>
    Belum ada aktivitas.
</div>

@endforelse

        </div>

    </div>

</div>
</div>

	<div class="row">
    <div class="col-lg-12">
        <x-bar-chart
            chartTitle="Grafik Jumlah Barang Berdasarkan Tahun Pembelian"
            chartID="chartCommodityCountEachYear"
            :series="$charts['commodity_each_year_of_purchase_count']['series']"
            :categories="$charts['commodity_each_year_of_purchase_count']['categories']"
            :distributed="false"
            :showLegend="false"
            :colors="['#6777EF']">
        </x-bar-chart>
    </div>
</div>

	

	@push('modal')
	@include('commodities.modal.show')
	@endpush

	@push('js')
	@endpush
</x-layout>
