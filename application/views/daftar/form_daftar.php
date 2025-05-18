
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-8 mx-auto">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Pendaftaran Kegiatan Mahasiswa</h3>
          </div>
          <div class="card-body">
            <!-- Tampilkan pesan flash jika ada -->
            <?php if ( $this->session->flashdata( 'success' ) ): ?>
            <div class="alert alert-success"><?= $this->session->flashdata( 'success' ); ?></div>
            <?php elseif ( $this->session->flashdata( 'error' ) ): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata( 'error' ); ?></div>
            <?php endif; ?>

            <form id="formTambahData" action="<?= base_url('hmps/ControllerDaftar/simpan') ?>" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
              <div class="form-group">
                <label for="nama_kegiatan">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal_berakhir">Tanggal Berakhir</label>
                <input type="date" name="tanggal_berakhir" class="form-control" required>
            </div>
           
              <!-- Upload Surat Pengantar -->
              <div class="form-group">
                <label for="dokumen">Upload Proposal (PDF)</label>
                <input type="file" name="dokumen" class="form-control-file" accept=".pdf" required>
              </div>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
function validateForm() {
    // Mengambil semua elemen input yang bersifat required
    const form = document.getElementById('formTambahData');
    const inputs = form.querySelectorAll('[required]');

    for (let input of inputs) {
        if (!input.value.trim()) {
            alert('Harap isi semua bidang yang wajib diisi.');
            input.focus();
            // Mengarahkan fokus ke input yang kosong
            return false;
            // Mencegah pengiriman form
        }
    }
    return true;
    // Izinkan pengiriman form jika semua bidang telah terisi
}
</script>
