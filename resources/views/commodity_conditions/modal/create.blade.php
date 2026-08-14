<div class="modal fade" id="commodity_condition_create_modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('kondisi.store') }}" method="POST">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        <i class="fas fa-plus-circle"></i>
                        Tambah Kondisi
                    </h5>

                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <label>Nama Kondisi</label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="Contoh: Baik">

                    </div>

                    <div class="form-group">

                        <label>Warna Badge</label>

                        <select name="badge_color" class="form-control">

                            <option value="">-- Pilih Warna --</option>

                            <option value="success">🟢 Hijau (Success)</option>
                            <option value="warning">🟡 Kuning (Warning)</option>
                            <option value="danger">🔴 Merah (Danger)</option>
                            <option value="info">🔵 Biru Muda (Info)</option>
                            <option value="primary">🔷 Biru (Primary)</option>
                            <option value="dark">⚫ Hitam (Dark)</option>
                            <option value="secondary">⚪ Abu-abu (Secondary)</option>

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Simpan
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>