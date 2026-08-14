<div class="modal fade"
     id="commodity_condition_edit_modal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog">

        <form id="editForm" method="POST">

            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Ubah Data Kondisi
                    </h5>

                    <button type="button"
                            class="close"
                            data-dismiss="modal">
                        <span>&times;</span>
                    </button>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <label>Nama Kondisi</label>

                        <input
                            type="text"
                            id="edit_name"
                            name="name"
                            class="form-control"
                            required>

                    </div>

                    <div class="form-group">

                        <label>Warna Badge</label>

                        <select
                            id="edit_badge_color"
                            name="badge_color"
                            class="form-control"
                            required>

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

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">
                        Simpan
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>