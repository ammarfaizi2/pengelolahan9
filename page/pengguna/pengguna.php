<section class="content">
  <div class="row">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Pengguna</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <a href="?page=pengguna&aksi=tambah" class="btn btn-info" style="margin-bottom: 10px;" title="">Tambah</a>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Nama</th>
              <th>Level</t>
              <th>Foto</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>

            <?php

            $no = 1;

            $sql = $koneksi->query("select * from tb_user");

            while ($data = $sql->fetch_assoc()) {


            ?>


              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['username'] ?></td>
                <td><?php echo $data['nama_user'] ?></td>
                <td><?php echo $data['level'] ?></td>
                <td><img src="images/<?php echo $data['foto'] ?>" widht="75" height="75" alt=""></td>

                <td>

                  <a href="?page=pengguna&aksi=ubah&id=<?php echo $data['id']; ?>" class="btn btn-success" title=""><i class="fa fa-edit"></i> Ubah</a>

                  <a onclick="return confirm('Apakah Anda Yakin Mengahpus Data Ini')" href="?page=pengguna&aksi=hapus&id=<?php echo $data['id']; ?>" class="btn btn-danger" title=""><i class="fa fa-trash"></i> Hapus</a>


                </td>

              </tr>


            <?php } ?>

          </tbody>

        </table>

      </div>
    </div>
  </div>
</section>