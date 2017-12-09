<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Barang</h4>
        </div>
        <div class="modal-body">
          <form method="post">
          	<div class="form-group">
          		<label>Nama Barang</label>
          		<input type="text" name="nama_brg" class="form-control" placeholder="Nama Barang ..">
          	</div>
          	<div class="form-group">
          		<label>jenis</label>
          		<input type="text" name="jenis" class="form-control" placeholder="Jenis Barang ..">
          	</div>
          	<div class="form-group">
          		<label>Suplier</label>
          		<input type="text" name="suplier" class="form-control" placeholder="Suplier ..">
          	</div>
          	<div class="form-group">
          		<label>Harga Modal</label>
          		<input type="text" name="harga_modal" class="form-control" placeholder="Modal per unit ..">
          	</div>
          	<div class="form-group">
          		<label>Harga jual</label>
          		<input type="text" name="harga_jual" class="form-control" placeholder="Harga Jual per unit ..">
          	</div>
          	<div class="form-group">
          		<label>Jumlah</label>
          		<input type="text" name="jumlah" class="form-control" placeholder="Jumlah ..">
          	</div>

          	<div class="modal-footer">
          		<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          		<input type="submit" name="btn-save" class="btn btn-primary" value="Simpan">
          	</div>
          </form>
        </div>
      </div>
      
    </div>
  </div>


  <!-- My Entry -->
  <div class="modal fade" id="myEntry" role="dialog">
    <div class="modal-dialog">
      
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Penjualan</h4>
        </div>
        <div class="modal-body">
          <form method="post">
            <div class="form-group">
              <label>Tanggal</label>
              <input type="text" name="tgl" id="tgl" class="form-control" autocomplete="off">
            </div>
            <div class="form-group">
              <label>Nama Barang</label>
              <select class="form-control" name="nama" onchange="fetch_select(this.value);">
              <option>Nama Barang</option>
                <?php 
                $query = "SELECT * FROM tb_barang group by nama_brg";
                $data = 'nama_brg';
                $barang->option($query,$data);                
                ?>
              </select>
            </div>

            <div class="form-group">
              <label>Harga Jual / unit</label>
              <select class="form-control" name="harga" id="new_select">
         </select>
              <!-- <input type="text" name="harga" class="form-control" placeholder="Harga" autocomplete="off"> -->
            </div>
            <div class="form-group">
              <label>Jumlah</label>
              <input type="text" name="jumlah" class="form-control" placeholder="Jumlah" autocomplete="off">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <input type="reset" class="btn btn-danger" value="Reset">
              <input type="submit" name="btn-save" class="btn btn-primary" value="Simpan">
            </div>

          </form>
        </div>
      </div>

    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#tgl").datepicker({dateFormat : 'yy/mm/dd'});
    });
  </script>
