<?php include "conn.php";
include "head.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data using mysqli_real_escape_string for basic input sanitization
    $victimName = mysqli_real_escape_string($conn, $_POST['victimName']);
    $victimDOB = mysqli_real_escape_string($conn, $_POST['victimDOB']);
    $victimAge = mysqli_real_escape_string($conn, $_POST['victimAge']);
    $victimSex = mysqli_real_escape_string($conn, $_POST['victimSex']);
    $victimGradeSection = mysqli_real_escape_string($conn, $_POST['victimGradeSection']);
    $victimAdviser = mysqli_real_escape_string($conn, $_POST['victimAdviser']);
    $motherName = mysqli_real_escape_string($conn, $_POST['motherName']);
    $motherOccupation = mysqli_real_escape_string($conn, $_POST['motherOccupation']);
    $motherAddress = mysqli_real_escape_string($conn, $_POST['motherAddress']);
    $motherContact = mysqli_real_escape_string($conn, $_POST['motherContact']);
    $fatherName = mysqli_real_escape_string($conn, $_POST['fatherName']);
    $fatherOccupation = mysqli_real_escape_string($conn, $_POST['fatherOccupation']);
    $fatherAddress = mysqli_real_escape_string($conn, $_POST['fatherAddress']);
    $fatherContact = mysqli_real_escape_string($conn, $_POST['fatherContact']);
    $complainantName = mysqli_real_escape_string($conn, $_POST['complainantName']);
    $relationshipToVictim = mysqli_real_escape_string($conn, $_POST['relationshipToVictim']);
    $complainantContact = mysqli_real_escape_string($conn, $_POST['complainantContact']);
    $complainantAddress = mysqli_real_escape_string($conn, $_POST['complainantAddress']);
    $complainedName = mysqli_real_escape_string($conn, $_POST['complainedName']);
    $complainedDOB = mysqli_real_escape_string($conn, $_POST['complainedDOB']);
    $complainedAge = mysqli_real_escape_string($conn, $_POST['complainedAge']);
    $complainedSex = mysqli_real_escape_string($conn, $_POST['complainedSex']);
    $complainedDesignation = mysqli_real_escape_string($conn, $_POST['complainedDesignation']);
    $complainedContact = mysqli_real_escape_string($conn, $_POST['complainedContact']);
    $complainedAddress = mysqli_real_escape_string($conn, $_POST['complainedAddress']);
    $caseDetails = mysqli_real_escape_string($conn, $_POST['caseDetails']);
    $actionTaken = mysqli_real_escape_string($conn, $_POST['actionTaken']);
    $recommendations = mysqli_real_escape_string($conn, $_POST['recommendations']);

    // Insert data into database
    $sql = "INSERT INTO complaints 
            (victimName, victimDOB, victimAge, victimSex, victimGradeSection, victimAdviser, 
            motherName, motherOccupation, motherAddress, motherContact, 
            fatherName, fatherOccupation, fatherAddress, fatherContact, 
            complainantName, relationshipToVictim, complainantContact, complainantAddress,
            complainedName, complainedDOB, complainedAge, complainedSex, complainedDesignation, complainedContact, complainedAddress,
            caseDetails, actionTaken, recommendations) 
            VALUES 
            ('$victimName', '$victimDOB', '$victimAge', '$victimSex', '$victimGradeSection', '$victimAdviser', 
            '$motherName', '$motherOccupation', '$motherAddress', '$motherContact', 
            '$fatherName', '$fatherOccupation', '$fatherAddress', '$fatherContact', 
            '$complainantName', '$relationshipToVictim', '$complainantContact', '$complainantAddress',
            '$complainedName', '$complainedDOB', '$complainedAge', '$complainedSex', '$complainedDesignation', '$complainedContact', '$complainedAddress',
            '$caseDetails', '$actionTaken', '$recommendations')";

    if ($conn->query($sql) === TRUE) {
        $successMessage = "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

include "admin-header.php"
?>


<div class="container p-5">
    <h2 class="mt-4">Complaint Form</h2>
    <?php if (!empty($successMessage)) : ?>
        <div class="alert alert-success mt-4" role="alert">
            <?php echo $successMessage; ?>
        </div>
    <?php endif; ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <!-- Victim Section -->
        <div class="container bg-white p-4 rounded-lg mt-4">
            <h4>A. Victim</h4>
            <div class="form-group">
                <label for="victimName">Name:</label>
                <input type="text" class="form-control" id="victimName" name="victimName">
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

        <div class="container bg-white p-4 rounded-lg mt-4">

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




        <div class="container bg-white p-4 rounded-lg mt-4">

            <!-- Complainant Section -->
            <h4>B. Complainant</h4>
            <div class="form-group">
                <label for="complainantName">Name:</label>
                <input type="text" class="form-control" id="complainantName" name="complainantName">
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

        <div class="container bg-white p-4 rounded-lg mt-4">

            <!-- Person Complained Of Section -->
            <h4>C. School Personnel Complained Of</h4>
            <div class="form-group">
                <label for="complainedName">Name:</label>
                <input type="text" class="form-control" id="complainedName" name="complainedName">
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

        <div class="container bg-white p-4 rounded-lg mt-4">

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

<?php include "admin-footer.php" ?>