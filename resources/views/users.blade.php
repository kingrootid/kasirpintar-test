<x-DashboardLayout>
    <div class="row action" style="display: none;margin-bottom: 1.5rem;">
        <div class="col-12">
            <div id="form">
                <div class="card hide card-add">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
                        </div>
                        <form id="add" action="{{ url('ajax/users') }}" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <input type="hidden" name="action" value="add">
                                <div class="form-group mb-3">
                                    <label>NIP</label>
                                    <input type="number" class="form-control" name="nip" placeholder="Masukan NIP" />
                                </div>
                                <div class="form-group mb-3">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="name" placeholder="Masukan Nama User" />
                                </div>
                                <div class="form-group mb-3">
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="password" placeholder="Masukan Password" />
                                </div>
                                <div class="form-group mb-3">
                                    <label>Jabatan</label>
                                    <select class="form-control" name="role">
                                        <option value="DIREKTUR">DIREKTUR</option>
                                        <option value="FINANCE">FINANCE</option>
                                        <option value="STAFF">STAFF</option>
                                    </select>
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
                        <form id="edit" action="{{ url('ajax/users') }}" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <input type="hidden" name="id" id="edit_id" value="">
                                <input type="hidden" name="action" value="edit">
                                <div class="form-group mb-3">
                                    <label>NIP</label>
                                    <input type="number" class="form-control" id="edit_nip" name="nip" placeholder="Masukan NIP" />
                                </div>
                                <div class="form-group mb-3">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" id="edit_name" name="name" placeholder="Masukan Nama User" />
                                </div>
                                <div class="form-group mb-3">
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="password" placeholder="Masukan Password" />
                                </div>
                                <div class="form-group mb-3">
                                    <label>Jabatan</label>
                                    <select class="form-control" id="edit_role" name="role">
                                        <option value="DIREKTUR">DIREKTUR</option>
                                        <option value="FINANCE">FINANCE</option>
                                        <option value="STAFF">STAFF</option>
                                    </select>
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
                    <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
                    <button class="btn btn-primary" onclick="openForm('add')"><i class="fa-solid fa-square-plus"></i> Tambah Data</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter" id="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Tanggal dibuat</th>
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
                ajax: "{{ url('data/users') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nip',
                        name: 'nip'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        </script>
    </x-slot:script>
</x-DashboardLayout>