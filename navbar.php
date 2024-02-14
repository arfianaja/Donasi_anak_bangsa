<?php

if (!isset($_SESSION['member'])) {
    echo '<script language="javascript">alert("Anda harus Login!"); document.location="../login.php";</script>';
} else {
    include '../connect.php';

    $nama_pengguna = $_SESSION['member'];

    // Use a prepared statement to prevent SQL injection
    $query = "SELECT * FROM users WHERE name = ?";
    
    // Prepare the statement
    $stmt = mysqli_prepare($conn, $query);
    
    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "s", $_SESSION['member']);
    
    // Execute the query
    mysqli_stmt_execute($stmt);
    
    // Get the result
    $result = mysqli_stmt_get_result($stmt);
    
    // Fetch the data
    $hasil = mysqli_fetch_array($result);
}
?>

<!-- -------------------- HTML -------------------- -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Account Drop Down</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="navbar.css">
</head>

<body>
    <nav>
        <div class="logo">
            logo
        </div>
        <ul class="link">
            <li><a href="#">Frontend</a></li>
            <li><a href="#">Backend</a></li>
            <li><a href="#">Code</a></li>
            <li><a href="#">Project</a></li>
        </ul>
        <div class="account">
            <div class="profile">
                <img src="https://source.unsplash.com/100x100/?face" alt="">
            </div>
            <div class="menu">
                <h3><?php echo $namaPengguna; ?></h3>
                <p>Web Designer</p>


                <ul>
                    <li>
                        <i class="fa-solid fa-user"></i>
                        <a href="#">Profile</a>  
                    </li>
                    <li>
                        <i class="fa-regular fa-message"></i>
                        <a href="#">Message</a>  
                    </li>
                    <li>
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <a href="#">Log out</a>  
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <section>
        your content
    </section>


    <script src="navbar.js"></script>
</body>

</html>