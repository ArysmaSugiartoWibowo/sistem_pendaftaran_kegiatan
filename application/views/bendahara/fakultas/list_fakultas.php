<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Data Fakultas</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="<?php echo site_url('bendahara/fakultas/create'); ?>" class="btn btn-primary mb-3">Tambah Fakultas</a>
                        
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>

                                        <th>Nama Fakultas</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($fakultas as $b): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td> <!-- Menampilkan nomor urut -->
                
                                            <td><?php echo $b->nama_fakultas; ?></td>
                                            <td colspan=3>
                                                <a href="<?php echo site_url('bendahara/fakultas/edit/' . $b->id_fakultas); ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="<?php echo site_url('bendahara/jurusan/index/' . $b->id_fakultas); ?>" class="btn btn-primary btn-sm">Jurusan</a>
                                                <a href="<?php echo site_url('bendahara/fakultas/delete/' . $b->id_fakultas); ?>" class="btn btn-danger btn-sm">Hapus</a>
                                            </td>
                                            
                                                
                                            
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

<script src="<?= base_url('vendor') ?>/plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
