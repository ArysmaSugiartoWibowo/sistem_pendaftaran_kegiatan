<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Jurusan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
        <form action="<?php echo site_url('bendahara/jurusan/store'); ?>" method="POST">
            <div class="form-group">
                <label for="nama_jurusan">Nama jurusan</label>
                <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" required>
            </div>
            <div class="form-group">
                <select id="id_fakultas" name="id_fakultas" class="form-control">
                                    <option value="">-- Pilih Fakultas --</option>
                                    <?php foreach ($fakultas as $f): ?>
                                        <option value="<?= $f->id_fakultas ?>"><?= $f->nama_fakultas ?></option>
                                    <?php endforeach; ?>
                                </select>
            </div>
                       <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Non Aktif">Non Aktif</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
                </div>
            </div>
        </div>
    </div>
