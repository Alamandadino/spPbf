<?php

session_start();
if (!isset($_SESSION['admin'])) {
  header("location: login.php");
}

?>
<?php require 'header.php'; ?>

<div class="dashboard">
  <?php require 'aside.php'; ?>

  <main>
    <h3>Data IKM</h3>

    <div class="search">
      <form action="" method="POST">
        <select name="semester" id="">
          <option value="">--Semester--</option>
          <option value="Genap">Genap</option>
          <option value="Ganjil">Ganjil</option>
        </select>
        <select name="tahun" id="">
          <option value="">--Tahun--</option>
          <option value="">2024</option>
        </select>
        <div class="col">
          <button type="submit">Cari</button>
        </div>
      </form>
    </div>

    <div class="card" style="overflow-x: auto;">
      <table id="data" class="jawaban-res" border="1">
      </table>

      <?php
      require '../app/init.php';
      $conn = connect_DB();
      $respondens = query_select('respondens');
      $jawaban = query_select('jawaban_kuis');
      ?>
    </div>

  </main>
</div>
</body>

<script>
  document.title = "Data IKM";

  document.addEventListener(
    "DOMContentLoaded",
    () => {
      // Load Data
      loadJawabanRes();
    },
    false
  );

  const loadJawabanRes = () => {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.querySelector(
        ".jawaban-res"
      ).innerHTML = this.response;

      // Inisialisasi DataTables setelah data dimuat
      $('#data').DataTable();
    };
    xhttp.open("GET", "api/jawaban-res.php", true);
    xhttp.send();
  };
</script>

</html>