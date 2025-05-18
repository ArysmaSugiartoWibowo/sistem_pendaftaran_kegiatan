

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-header">
                    <h3 class="card-title">Data Pendaftaran Kegiatan</h3>                  
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="a" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Kegiatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php if(!empty($daftar)): ?>   
                                <?php foreach ($daftar as $d): ?>

                     
                                    
                                    <tr>
                                        <td><?php echo $d->nama_kegiatan; ?></td>
                                        
                                        <td>
                                        <button type="button" class="btn btn-info btn-sm view-details" 
                                                    data-toggle="modal" data-target="#detailModal" 
                                                    data-nama_kegiatan="<?php echo $d->nama_kegiatan; ?>"
                                                    data-tanggal_mulai="<?php echo $d->tanggal_mulai; ?>"
                                                    data-tanggal_berakhir="<?php echo $d->tanggal_berakhir; ?>"
                                                    data-ktr="<?php echo $d->keterangan; ?>"
                                                    <?php if(!empty($d->dokumen)) :?>
                                                    data-dokumen="<?php echo base_url("uploads/".$d->dokumen); ?>"
                                                    <?php endif ;?>
                                                    <?php if(!empty($d->dokumen_proposal_ttd)) :?>
                                                       data-dokumen_proposal_tt="<?php echo base_url("uploads/".$d->dokumen_proposal_ttd); ?>"
                                                    <?php endif ;?>
                                                    <?php if(!empty($d->desposisi)) :?>
                                                    data-desposisii="<?php echo base_url("uploads/".$d->desposisi); ?>"
                                                    <?php endif ;?>
                                                    <?php if(!empty($d->dokumen_lpj)) :?>
                                                     data-dokumen_lpjj="<?php echo base_url("uploads/".$d->dokumen_lpj); ?>"
                                                    <?php endif ;?>
                                                    <?php if(!empty($d->lpj_pembina)) :?>
                                                     data-lpj_pembinaa="<?php echo base_url("uploads/".$d->lpj_pembina); ?>"
                                                    <?php endif ;?>
                                                    <?php if(!empty($d->lpj_ppkn)) :?>
                                                     data-lpj_ppknn="<?php echo base_url("uploads/".$d->lpj_ppkn); ?>"
                                                    <?php endif ;?>
                                                    <?php if(!empty($d->kwitansi_bendahara)) :?>
                                                     data-kwitansi_bendaharaa="<?php echo base_url("uploads/".$d->kwitansi_bendahara); ?>"
                                                    <?php endif ;?>
                                                    data-status="<?php echo $d->status; ?>"> <!-- Added data-status here -->
                                                    <i class="fa fa-eye"></i> Detail
                                            </button>
                                            <!-- Tombol untuk membuka modal -->
                                            <?php if($d->status == '1'): ?>
                                              
                                                        <!-- Tombol Aktifkan dengan data-id untuk id peserta -->
                                                        <button type="button" class="btn btn-primary btn-sm activate-button" 
                                                            data-toggle="modal" data-target="#activateModal" 
                                                            data-idsetuju="<?php echo $d->id_pendaftaran_alias; ?>">
                                                            <i class="fa fa-check"></i> Setuju 
                                                        </button>
                                                        <!-- Tombol Aktifkan dengan data-id untuk id peserta -->
                                                        <button type="button" class="btn btn-danger btn-sm tolak-button" 
                                                            data-toggle="modal" data-target="#modalTolak" 
                                                            data-ids="<?php echo $d->id_pendaftaran_alias; ?>">
                                                            <i class="fa fa-trash"></i> Tolak
                                                        </button>
                                                        <?php elseif($d->status == '4'): ?>
                                                     <!-- Tombol Setujui LPJ -->
                                                        <button type="button" class="btn btn-primary btn-sm activeLpj" 
                                                                data-toggle="modal" data-target="#activateLpj" 
                                                                data-idl="<?php echo $d->id_lpj; ?>"
                                                                data-idls="<?php echo $d->id_pendaftaran_alias; ?>"
                                                                >
                                                            <i class="fa fa-check"></i> Setujui LPJ
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm tolakLpj-button" 
                                                            data-toggle="modal" data-target="#modalTolakLpj" 
                                                            data-idss="<?php echo $d->id_pendaftaran_alias; ?>">
                                                            <i class="fa fa-trash"></i> Tolak Lpj
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

