<!DOCTYPE html>
<?php
include("security.php");
checkSession(false);
include("app.php");

$ID = $_SESSION["id"];
$courses = getAllCourses();

if (isset($_POST["sectionNumber"])) {
  $sectionNumber = $_POST['sectionNumber'];
  $courseID = $_POST['courseID'];
  $type = $_POST['type'];
  $hours = $_POST['hours'];
  $instructorID = $_POST['id'];

  $section = getSection($sectionNumber);

  if ($section == null) {
    $sql = "INSERT INTO Section (sectionNumber, courseID, type, hours, instructorID) 
            VALUES ('$sectionNumber', '$courseID', '$type', '$hours', '$instructorID')";

    if (mysqli_query($con, $sql)) {
      header("Location: AddNewSectionS2.php?id=$sectionNumber");
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
  } else {
    echo "<script>alert('This Section Number is already used!')</script>";
  }
}


?>
<html>

<head>

  <meta charset="UTF-8">
  <title>Add New Section</title>
  <style>
    div {
      border-style: double;
    }

    body {
      background: linear-gradient(to right, #e2ecfe, #e6dbfa);

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


  </header>
  <h1>Add new section</h1>
  <br>
  <h2>Step1:section Details</h2>

  <div id="form" method="POST">
    <form method="POST">
      <input hidden name="add-section" value="true">
      <input hidden name="id" value="<?php echo $ID; ?>">
      <label for="section">section Number:</label>
      <input type="number" id="section" name="sectionNumber" required><br>
      <p>
        course:
        <select name="courseID" required>
          <?php
          foreach ($courses as $row) {
            echo "<option value='{$row["id"]}'>{$row["symbol"]} - {$row["name"]}</option>";
          }
          ?>
        </select>
      </p>

      <p>Type:</p>
      <input type="radio" id="lab1" name="type" value="Lab" required>
      <label for="age1">Lab</label><br>
      <input type="radio" id="lab2" name="type" value="Lecture" required>
      <label for="age2">Lecture</label><br> <br>

      <label for="Hours">Hours:</label>
      <input type="number" id="section" name="hours" required><br><br> <br>
      <button type="submit">Next</button>
    </form>
  </div><br>

  <footer class="text-center">
    <p>@Copyright KSU - IT department</p>
  </footer>
</body>

</html>