<!DOCTYPE html>

<html>

<head>
    <title> Instructor Log in page</title>
    <link rel="stylesheet" href="Style.css">
</head>

<body>

    <a href="index.php">
        <img id="logo" src="images\logo.png" alt=" Logo" style="width: 80pt">
    </a>

    <h2>Instructor Log in</h2>

    <section class="form-continer">

        <div id="error"> </div>

        <form action="app.php" class="form" method="get" id="form1" onsubmit="return validateForm()">

            <div class="user-detailes">
                <input hidden name="instructor-login" value="true">
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
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/;
            // Uppercase, lowercase, number, and special character


            if (passwordInput.value.length < 8 || passwordInput.value.length > 8) {
                alert("password must be equal to 8 character.");
                return false;
            }

            return true; // Form is valid
        }
    </script>

</body>

</html>