
<?php
include "db.php";

$message = "";
$messageType = "";

// Fetch all students
$students = mysqli_query($conn, "SELECT * FROM student ORDER BY name");

// Fetch all subjects
$subjects = mysqli_query($conn, "SELECT * FROM subject ORDER BY subject_name");

// Save marks when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $student_id = $_POST["student_id"];
    $subject_code = $_POST["subject_code"];
    $exam_date = $_POST["exam_date"];
    $marks_obtained = $_POST["marks_obtained"];

    // Get maximum marks for the selected subject
    $check = mysqli_prepare(
        $conn,
        "SELECT max_marks FROM subject WHERE subject_code = ?"
    );

    mysqli_stmt_bind_param($check, "s", $subject_code);
    mysqli_stmt_execute($check);
    mysqli_stmt_bind_result($check, $max_marks);
    mysqli_stmt_fetch($check);
    mysqli_stmt_close($check);

    // Validate marks
    if ($marks_obtained < 0 || $marks_obtained > $max_marks) {

        $message = "Marks must be between 0 and " . $max_marks;
        $messageType = "error";

    } else {

        // Insert marks into database
        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO marks
            (student_id, subject_code, exam_date, marks_obtained)
            VALUES (?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "issi",
            $student_id,
            $subject_code,
            $exam_date,
            $marks_obtained
        );

        if (mysqli_stmt_execute($stmt)) {
            $message = "Marks saved successfully!";
            $messageType = "success";
        } else {
            $message = "Error: " . mysqli_error($conn);
            $messageType = "error";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Internal Exam Marks Entry System</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f4f8;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 450px;
            margin: 60px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #cccccc;
        }

        h2 {
            text-align: center;
            color: #263b60;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 7px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 25px;
            background-color: #263b60;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #405b8c;
        }

        .success {
            color: green;
            text-align: center;
            margin-top: 15px;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 15px;
        }

        .report-link {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Internal Exam Marks Entry</h2>

    <?php if ($message != "") { ?>
        <p class="<?php echo $messageType; ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>
    <?php } ?>

    <form method="POST" action="">

        <label>Select Student</label>

        <select name="student_id" required>
            <option value="">-- Select Student --</option>

            <?php while ($student = mysqli_fetch_assoc($students)) { ?>
                <option value="<?php echo $student['student_id']; ?>">
                    <?php echo htmlspecialchars($student['name']); ?>
                    (ID: <?php echo $student['student_id']; ?>)
                </option>
            <?php } ?>

        </select>

        <label>Select Subject</label>

        <select name="subject_code" required>
            <option value="">-- Select Subject --</option>

            <?php while ($subject = mysqli_fetch_assoc($subjects)) { ?>
                <option value="<?php echo htmlspecialchars($subject['subject_code']); ?>">
                    <?php echo htmlspecialchars($subject['subject_name']); ?>
                    (Max: <?php echo $subject['max_marks']; ?>)
                </option>
            <?php } ?>

        </select>

        <label>Exam Date</label>

        <input type="date" name="exam_date" required>

        <label>Marks Obtained</label>

        <input type="number"
               name="marks_obtained"
               min="0"
               required>

        <button type="submit">Save Marks</button>

    </form>

    <div class="report-link">
        <a href="report.php">View Marks Report</a>
    </div>

</div>

</body>
</html>
