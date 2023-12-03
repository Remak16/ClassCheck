<!DOCTYPE html>
<?php
include("security.php");
checkSession(false);
include("app.php");

$ID = $_SESSION["id"];
$user = getInstructor($ID);

$table1 = getSections($ID);
$table2 = getExcuses($ID);
?>
<html>

<head>

    <style>
        section {
            border: 2px solid rgb(0, 0, 0);
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #e2ecfe, #e6dbfa);
        }

        header {

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
    <title>Instructor Homepage</title>
    <!-- AJAX Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <header>
        <a href="index.php">
            <img id="logo" src="images\logo.png" alt=" Logo" style="width: 80pt">
        </a>

        <nav>
            <ul>
                <li><a href="app.php?signout=true">Sign Out</a></li>
            </ul>
        </nav>
    </header>

    <h1>Welcome <?php echo $user["first_name"] . " " . $user["last_name"]; ?></h1>
    <section>
        <p>Instructor's Information</p>
        <p>Name : <?php echo $user["first_name"] . " " . $user["last_name"]; ?></p>
        <p>Email : <?php echo $user["email_address"] ?></p>
    </section>

    <br>



    <section>


        <div class="speacce">
            <label>Sections Teaching</label>
            <a href="AddNewSection.php"> Add New Section</a>

        </div>

        <br>
        <br>

        <table>
            <!-- Table headers -->
            <tr>
                <th class="header-text">Section Number</th>
                <th class="header-text">Course</th>
                <th class="header-text">Type</th>
                <th class="header-text">Hours</th>
                <th class="header-text">Attendance Record</th>
                <th></th>
            </tr>
            <?php
            foreach ($table1 as $row) {
                echo "<tr>";
                echo "<td>" . $row["sectionNumber"] . "</td>";
                echo "<td>" . $row["symbol"] . "<br><h6>" . $row["name"] . "</h6></td>";
                echo "<td>" . $row["type"] . "</td>";
                echo "<td>" . $row["hours"] . "</td>";
                echo "<td> <a href='InstructorAttendanceRecord.php?id={$row["sectionNumber"]}'>Attendance</a> </td>";
                echo "<td> <a href='app.php?deletesec={$row["sectionNumber"]}'>Delete</a> </td>";
                echo "</tr>";
            }
            if (count($table1) == 0) {
                echo "<td colspan=6> No Sections available </td>";
            }
            ?>
        </table>
    </section>
    <br>
    <br>
    <section>
        <h2>Uploaded Absence Excuses</h2>
        <table>
            <!-- Table headers -->
            <tr>
                <th class="header-text">Section</th>
                <th class="header-text">Student Name</th>
                <th class="header-text">Student ID</th>
                <th class="header-text">Absence Reason</th>
                <th class="header-text">Uploaded Excuse</th>
                <th>Date</th>
                <th></th>
            </tr>
            <?php
            foreach ($table2 as $row) {
                echo "<tr>";
                echo "<td>" . $row["sectionNumber"] . "</td>";
                echo "<td>" . $row["firstName"] . " " . $row["lastName"] . "</td>";
                echo "<td>" . $row["KSUID"] . "</td>";
                echo "<td>" . $row["absenceReason"] . "</td>";
                echo "<td><a href='files/{$row["uploadedExcuseFileName"]}' target='_blank'>Download</a></td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td><a href='#' onclick=\"excuse(this, {$row["id"]}, 1)\">Approve</a> | <a href='#' onclick=\"excuse(this, {$row["id"]}, 0)\">Disapprove</a></td>";
                echo "</tr>";
            }

            if (count($table2) == 0) {
                echo "<td colspan=7> No excuses available </td>";
            }
            ?>
        </table>
    </section>
    <br>
    <br>
    <footer class="text-center">
        <p>@Copyright KSU - IT department</p>
    </footer>
</body>
<script>
    function excuse(event, ksuid, ok) {
        console.log(event, ksuid, ok);
        const data = {
            excuse: ksuid,
            ok: ok,
        }
        $.ajax({
            url: 'app.php',
            method: "GET",
            data: data,
            success: function(data) {
                console.log(data);
                if (data === 'true') {
                    event.parentNode.parentNode.remove();
                }
            },
            error: function(error) {
                console.error(error);
            }
        });
    }
</script>

</html>