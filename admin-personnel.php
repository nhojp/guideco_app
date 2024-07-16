<?php include "conn.php";
include "head.php";
// Start session
session_start();

// Check if user is logged in and is an admin
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['admin'])) {
    header('Location: index.php'); // Redirect if not logged in or not admin
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data using mysqli_real_escape_string for basic input sanitization
    // Assuming $_POST values are set properly, adjust as per your form structure
    $victimFirstName = isset($_POST['victimFirstName']) ? mysqli_real_escape_string($conn, ucwords(strtolower($_POST['victimFirstName']))) : '';
    $victimMiddleName = isset($_POST['victimMiddleName']) ? mysqli_real_escape_string($conn, ucwords(strtolower($_POST['victimMiddleName']))) : '';
    $victimLastName = isset($_POST['victimLastName']) ? mysqli_real_escape_string($conn, ucwords(strtolower($_POST['victimLastName']))) : '';
    $victimDOB = isset($_POST['victimDOB']) ? mysqli_real_escape_string($conn, $_POST['victimDOB']) : '';
    $victimAge = isset($_POST['victimAge']) ? mysqli_real_escape_string($conn, $_POST['victimAge']) : '';
    $victimSex = isset($_POST['victimSex']) ? mysqli_real_escape_string($conn, $_POST['victimSex']) : '';
    $victimGrade = isset($_POST['victimGrade']) ? mysqli_real_escape_string($conn, $_POST['victimGrade']) : '';
    $victimSection = isset($_POST['victimSection']) ? mysqli_real_escape_string($conn, $_POST['victimSection']) : '';
    $victimAdviser = isset($_POST['victimAdviser']) ? mysqli_real_escape_string($conn, $_POST['victimAdviser']) : '';

    $motherName = isset($_POST['motherName']) ? mysqli_real_escape_string($conn, ucwords(strtolower($_POST['motherName']))) : '';
    $motherOccupation = isset($_POST['motherOccupation']) ? mysqli_real_escape_string($conn, $_POST['motherOccupation']) : '';
    $motherAddress = isset($_POST['motherAddress']) ? mysqli_real_escape_string($conn, $_POST['motherAddress']) : '';
    $motherContact = isset($_POST['motherContact']) ? mysqli_real_escape_string($conn, $_POST['motherContact']) : '';

    $fatherName = isset($_POST['fatherName']) ? mysqli_real_escape_string($conn, ucwords(strtolower($_POST['fatherName']))) : '';
    $fatherOccupation = isset($_POST['fatherOccupation']) ? mysqli_real_escape_string($conn, $_POST['fatherOccupation']) : '';
    $fatherAddress = isset($_POST['fatherAddress']) ? mysqli_real_escape_string($conn, $_POST['fatherAddress']) : '';
    $fatherContact = isset($_POST['fatherContact']) ? mysqli_real_escape_string($conn, $_POST['fatherContact']) : '';

    $complainantFirstName = isset($_POST['complainantFirstName']) ? mysqli_real_escape_string($conn, ucwords(strtolower($_POST['complainantFirstName']))) : '';
    $complainantMiddleName = isset($_POST['complainantMiddleName']) ? mysqli_real_escape_string($conn, ucwords(strtolower($_POST['complainantMiddleName']))) : '';
    $complainantLastName = isset($_POST['complainantLastName']) ? mysqli_real_escape_string($conn, ucwords(strtolower($_POST['complainantLastName']))) : '';
    $relationshipToVictim = isset($_POST['relationshipToVictim']) ? mysqli_real_escape_string($conn, $_POST['relationshipToVictim']) : '';
    $complainantContact = isset($_POST['complainantContact']) ? mysqli_real_escape_string($conn, $_POST['complainantContact']) : '';
    $complainantAddress = isset($_POST['complainantAddress']) ? mysqli_real_escape_string($conn, $_POST['complainantAddress']) : '';

    $complainedFirstName = isset($_POST['complainedFirstName']) ? mysqli_real_escape_string($conn, ucwords(strtolower($_POST['complainedFirstName']))) : '';
    $complainedMiddleName = isset($_POST['complainedMiddleName']) ? mysqli_real_escape_string($conn, ucwords(strtolower($_POST['complainedMiddleName']))) : '';
    $complainedLastName = isset($_POST['complainedLastName']) ? mysqli_real_escape_string($conn, ucwords(strtolower($_POST['complainedLastName']))) : '';
    $complainedDOB = isset($_POST['complainedDOB']) ? mysqli_real_escape_string($conn, $_POST['complainedDOB']) : '';
    $complainedAge = isset($_POST['complainedAge']) ? mysqli_real_escape_string($conn, $_POST['complainedAge']) : '';
    $complainedSex = isset($_POST['complainedSex']) ? mysqli_real_escape_string($conn, $_POST['complainedSex']) : '';
    $complainedDesignation = isset($_POST['complainedDesignation']) ? mysqli_real_escape_string($conn, $_POST['complainedDesignation']) : '';
    $complainedContact = isset($_POST['complainedContact']) ? mysqli_real_escape_string($conn, $_POST['complainedContact']) : '';
    $complainedAddress = isset($_POST['complainedAddress']) ? mysqli_real_escape_string($conn, $_POST['complainedAddress']) : '';

    $caseDetails = isset($_POST['caseDetails']) ? mysqli_real_escape_string($conn, $_POST['caseDetails']) : '';
    $actionTaken = isset($_POST['actionTaken']) ? mysqli_real_escape_string($conn, $_POST['actionTaken']) : '';
    $recommendations = isset($_POST['recommendations']) ? mysqli_real_escape_string($conn, $_POST['recommendations']) : '';


    // Insert data into database
    $sql = "INSERT INTO complaints 
            (victimFirstName, victimMiddleName, victimLastName, victimDOB, victimAge, victimSex, victimGrade, victimSection, victimAdviser, 
            motherName, motherOccupation, motherAddress, motherContact, 
            fatherName, fatherOccupation, fatherAddress, fatherContact, 
            complainantFirstName, complainantMiddleName, complainantLastName, relationshipToVictim, complainantContact, complainantAddress,
            complainedFirstName, complainedMiddleName, complainedLastName, complainedDOB, complainedAge, complainedSex, complainedDesignation, complainedContact, complainedAddress,
            caseDetails, actionTaken, recommendations) 
            VALUES 
            ('$victimFirstName', '$victimMiddleName', '$victimLastName', '$victimDOB', '$victimAge', '$victimSex', '$victimGrade', '$victimSection', '$victimAdviser', 
            '$motherName', '$motherOccupation', '$motherAddress', '$motherContact', 
            '$fatherName', '$fatherOccupation', '$fatherAddress', '$fatherContact', 
            '$complainantFirstName', '$complainantMiddleName', '$complainantLastName', '$relationshipToVictim', '$complainantContact', '$complainantAddress',
            '$complainedFirstName', '$complainedMiddleName', '$complainedLastName', '$complainedDOB', '$complainedAge', '$complainedSex', '$complainedDesignation', '$complainedContact', '$complainedAddress',
            '$caseDetails', '$actionTaken', '$recommendations')";

    if ($conn->query($sql) === TRUE) {
        $successMessage = "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

include "admin-header.php"
?>


<div class="container-fluid mt-2 mb-5">
    <div class="container-fluid bg-white pt-4 rounded-lg">
        <h2 class="pb-4 font-weight-bold">Complaint Form Against School Personnel</h2>
    </div>
    <?php if (!empty($successMessage)) : ?>
        <div class="alert alert-success mt-4" role="alert">
            <?php echo $successMessage; ?>
        </div>
    <?php endif; ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <!-- Victim Section -->
        <div class="container-fluid bg-white p-4 rounded-lg mt-2">
            <h4>A. Victim</h4>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="victimFirstName">First Name:</label>
                    <input type="text" class="form-control" id="victimFirstName" name="victimFirstName">
                </div>
                <div class="form-group col-md-4">
                    <label for="victimMiddleName">Middle Name:</label>
                    <input type="text" class="form-control" id="victimMiddleName" name="victimMiddleName">
                </div>
                <div class="form-group col-md-4">
                    <label for="victimLastName">Last Name:</label>
                    <input type="text" class="form-control" id="victimLastName" name="victimLastName">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="victimDOB">Date of Birth:</label>
                    <input type="date" class="form-control" id="victimDOB" name="victimDOB">
                </div>
                <div class="form-group col-md-4">
                    <label for="victimAge">Age:</label>
                    <input type="number" class="form-control" id="victimAge" name="victimAge">
                </div>
                <div class="form-group col-md-4">
                    <label for="victimSex">Sex:</label>
                    <select class="form-control" id="victimSex" name="victimSex">
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="victimGrade">Grade/Yr.:</label>
                    <input type="text" class="form-control" id="victimGrade" name="victimGrade">
                </div>
                <div class="form-group col-md-6">
                    <label for="victimSection">Section:</label>
                    <input type="text" class="form-control" id="victimSection" name="victimSection">
                </div>
            </div>
            <div class="form-group">
                <label for="victimAdviser">Adviser:</label>
                <input type="text" class="form-control" id="victimAdviser" name="victimAdviser">
            </div>
        </div>

        <div class="container-fluid bg-white p-4 rounded-lg mt-4">

            <h5>Parents:</h5>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="motherName">Mother:</label>
                        <input type="text" class="form-control" id="motherName" name="motherName">
                    </div>
                    <div class="form-group">
                        <label for="motherOccupation">Occupation:</label>
                        <input type="text" class="form-control" id="motherOccupation" name="motherOccupation">
                    </div>
                    <div class="form-group">
                        <label for="motherAddress">Address:</label>
                        <input type="text" class="form-control" id="motherAddress" name="motherAddress">
                    </div>
                    <div class="form-group">
                        <label for="motherContact">Contact Number:</label>
                        <input type="text" class="form-control" id="motherContact" name="motherContact">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fatherName">Father:</label>
                        <input type="text" class="form-control" id="fatherName" name="fatherName">
                    </div>
                    <div class="form-group">
                        <label for="fatherOccupation">Occupation:</label>
                        <input type="text" class="form-control" id="fatherOccupation" name="fatherOccupation">
                    </div>
                    <div class="form-group">
                        <label for="fatherAddress">Address:</label>
                        <input type="text" class="form-control" id="fatherAddress" name="fatherAddress">
                    </div>
                    <div class="form-group">
                        <label for="fatherContact">Contact Number:</label>
                        <input type="text" class="form-control" id="fatherContact" name="fatherContact">
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid bg-white p-4 rounded-lg mt-4">

            <!-- Complainant Section -->
            <h4>B. Complainant</h4>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="complainantFirstName">First Name:</label>
                    <input type="text" class="form-control" id="complainantFirstName" name="complainantFirstName">
                </div>
                <div class="form-group col-md-4">
                    <label for="complainantMiddleName">Middle Name:</label>
                    <input type="text" class="form-control" id="complainantMiddleName" name="complainantMiddleName">
                </div>
                <div class="form-group col-md-4">
                    <label for="complainantLastName">Last Name:</label>
                    <input type="text" class="form-control" id="complainantLastName" name="complainantLastName">
                </div>
            </div>
            <div class="form-group">
                <label for="relationshipToVictim">Relationship to Victim:</label>
                <input type="text" class="form-control" id="relationshipToVictim" name="relationshipToVictim">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="complainantContact">Contact Number:</label>
                    <input type="text" class="form-control" id="complainantContact" name="complainantContact">
                </div>
                <div class="form-group col-md-6">
                    <label for="complainantAddress">Address:</label>
                    <input type="text" class="form-control" id="complainantAddress" name="complainantAddress">
                </div>
            </div>
        </div>

        <div class="container-fluid bg-white p-4 rounded-lg mt-4">

            <!-- Person Complained Of Section -->
            <h4>C. School Personnel Complained Of</h4>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="complainedFirstName">First Name:</label>
                    <input type="text" class="form-control" id="complainedFirstName" name="complainedFirstName">
                </div>
                <div class="form-group col-md-4">
                    <label for="complainedMiddleName">Middle Name:</label>
                    <input type="text" class="form-control" id="complainedMiddleName" name="complainedMiddleName">
                </div>
                <div class="form-group col-md-4">
                    <label for="complainedLastName">Last Name:</label>
                    <input type="text" class="form-control" id="complainedLastName" name="complainedLastName">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="complainedDOB">Date of Birth:</label>
                    <input type="date" class="form-control" id="complainedDOB" name="complainedDOB">
                </div>
                <div class="form-group col-md-4">
                    <label for="complainedAge">Age:</label>
                    <input type="number" class="form-control" id="complainedAge" name="complainedAge">
                </div>
                <div class="form-group col-md-4">
                    <label for="complainedSex">Sex:</label>
                    <select class="form-control" id="complainedSex" name="complainedSex">
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="complainedDesignation">Designation/Position:</label>
                <input type="text" class="form-control" id="complainedDesignation" name="complainedDesignation">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="complainedContact">Contact Number:</label>
                    <input type="text" class="form-control" id="complainedContact" name="complainedContact">
                </div>
                <div class="form-group col-md-6">
                    <label for="complainedAddress">Address:</label>
                    <input type="text" class="form-control" id="complainedAddress" name="complainedAddress">
                </div>
            </div>
        </div>

        <div class="container-fluid bg-white p-4 rounded-lg mt-4">

            <!-- Details of the Case Section -->
            <h4>II. Details of the Case</h4>
            <div class="form-group">
                <label for="caseDetails">Details of the Case:</label>
                <textarea class="form-control" id="caseDetails" name="caseDetails" rows="5"></textarea>
            </div>

            <!-- Action Taken Section -->
            <h4>III. Action Taken</h4>
            <div class="form-group">
                <label for="actionTaken">Action Taken:</label>
                <textarea class="form-control" id="actionTaken" name="actionTaken" rows="5"></textarea>
            </div>

            <!-- Recommendations Section -->
            <h4>IV. Recommendations</h4>
            <div class="form-group">
                <label for="recommendations">Recommendations:</label>
                <textarea class="form-control" id="recommendations" name="recommendations" rows="5"></textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg mt-4">Submit</button>
    </form>
</div>

<?php include "admin-footer.php"; include "footer.php"?>