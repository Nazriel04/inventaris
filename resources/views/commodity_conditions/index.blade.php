<x-layout>
    <x-slot name="title">Halaman Daftar Kondisi</x-slot>
    <x-slot name="page_heading">Daftar Kondisi</x-slot>

    <div class="card">
        <div class="card-body">

            @include('utilities.alert')

            <div class="d-flex justify-content-end mb-3">

                <div class="btn-group">

                    <button type="button"
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-target="#commodity_condition_create_modal">

                        <i class="fas fa-fw fa-plus"></i>
                        Tambah Data

                    </button>

                </div>

            </div>

            <div class="row">

                <div class="col-lg-12">

                    <x-datatable>

                        <thead>

                            <tr>

                                <th>#</th>
                                <th>Nama Kondisi</th>
                                <th>Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($commodity_conditions as $commodity_condition)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
    <span class="badge badge-{{ $commodity_condition->badge_color }}">
        {{ $commodity_condition->name }}
    </span>
</td>

                                <td class="text-center">

                                    <div class="btn-group">

                                       <button
    class="btn btn-sm btn-success mr-2 edit-modal"
    data-id="{{ $commodity_condition->id }}"
    data-name="{{ $commodity_condition->name }}"
    data-badge_color="{{ $commodity_condition->badge_color }}"
    data-toggle="modal"
    data-target="#commodity_condition_edit_modal">

    <i class="fas fa-edit"></i>

</button>

                                       <form action="{{ route('kondisi.destroy', $commodity_condition->id) }}"
      method="POST">

    @csrf
    @method('DELETE')

    <button
        type="submit"
        class="btn btn-sm btn-danger delete-button">

        <i class="fas fa-trash"></i>

    </button>

</form>

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
    @include('commodity_conditions.modal.create')
    @include('commodity_conditions.modal.edit')
@endpush
@push('js')
<script>
console.log('Script Loaded');
$('.edit-modal').click(function () {

    let id = $(this).data('id');
    let name = $(this).data('name');
    let badge_color = $(this).data('badge_color');

    console.log(id);
    console.log(name);
    console.log(badge_color);

    $('#edit_name').val(name);
    $('#edit_badge_color').val(badge_color);

    console.log($('#edit_badge_color').val());

    $('#editForm').attr('action', '/kondisi/' + id);

});

</script>
@endpush
</x-layout>