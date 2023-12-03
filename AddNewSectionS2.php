<!DOCTYPE html>
<?php
include("security.php");
checkSession(false);
include("app.php");

if (!isset($_GET["id"])) {
  header("Location: AddNewSection.php");
}
$sectionId = $_GET["id"];
$sectionStudents = getSectionStudents($sectionId);

?>
<html>

<head>
  <meta charset="UTF-8">
  <title>Add New Section</title>
  <!-- AJAX Library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <style>
    table,
    th,
    td {
      border: 1px solid black;
      border-collapse: collapse;
    }

    th {
      background: linear-gradient(-10deg, #b5b7ec, #bbcff0);
      /* Background color for header cells */
      padding: 10px;
      text-align: center;
    }

    td {

      text-align: center;
    }

    caption {
      text-align: left;
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
  <h2>Step2 :Add student to section</h2>

  <div id="form">
    <div class="input-box" id="err">
      <?php
      if (isset($_GET['error'])) echo "<p>{$_GET['error']}</p>";
      ?>
    </div>
    <form method="GET" action="app.php">
      <input hidden name="add-student" value="true">
      <input hidden name="id" value="<?php echo $sectionId; ?>">
      <label for="KSU ID"> KSU ID:</label>
      <input type="text" id="KSUID" name="ksuId" required>
      <label for="KSU ID"> Student Name:</label>
      <input type="text" name="name" disabled id="name">
      <button type="submit">Add</button>
    </form>
  </div>
  <br> <br>

  <div id="table">
    <table style="width:100%">
      <caption> Student List:</caption>
      <thead>
        <tr>
          <th>KSU ID</th>
          <th>Name</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($sectionStudents as $student) {
          echo "<tr>";
          echo "<td>" . $student["KSUID"] . "</td>";
          echo "<td>" . $student["firstName"] . " " . $student["lastName"] . "</td>";
          echo "</tr>";
        }
        if (count($sectionStudents) == 0) echo "<td colspan=2> No records availalbe</td>";
        ?>
      </tbody>
    </table>


  </div> <br> <br>

  <a href="InstructorHomepage.php" class="Done"> <button type="button">Done</button></a>
  <br> <br> <br>
  <footer class="text-center">
    <p>@Copyright KSU - IT department</p>
  </footer>
</body>
<script>
  $(document).ready(function() {
    $("#KSUID").on("keyup", function() {
      var ksuidValue = $('#KSUID').val();
      if (ksuidValue.length != 9) {
        $('#err').html('Please enter a 9-digit KSUID.');
        $('#name').val('');
        return;
      } else {
        $('#err').html('');
      }

      $.ajax({
        url: 'app.php',
        data: {
          getName: 1,
          ksuid: ksuidValue,
        },
        method: 'GET',
        success: function(response) {
          $('#name').val(response);
        },
        error: function(error) {
          console.error('Error AJAX request:', error); //??????????????????????????????????????///
        }
      });
    });
  });
</script>

</html>