<!-- Modal Bootstrap untuk upload file PDF -->
<div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-labelledby="activateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo site_url('pembina/ControllerPembina/simpan'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="activateModalLabel">Upload Proposal Yang Sudah Di Tanda Tangani (PDF)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_pendaftaran" id="id_pendaftaran_setuju">
                    <div class="form-group">
                        <input type="file" name="dokumen_proposal_ttd" id="dokumen_proposal_ttd" class="form-control" accept=".pdf" required>
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

<!-- Modal Bootstrap -->
<div class="modal fade" id="activateLpj" tabindex="-1" role="dialog" aria-labelledby="activateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo site_url('pembina/ControllerPembina/simpan_lpj'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="activateModalLabel">Upload Lpj Yang Sudah Ditandatangani (PDF)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Input Hidden untuk Menyimpan ID Pendaftaran -->
                    <input type="hidden" name="id_lpj" id="id_lpj">
                    <input type="hidden" name="id_pendaftaran" id="id_pendaftarannn">
                    
                    <!-- Input untuk Upload File -->
                    <div class="form-group">
                        <label for="lpj_pembina">Upload Lpj Yang Sudah Ditanda Tangani (PDF)</label>
                        <input type="file" name="lpj_pembina" id="lpj_pembina" class="form-control" accept=".pdf" required>
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



<!-- Modal Bootstrap untuk upload Tolak proposal -->
<div class="modal fade" id="modalTolak" tabindex="-1" role="dialog" aria-labelledby="activateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo site_url('pembina/ControllerPembina/tolak'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="activateModalLabel">Berikan Alasan Menolak Proposal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Input Hidden untuk ID -->
                    <input type="hidden" name="id_pendaftaran" id="id_pendaftarann">
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3" required></textarea>
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


<!-- Modal Bootstrap untuk upload Tolak lpj -->
<div class="modal fade" id="modalTolakLpj" tabindex="-1" role="dialog" aria-labelledby="activateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo site_url('pembina/ControllerPembina/tolak_lpj'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="activateModalLabel">Berikan Alasan Menolak LPJ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Input Hidden untuk ID -->
                    <input type="hidden" name="id_pendaftaran" id="id_pendaftarannnn">
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3" required></textarea>
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


<!--  -->


<?php $this->load->view('modal_detail'); ?>






<script>
    // Script untuk mengisi id peserta ke dalam modal
    document.addEventListener('DOMContentLoaded', function() {
        $('.activate-button').on('click', function() {
            var id_setuju = $(this).data('idsetuju');
            $('#id_pendaftaran_setuju').val(id_setuju); // Set id_pm di modal
        });
    });
</script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
    $(document).on('click', '.tolak-button', function () {
        var id_pm = $(this).data('ids');
        console.log(id_pm); // Periksa nilai yang diambil dari tombol
 // Ambil data-id dari tombol
        $('#id_pendaftarann').val(id_pm); // Set nilai id_pendaftaran di modal
    });
});

</script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
    $(document).on('click', '.tolakLpj-button', function () {
        var id_pm = $(this).data('idss');
        console.log(id_pm); // Periksa nilai yang diambil dari tombol
 // Ambil data-id dari tombol
        $('#id_pendaftarannnn').val(id_pm); // Set nilai id_pendaftaran di modal
    });
});

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $(document).on('click', '.activeLpj', function () {
            // Ambil data-idl dari tombol
            var id_pm = $(this).data('idl');
            var id_pms = $(this).data('idls');
            
            // Debugging: Pastikan data-idl diambil dengan benar
            console.log("ID Pendaftaran:", id_pm);

            // Masukkan ID ke dalam input hidden di modal
            $('#id_lpj').val(id_pm);
            $('#id_pendaftarannn').val(id_pms);
        });
    });
</script>


