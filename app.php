<?php

$con = new mysqli("localhost", "root", "", "ksudb" ,"3308");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_GET['student-login'])) {
    $id = $_GET['id'];
    $password = $_GET['password'];

    $sql = "SELECT * FROM studentaccount WHERE KSUID = $id";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];
        if (password_verify($password, $hashedPassword)) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['id'] = $row['KSUID'];
            $_SESSION['role'] = 'student';
            header("Location: StudentHomepage.php");
        } else {
            $err = "Invalid Password";
            header("Location: StudentLogin.php?error=$err");
        }
    } else {
        $err = 'Wrong credintials';
        header("Location: StudentLogin.php?error=$err");
    }
}

if (isset($_GET['student-signup'])) {

    $id = $_GET['id'];
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $password = password_hash($_GET['password'], PASSWORD_DEFAULT);
    try {
        $sql = "INSERT INTO student (KSUID, firstName, lastName) VALUES ($id, '$fname', '$lname')";
        $result = mysqli_query($con, $sql);
        $sql = "INSERT INTO studentaccount (KSUID, password) VALUES ($id, '$password')";
        $result = mysqli_query($con, $sql);
        header("Location: StudentLogin.php");
    } catch (mysqli_sql_exception $e) {
        $err = 'Student with same ID already exists';
        header("Location: StudentSignup.php?error=$err");
    }
}

if (isset($_GET['instructor-signup'])) {
    $fname = $_GET['firstName'];
    $lname = $_GET['lastName'];
    $email = $_GET['email'];
    $password = password_hash($_GET['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO instructor (first_name, last_name, email_address, password) VALUES ('$fname', '$lname', '$email', '$password')";

    try {
        $query = mysqli_query($con, $sql);
        header("Location: InstructorLogin.php");
    } catch (mysqli_sql_exception $e) {
        $err = "email already used!";
        header("Location: InstructorSignup.php?error=$err");
    }
}

if (isset($_GET['instructor-login'])) {
    $email = $_GET['email'];
    $password = $_GET['password'];

    $sql = "SELECT * FROM instructor WHERE email_address = '$email'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];
        if (password_verify($password, $hashedPassword)) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['id'] = $row['id'];
            $_SESSION['role'] = "instructor";
            header("Location: InstructorHomepage.php");
        } else {
            $err = "Invalid password";
            header("Location: InstructorLogin.php?error=$err");
        }
    } else {
        $err = 'Email does not exists';
        header("Location: InstructorLogin.php?error=$err");
    }
}

function getInstructor($id)
{
    global $con;
    $sql = "select * from instructor where id = $id";
    $query =  mysqli_query($con, $sql);
    return mysqli_fetch_assoc($query);
}

function getSections($id)
{
    global $con;
    $sql = "SELECT Section.sectionNumber, Section.courseID, Section.type, Section.hours, Section.instructorID, Course.symbol, Course.name
    FROM Section
    JOIN Course ON Section.courseID = Course.id
    WHERE Section.instructorID = $id;";

    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
}

function getExcuses($id)
{
    global $con;
    $sql = "SELECT UploadedExcuses.* , Student.*, Section.sectionNumber, ClassAttendanceRecord.date FROM UploadedExcuses
        JOIN ClassAttendanceRecord ON ClassAttendanceRecord.id = UploadedExcuses.attendanceRecordID
        JOIN Section ON Section.sectionNumber = ClassAttendanceRecord.sectionNumber
        JOIN StudentAccount ON StudentAccount.id = UploadedExcuses.studentAccountID
        JOIN Student ON Student.KSUID = StudentAccount.KSUID
        WHERE UploadedExcuses.decision = 'under consideration'
        AND Section.instructorID = $id";

    $result = mysqli_query($con, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
}

if (isset($_GET["deletesec"])) {
    $id = $_GET["deletesec"];

    $sql = "DELETE FROM StudentAttendanceInRecord WHERE attendanceRecordID IN (SELECT id FROM ClassAttendanceRecord WHERE sectionNumber = $id)";
    mysqli_query($con, $sql);

    $sql = "DELETE FROM UploadedExcuses WHERE attendanceRecordID IN (SELECT id FROM ClassAttendanceRecord WHERE sectionNumber = $id)";
    mysqli_query($con, $sql);

    $sql = "DELETE FROM ClassAttendanceRecord WHERE sectionNumber = $id";
    mysqli_query($con, $sql);

    $sql = "DELETE FROM SectionStudents WHERE sectionNumber = $id";
    mysqli_query($con, $sql);

    $sql = "DELETE FROM section WHERE sectionNumber = $id";
    mysqli_query($con, $sql);

    header("Location: InstructorHomepage.php");
}


if (isset($_GET["add-section"])) {
}


if (isset($_GET["excuse"])) {
    $id = $_GET["excuse"];
    $approve = $_GET["ok"] == 1;

    if ($approve) {
        $sql = "Update UploadedExcuses set decision = 'approved' where id = $id";
    } else {
        $sql = "Update UploadedExcuses set decision = 'disapproved' where id = $id";
    }

    $result = mysqli_query($con, $sql);
    if ($result) echo 'true';
    else echo 'false';
}


function getSection($id)
{
    global $con;
    $sql = "SELECT * from section 
    JOIN course ON course.id = section.courseID
    WHERE sectionNumber = $id";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

function getAttendances($id)
{
    global $con;
    $sql = "SELECT * FROM classattendancerecord WHERE sectionNumber = $id ORDER BY date DESC";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $attendances = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $attendances;
    } else {
        return array();
    }
}

function getStudentsAttends($id)
{
    global $con;
    $sql = "SELECT * FROM studentattendanceinrecord 
    JOIN student ON studentKSUID = KSUID
    WHERE attendanceRecordID = $id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $students;
    } else {
        return array();
    }
}

