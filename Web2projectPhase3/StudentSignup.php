<!DOCTYPE html>

<html>

<head>
    <title> Student sign up page</title>
    <link rel="stylesheet" href="Style.css">

</head>

<body>
    <a href="index.php">
        <img id="logo" src="images\logo.png" alt=" Logo" style="width: 80pt">
    </a>

    <!--    <div class="logo"> 
         <a href="#"><img src="images\logo.png" alt=""> </a>   
         <p>RPR</p>  
    </div>-->

    <h2>Sign up now to become part of ClASS CHEAK community!</h2>

    <section class="form-continer">

        <div id="error"> </div>

        <form action="app.php" class="form" method="get" id="form1" onsubmit="return validateForm()">

            <div class="user-detailes">
                <input hidden name="student-signup" value="true">

                <div class="input-box">
                    <span class="details">KSU ID: </span>
                    <input type="number" placeholder="Enter KSU ID" id="id" name="id" required>
                    <!-- required -->
                </div>

                <div class="input-box">
                    <span class="details">Password: </span>
                    <input type="password" placeholder="Password" maxlength="10" id="password" name="password" required>
                </div>

                <div class="input-box">
                    <span class="details">Firstname: </span>
                    <input type="text" placeholder="Enter first name" name="fname" required>
                    <!-- required -->
                </div>

                <div class="input-box">
                    <span class="details">Lastname: </span>
                    <input type="text" placeholder="Enter last name" name="lname" required>
                </div>
            </div>
            <div class="input-box">
                <?php
                if (isset($_GET['error'])) echo "<p>{$_GET['error']}</p>";
                ?>
            </div>
            <div class="button">
                <input type="submit">
            </div>
        </form>
    </section>

    <script>
        function validateForm() {
            var ksuid = document.getElementById("KSUID");
            const passwordInput = document.getElementById("password");


            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/;
            // Uppercase, lowercase, number, and special character

            if (ksuid.value.length > 9 || ksuid.value.length < 9) {
                alert("KSU ID must be equal to 9 digits.");
                return false;
            }

            if (passwordInput.value.length < 8 || passwordInput.value.length > 8) {
                alert("password must be equal to 8 character.");
                return false;
            }



            return true; // Form is valid
        }
    </script>
</body>

</html>