<?php include 'connection/header.php'; ?>
    <div class="container">
        <h2>tax payer Registration form </h2>
        <form id="registrationForm" action="registration.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">User Name:</label>
                <input type="text" class="form-control" id="username" name="username"  >
            </div>
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name"  >
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name"  >
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number"  >
            </div>

            <div class="form-group">
                <label for="tin">TIN (Tax Identification Number):</label>
                <input type="text" class="form-control" id="tin" name="tin"  >
                <small id="tinHelp" class="form-text text-muted">Please enter a valid Ethiopian TIN number.</small>
            </div>

            <div class="form-group">
                <label for="sex">Sex:</label>
                <select class="form-control" id="sex" name="sex"  >
                    <option value="">Select Sex</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="income_source">Income Source:</label>
                <select class="form-control" id="income_source" name="income_source"  >

                    <option value="Employment"> Income from employment</option>
                    <option value="Rental Of Buildings"> Income from the rental of buildings</option>
                    <option value="Business Activities"> Income from business activities</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email"  >
            </div>

            <div class="form-group">
                <label for="place_of_work">Place of Work (Business):</label>
                <input type="text" class="form-control" id="place_of_work" name="place_of_work"  >
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password"  >
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password"  >
            </div>

            <div class="form-group">
                <label for="photo">Personal Photo:</label>
                <input type="file" class="form-control-file" id="photo" name="photo"  >
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>
</html>
<?php include "connection/footer_index.php" ?>