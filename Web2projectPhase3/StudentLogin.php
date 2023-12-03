<!DOCTYPE html>

<html>

<head>
    <title> Student Log in page</title>
    <link rel="stylesheet" href="Style.css">

</head>


<body>
    <a href="index.php">
        <img id="logo" src="images\logo.png" alt=" Logo" style="width: 80pt">
    </a>

    <h2>Student Log in</h2>

    <section class="form-continer">

        <div id="error"> </div>

        <form class="form" method="get" id="form1" action="app.php">

            <div class="user-detailes">
                <input hidden name="student-login" value="true">
                <div class="input-box">
                    <span class="details">KSU ID: </span>
                    <input type="number" placeholder="Enter KSU ID" id="KSUID" name="id" required>
                </div>

                <div class="input-box">
                    <span class="details">Password: </span>
                    <input type="password" placeholder="Password " maxlength="10" id="password" name="password" required>
                </div>

                <div class="input-box">
                    <?php
                    if (isset($_GET['error'])) echo "<p>{$_GET['error']}</p>";
                    ?>
                </div>

            </div>

            <div class="button">
                <input type="submit">
            </div>


        </form>
    </section>

    <script>
        const form = document.getElementById('form1');
        form.addEventListener("submit", function(event) {
            var ksuid = document.getElementById("KSUID");
            const passwordInput = document.getElementById("password");

            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/;
            // Uppercase, lowercase, number, and special character


            if (ksuid.value.length > 9 || ksuid.value.length < 9) {
                alert("KSU ID must be equal to 9 digits.");
                event.preventDefault();
            }

            if (passwordInput.value.length < 8 || passwordInput.value.length > 8) {
                alert("password must be equal to 8 character.");
                event.preventDefault();
            }
        })
    </script>
</body>

</html>