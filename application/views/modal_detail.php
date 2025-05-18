<!-- Modal Bootstrap untuk Lihat Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Kegiatan :</strong> <span id="nama_kegiatan"></span></p>
                <p><strong>Tanggal Mulai :</strong> <span id="tanggal_mulai"></span></p>
                <p><strong>Tanggal Berakhir :</strong> <span id="tanggal_berakhir"></span></p>
                <p id="keterangan-wrapper"><strong>Keterangan :</strong> <span id="keterangan"></span></p>
                <p><strong>Proposal :</strong> <span><a id="dokumen" href="#" target='_blank'>Download</a></span></p>
                <p id="dokumen_proposal_tt-wrapper"><strong>Proposal Yang Sudah Ditandatangani Pembina :</strong> 
                    <span><a id="dokumen_proposal_tt" href="#" target='_blank'>Download</a></span>
                </p>
                <p id="desposisii-wrapper"><strong>Desposisi :</strong> 
                    <span><a id="desposisii" href="#" target='_blank'>Download</a></span>
                </p>
                <p id="dokumen_lpjj-wrapper"><strong>Dokumen Lpj :</strong> 
                    <span><a id="dokumen_lpjj" href="#" target='_blank'>Download</a></span>
                </p>
                <p id="lpj_pembinaa-wrapper"><strong>Lpj Yang Sudah Ditanda Tangani Pembina :</strong> 
                    <span><a id="lpj_pembinaa" href="#" target='_blank'>Download</a></span>
                </p>
                <p id="lpj_ppknn-wrapper"><strong>Lpj Yang Sudah Ditanda Tangani Pembuat Komitmen Anggaran:</strong> 
                    <span><a id="lpj_ppknn" href="#" target='_blank'>Download</a></span>
                </p>
                <p id="kwitansi_bendaharaa-wrapper"><strong> Kwitansi Bukti Pembayaran & Surat Perintah Bayar :</strong> 
                    <span><a id="kwitansi_bendaharaa" href="#" target='_blank'>Download</a></span>
                </p>
                <p><strong>Status:</strong> <span id="status"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Populate the View Details Modal
        $('.view-details').on('click', function () {
            // Mengisi data dinamis
            $('#nama_kegiatan').text($(this).data('nama_kegiatan'));
            $('#tanggal_mulai').text($(this).data('tanggal_mulai'));
            $('#tanggal_berakhir').text($(this).data('tanggal_berakhir'));

            // Handle Keterangan
            var keterangan = $(this).data('ktr');
            if (keterangan && keterangan.trim() !== '') {
                $('#keterangan').text(keterangan);
                $('#keterangan-wrapper').show(); // Tampilkan elemen jika ada keterangan
            } else {
                $('#keterangan-wrapper').hide(); // Sembunyikan elemen jika kosong
            }

            // Handle Dokumen Proposal TTD
            var dokumenProposalTTD = $(this).data('dokumen_proposal_tt');
            if (dokumenProposalTTD && dokumenProposalTTD.trim() !== '') {
                $('#dokumen_proposal_tt').attr('href', dokumenProposalTTD);
                $('#dokumen_proposal_tt-wrapper').show(); // Tampilkan elemen jika ada dokumen_proposal_tt
            } else {
                $('#dokumen_proposal_tt-wrapper').hide(); // Sembunyikan elemen jika kosong
            }

            // Handle Desposisi
            var desposisi = $(this).data('desposisii');
            if (desposisi && desposisi.trim() !== '') {
                $('#desposisii').attr('href', desposisi);
                $('#desposisii-wrapper').show(); // Tampilkan elemen jika ada desposisi
            } else {
                $('#desposisii-wrapper').hide(); // Sembunyikan elemen jika kosong
            }

            // Handle Lpj
            var dokumenLpj = $(this).data('dokumen_lpjj');
            if (dokumenLpj && dokumenLpj.trim() !== '') {
                $('#dokumen_lpjj').attr('href', dokumenLpj);
                $('#dokumen_lpjj-wrapper').show(); // Tampilkan elemen jika ada lpj
            } else {
                $('#dokumen_lpjj-wrapper').hide(); // Sembunyikan elemen jika kosong
            }

            // Handle Dokumen
            var dokumen = $(this).data('dokumen');
            if (dokumen && dokumen.trim() !== '') {
                $('#dokumen').attr('href', dokumen);
                $('#dokumen').closest('p').show(); // Tampilkan elemen jika ada dokumen
            } else {
                $('#dokumen').closest('p').hide(); // Sembunyikan elemen jika kosong
            }
            // Handle Lpj Pembina
            var lpj_pembinaa = $(this).data('lpj_pembinaa');
            if (lpj_pembinaa && lpj_pembinaa.trim() !== '') {
                $('#lpj_pembinaa').attr('href', lpj_pembinaa);
                $('#lpj_pembinaa').closest('p').show(); // Tampilkan elemen jika ada lpj_pembina
            } else {
                $('#lpj_pembinaa').closest('p').hide(); // Sembunyikan elemen jika kosong
            }
            // Handle Lpj Ppkn
            var lpj_ppknn = $(this).data('lpj_ppknn');
            if (lpj_ppknn && lpj_ppknn.trim() !== '') {
                $('#lpj_ppknn').attr('href', lpj_ppknn);
                $('#lpj_ppknn').closest('p').show(); // Tampilkan elemen jika ada lpj_ppknn
            } else {
                $('#lpj_ppknn').closest('p').hide(); // Sembunyikan elemen jika kosong
            }
            // Handle Kwitansi Bendahara
            var kwitansi_bendaharaa = $(this).data('kwitansi_bendaharaa');
            if (kwitansi_bendaharaa && kwitansi_bendaharaa.trim() !== '') {
                $('#kwitansi_bendaharaa').attr('href', kwitansi_bendaharaa);
                $('#kwitansi_bendaharaa').closest('p').show(); // Tampilkan elemen jika ada kwitansi_bendaharaa
            } else {
                $('#kwitansi_bendaharaa').closest('p').hide(); // Sembunyikan elemen jika kosong
            }

            // Set the status dynamically
            var status = $(this).data('status');
            if (status == '-4') {
                $('#status').text('Lpj Ditolak Oleh Bendahara Pengeluaran Pembantu');
            } 
            else if (status == '-3') {
                $('#status').text('Lpj Ditolak Oleh Pembuat Komitmen Anggaran');
            } 
            else if (status == '-2') {
                $('#status').text('Lpj Ditolak Oleh Pembina');
            } else if (status == '-1') {
                $('#status').text('Proposal Ditolak Oleh Penjabat Pembuat Komitmen Anggaran');
            }
            else if (status == '0') {
                $('#status').text('Proposal Ditolak Oleh Pembina');
            } else if (status == '1') {
                $('#status').text('Menunggu Persetujuan Pembina');
            }
             else if (status == '2') {
                $('#status').text('Menunggu Persetujuan Penjabat Pembuat Komitmen Anggaran');
            } else if (status == '3') {
                $('#status').text('Penjabat Pembuat Komitmen Anggaran Disetujui, Silahkan Jalankan Acara Dan Upload Lpj');
            } else if (status == '4') {
                $('#status').text('Menunggu Persetujuan Pembina Tentang Lpj');
                $('#batal-wrapper').show(); // Tampilkan tombol batal jika status = 4
            } else if (status == '5') {
                $('#status').text('Menunggu Persetujuan Pembuat Komitmen Anggaran Tentang Lpj');
            } 
             else if (status == '6') {
                $('#status').text('Menunggu Respon Bendahara Pengeluaran Pembantu Tentang Lpj');
            } 
             else if (status == '7') {
                $('#status').text('Kegiatan Selesai');

            } 
            else {
                $('#batal-wrapper').hide(); // Sembunyikan tombol batal jika status bukan 4
            }
        });
    });
</script>
