<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Struktur Organisasi 3 Tingkatan</title>
<style>
  /* Reset dasar agar rapi */
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: Arial, sans-serif;
    background-color: #f4f7f6;
    display: flex;
    justify-content: center;
    padding: 50px;
  }

  /* Styling khusus untuk container struktur organisasi */
  .org-chart ul {
    padding-top: 20px;
    position: relative;
    display: flex;
    justify-content: center;
    list-style-type: none;
  }

  .org-chart li {
    float: left;
    text-align: center;
    list-style-type: none;
    position: relative;
    padding: 20px 10px 0 10px;
  }

  /* Membuat garis horizontal yang menghubungkan kotak-kotak */
  .org-chart li::before, .org-chart li::after {
    content: '';
    position: absolute;
    top: 0;
    right: 50%;
    border-top: 2px solid #ccc;
    width: 50%;
    height: 20px;
  }
  
  .org-chart li::after {
    right: auto;
    left: 50%;
    border-left: 2px solid #ccc;
  }

  /* Menghapus garis untuk elemen pertama dan terakhir agar tidak bocor ke samping */
  .org-chart li:first-child::before, .org-chart li:last-child::after {
    border: 0 none;
  }

  /* Menambahkan garis vertikal ke atas untuk elemen pertama dan terakhir */
  .org-chart li:last-child::before {
    border-right: 2px solid #ccc;
    border-radius: 0 5px 0 0;
  }
  
  .org-chart li:first-child::after {
    border-radius: 5px 0 0 0;
  }

  /* Menghapus garis jika hanya ada satu anak (tidak punya saudara) */
  .org-chart li:only-child::after, .org-chart li:only-child::before {
    display: none;
  }
  .org-chart li:only-child {
    padding-top: 0;
  }

  /* Membuat garis vertikal turun dari induk (parent) ke anak (child) */
  .org-chart ul ul::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    border-left: 2px solid #ccc;
    width: 0;
    height: 20px;
    margin-left: -1px;
  }

  /* Styling untuk Kotak Jabatan (Node) */
  .node {
    padding: 15px 25px;
    display: inline-block;
    border-radius: 8px;
    background-color: white;
    border: 2px solid #2c3e50;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: all 0.3s;
  }

  .node:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 10px rgba(0,0,0,0.15);
  }

  .jabatan {
    font-weight: bold;
    color: #2c3e50;
    margin-bottom: 5px;
  }

  .nama {
    font-size: 14px;
    color: #7f8c8d;
  }

  /* Pembedaan Warna Tiap Tingkat */
  .level-1 { background-color: #e8f8f5; border-color: #1abc9c; } /* Tingkat 1 */
  .level-2 { background-color: #ebf5fb; border-color: #3498db; } /* Tingkat 2 */
  .level-3 { background-color: #fef9e7; border-color: #f1c40f; } /* Tingkat 3 */

</style>
</head>
<body>

<div class="org-chart">
  <ul>
    <li>
      <div class="node level-1">
        <div class="jabatan">Direktur Utama</div>
        <div class="nama">Budi Santoso</div>
      </div>
      
      <ul>
        <li>
          <div class="node level-2">
            <div class="jabatan">Manajer IT</div>
            <div class="nama">Andi Wijaya</div>
          </div>
          
          <ul>
            <li>
              <div class="node level-3">
                <div class="jabatan">Staf Frontend</div>
                <div class="nama">Rina</div>
              </div>
            </li>
            <li>
              <div class="node level-3">
                <div class="jabatan">Staf Backend</div>
                <div class="nama">Dito</div>
              </div>
            </li>
          </ul>
        </li>
        
        <li>
          <div class="node level-2">
            <div class="jabatan">Manajer Keuangan</div>
            <div class="nama">Siti Aminah</div>
          </div>
          
          <ul>
            <li>
              <div class="node level-3">
                <div class="jabatan">Staf Akunting</div>
                <div class="nama">Faisal</div>
              </div>
            </li>
            <li>
              <div class="node level-3">
                <div class="jabatan">Staf Pajak</div>
                <div class="nama">Maya</div>
              </div>
            </li>
          </ul>
        </li>
      </ul>

    </li>
  </ul>
</div>

</body>
</html>