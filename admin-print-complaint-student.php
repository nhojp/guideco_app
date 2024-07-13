<?php
// Include database connection file
include 'conn.php';

// Fetch data from the database
$id = $_GET['id']; // Assuming you pass the ID through GET method

// Fetch data from complaints table
$sql_complaints = "SELECT * FROM complaints_student WHERE id = $id"; // Adjust table name and column names as per your database structure
$result_complaints = $conn->query($sql_complaints);

if ($result_complaints->num_rows > 0) {
    $complaint = $result_complaints->fetch_assoc();
} else {
    die("No complaint record found");
}

// Fetch data from admin table
$sql_admin = "SELECT * FROM admin"; // Adjust table name and column names as per your database structure
$result_admin = $conn->query($sql_admin);

if ($result_admin->num_rows > 0) {
    $admin = $result_admin->fetch_assoc();
    // Extract admin details
    $adminName = htmlspecialchars($admin['first_name'] . ' ' . $admin['middle_name'] . ' ' . $admin['last_name']);
    $designation = htmlspecialchars($admin['position']);
} else {
    die("No admin record found");
}

// Get current date
$currentDate = date('Y-m-d'); // Adjust format as needed

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intake-Sheet-Form-Annex-A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style-form.css">
    <script>
        window.onload = function() {
            window.print();
        };
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            /* Adjust as needed */
        }

        .table-bordered {
            border: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <table class="table-form">
            <tr>
                <td class="text-right font-weight-bold">
                    Annex "A"
                </td>
            </tr>
            <tr>
                <td class="text-center font-weight-bold">
                    DEPARTMENT OF EDUCATION
                </td>
            </tr>
            <tr>
                <td class="text-center font-weight-bold">
                    INTAKE SHEET
                </td>
            </tr>
            <tr>
                <td class="text-center font-weight-bold">
                    (Confidential)
                </td>
            </tr>
        </table>

        <table class="table-form">
            <tr>
                <td class="text-left font-weight-bold">
                    <p>I. INFORMATION</p>
                </td>
            </tr>
        </table>

        <table class="table-form">
            <tr>
                <td class="text-left font-weight-bold">
                    <p class="ml-4">A. VICTIM</p>
                </td>
            </tr>
        </table>

        <table class="table-form">
            <tr>
                <td>
                    <p style="margin-left: 50px;">Name: <u class="ml-2"><?php echo htmlspecialchars($complaint['victimFirstName'] . ' ' . $complaint['victimMiddleName'] . ' ' . $complaint['victimLastName']); ?></u></p>
                </td>
            </tr>
        </table>

        <table class="table-form">
            <tbody>
                <tr>
                    <th>
                    <td>
                        <p style="margin-left: 45px;">Date of Birth: <u><?php echo htmlspecialchars($complaint['victimDOB']); ?></u></p>
                    </td>
                    </th>
                    <th>
                    <td>
                        <p>Age: <u><?php echo htmlspecialchars($complaint['victimAge']); ?></u></p>
                    </td>
                    </th>
                    <th>
                    <td>
                        <p>Sex: <u><?php echo htmlspecialchars($complaint['victimSex']); ?></u></p>
                    </td>
                    </th>
                </tr>

            </tbody>
        </table>

        <table class="table-form">
            <tbody>
                <tr>
                    <th>
                    <td>
                        <p style="margin-left: 45px;"> Gr./Yr. and Section: <u><?php echo htmlspecialchars($complaint['victimGrade'] . ' - ' . $complaint['victimSection']); ?></u>
                        </p>
                    </td>
                    </th>
                    <th>
                    <td>
                        <p> Adviser: <u><?php echo htmlspecialchars($complaint['victimAdviser']); ?></u>
                        </p>
                    </td>
                    </th>

                </tr>
            </tbody>
        </table>

        <table class="table-form">
            <tr>
                <td>
                    <p style="margin-left: 50px;"> Parents:</p>
                </td>
            </tr>
        </table>

        <table class="table-form">
            <tr>
                <td>
                    <p style="margin-left: 65px;"> Mother: <u><?php echo htmlspecialchars($complaint['motherName']); ?></u></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 65px;"> Occupation: <u><?php echo htmlspecialchars($complaint['motherOccupation']); ?></u>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 65px;"> Address: <u><?php echo htmlspecialchars($complaint['motherAddress']); ?></u>
                        </u>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 65px;"> Contact Number: <u><?php echo htmlspecialchars($complaint['motherContact']); ?></u>
                        </u>
                    </p>
                </td>
            </tr>
        </table>

        <table class="table-form mt-2">
            <tr>
                <td>
                    <p style="margin-left: 65px;"> Father: <u><?php echo htmlspecialchars($complaint['fatherName']); ?></u>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 65px;"> Occupation: <u><?php echo htmlspecialchars($complaint['fatherOccupation']); ?></u>
                        </u>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 65px;"> Address: <u><?php echo htmlspecialchars($complaint['fatherAddress']); ?></u>
                        </u>
                        </u>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 65px;"> Contact Number: <u><?php echo htmlspecialchars($complaint['fatherContact']); ?></u>
                        </u>
                        </u>
                    </p>
                </td>
            </tr>
        </table>

        <table class="table-form">
            <tr>
                <td class="text-left font-weight-bold">
                    <p class="ml-4">B. COMPLAINANT</p>
                </td>
            </tr>
        </table>

        <table class="table-form">
            <tr>
                <td>
                    <p style="margin-left: 50px;"> Name: <u><?php echo htmlspecialchars($complaint['complainantFirstName'] . ' ' . $complaint['complainantMiddleName'] . ' ' . $complaint['complainantLastName']); ?></u>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 50px;"> Relationship to Victim: <u><?php echo htmlspecialchars($complaint['relationshipToVictim']); ?></u> </p>
                </td>
            </tr>
            <tr>
                <td></u>
                    <p style="margin-left: 50px;"> Address: <u><?php echo htmlspecialchars($complaint['complainantAddress']); ?></u>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 50px;"> Contact Number: <u><?php echo htmlspecialchars($complaint['complainantContact']); ?></u>
                    </p>
                </td>
            </tr>
        </table>

        <table class="table-form">
            <tr>
                <td class="text-left font-weight-bold">
                    <p class="ml-4">C. STUDENT COMPLAINED OF</p>
                </td>
            </tr>
        </table>

        <table class="table-form">
            <tr>
                <td>
                    <p style="margin-left: 50px;">Name: <u class="ml-2"><?php echo htmlspecialchars($complaint['complainedFirstName'] . ' ' . $complaint['complainedMiddleName'] . ' ' . $complaint['complainedLastName']); ?></u></p>
                </td>
            </tr>
        </table>

        <table class="table-form">
            <tbody>
                <tr>
                    <th>
                    <td>
                        <p style="margin-left: 45px;">Date of Birth: <u><?php echo htmlspecialchars($complaint['complainedDOB']); ?></u></p>
                    </td>
                    </th>
                    <th>
                    <td>
                        <p>Age: <u><?php echo htmlspecialchars($complaint['complainedAge']); ?></u></p>
                    </td>
                    </th>
                    <th>
                    <td>
                        <p>Sex: <u><?php echo htmlspecialchars($complaint['complainedSex']); ?></u></p>
                    </td>
                    </th>
                </tr>
            </tbody>
        </table>

        <table class="table-form">
            <tbody>
                <tr>
                    <th>
                    <td>
                        <p style="margin-left: 45px;"> Gr./Yr. and Section: <u><?php echo htmlspecialchars($complaint['complainedGrade'] . ' - ' . $complaint['complainedSection']); ?></u>
                        </p>
                    </td>
                    </th>
                    <th>
                    <td>
                        <p> Adviser: <u><?php echo htmlspecialchars($complaint['complainedAdviser']); ?></u>
                        </p>
                    </td>
                    </th>
                </tr>
            </tbody>
        </table>

        <table class="table-form">
            <tr>
                <td>
                    <p style="margin-left: 50px;"> Parents:</p>
                </td>
            </tr>
        </table>

        <table class="table-form">
            <tr>
                <td>
                    <p style="margin-left: 65px;"> Mother: <u><?php echo htmlspecialchars($complaint['complainedMotherName']); ?></u></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 65px;"> Occupation: <u><?php echo htmlspecialchars($complaint['complainedMotherOccupation']); ?></u>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 65px;"> Address: <u><?php echo htmlspecialchars($complaint['complainedMotherAddress']); ?></u>
                        </u>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 65px;"> Contact Number: <u><?php echo htmlspecialchars($complaint['complainedMotherContact']); ?></u>
                        </u>
                    </p>
                </td>
            </tr>
        </table>

        <table class="table-form mt-2">
            <tr>
                <td>
                    <p style="margin-left: 65px;"> Father: <u><?php echo htmlspecialchars($complaint['complainedFatherName']); ?></u>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 65px;"> Occupation: <u><?php echo htmlspecialchars($complaint['complainedFatherOccupation']); ?></u>
                        </u>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 65px;"> Address: <u><?php echo htmlspecialchars($complaint['complainedFatherAddress']); ?></u>
                        </u>
                        </u>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 65px;"> Contact Number: <u><?php echo htmlspecialchars($complaint['complainedFatherContact']); ?></u>
                        </u>
                        </u>
                    </p>
                </td>
            </tr>
        </table>

        <table class="table-form">
            <tr>
                <td class="text-left font-weight-bold">
                    <p>II. DETAILS OF THE CASE</p>
                </td>
            </tr>
        </table>

        <table class="table-form">
            <tr>
                <td class="text-left">
                    <p class="ml-4"> <?php echo nl2br(htmlspecialchars($complaint['caseDetails'])); ?>
                    </p>
                </td>
            </tr>
        </table>

        <table class="table-form">
            <tr>
                <td class="text-left font-weight-bold">
                    <p>III. ACTION TAKEN</p>
                </td>
            </tr>
        </table>

        <table class="table-form">
            <tr>
                <td class="text-left">
                    <p class="ml-4"> <?php echo nl2br(htmlspecialchars($complaint['actionTaken'])); ?>
                    </p>
                </td>
            </tr>
        </table>

        <table class="table-form">
            <tr>
                <td class="text-left font-weight-bold">
                    <p>IV. RECOMMENDATIONS</p>
                </td>
            </tr>
        </table>

        <table class="table-form">
            <tr>
                <td class="text-left">
                    <p class="ml-4"> <?php echo nl2br(htmlspecialchars($complaint['recommendations'])); ?>
                    </p>
                </td>
            </tr>
        </table>

        <table class="table-form" style="margin-top: 200px;">
            <tbody>
                <tr>
                    <th style="width: 50%;">
                    <th style="width: 50%;"></th>
                </tr>

                <tr>
                    <td class="text-right">
                        <p><b>Prepared by:</b></p>

                    </td>
                    <td>

                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td class="text-center">
                        <p><u><?php echo $adminName; ?></u></p>
                    </td>
                </tr>

                <tr>
                    <td>
                    </td>
                    <td class="text-center">
                        <p>Signature over printed name</p>
                    </td>
                </tr>

                <tr>
                    <td>
                    </td>
                    <td class="text-center">
                    <p>Designation: <u><?php echo $designation; ?></u></p>
                    </td>
                </tr>

                <tr>
                    <td>
                    </td>
                    <td class="text-center">
                    <p>Date: <u><?php echo $currentDate; ?></u></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>