<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Data Pengguna Level Pembina</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <a href="<?php echo site_url('ppkn/ControllerPpkn/register'); ?>" class="btn btn-primary mb-3">Daftar User Level Pembina</a>
                        <div class="table-responsive">
                            <table id="mytable_mahasiswa" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama User</th>
                                        <th>Jurusan</th>
                                        <th>Level</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php if(!empty($user)): ?>   
                                <?php foreach ($user as $d): ?>
                     
                                    
                                    <tr>
                                        <td><?php echo $d->username; ?></td> 
                                        <td><?php echo $d->nama_jurusan; ?></td> 
                                        <td>Pembina</td> 
                                        <td>
                                        <?= anchor(site_url("ppkn/ControllerBPpkn/hapus_user/". $d->id), '<i class="fa fa-trash"></i> Hapus User', 'class="btn btn-danger btn-sm" title="Hapus User"') ?>
                                        </td>          
                                    </tr>
     
                                <?php endforeach; ?>
                                <?php endif;?>
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

