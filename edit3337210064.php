<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
    * {
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    body {
        font-family: Helvetica;
        -webkit-font-smoothing: antialiased;
        background: rgba(71, 147, 227, 1);
    }

    h2 {
        text-align: center;
        font-size: 18px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white;
        padding: 30px 0;
    }

    /* Table Styles */

    .table-wrapper {
        margin: 10px 70px 70px;
        box-shadow: 0px 35px 50px rgba(0, 0, 0, 0.2);
    }

    .fl-table {
        border-radius: 5px;
        font-size: 12px;
        font-weight: normal;
        border: none;
        border-collapse: collapse;
        width: 100%;
        max-width: 100%;
        white-space: nowrap;
        background-color: white;
    }

    .fl-table td,
    .fl-table th {
        text-align: center;
        padding: 8px;
    }

    .fl-table td {
        border-right: 1px solid #f8f8f8;
        font-size: 12px;
    }

    .fl-table thead th {
        color: #ffffff;
        background: #4FC3A1;
    }


    .fl-table thead th:nth-child(odd) {
        color: #ffffff;
        background: #324960;
    }

    .fl-table tr:nth-child(even) {
        background: #F8F8F8;
    }

    /* Responsive */

    @media (max-width: 767px) {
        .fl-table {
            display: block;
            width: 100%;
        }

        .table-wrapper:before {
            content: "Scroll horizontally >";
            display: block;
            text-align: right;
            font-size: 11px;
            color: white;
            padding: 0 0 10px;
        }

        .fl-table thead,
        .fl-table tbody,
        .fl-table thead th {
            display: block;
        }

        .fl-table thead th:last-child {
            border-bottom: none;
        }

        .fl-table thead {
            float: left;
        }

        .fl-table tbody {
            width: auto;
            position: relative;
            overflow-x: auto;
        }

        .fl-table td,
        .fl-table th {
            padding: 20px .625em .625em .625em;
            height: 60px;
            vertical-align: middle;
            box-sizing: border-box;
            overflow-x: hidden;
            overflow-y: auto;
            width: 120px;
            font-size: 13px;
            text-overflow: ellipsis;
        }

        .fl-table thead th {
            text-align: left;
            border-bottom: 1px solid #f7f7f9;
        }

        .fl-table tbody tr {
            display: table-cell;
        }

        .fl-table tbody tr:nth-child(odd) {
            background: none;
        }

        .fl-table tr:nth-child(even) {
            background: transparent;
        }

        .fl-table tr td:nth-child(odd) {
            background: #F8F8F8;
            border-right: 1px solid #E6E4E4;
        }

        .fl-table tr td:nth-child(even) {
            border-right: 1px solid #E6E4E4;
        }

        .fl-table tbody td {
            display: block;
            text-align: center;
        }
    }
</style>
</head>
<?php
// include database connection file
include("../config.php");

?>

<body>
    <?php //cek  
    if (isset($_POST['submit'])) {
        // ambil data dari formulir
        $nim = $_POST['nim'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $alamat = $_POST['alamat'];
        $about = $_POST['about'];
        $email = $_POST['email'];
        $link_in = $_POST['link_in'];
        $link_git = $_POST['link_git'];
        $link_twit = $_POST['link_twit'];
        $link_fb = $_POST['link_fb'];
        $award = $_POST['award'];
        $interest = $_POST['interest'];
        $skill = $_POST['skill'];

        // query
        $sql = "UPDATE about, interests, awards, skills SET
                fname = '$fname',
                lname = '$lname',
                alamat = '$alamat',
                about = '$about',
                email = '$email',
                link_in = '$link_in',
                link_git = '$link_git',
                link_twit = '$link_twit',
                link_fb = '$link_fb',
                award = '$award',
                interest = '$interest',
                skill = '$skill' 
                WHERE about.nim = $nim AND interests.nim = $nim  AND awards.nim = $nim AND skills.nim = $nim
            ";

        $query = mysqli_query($conn, $sql);
        // mengecek apakah query berhasil diubah
        if ($query == TRUE) {
            echo '<script type="text/javascript">
                            swal.fire({
                                title: "Berhasil",
                                icon: "success",
                                text: "Data Berhasil Diubah !",
                                type: "success"
                            })
                            .then(function() {
                                window.location = "../index.php";
                            });
                    </script>';
        } else {
            echo '<script type="text/javascript">
                    swal.fire({
                        title: "Gagal !",
                        icon: "error",
                        text: "Data Gagal Diubah ! Silahkan Hub Admin",
                        type: "error"
                    }).then(function() {
                        window.location = "../index.php";
                    });
                    </script>';
        }
    }
    //fix for sweetalert no reporting error $nim
    error_reporting(0);

    $nim = $_GET['nim'];

    // update user data about
    $sql = "SELECT * FROM about WHERE nim=$nim";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);

    $fname = $row["fname"];
    $lname = $row["lname"];
    $alamat = $row["alamat"];
    $about = $row["about"];
    $email = $row["email"];
    $link_in = $row["link_in"];
    $link_git = $row["link_git"];
    $link_twit = $row["link_twit"];
    $link_fb = $row["link_fb"];

    //awards
    $sql = "SELECT * FROM awards WHERE nim=$nim";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);

    $award = $row['award'];

    //interest
    $sql = "SELECT * FROM interests WHERE nim=$nim";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);

    $interest = $row["interest"];

    //skills
    $sql = "SELECT * FROM skills WHERE nim=$nim";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);

    $skill = $row["skill"];

    ?>
    <center>
        <div class="container-fluid position-absolute bottom-0 start-50 translate-middle-x">
            <span class="navbar-brand mb-0 h1"> <button type="submit" name="submit" class="btn btn-dark"><i class="fas fa-edit"></i> Edit</button>
                <a class="btn btn-dark" href="../index.php">Go to Home</a></span>
        </div>
        <form method="post" action='edit3337210023.php' enctype="multipart/form-data">
            <div class="table-wrapper">
                <table class="fl-table">
                    <tr>
                        <td><input type="hidden" name="nim" value=<?php echo $_GET['nim']; ?>></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>first name</td>
                        <td><input type="text" class="form-control" id="fname" name="fname" value="<?= $fname ?>" required></td>
                    </tr>
                    <tr>
                        <td>last name</td>
                        <td><input type="text" class="form-control" id="lname" name="lname" value="<?= $lname ?>" required></td>
                    </tr>
                    <tr>
                        <td>alamat</td>
                        <td><input type="text" class="form-control" id="alamat" name="alamat" value="<?= $alamat ?>" required></td>
                    </tr>
                    <tr>
                        <td>about</td>
                        <td><textarea type="textarea" class="form-control" id="about" name="about" required><?= $about ?></textarea></td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td><input type="text" class="form-control" id="email" name="email" value="<?= $email ?>" required></td>
                    </tr>
                    <tr>
                        <td>link_in</td>
                        <td><input type="text" class="form-control" id="link_in" name="link_in" value="<?= $link_in ?>" required></td>
                    </tr>
                    <tr>
                        <td>link_git</td>
                        <td><input type="text" class="form-control" id="link_git" name="link_git" value="<?= $link_git ?>" required></td>
                    </tr>
                    <tr>
                        <td>link_twit</td>
                        <td><input type="text" class="form-control" id="link_twit" name="link_twit" value="<?= $link_twit ?>" required></td>
                    </tr>
                    <tr>
                        <td>link_fb</td>
                        <td><input type="text" class="form-control" id="link_fb" name="link_fb" value="<?= $link_fb ?>" required></td>
                    </tr>

                    <!-- Awards -->
                    <tr>
                        <td>award</td>
                        <td><input type="text" class="form-control" id="award" name="award" value="<?= $award ?>" required></td>
                    </tr>

                    <!-- Interest -->
                    <tr>
                        <td>interest</td>
                        <td><input type="text" class="form-control" id="interest" name="interest" value="<?= $interest ?>" required></td>
                    </tr>

                    <!-- Skills -->
                    <tr>
                        <td>skill</td>
                        <td><input type="text" class="form-control" id="skill" name="skill" value="<?= $skill ?>" required></td>
                    </tr>

                </table>
            </div>
        </form>
    </center>
</body>

</html>