<?php
include 'conn.php'; // Database connection

// Check if a student ID is provided in the query parameter
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Fetch the student's details
    $query = "SELECT s.first_name, s.middle_name, s.last_name 
              FROM students s
              WHERE s.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student_details = $result->fetch_assoc();
    $stmt->close();
}

// Fetch admin details (assuming there's a single admin; modify if needed)
$query_admin = "SELECT first_name, middle_name, last_name, position FROM admin LIMIT 1";
$result_admin = $conn->query($query_admin);
$admin_details = $result_admin->fetch_assoc();
$admin_full_name = $admin_details['first_name'] .' ' . $admin_details['last_name'];


// Get the current date
$current_date = date('jS \d\a\y \o\f F Y');
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Good Moral Character</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style-form.css">
    <script>
        // Function to trigger print dialog
        function printPage() {
            window.print();
        }
        // Call printPage function when the page loads
        window.onload = printPage;
    </script>
</head>

<body>
    <div class="container-fluid print-mt">
        <div class="container line">
            <table class="table-form">
                <tr>
                    <td class="text-center">
                        <img class="logo" src="img/kagawaran_ng_edukasyon.png" alt="logo">
                    </td>
                </tr>
                <tr>
                    <td class="text-center blackletter" style="font-size:24px; font-weight:bold;">
                        Republic of the Philippines
                    </td>
                </tr>
                <tr>
                    <td class="text-center blackletter" style="font-size:32px; font-weight:bold;">
                        Department of Education
                    </td>
                </tr>
                <tr>
                    <td class="text-center serif" style="font-size:18px; font-weight:bold;">
                        REGION IV-A CALABARZON
                    </td>
                </tr>
                <tr>
                    <td class="text-center serif" style="font-size:18px; font-weight:bold;">
                        SCHOOLS DIVISION OF BATANGAS
                    </td>
                </tr>
                <tr>
                    <td class="text-center serif" style="font-size:18px; font-weight:bold;">
                        NASUGBU EAST SENIOR HIGH SCHOOL
                    </td>
                </tr>
                <tr>
                    <td class="text-center serif" style="font-size:18px; font-weight:bold;">
                        LUMBANGAN, NASUGBU, BATANGAS
                    </td>
                </tr>
            </table>
        </div>
        <div class="container line " style="margin-top: 120px;">
            <table class="table-form">
                <tr>
                    <td class="text-center serif" style="font-size:40px; font-weight:bold;">
                        CERTIFICATE OF GOOD MORAL CHARACTER
                    </td>
                </tr>
                <tr>
                    <td class="pt-5 pl-5 pr-5 certify-text">
                        This is to certify that <u><?php echo htmlspecialchars($student_details['first_name'] . ' ' . $student_details['middle_name'] . ' ' . $student_details['last_name']); ?></u> is a bonafide student of <b>Nasugbu
                            East Senior High School</b> during the School Year _______.
                    </td>
                </tr>
                <tr>
                    <td class="pt-4 pl-5 pr-5" style="font-size:20px; text-indent: 70px;">
                        This is to certify further that he/she is a student of good moral character and has no
                        property or financial responsibility in this school.
                    </td>
                </tr>
                <tr>
                    <td class="pt-4 pl-5 pr-5" style="font-size:20px; text-indent: 70px;">
                        This certification is issued upon the student request for college admission purposes.
                    </td>
                </tr>
                <tr>
                    <td class="pt-4 pl-5 pr-5" style="font-size:20px; text-indent: 75px;">
                        Given this <u><?php echo $current_date; ?></u> at Nasugbu East Senior High School, Lumbangan,
                        Nasugbu, Batangas, Philippines.
                    </td>
                </tr>
                <tr>
                    <td style="font-size:22px; padding-left:730px; padding-top: 130px;">
                        <b class="line"><?php echo htmlspecialchars($admin_full_name); ?></b>
                    </td>
                </tr>
                <tr>
                    <td class="pt-2 float-right" style="font-size:20px; padding-bottom:360px;">
                        Guidance Program Coordinator
                    </td>
                </tr>
            </table>
        </div>
        <div class="container">
            <table>
                <tr>
                    <table border="0" cellspacing="0" cellpadding="2">
                        <tr>
                            <td>
                                <img class="logo" src="img/neshs.jpg" alt="logo">
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            Address: Brgy. Lumbangan, Nasugbu 4231, Batangas
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Telephone: 09162250568 / 09363156515
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Email: nasugbueastseniorhighschool@gmail.com
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                </tr>
            </table>
        </div>
    </div>
</body>

</html>