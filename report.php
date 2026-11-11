
<?php
include "db.php";

// Retrieve marks with student and subject details
$sql = "SELECT
            student.name AS student_name,
            subject.subject_name,
            subject.max_marks,
            marks.marks_obtained,
            marks.exam_date
        FROM marks
        INNER JOIN student
            ON marks.student_id = student.student_id
        INNER JOIN subject
            ON marks.subject_code = subject.subject_code
        ORDER BY marks.exam_date DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Marks Report</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f4f8;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #cccccc;
        }

        h2 {
            text-align: center;
            color: #263b60;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 13px;
            text-align: center;
            border: 1px solid #dddddd;
        }

        th {
            background-color: #263b60;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f4f8;
        }

        .back-link {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 20px;
            background-color: #263b60;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-link:hover {
            background-color: #405b8c;
        }

        .empty {
            text-align: center;
            padding: 20px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Internal Exam Marks Report</h2>

    <table>

        <tr>
            <th>Student Name</th>
            <th>Subject Name</th>
            <th>Max Marks</th>
            <th>Marks Obtained</th>
            <th>Exam Date</th>
        </tr>

        <?php if ($result && mysqli_num_rows($result) > 0) { ?>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <tr>
                    <td><?php echo htmlspecialchars($row['student_name']); ?></td>

                    <td><?php echo htmlspecialchars($row['subject_name']); ?></td>

                    <td><?php echo htmlspecialchars($row['max_marks']); ?></td>

                    <td><?php echo htmlspecialchars($row['marks_obtained']); ?></td>

                    <td><?php echo htmlspecialchars($row['exam_date']); ?></td>
                </tr>

            <?php } ?>

        <?php } else { ?>

            <tr>
                <td colspan="5" class="empty">
                    No marks records found.
                </td>
            </tr>

        <?php } ?>

    </table>

    <a href="marks.php" class="back-link">Back to Marks Entry</a>

</div>

</body>
</html>
