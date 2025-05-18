<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-header">
                    <?= $nama_fakultas; ?>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <a href="<?php echo site_url('bendahara/fakultas/'); ?>" class="btn btn-warning mb-3">Kembali</a>
                        <a href="<?php echo site_url('bendahara/jurusan/create'); ?>" class="btn btn-primary mb-3">Tambah Jurusan</a>
                        
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>

                                        <th>Nama Jurusan</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($jurusan as $b): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td> <!-- Menampilkan nomor urut -->
                
                                            <td><?php echo $b->nama_jurusan; ?></td>
                                            <td colspan=3>
                                                <a href="<?php echo site_url('bendahara/jurusan/edit/' . $b->id_jurusan); ?>" class="btn btn-warning btn-sm">Edit</a>
                                                
                                                <a href="<?php echo site_url('bendahara/jurusan/delete/' . $b->id_jurusan); ?>" class="btn btn-danger btn-sm">Hapus</a>
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