function getSectionStudents($id)
{
    global $con;
    $sql = "SELECT * FROM sectionstudents 
    JOIN student on KSUID = studentKSUID
    WHERE sectionNumber = $id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $students;
    } else {
        return array();
    }
}


if (isset($_POST["add-attends"])) {
    $sectionNumber = $_POST["sectiodId"];
    $date = $_POST["selectedDate"];

    $students = getSectionStudents($sectionNumber);
    global $con;
    $sql = "INSERT INTO ClassAttendanceRecord (sectionNumber, date) VALUES ('$sectionNumber', '$date')";
    mysqli_query($con, $sql);
    $attendID = mysqli_insert_id($con);

    foreach ($students as $student) {
        $ksuId = $student["studentKSUID"];
        $attend = $_POST["attendance-$ksuId"];
        $sql = "INSERT INTO studentattendanceinrecord (attendanceRecordID, studentKSUID, attendance)
        VALUES ($attendID, $ksuId, $attend)";
        mysqli_query($con, $sql);
    }

    header("Location: InstructorAttendanceRecord.php?id=$sectionNumber");
}


function getAllCourses()
{
    global $con;
    $sql = "SELECT * FROM course";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $courses;
    } else {
        return array();
    }
}

function getStudent($id)
{
    global $con;
    $sql = "SELECT * FROM student WHERE KSUID = $id";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);
        return $student;
    } else {
        return null;
    }
}

function existsStudnetSection($ksuId, $sectionNumber)
{
    global $con;
    $sql = "SELECT * FROM sectionstudents WHERE sectionNumber = $sectionNumber AND studentKSUID = $ksuId";
    $result = mysqli_query($con, $sql);
    return mysqli_num_rows($result) > 0;
}

if (isset($_GET["add-student"])) {
    $sectionNumber = $_GET["id"];
    $ksuId = $_GET["ksuId"];

    $student = getStudent($ksuId);
    if ($student == null) {
        $err = "The KSU ID doen't match any studnet!";
        header("Location: AddNewSectionS2.php?id=$sectionNumber&error=$err");
    } else if (existsStudnetSection($ksuId, $sectionNumber)) {
        $err = "The Student already registered in this section!";
        header("Location: AddNewSectionS2.php?id=$sectionNumber&error=$err");
    } else {
        global $con;
        $sql = "INSERT INTO sectionstudents VALUES ($sectionNumber, $ksuId)";
        $result = mysqli_query($con, $sql);
        header("Location: AddNewSectionS2.php?id=$sectionNumber");
    }
}

if (isset($_GET["signout"])) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_destroy();
    header("Location: index.php");
}


function getAttendancePercentage($studentId, $courseId)
{
    global $con;
    $sql = "SELECT SAI.attendance, S.type, S.hours FROM StudentAttendanceInRecord AS SAI 
        JOIN ClassAttendanceRecord AS CAR ON SAI.attendanceRecordID = CAR.id 
        JOIN Section AS S ON CAR.sectionNumber = S.sectionNumber
        WHERE SAI.studentKSUID = $studentId AND S.courseID = $courseId";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $attendances = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $total = 0;
        $absent = 0;
        foreach ($attendances as $row) {
            if ($row["type"] == "Lecture") {
                $total +=  $row["hours"];
            } else {
                $total +=  1.0 * $row["hours"] / 2.0;
            }

            if ($row["attendance"] == 0) { // absent       
                if ($row["type"] == "Lecture") {
                    $absent +=  $row["hours"];
                } else {
                    $absent +=  1.0 * $row["hours"] / 2.0;
                }
            }
        }
        if (count($attendances) != 0) {
            $res = 100.0 * ($total - $absent) / $total;
            return round($res, 2);
        } else {
            return -1;
        }
    } else {
        return -1;
    }
}

