<x-layout>
	<x-slot name="title">Halaman Daftar Barang</x-slot>
	<x-slot name="page_heading">Daftar Barang</x-slot>

	<div class="row">

    <!-- Total Barang -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-columns"></i>
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

    <!-- Kondisi Baik -->
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
                    <h4>Kondisi Rusak Ringan</h4>
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
                    <h4>Kondisi Rusak Berat</h4>
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
	<div class="card">
		<div class="card-body">
			@include('utilities.alert')
			<div class="d-flex justify-content-end mb-3">
				<div class="btn-group">
					

					

					@can('tambah barang')
					<button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#commodity_create_modal">
						<i class="fas fa-fw fa-plus"></i>
						Tambah Data
					</button>
					@endcan

					@can('print barang')
					<form action="{{ route('barang.print') }}" method="POST">
						@csrf
						<button type="submit" class="btn btn-success">
							<i class="fas fa-fw fa-print"></i>
							Print
						</button>
					</form>
					@endcan
				</div>
			</div>

			<x-filter>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="commodity_location_id">Lokasi Barang:</label>
							<select name="commodity_location_id" id="commodity_location_id" @class([ 'form-control' , 'is-valid'=>
								request()->filled('commodity_location_id')
								])
								>
								<option value="">Pilih lokasi barang..</option>
								@foreach ($commodity_locations as $commodity_location)
								<option value="{{ $commodity_location->id }}"
									@selected(request('commodity_location_id')==$commodity_location->id)>{{
									$commodity_location->name
									}}</option>
								@endforeach
							</select>
						</div>
					</div>
					

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="commodity_condition_id">Kondisi:</label>

<select name="commodity_condition_id"
        id="commodity_condition_id"
        @class([
            'form-control',
            'is-valid' => request()->filled('commodity_condition_id')
        ])>

    <option value="">Pilih kondisi..</option>

    @foreach ($commodity_conditions as $commodity_condition)
        <option value="{{ $commodity_condition->id }}"
            @selected(request('commodity_condition_id') == $commodity_condition->id)>
            {{ $commodity_condition->name }}
        </option>
    @endforeach

</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="year_of_purchase">Tahun Pembelian:</label>
							<select name="year_of_purchase" id="year_of_purchase" @class([ 'form-control' , 'is-valid'=>
								request()->filled('year_of_purchase')
								])
								>
								<option value="">Pilih tahun pembelian..</option>
								@foreach ($year_of_purchases as $year_of_purchase)
								<option value="{{ $year_of_purchase }}" @selected(request('year_of_purchase')==$year_of_purchase)>{{
									$year_of_purchase }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				

				<x-slot name="resetFilterURL">{{ route('barang.index') }}</x-slot>
			</x-filter>

			<div class="row">
				<div class="col-lg-12">
					<x-datatable>
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Kode Barang</th>
								<th scope="col">Nama Barang</th>
								<th scope="col">Tahun Pembelian</th>
								<th scope="col">Kondisi</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($commodities as $commodity)
							<tr>
								<th scope="row">{{ $loop->iteration }}</th>
								<td class="text-center align-middle">
									<div class="d-flex flex-column align-items-center">
										<span class="badge badge-primary mb-2">
											{{ $commodity->item_code }}
										</span>
										
									</div>
								</td>
								<td>{{ Str::limit($commodity->name, 55, '...') }}</td>
								<td>{{ $commodity->year_of_purchase }}</td>
								<td>
    <span class="badge badge-pill badge-{{ $commodity->commodityCondition->badge_color ?? 'secondary' }}">
        {{ $commodity->getConditionName() }}
    </span>
</td>
								<td class="text-center">
									<div class="btn-group" role="group" aria-label="Basic example">
										@can('detail barang')
										<a data-id="{{ $commodity->id }}" class="btn btn-sm btn-info text-white show-modal mr-2"
											data-toggle="modal" data-target="#show_commodity" title="Lihat Detail">
											<i class="fas fa-fw fa-search"></i>
										</a>
										@endcan

										@can('ubah barang')
										<a data-id="{{ $commodity->id }}" class="btn btn-sm btn-success text-white edit-modal mr-2"
											data-toggle="modal" data-target="#edit_commodity" title="Ubah data">
											<i class="fas fa-fw fa-edit"></i>
										</a>
										@endcan

<a href="{{ route('barang.label', $commodity->id) }}"
   class="btn btn-sm btn-dark text-white mr-2"
   title="Cetak Label QR">

    <i class="fas fa-tags"></i>

</a>

										@can('print individual barang')
										<form action="{{ route('barang.print-individual', $commodity->id) }}" method="POST">
											@csrf
											<button type="submit" class="btn btn-sm btn-primary mr-2">
												<i class="fas fa-fw fa-print"></i>
											</button>
										</form>
										@endcan

										@can('hapus barang')
										<form action="{{ route('barang.destroy', $commodity) }}" method="POST">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-sm btn-danger delete-button"><i
													class="fas fa-fw fa-trash-alt"></i></button>
										</form>
										@endcan
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</x-datatable>
				</div>
			</div>
		</div>
	</div>

	@push('modal')
	@include('commodities.modal.show')
	@include('commodities.modal.create')
	@include('commodities.modal.edit')
	@endpush

	@push('js')
	@include('commodities._script')
	@endpush
</x-layout>