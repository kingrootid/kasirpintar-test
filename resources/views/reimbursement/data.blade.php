<x-DashboardLayout>
    <div class="row action" style="display: none;margin-bottom: 1.5rem;">
        <div class="col-12">
            <div id="form">
                <div class="card hide card-add">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
                        </div>
                        <form id="add" action="{{ url('ajax/req-reimbursement') }}" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <input type="hidden" name="action" value="add">
                                <div class="form-group mb-3">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="name" placeholder="Masukan Nama Reimbursement" />
                                </div>
                                <div class="form-group mb-3">
                                    <label>Attachment</label>
                                    <input type="file" class="form-control" data-type="add" name="attachment" />
                                </div>
                                <div class="form-group mb-3">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi"></textarea>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-danger" onclick="closeForm()">Tutup</button>

                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card hide card-edit">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
                        </div>
                        <form id="edit" action="{{ url('ajax/req-reimbursement') }}" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <input type="hidden" name="id" id="edit_id" value="">
                                <input type="hidden" name="action" value="edit">
                                <div class="form-group mb-3">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" id="edit_name" name="name" placeholder="Masukan Nama Reimbursement" />
                                </div>
                                <div class="form-group mb-3">
                                    <label>Attachment</label>
                                    <input type="file" class="form-control" data-type="add" id="edit" name="attachment" />
                                </div>
                                <div class="form-group mb-3">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" id="edit_deskripsi" name="deskripsi"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-danger" onclick="closeForm()">Tutup</button>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- HTML (DOM) Sourced Data table start -->
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Request Reimbursement</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter" id="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nama Pengaju</th>
                                    <th>Nama</th>
                                    <th>Dokumen</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status Pengajuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot:script>
        <script>
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('data/reimbursement') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'attachment',
                        name: 'attachment'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            function verifikasiPending(id) {
                Swal.fire({
                    icon: 'question',
                    title: 'Konfirmasi',
                    text: "Anda yakin memverifikasi data Tersebut ?",
                    showCancelButton: true,
                    confirmButtonText: "Iya",
                    cancelButtonText: "Tidak",
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        const form = new FormData();
                        form.append('_token', token);
                        form.append('id', id);
                        form.append('action', 'verifikasiDirektur');
                        callendpoint('verifikasi', form);
                    }
                });
            }

            function verifikasiFinance(id) {
                Swal.fire({
                    icon: 'question',
                    title: 'Konfirmasi',
                    text: "Anda yakin memverifikasi data Tersebut ?",
                    showCancelButton: true,
                    confirmButtonText: "Iya",
                    cancelButtonText: "Tidak",
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        const form = new FormData();
                        form.append('_token', token);
                        form.append('id', id);
                        form.append('action', 'verifikasiFinance');
                        callendpoint('verifikasi', form);
                    }
                });
            }

            function tolak(id) {
                Swal.fire({
                    icon: 'question',
                    title: 'Konfirmasi',
                    text: "Anda yakin menolak pengajuan tersebut ?",
                    showCancelButton: true,
                    confirmButtonText: "Iya",
                    cancelButtonText: "Tidak",
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        const form = new FormData();
                        form.append('_token', token);
                        form.append('id', id);
                        form.append('action', 'verifikasiDirektur');
                        callendpoint('verifikasi', form);
                    }
                });
            }
        </script>
    </x-slot:script>
</x-DashboardLayout>