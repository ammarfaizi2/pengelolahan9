<?php

function reconstruct_tagihan_bebas($koneksi, $id_siswa, $id_kelas, $gaji)
{
  $q1 = $koneksi->query(
    $qqq = "SELECT
    a.id_bayar,
    a.id_kelas,
    a.id_kategori,
    a.jml_bayar,
    b.tipe_bayar
    FROM tb_kategori AS a
    INNER JOIN tb_jenis_bayar AS b
    ON a.id_bayar = b.id_bayar
    WHERE a.batas_bawah <= {$gaji} AND a.batas_atas >= {$gaji}
    AND a.id_kelas = '{$id_kelas}' AND b.tipe_bayar = 'Bebas'"
  );
  if (!$q1) { var_dump(mysqli_error($koneksi));die;}
  $query = true;

  $insertQuery = "INSERT INTO tb_tagihan_bebas(id_bayar, id_siswa, id_kelas, id_kategori, total_tagihan) VALUES ";

 $i = 0;
  while ($r = $q1->fetch_assoc()) {
    $dt = $biaya_oke;
    $insertQuery .= ($i++ ? "," : "")."('{$r["id_bayar"]}', '{$id_siswa}', '{$r["id_kelas"]}', '{$r["id_kategori"]}', '{$r["jml_bayar"]}')";
  }

  $query = $koneksi->query("DELETE FROM tb_tagihan_bebas WHERE id_siswa = '{$id_siswa}'");
  if (!$query) { var_dump(mysqli_error($koneksi));die;}
  if ($i > 0) {
    $query = ($koneksi->query($insertQuery) && $query);
    if (!$query) { var_dump(mysqli_error($koneksi));die;}
  }

  return $query;
}


  $query = $koneksi->query("DELETE FROM tb_tagihan_bebas WHERE id_siswa = '{$id_siswa}'");
  if (!$query) { var_dump(mysqli_error($koneksi));die;}
  if ($i > 0) {
    $query = ($koneksi->query($insertQuery) && $query);
    if (!$query) { var_dump(mysqli_error($koneksi));die;}
  }

  return $query;


function tagihan_bebas($vars)
{
  extract($vars);

  $sqlSiswa2 = $koneksi->query("SELECT * FROM tb_siswa where kelas = '$id_kelas' and gaji_ortu between '$bawah_oke' and '$atas_oke'");

  $query = true;

  $insertQuery = "INSERT INTO tb_tagihan_bebas(id_bayar, id_siswa, id_kelas, id_kategori, total_tagihan) VALUES ";

$i = 0;
  while ($ds = $sqlSiswa2->fetch_assoc()) {
      $idSiswa = $ds['id_siswa'];
      $dt = $biaya_oke;
      $insertQuery .= ($i++ ? "," : "")."('$id_bayar', '$idSiswa', '$id_kelas', '$id_kategori', '$dt')";
    
  }


  $query = ($koneksi->query("DELETE FROM tb_tagihan_bebas WHERE id_kategori = '{$id_kategori}'") && $query);
  if (!$query) {
    var_dump(mysqli_error($koneksi));die;
  }

  if ($i > 0) {
    $query = ($koneksi->query($insertQuery) && $query);
    if (!$query) {
      var_dump(mysqli_error($koneksi));die;
    }
  }

  return $query;
}
