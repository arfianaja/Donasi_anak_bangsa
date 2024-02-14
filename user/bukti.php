<?php
include '../connect.php';

// Ambil ID donasi dari parameter URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan informasi donasi berdasarkan ID
    $query = "SELECT * FROM donasi WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $donasi_info = mysqli_fetch_assoc($result);
        
    ?>
    

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bukti Pembayaran</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/font-awesome.css">
  <link rel="stylesheet" href="donasi/user/assets/css/style.css">
  <style>

    @media print {
    .btn,
    .link-item {
        display: none;
        }
    }
      /* --------------
    Fonts
    --------------- */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    /* --------------
    Variables  
    ---------------- */
    :root{
        --main-color: #e02f6b;
        --blue:#0000ff;
        --blue-dark: #18293c;
        --purple-light: #EAD6EE;
        --blue-light: #A0F1EA;
        --orange: #ffa500;
        --purple: #BB73E0;
        --pink: #FF8DDB;
        --light: #C1FCD3;
        --red-orange: #FEA858;
        --green-dark: #0CCDA3;
        --white: #ffffff;
        --white-alpa-40: rgba(255, 255, 255, 0.40);
        --white-alpa-25: rgba(255, 255, 255, 0.25);
        --backdrop-filter-blur: blur(5px);
    }

    *{
     box-sizing: border-box;
     padding: 0;
     margin: 0;
     outline: none;
    }

    ::before,
    ::after{
        box-sizing: border-box;
    }

    body{
        min-height: 100vh;
        background-image: linear-gradient(to bottom right, var(--green-dark), var(--light));
        background-attachment: fixed;
        font-size: 16px;
        font-family: 'Poppins', sans-serif;
        font-weight: 300;
        color: var(--blue-dark);
        line-height: 1.5;
        overflow-x: hidden;
        -webkit-top-highlight-color: transparent;
        padding: 35px 15px;
    }

    body.hide-scrolling{
        overflow-y: hidden;
    }

    body::before{
        content: '';
        position: fixed;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        background-color: var(--red-orange);
        z-index: -1;
        opacity: 0.12;
    }

    section{
        background-color: var(--white-alpa-25);
        border: 1px solid var(--white-alpa-40);
        min-height: calc(100vh - 70px);
        border-radius: 30px;
        backdrop-filter: var(--backdrop-filter-blur);
    }

    section.fade-out{
        animation: fadeOut 0.5s ease-in-out forwards;
    }

    .main{
        max-width: 1200px;
        margin: auto;
        transition: all 0.5s ease-in-out;
        position: relative;
    }

    .main.fade-out{
        opacity: 0;
    }

    .container{
        padding: 0 40px;
        width: 100%;
    }

    .row{
        display: flex;
        flex-wrap: wrap;
    }

    .align-items-center{
        align-items: center;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar{
        width: 5px;
    }

    ::-webkit-scrollbar-track{
        background-color: var(--white);
    }

    ::-webkit-scrollbar-thumb{
        background-color: var(--main-color);
    }

    /* Buttons */
    button{
        font-family: inherit;
        user-select: none;
    }

    .btn{
        line-height: 1.5;
        background-color: var(--white-alpa-25);
        border: 1px solid var(--white-alpa-40);
        padding: 10px 28px;
        display: inline-block;
        border-radius: 30px;
        color: var(--main-color);
        font-weight: 500;
        text-transform: capitalize;
        font-family: inherit;
        font-size: 16px;
        user-select: none;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        vertical-align: middle;
        transition: color 0.3s ease;
    }

    .btn::before{
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 0%;
        background-color: var(--main-color);
        border-radius: 20px;
        z-index: -1;
        transition: width 0.3s ease;
    }

    .btn:hover::before{
        width: 100%;
    }

    .btn:hover{
        color: var(--white);
    }

    /* Bulat Bulat */
    .bg-circles{
        position: fixed;
        top: 0;
        height: 100%;
        max-width: 1200px;
        width: calc(100% - 30px);
        left: 50%;
        transform: translateX(-50%);
    }

    .bg-circles div{
        position: absolute;
    }

    .bg-circles .circle-1{
        height: 60px;
        width: 60px;
        background-color: var(--blue);
        left: 10%;
        top: 80%;
        opacity: 0.3;
        animation: zoomInOut 8s linear infinite;
        border-radius: 50%;
    }

    .bg-circles .circle-2{
        height: 80px;
        width: 80px;
        background-color: var(--main-color);
        left: 40%;
        top: 60%;
        opacity: 0.4;
        animation: bounceTop 5s ease-in-out infinite;
        border-radius: 50%;
    }

    .bg-circles .circle-3{
        height: 120px;
        width: 120px;
        background-color: var(--white);
        top: 40%;
        right: -60px;
        opacity: 0.6;
        border-radius: 50%;
    }

    .bg-circles .circle-4{
        height: 50px;
        width: 50px;
        background-color: var(--orange);
        left: -30px;
        top: 20%;
        opacity: 0.6;
        border-radius: 50%;
    }

    .bg-circles .circle-5{
        height: 45px;
        width: 45px;
        background-color: var(--purple);
        left: 60%;
        top: 120px;
        opacity: 0.6;
        animation: spin  1s ease-in-out infinite;
    }

    .bg-circles .circle-6{
        height: 50px;
        width: 50px;
        background-color: chartreuse;
        opacity: 0.6;
        animation: bounceTop 5s ease-in-out infinite;
        top: 130px;
        left: 98%;
        border-radius: 50%;
    }

    /* znimztion */
    @keyframes fadeIn{
        0%{
            opacity: 0;
        }
        100%{
            opacity: 1;
        }
    }

    @keyframes fadeOut{
        0%{
            opacity: 1;
        }
        100%{
            opacity: 0;
        }
    }

    @keyframes zoomInOut{
        0%,100%{
            transform: scale(0.5);
        }
        50%{
            transform: scale(1);
        }
    }

    @keyframes bounceTop{
        0%,100%{
            transform: translateY(-50%);
        }
        50%{
            transform: translateY(0px);
        }
    }

    @keyframes spin{
        0%{
            transform: rotate(0deg);
        }
        100%{
            transform: rotate(360deg);
        }
    }

    /* Section title */
    .section-title{
        padding: 0 15px;
        width: 100%;
        text-align: center;
        margin-bottom: 40px;
    }

    .section-title h2{
        font-size: 40px;
        text-transform: capitalize;
    }

    /* About */

    .about-img{
        width: 40%;
        padding: 0 15px;
    }

    .about-text{
        width: 60%;
        padding: 0 15px;
    }

    .about-img .img-box{
        background-color: var(--white-alpa-25);
        max-width: 500px;
        border: 1px solid var(--white-alpa-40);
        margin: auto;
        border-radius: 10px;
    }

    .about-img .img-box img{
        width: 100%;
        border-radius: 10px;
        height: 400px;
    }

    .about-text h3{
        text-transform: capitalize;
        font-size: 20px;
        margin: 20px 0;
    }

    .about-text .skills{
        display: flex;
        flex-wrap: wrap;
    }
    .about-text .skill-item{
        background-color: var(--white-alpa-25);
        border: 1px solid var(--white-alpa-40);
        padding: 5px 15px;
        text-transform: capitalize;
        margin: 0 10px 10px 0;
        border-radius: 20px;
    }

    .about-tabs{
        margin-top: 20px;
    }

    .about-tabs .tabs-item{
        padding: 2px 0;
        background-color: transparent;
        border: none;
        text-transform: capitalize;
        display: inline-block;
        color: var(--blue-dark);
        font-size: 20px;
        cursor: pointer;
        font-weight: 500;
        margin: 0 30px 0 0;
        position: relative;
        opacity: 0.5;
        transition: all 0.3s ease;
    }

    .about-tabs .tabs-item:last-child{
        margin: 0;
    }

    .about-tabs .tabs-item::before{
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 0%;
        height: 1px;
        background-color: var(--blue-dark);
        transition: width 0.3s ease;
    }

    .about-tabs .tabs-item:hover::before{
        width: 100%;
    }

    .about-tabs .tabs-item.active::before{
        width: 100%;
        background-color: var(--main-color);
    }

    .about-tabs .tabs-item.active{
        color: var(--main-color);
        opacity: 1;
        cursor: auto;
    }

    .about-text .tab-content{
        padding: 40px 0;
        display: none;
    }

    .about-text .tab-content.active{
        display: block;
    }

    .about-text .timeline{
        position: relative;
    }

    .about-text .timeline::before{
        content: '';
        position: absolute;
        height: 100%;
        width: 1px;
        top: 0;
        left: 5px;
        background-color: var(--main-color);
    }

    .about-text .timeline-item{
        margin-bottom: 30px;
        position: relative;
        padding: 10px 0 0 40px;
    }

    .about-text .timeline-item::before{
        content: '';
        position: absolute;
        height: 11px;
        width: 11px;
        background-color: var(--main-color);
        left: 0;
        top: 16px;
        border-radius: 50%;
    }

    .about-text .timeline-item:last-child{
        margin-bottom: 0;
    }

    .about-text .timeline-item .date{
        display: block;
        color: var(--main-color);
        font-weight: 400;
        margin: 0 0 10px;
    }

    .about-text .timeline-item h4{
        font-size: 18px;
        text-transform: capitalize;
        margin: 0 0 10px;
    }

    .about-text .timeline-item h4 span{
        font-weight: 400;
    }

    .about-text .btn{
        margin: 0 15px 15px 0;
    }   

  </style>
</head>
<body>

    <!-- Bulat Bulat -->
    <div class="bg-circles">
        <div class="circle-1"></div>
        <div class="circle-2"></div>
        <div class="circle-3"></div>
        <div class="circle-4"></div>
        <div class="circle-5"></div>
        <div class="circle-6"></div>
    </div>

    <div class="main">

        <!-- About -->
        <section class="about-section sec-padding" id="about">
            <div class="container">
            <div class="row">
                <div class="section-title">
                <h2><p>Bukti Pembayaran</p></h2>
                </div>
            </div>
            <div class="row">
                <div class="about-img">
                <div class="img-box">
                    <img src="<?php echo "../admin/uploads/" . $donasi_info["gambar"]; ?>">
                </div>
                </div>
                <div class="about-text">
                

                <!-- education start -->
                <div class="tab-content active" id="education">
                    <div class="timeline">
                        <div class="timeline-item">
                            <span class="date">Relawan</span>
                            <h4><p>Nama: <?php echo $donasi_info['nama']; ?></p></h4>
                            <h4><p>Email: <?php echo $donasi_info['email']; ?></p></h4>
                            <h4><p>Alamat: <?php echo $donasi_info['alamat']; ?></p></h4>
                            <h4><p>Tanggal: <?php echo $donasi_info['tanggal']; ?></p></h4>
                            <h4><p>Nomor Telepon: <?php echo $donasi_info['nomor_telp']; ?></p></h4>
                        </div>

                        <div class="timeline-item">
                            <span class="date">Bencana</span>
                            <h4><p>Nama Bencana : <?php echo $donasi_info['nama_bencana']; ?></p></h4>
                            <h4><p>Deskripsi : <?php echo $donasi_info['deskripsi']; ?></p></h4>
                            <h4><p>Jumlah Donasi : Rp <?php echo number_format($donasi_info['jumlah_donasi']); ?></p></h4>
                            <h4><p>Bank : <?php echo $donasi_info['nama_bank']; ?> <span>-</span> <?php echo $donasi_info['nomor_rek']; ?> </p></h4>
                            <h4><p>Status : Lunas</p></h4>
                        </div>

                    </div>
                </div>
                <!-- education end -->


                <form action="bencana.php">
                    <button class="btn link-item">Kembali</button>
                </form>
                <button onclick="printPage()" class="btn link-item">Cetak Riwayat Donasi</button>

                </div>
            </div>
            </div>
        </section>
        <!-- about end -->
    </div>
    <script>
        function printPage() {
            window.print();
        }

        const tabsContainer = document.querySelector(".about-tabs"),
        aboutSection = document.querySelector(".about-section");

        tabsContainer.addEventListener("click", (e) =>{
            if(e.target.classList.contains("tabs-item") && !e.target.classList.contains("active")){
                tabsContainer.querySelector(".active").classList.remove("active");
                e.target.classList.add("active");
                const target = e.target.getAttribute("data-target");
                aboutSection.querySelector(".tab-content.active").classList.remove("active");
                aboutSection.querySelector(target).classList.add("active");
            }
        });

    </script>

</body>
</html>

<?php
    } else {
        echo "Data donasi tidak ditemukan.";
    }
} else {
    echo "ID Donasi tidak diberikan.";
}

// Jangan lupa untuk menutup koneksi database setelah selesai menggunakan
mysqli_close($conn);
?>