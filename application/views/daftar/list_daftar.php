<!-- Tambahkan logika untuk memeriksa apakah ada status == 7 -->
<?php 
    $show_daftar_kegiatan_button = true; 
    if (!empty($daftar)) {
        foreach ($daftar as $d) {
            if ($d['status'] == 7) {
                $show_daftar_kegiatan_button = false;
                break;
            }
        }
    }
?>



<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-header">
                    <?php if ($show_daftar_kegiatan_button): ?>

                        <h3 class="card-title">Data Pendaftaran Kegiatan</h3>
                        <?php else : ?> 
                            <h3 class="card-title">Data Riwayat Kegiatan</h3>
                        <?php endif; ?>   
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <!-- Hanya tampilkan tombol jika tidak ada status == 7 -->
                    <?php if ($show_daftar_kegiatan_button): ?>
                        <a href="<?php echo site_url('hmps/ControllerDaftar/tambah'); ?>" class="btn btn-primary mb-3">Daftar Kegiatan</a>
                        <?php endif; ?>
                        
                        <div class="table-responsive">
                            <table id="mytable_mahasiswa" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Kegiatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($daftar)) : ?>
                                <?php foreach ($daftar as $d): ?>
                     
                                    
                                    <tr>
                                        <td><?php echo $d['nama_kegiatan']; ?></td> 
                                        <td colspan="3">
                                        <button type="button" class="btn btn-info btn-sm view-details" 
                                                    data-toggle="modal" data-target="#detailModal" 
                                                    data-nama_kegiatan="<?php echo $d['nama_kegiatan']; ?>"
                                                    data-tanggal_mulai="<?php echo $d['tanggal_mulai']; ?>"
                                                    data-tanggal_berakhir="<?php echo $d['tanggal_berakhir']; ?>"
                                                    data-ktr="<?php echo $d['keterangan']; ?>"
                                                    <?php if(!empty($d['dokumen'])) :?>
                                                    data-dokumen="<?php echo base_url("uploads/".$d['dokumen']); ?>"
                                                    <?php endif ;?>
                                                    <?php if(!empty($d['dokumen_proposal_ttd'])) :?>
                                                     data-dokumen_proposal_tt="<?php echo base_url("uploads/".$d['dokumen_proposal_ttd']); ?>"
                                                    <?php endif ;?>
                                                    <?php if(!empty($d['desposisi'])) :?>
                                                     data-desposisii="<?php echo base_url("uploads/".$d['desposisi']); ?>"
                                                    <?php endif ;?>
                                                    <?php if(!empty($d['dokumen_lpj'])) :?>
                                                     data-dokumen_lpjj="<?php echo base_url("uploads/".$d['dokumen_lpj']); ?>"
                                                    <?php endif ;?>
                                                    <?php if(!empty($d['lpj_pembina'])) :?>
                                                     data-lpj_pembinaa="<?php echo base_url("uploads/".$d['lpj_pembina']); ?>"
                                                    <?php endif ;?>
                                                    <?php if(!empty($d['lpj_ppkn'])) :?>
                                                     data-lpj_ppknn="<?php echo base_url("uploads/".$d['lpj_ppkn']); ?>"
                                                    <?php endif ;?>
                                                    <?php if(!empty($d['kwitansi_bendahara'])) :?>
                                                     data-kwitansi_bendaharaa="<?php echo base_url("uploads/".$d['kwitansi_bendahara']); ?>"
                                                    <?php endif ;?>
                                                    data-status="<?php echo $d['status']; ?>"> <!-- Added data-status here -->
                                                    <i class="fa fa-eye"></i> Detail
                                            </button>
                                            <!-- Tombol untuk membuka modal -->
                                            <?php if ($d['status'] <= '1' &&  $d['status'] >= '-1') : ?>
                                                <?= anchor(site_url("hmps/ControllerDaftar/hapus/" . $d['pendaftaran_id']), '<i class="fa fa-trash"></i> Batal', 'class="btn btn-danger btn-sm" title="Batal"') ?>
                                            <?php elseif ( $d['status'] <= '-2'  ) : ?>
                                                <?= anchor(site_url("hmps/ControllerDaftar/hapus_lpj/". $d['pendaftaran_id']), '<i class="fa fa-trash"></i> Batalkan Lpj', 'class="btn btn-danger btn-sm" title="Batalkan Lpj"') ?>
                                            <?php elseif ( $d['status'] == '4'  ) : ?>
                                                <?= anchor(site_url("hmps/ControllerDaftar/hapus_lpj/". $d['pendaftaran_id']), '<i class="fa fa-trash"></i> Batalkan Lpj', 'class="btn btn-danger btn-sm" title="Batalkan Lpj"') ?>
                                            <?php elseif ($d['status'] == '3') : ?>
                                                <button type="button" class="btn btn-primary btn-sm activate-button" 
                                                            data-toggle="modal" data-target="#activateModal" 
                                                            data-id="<?php echo $d['pendaftaran_id'] ?>">
                                                            <i class="fa fa-check"></i> Upload Lpj
                                                        </button>
                                            <?php endif; ?>
                                         

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

<?php $this->load->view('modal_detail'); ?>


<!-- Modal Upload Lpj -->
<div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-labelledby="activateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo site_url('hmps/ControllerDaftar/upload_lpj'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="activateModalLabel">Upload Lpj (PDF)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_pendaftaran" id="id_pendaftaraan">
                    <div class="form-group">
                        <input type="file" name="dokumen_lpj" id="dokumen_lpj" class="form-control" accept=".pdf" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    // Script untuk mengisi id peserta ke dalam modal
    document.addEventListener('DOMContentLoaded', function() {
        $('.activate-button').on('click', function() {
            var id_pm = $(this).data('id');
            $('#id_pendaftaraan').val(id_pm); // Set id_pm di modal
        });
    });
</script>
