<?php
// ------------------------------
//  STV's CARD STYLE RESEPONSIVE REGISTRATION FORM - 2026
// ------------------------------
// STEP 1: Initialize variables
// WHY: Prevent undefined variable errors when page loads first time
// ------------------------------
$name = $email = $phone = $age = $gender = $qualification = $course = "";
$errors = [];   // Array to store validation errors
$success = "";  // Success message


// ------------------------------
// STEP 2: Check if form is submitted
// WHY: Run validation only after user clicks submit
// ------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ------------------------------
    // STEP 3: Function to clean input
    // WHY:
    // - trim() removes extra spaces
    // - htmlspecialchars() prevents XSS attacks
    // ------------------------------
    function clean($data) {
        return htmlspecialchars(trim($data));
    }

    // ------------------------------
    // STEP 4: Get and sanitize form data
    // WHY: Always clean user input before using it
    // ------------------------------
    $name = clean($_POST["name"]);
    $email = clean($_POST["email"]);
    $phone = clean($_POST["phone"]);
    $age = clean($_POST["age"]);
    $gender = isset($_POST["gender"]) ? clean($_POST["gender"]) : "";
    $qualification = clean($_POST["qualification"]);
    $course = clean($_POST["course"]);


    // ------------------------------
    // STEP 5: Validation rules
    // WHY: Ensure correct and safe data before processing
    // ------------------------------

    // Name validation
    if (empty($name)) {
        $errors[] = "Name is required";
    }

    // Email validation
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Phone validation (must be exactly 10 digits)
    if (empty($phone)) {
        $errors[] = "Phone number is required";
    } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
        $errors[] = "Phone must be exactly 10 digits";
    }

    // Age validation (must be numeric and within range)
    if (empty($age)) {
        $errors[] = "Age is required";
    } elseif (!is_numeric($age) || $age < 1 || $age > 100) {
        $errors[] = "Age must be between 1 and 100";
    }

    // Gender validation
    if (empty($gender)) {
        $errors[] = "Gender is required";
    }

    // Qualification validation
    if (empty($qualification)) {
        $errors[] = "Qualification is required";
    }

    // Course validation
    if (empty($course)) {
        $errors[] = "Course is required";
    }


    // ------------------------------
    // STEP 6: If no errors → success
    // WHY: Only proceed when all validations pass
    // ------------------------------
    if (empty($errors)) {
        $success = "🎉 Student registered successfully!";

        // Clear form after success
        $name = $email = $phone = $age = $gender = $qualification = $course = "";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Registration Form by STV</title>

    <!-- ------------------------------
         STEP 7: Bootstrap CSS
         WHY: For modern UI and styling
    ------------------------------ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Background styling */
        body {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }

        /* Card rounded corners */
        .card {
            border-radius: 15px;
        }
        footer {
            background: rgba(0, 0, 0, 0.2);
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

<!-- ------------------------------
     STEP 8: Center layout using flexbox
     WHY: Keeps form centered vertically & horizontally
------------------------------ -->
<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="card shadow-lg p-4 w-100" style="max-width: 500px;">

        <h3 class="text-center mb-3">🎓 Student Registration</h3>

        <!-- ------------------------------
             STEP 9: Show validation errors
             WHY: Inform user what went wrong
        ------------------------------ -->
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $e): ?>
                    <div><?php echo $e; ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- ------------------------------
             STEP 10: Show success message
        ------------------------------ -->
        <?php if ($success): ?>
            <div class="alert alert-success">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <!-- ------------------------------
             STEP 11: Form starts
             WHY: method="post" sends data securely
        ------------------------------ -->
        <form method="post">

            <!-- Name -->
            <div class="mb-2">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
            </div>

            <!-- Email -->
            <div class="mb-2">
                <label class="form-label">Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
            </div>

            <!-- Phone -->
            <div class="mb-2">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
            </div>

            <!-- Age -->
            <div class="mb-2">
                <label class="form-label">Age</label>
                <input type="number" name="age" class="form-control" value="<?php echo $age; ?>">
            </div>

            <!-- Gender -->
            <div class="mb-2">
                <label class="form-label">Gender</label><br>
                <input type="radio" name="gender" value="Male" <?php if($gender=="Male") echo "checked"; ?>> Male
                <input type="radio" name="gender" value="Female" <?php if($gender=="Female") echo "checked"; ?>> Female
            </div>

            <!-- Qualification -->
            <div class="mb-2">
                <label class="form-label">Qualification</label>
                <input type="text" name="qualification" class="form-control" value="<?php echo $qualification; ?>">
            </div>

            <!-- Course -->
            <div class="mb-3">
                <label class="form-label">Course</label>
                <input type="text" name="course" class="form-control" value="<?php echo $course; ?>">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">
                Register
            </button>

        </form>
    </div>
</div>
<!-- Footer -->
<footer class="text-center mt-4 p-3 text-white">
    <small>
        © <?php echo date("Y"); ?> A multipurpose student registration form by STV | All Rights Reserved
    </small>
</footer>

</body>
</html>
