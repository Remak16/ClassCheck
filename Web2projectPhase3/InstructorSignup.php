<!DOCTYPE html>

<html>

<head>
    <title> Instructor sign up page</title>
    <link rel="stylesheet" href="Style.css">

</head>

<!-- ----------------------- -->

<body>
    <div>
        <a href="index.php">
            <img id="logo" src="images\logo.png" alt=" Logo" style="width: 80pt">
        </a>

    </div>

    <h2>Sign up now to become part of ClASS CHEAK community!</h2>

    <section class="form-continer">

        <div id="error"> </div>

        <form action="app.php" class="form" method="get" id="form1" onsubmit="return validateForm()">

            <div class="user-detailes">
                <input hidden name="instructor-signup" value="true">

                <div class="input-box">
                    <span class="details">First Name: </span>
                    <input type="text" placeholder="First Name" name="firstName" id="firstName" required>
                </div>

                <div class="input-box">
                    <span class="details">Last Name: </span>
                    <input type="text" placeholder="Last Name" name="lastName" id="lastName" required>
                </div>

                <div class="input-box">
                    <span class="details">Email: </span>
                    <input type="email" placeholder="Ex: maha@ksu.edu.sa " id="Email" name="email" required>
                    <!-- required -->
                </div>

                <div class="input-box">
                    <span class="details">Password: </span>
                    <input type="password" placeholder="Password " maxlength="10" id="password" name="password" required>
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
            const passwordInput = document.getElementById("password");

            var nameInput1 = document.getElementById("firstName").value;
            var nameInput2 = document.getElementById("lastName").value;

            // var name1 =document.myform.firstName.value;
            // var name2 =document.myform.lastName.value;

            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/;
            // Uppercase, lowercase, number, and special character

            // Regular expressions for validation
            const nameRegex = /^[a-zA-Z\s]*$/;
            // /^[a-zA-Z]+$/;  // Only letters (uppercase and lowercase) 


            // if (name1 == null || name1 == "" || name1.value.length < 3 || !nameRegex.test(name1)) {
            //    alert("Please enter a valid fisrt name.");
            //    return false;  // Prevent form submission

            // }else{
            // //    alert("it is valid first name.");
            //    return true;
            // }


            // if (name1 == null || name1 == "" || name1.value.length < 3 || !nameRegex.test(name1)){  
            //     alert("Please enter a valid fisrt name.");
            //    return false;  // Prevent form submission
            // }else{
            // //    alert("it is valid first name.");
            //    return true;
            // }

            if (passwordInput.value.length < 8 || passwordInput.value.length > 8) {
                alert("password must be equal to 8 character.");
                return false;
            }


            if (nameInput1.value.length > 12 || !nameRegex.test(nameInput1)) {
                alert("Please enter a valid fisrt name.");
                return false;
            } else if (nameInput1.value.length <= 12 || nameRegex.test(nameInput1)) {
                alert("it is valid first name.");
            }


            if (nameInput2.value.length > 12 || !nameRegex.test(nameInput2)) {
                alert("Please enter a valid last name.");
                return false;
            } else {
                alert("it is valid last name.");
            }




            return true; // Form is valid
        }
    </script>
</body>

</html>