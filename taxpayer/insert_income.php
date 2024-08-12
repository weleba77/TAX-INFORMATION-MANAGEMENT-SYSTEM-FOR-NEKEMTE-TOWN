<?php
session_start(); 
include '../connection/connection.php'; // Include database connection file
include 'connection/user_heder.php'; // Include user header with navigation
?>
<main>
    <div class="container my-5">
        <h1>Insert Income Information</h1>
        <p class="lead">Insert your income amount below.</p>

        <form id="incomeForm" action="submit_income.php" method="post">
                <div class="form-group">
                    <label for="income_amount">Income Amount</label>
                    <input type="number" class="form-control" id="income_amount" name="income_amount" required>
                </div>
                <div class="form-group">
                    <label for="income_source">Income Source</label>
                    <select class="form-control" id="income_source" name="income_source" required>
                        <option value="Employment">Employment</option>
                        <option value="Rental of Building">Rental of Building</option>
                        <option value="Business Activities">Business Activities</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>
</main>


<?php include '../connection/footer.php'; ?>
