<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data Fakultas</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
        <form action="<?php echo site_url('bendahara/fakultas/update/' . $fakultas->id_fakultas); ?>" method="POST">
            <div class="form-group">
                <label for="nama_fakultas">Nama Fakultas</label>
                <input type="text" class="form-control" id="nama_fakultas" name="nama_fakultas" value="<?php echo $fakultas->nama_fakultas; ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Aktif" <?php echo ($fakultas->status == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                    <option value="Non Aktif" <?php echo ($fakultas->status == 'Non Aktif') ? 'selected' : ''; ?>>Non Aktif</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
        </div>
                </div>
            </div>
        </div>
    </div>

