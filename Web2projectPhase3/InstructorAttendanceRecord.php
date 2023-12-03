<!DOCTYPE html>
<html>
<?php
include("security.php");
checkSession(false);
include("app.php");

if (!isset($_GET["id"])) {
    header("Location: InstructorHomepage.php");
}

$ID = $_SESSION["id"];
$sectionId = $_GET["id"];
$section = getSection($sectionId);

$attends = getAttendances($sectionId);

$studentAttends = array();
$curAttend = null;
if (isset($_GET["attend"])) $curAttend = $_GET["attend"];

if (count($attends) > 0) {

    if (isset($curAttend)) $studentAttends = getStudentsAttends($curAttend);
    else $studentAttends = getStudentsAttends($attends[0]["id"]);
}

$sectionStudents = getSectionStudents($sectionId);

?>

<head>
    <title>Instructor Attendance Record</title>
    <!-- AJAX Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        section {
            border: 2px solid rgb(0, 0, 0);
        }


        body {
            font-family: Arial, sans-serif;

            background: linear-gradient(to right, #e2ecfe, #e6dbfa);
        }


        header {
            /*            background: linear-gradient(-10deg , #b5b7ec , #bbcff0); */
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
        }


        th.header-text {
            font-size: larger;
            background: linear-gradient(-10deg, #b5b7ec, #bbcff0);
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
            height: 100%;
            width: 100%;
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
                <li><a href="app.php?signout=true">Sign Out</a></li>
            </ul>
        </nav>
        <p class="secibfo">
        <section>
            <h5>Section Information</h5>
            <p>Section Number: <?php echo $section["sectionNumber"] ?></p>
            <p>Section Type: <?php echo $section["type"] ?></p>
            <p>Section Hours: <?php echo $section["hours"] ?></p>
            <p>Course Code: <?php echo $section["symbol"] ?></p>
            <p>Course Name: <?php echo $section["name"] ?></p>
        </section>
        </p>
    </header>


    <h2>Display Attendance for Previous Class</h2>
    <section>
        <form method="GET">
            <label for="classDate">Select Date:</label>
            <input hidden name="id" value="<?php echo $sectionId ?>">
            <select id="classDate" name="attend">
                <?php
                foreach ($attends as $row) {
                    if ($curAttend == $row["id"]) echo "<option selected value='{$row["id"]}'>{$row["date"]}</option>";
                    else echo "<option value='{$row["id"]}'>{$row["date"]}</option>";
                }
                ?>
            </select>
        </form>
        <p>
        <table>
            <tr>
                <th class="header-text">KSU ID</th>
                <th class="header-text">Name</th>
                <th class="header-text">Attendance</th>
            </tr>
            <tbody id="table1">
                <?php
                foreach ($studentAttends as $row) {
                    echo "<tr>";
                    echo "<td>" . $row["KSUID"] . "</td>";
                    echo "<td>" . $row["firstName"] . " " . $row["lastName"] . "</td>";
                    if ($row["attendance"] == '1') echo "<td> Attended </td>";
                    else echo "<td> Absent </td>";
                    echo "</tr>";
                }
                if (count($studentAttends) == 0) echo "<td colspan=3> No records availalbe</td>";
                ?>
            </tbody>

        </table>
        </p>
    </section>
    <h2>Add New Class Attendance</h2>
    <section>
        <form action="app.php" method="POST">
            <label for="selectedDate">Select Date:</label>
            <input hidden name="sectiodId" value="<?php echo $sectionId ?>">
            <input hidden name="add-attends" value="true">
            <input type="date" id="selectedDate" name="selectedDate" required>
            <p>
            <table>
                <tr>
                    <th class="header-text">KSU ID</th>
                    <th class="header-text">Name</th>
                    <th class="header-text">Attendance</th>
                </tr>
                <?php
                foreach ($sectionStudents as $student) {
                    echo "<tr>";
                    echo "<td>" . $student["KSUID"] . "</td>";
                    echo "<td>" . $student["firstName"] . " " . $student["lastName"] . "</td>";
                    echo "<td>";
                    echo "<select name='attendance-" . $student["KSUID"] . "'>";
                    echo "<option value='1'>Attended</option>";
                    echo "<option value='0'>Absent</option>";
                    echo "</select>";
                    echo "</td>";
                    echo "</tr>";
                }
                if (count($sectionStudents) == 0) echo "<td colspan=3> No records availalbe</td>";
                ?>
            </table>
            </p>
            <div class="center-button">
                <input type="submit" value="Save">
            </div>
        </form>
    </section>
    <br>
    <br>
    <br>
    <footer class="text-center">
        <p>@Copyright KSU - IT department</p>
    </footer>
</body>
<script>
    $(document).ready(function() {
        $("#classDate").change(function() {
            const attendId = $(this).val();
            console.log(attendId);
            const data = {
                getStuAttend: attendId,
            }
            $.ajax({
                url: 'app.php',
                method: "GET",
                data: data,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    const tb = document.getElementById("table1");
                    tb.innerHTML = "";
                    data.forEach(e => {
                        let row = "";
                        row += "<tr>";
                        row += "<td>" + e["KSUID"] + "</td>";
                        row += "<td>" + e["firstName"] + " " + e["lastName"] + "</td>";
                        if (e["attendance"] == '1') row += "<td> Attended </td>";
                        else row += "<td> Absent </td>";
                        row += "</tr>";
                        tb.innerHTML += row;
                    });
                },
                error: function(error) {
                    console.error(error);
                }
            });
        })
    })
</script>

</html>