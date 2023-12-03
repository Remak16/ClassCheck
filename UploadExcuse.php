<!DOCTYPE html>
<?php
include("security.php");
checkSession(true);
include("app.php");

if (!isset($_GET["id"])) {
    header("Location: StudentHomepage.php");
}

$ID = $_SESSION["id"];
$classId = $_GET["id"];
$course = getClassCourse($classId);

?>

<html>

<head>
    <title>Excuse Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <a href="StudentHomepage.php"></a>
    <style>
        section {
            border: 1px solid rgb(0, 0, 0);
            background: #ccccff;

        }

        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: linear-gradient(to right, #e2ecfe, #e6dbfa);
        }

        div {

            border: 5px;
            border-style: ridge;
            margin: auto;

            background: linear-gradient(-10deg, #b5b7ec, #bbcff0);
        }

        .text-center {
            text-align: center;
            background: linear-gradient(-135deg, #5586e3, #a33ee7);
        }
    </style>
</head>

<body>
    <a href="index.php">
        <img id="logo" src="images\logo.png" alt=" Logo" style="width: 80pt">
    </a>

    <section>
        <p> Course: <?php echo $course["symbol"] ?> <br>
            Type: <?php echo $course["type"] ?> <br>
            Date: <?php echo $course["date"] ?>
        </p>
    </section>
    <div>
        <h2> Reason for absence:</h2>
        <form action="app.php" method="POST" enctype="multipart/form-data">
            <input hidden name="upload-excuse" value="true">
            <input hidden name="id" value="<?php echo $ID; ?>">
            <input hidden name="classId" value="<?php echo $classId; ?>">
            <input type="text" id="Excuse_Reason" name="reason" required>

            <h2> Upload file for supporting document:</h2>
            <input type="file" id="Excuse_file" name="uploadedFile" required>

            <p>
                <input type="submit" value="Send">
            </p>
        </form>
    </div>
    <br>
    <br>
    <footer class="text-center">
        <p>@Copyright KSU - IT department</p>
    </footer>
</body>

</html>