function getStudentCourses($id)
{
    global $con;
    $sql = "SELECT DISTINCT C.id, C.symbol, C.name
    FROM Course AS C
    JOIN Section AS S ON C.id = S.courseID
    JOIN SectionStudents AS SS ON S.sectionNumber = SS.sectionNumber
    WHERE SS.studentKSUID = $id";

    $result = mysqli_query($con, $sql);
    if ($result) {
        $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($courses as &$course) {
            $course['percentage'] = getAttendancePercentage($id, $course['id']);
        }
        return $courses;
    } else {
        return array();
    }
}


function getStudentAttends($id, $courseId, $isLecture)
{
    global $con;
    $type = $isLecture ? "Lecture" : "Lab";
    $sql = "SELECT SA.*, CA.date, CA.id FROM studentattendanceinrecord as SA
    JOIN classattendancerecord AS CA ON CA.id = SA.attendanceRecordID
    JOIN section AS S ON S.sectionNumber = CA.sectionNumber
    WHERE studentKSUID = $id
    AND S.type = '$type'
    AND S.courseID = '$courseId'";

    $result = mysqli_query($con, $sql);
    if ($result) {
        $attends = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $attends;
    } else {
        return array();
    }
}

function getStudentExcuses($id, $courseId)
{
    global $con;
    $sql = "SELECT UE.*, S.type, CAR.date
        FROM UploadedExcuses AS UE
        JOIN ClassAttendanceRecord AS CAR ON UE.attendanceRecordID = CAR.id
        JOIN Section AS S ON CAR.sectionNumber = S.sectionNumber
        JOIN StudentAccount AS SA ON SA.id = UE.studentAccountID
        WHERE SA.KSUID = $id
        AND S.courseID = $courseId";

    $result = mysqli_query($con, $sql);
    if ($result) {
        $exuses = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $exuses;
    } else {
        return array();
    }
}

function getCourse($id)
{
    global $con;
    $sql = "SELECT * FROM course where id = $id";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

function getClassCourse($id)
{
    global $con;
    $sql = "SELECT C.*, S.*, CA.date FROM classattendancerecord as CA
        JOIN section AS S ON S.sectionNumber = CA.sectionNumber
        JOIN course AS C ON C.id = S.courseID
        WHERE CA.id = $id";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

function getStudentAccountId($id)
{
    global $con;
    echo $id;
    $sql = "SELECT * FROM studentaccount WHERE KSUID = $id";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_array($result)[0];
}

if (isset($_POST["upload-excuse"])) {
    $reason = $_POST['reason'];
    $classId = $_POST['classId'];
    $attendId = getStudentAccountId($_POST['id']);
    $decision = "under consideration";

    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpName = $_FILES['uploadedFile']['tmp_name'];
        $originalFileName = $_FILES['uploadedFile']['name'];

        $uniqueFileName = time() . '_' . $originalFileName;

        $uploadDirectory = 'files/';

        if (move_uploaded_file($fileTmpName, $uploadDirectory . $uniqueFileName)) {
            global $con;
            $sql = "INSERT INTO uploadedExcuses (uploadedExcuseFileName, absenceReason, studentAccountID, attendanceRecordID, decision) 
                    VALUES ('$uniqueFileName', '$reason', '$attendId', '$classId', '$decision')";

            if (mysqli_query($con, $sql)) {
                header('Location: StudentHomepage.php');
            } else {
                $err = "Error: " . mysqli_error($your_db_connection);
            }
        } else {
            $err = "File upload failed.";
        }
    } else {
        $err = "File not uploaded or an error occurred.";
    }
}

////// PHASE 3

if (isset($_GET["getName"])) {
    $ksuid = $_GET['ksuid'];
    $student = getStudent($ksuid);
    if ($student != null) {
        $name = $student["firstName"] . " " . $student["lastName"];
        echo $name;
    } else {
        echo "No student with this ID";
    }
}


if (isset($_GET["getStuAttend"])) {
    $result = getStudentsAttends($_GET["getStuAttend"]);
    echo json_encode($result);
}
