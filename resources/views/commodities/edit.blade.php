<x-layout>

    <x-slot name="title">Edit Barang</x-slot>

    <x-slot name="page_heading">Edit Barang</x-slot>

    <div class="card">

        <div class="card-header">
            <h4>
                <i class="fas fa-edit"></i>
                Edit Data Barang
            </h4>
        </div>

        <div class="card-body">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
          
<form action="{{ route('barang.update', $commodity) }}" method="POST">
    @csrf
    @method('PUT')
                <div class="form-group">
                    <label>Kode Barang</label>

                    <input type="text"
                           name="item_code"
                           class="form-control"
                           value="{{ $commodity->item_code }}">
                </div>

                <div class="form-group">
                    <label>Nama Barang</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ $commodity->name }}">
                </div>
<div class="form-group">
    <label>Ruangan</label>

    <select name="commodity_location_id" class="form-control">

        @foreach($commodity_locations as $location)

            <option
                value="{{ $location->id }}"
                @selected($commodity->commodity_location_id == $location->id)>

                {{ $location->name }}

            </option>

        @endforeach

    </select>
</div>

<div class="form-group">
    <label>Tahun Pembelian</label>

    <input type="number"
           name="year_of_purchase"
           class="form-control"
           value="{{ old('year_of_purchase', $commodity->year_of_purchase) }}">
</div>
<div class="form-group">
    <label>Kuantitas</label>

    <input type="number"
           name="quantity"
           class="form-control"
           value="{{ old('quantity', $commodity->quantity) }}">
</div>
<div class="form-group">
    <label>Harga</label>

    <input type="number"
           name="price"
           class="form-control"
           value="{{ old('price', $commodity->price) }}">
</div>
<div class="form-group">
    <label>Harga Satuan</label>

    <input type="number"
           name="price_per_item"
           class="form-control"
           value="{{ old('price_per_item', $commodity->price_per_item) }}">
</div>
<div class="form-group">
    <label>Kondisi</label>

    <select name="commodity_condition_id" class="form-control">

        @foreach($commodity_conditions as $condition)

            <option
                value="{{ $condition->id }}"
                @selected($commodity->commodity_condition_id == $condition->id)>

                {{ $condition->name }}

            </option>

        @endforeach

    </select>
<div class="form-group">
    <label>Catatan</label>

    <textarea name="note"
              class="form-control"
              rows="4">{{ old('note', $commodity->note) }}</textarea>
</div>
</div>
               <button type="submit" class="btn btn-success">
    <i class="fas fa-save"></i>
    Simpan Perubahan
</button>

                <a href="{{ route('barang.scan',$commodity->id) }}"
                   class="btn btn-secondary">

                    Batal

                </a>

            </form>

        </div>

    </div>

</x-layout>