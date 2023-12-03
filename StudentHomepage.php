<!DOCTYPE html>
<?php
include("security.php");
checkSession(true);
include("app.php");

$ID = $_SESSION["id"];
$user = getStudent($ID);

$table1 = getStudentCourses($ID);

?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Student homepage</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            background: linear-gradient(to right, #e2ecfe, #e6dbfa);
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid rgb(1, 1, 1);
        }




        .p {
            border: solid black;
            padding: 40px;

        }


        table {
            width: 100%;
            border-collapse: collapse;
        }


        th {
            background: linear-gradient(-10deg, #b5b7ec, #bbcff0);
            /* Background color for header cells */
            padding: 10px;
            text-align: center;
            color: #4f0099;
        }



        td {
            padding: 10px;
            text-align: center;
        }

        caption {
            text-align: left;
        }

        div {
            text-align: right;
        }

        .text-center {
            text-align: center;
            background: linear-gradient(-135deg, #5586e3, #a33ee7);
        }
    </style>
</head>

<body>
    <header>
        <a href="index.php">
            <img id="logo" src="images\logo.png" alt=" Logo" style="width: 80pt">
        </a>

        <h1>Welcome <?php echo ($user["firstName"] . " " . $user["lastName"]); ?></h1>

    </header>
    <div>
        <a class="log_out" href="app.php?signout=true">Log-out</a>

    </div>



    <p class="p">
        Student Information <br>
        Studnet Name : <?php echo $user["firstName"] . " " . $user["lastName"]; ?><br>
        Studnet KSU ID : <?php echo $user["KSUID"]; ?><br>
    </p>

    <table>
        <h2> Registered Courses</h2>
        <tr>
            <th>Course</th>
            <th>Attendance Record</th>
            <th>Absence percentage</th>
        </tr>

        <?php
            foreach ($table1 as $row) {
                echo "<tr>";
                echo "<td>". $row["name"] ."</td>";
                echo "<td><a href='StudentAttendanceRecord.php?id={$row["id"]}'>Attendance</a></td>";
                echo "<td>". $row["percentage"] ."%</td>";
                echo "</tr>";
            }
        ?>
    </table>
    </div>
    <br> <br> <br>
    <footer class="text-center">
        <p>@Copyright KSU - IT department</p>
    </footer>
</body>

</html>