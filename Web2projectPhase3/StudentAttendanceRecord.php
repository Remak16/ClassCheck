<html>
<?php
include("security.php");
checkSession(true);
include("app.php");

if (!isset($_GET["id"])) {
    header("Location: StudentHomepage.php");
}

$ID = $_SESSION["id"];
$courseId = $_GET["id"];
$course = getCourse($courseId);
$lectures = getStudentAttends($ID, $courseId, true);
$labs = getStudentAttends($ID, $courseId, false);
$excuses = getStudentExcuses($ID, $courseId);

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance Record</title>

    <style>
        section {
            border: 2px solid rgb(0, 0, 0);
        }


        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #e2ecfe, #e6dbfa);
        }


        header {
            /*            background-color: rgb(182, 197, 229);*/
            color: rgb(0, 0, 0);
            padding: 20px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;

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


        th {
            background: linear-gradient(-10deg, #b5b7ec, #bbcff0);
            /* Background color for header cells */
            padding: 10px;
            text-align: center;
            color: #4f0099;
        }


        th.header-text {
            font-size: larger;
        }


        td {
            padding: 10px;
            text-align: center;
        }


        tr:hover {
            background-color: lightgray;
        }


        /* Center-align the button */
        .center-button {
            display: flex;
            justify-content: center;
        }

        nav {
            position: absolute;
            top: 0;
            right: 0;
            padding: 20px;
            /* Optional padding for spacing */
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
        <h1>Attendance Record </h1>
        <nav>
            <ul>
                <li><a href="app.php?signout=true">log Out</a></li>
            </ul>
        </nav>
        <p>
        <h3> Course: <?php echo $course["symbol"] . " - " . $course["name"]; ?> </h3>
        </p>
    </header>


    <h2>Lecture Attendance</h2>
    <section>
        <p>
        <table>
            <tr>
                <th class="header-text">Date</th>
                <th class="header-text">Attendance</th>
                <th class="header-text">Upload Excuse for Absence</th>
            </tr>
            <?php
            foreach ($lectures as $row) {
                echo "<tr><td>{$row["date"]}</td>";
                if ($row["attendance"] == 1) {
                    echo "<td>Attended</td><td></td>";
                } else {
                    echo "<td>Absent</td>";
                    echo "<td><a href='UploadExcuse.php?id={$row["id"]}' target='_blank'>Upload Excuse</a></td>";
                }
                echo "</tr>";
            }
            if (count($lectures) == 0) {
                echo "<tr><td colspan=3> No records available </td></tr>";
            }
            ?>
        </table>
        </p>
    </section>
    <h2>Lab Attendance</h2>
    <section>

        <p>
        <table>
            <tr>
                <th class="header-text">Date</th>
                <th class="header-text">Attendance</th>
                <th class="header-text">Upload Excuse for Absence</th>
            </tr>
            <?php
            foreach ($labs as $row) {
                echo "<tr><td>{$row["date"]}</td>";
                if ($row["attendance"] == 1) {
                    echo "<td>Attended</td><td></td>";
                } else {
                    echo "<td>Absent</td>";
                    echo "<td><a href='UploadExcuse.php?id={$row["id"]}' target='_blank'>Upload Excuse</a></td>";
                }
                echo "</tr>";
            }
            if (count($labs) == 0) {
                echo "<tr><td colspan=3> No records available </td></tr>";
            }
            ?>
        </table>
        </p>

    </section>
    <h2>Previous Excuses for Absences</h2>
    <section>

        <p>
        <table>
            <tr>
                <th class="header-text">Class Type</th>
                <th class="header-text">Date</th>
                <th class="header-text">Absence Reason</th>
                <th class="header-text">Uploaded Excuse</th>
                <th class="header-text">Decision</th>
            </tr>
            <?php
            foreach ($excuses as $row) {
                echo "<tr>";
                echo "<td>{$row["type"]}</td>";
                echo "<td>{$row["date"]}</td>";
                echo "<td>{$row["absenceReason"]}</td>";
                echo "<td><a href='files/{$row["uploadedExcuseFileName"]}' target='_blank'>Excuse</a></td>";
                echo "<td>{$row["decision"]}</td>";
                echo "</tr>";
            }
            if (count($excuses) == 0) {
                echo "<tr><td colspan=5> No records available </td></tr>";
            }
            ?>
        </table>
        </p>
    </section>
    <br>
    <br>
    <br>
    <footer class="text-center">
        <p>@Copyright KSU - IT department</p>
    </footer>
</body>

</html>