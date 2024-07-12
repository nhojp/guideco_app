<?php
include "conn.php";
include "head.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data for victim
    $victimFirstName = $_POST['victimFirstName'];
    $victimMiddleName = $_POST['victimMiddleName'];
    $victimLastName = $_POST['victimLastName'];
    $victimDOB = $_POST['victimDOB'];
    $victimAge = $_POST['victimAge'];
    $victimSex = $_POST['victimSex'];
    $victimGrade = $_POST['victimGrade'];
    $victimSection = $_POST['victimSection'];
    $victimAdviser = $_POST['victimAdviser'];

    // Get form data for parents
    $motherName = $_POST['motherName'];
    $motherOccupation = $_POST['motherOccupation'];
    $motherAddress = $_POST['motherAddress'];
    $motherContact = $_POST['motherContact'];
    $fatherName = $_POST['fatherName'];
    $fatherOccupation = $_POST['fatherOccupation'];
    $fatherAddress = $_POST['fatherAddress'];
    $fatherContact = $_POST['fatherContact'];

    // Get form data for complainant
    $complainantFirstName = $_POST['complainantFirstName'];
    $complainantMiddleName = $_POST['complainantMiddleName'];
    $complainantLastName = $_POST['complainantLastName'];
    $relationshipToVictim = $_POST['relationshipToVictim'];
    $complainantContact = $_POST['complainantContact'];
    $complainantAddress = $_POST['complainantAddress'];

    // Get form data for person complained of
    $complainedFirstName = $_POST['complainedFirstName'];
    $complainedMiddleName = $_POST['complainedMiddleName'];
    $complainedLastName = $_POST['complainedLastName'];
    $complainedDOB = $_POST['complainedDOB'];
    $complainedAge = $_POST['complainedAge'];
    $complainedSex = $_POST['complainedSex'];
    $complainedGrade = $_POST['complainedGrade'];
    $complainedSection = $_POST['complainedSection'];
    $complainedAdviser = $_POST['complainedAdviser'];
    $complainedContact = $_POST['complainedContact'];
    $complainedAddress = $_POST['complainedAddress'];

    // Get form data for complained parents
    $complainedMotherName = $_POST['complainedMotherName'];
    $complainedMotherOccupation = $_POST['complainedMotherOccupation'];
    $complainedMotherAddress = $_POST['complainedMotherAddress'];
    $complainedMotherContact = $_POST['complainedMotherContact'];
    $complainedFatherName = $_POST['complainedFatherName'];
    $complainedFatherOccupation = $_POST['complainedFatherOccupation'];
    $complainedFatherAddress = $_POST['complainedFatherAddress'];
    $complainedFatherContact = $_POST['complainedFatherContact'];

    // Get form data for case details
    $caseDetails = $_POST['caseDetails'];
    $actionTaken = $_POST['actionTaken'];
    $recommendations = $_POST['recommendations'];

    // Insert data into database
    $sql = "INSERT INTO complaints_student 
            (victimFirstName, victimMiddleName, victimLastName, victimDOB, victimAge, victimSex, victimGrade, victimSection, victimAdviser, 
            motherName, motherOccupation, motherAddress, motherContact, 
            fatherName, fatherOccupation, fatherAddress, fatherContact, 
            complainantFirstName, complainantMiddleName, complainantLastName, relationshipToVictim, complainantContact, complainantAddress, 
            complainedFirstName, complainedMiddleName, complainedLastName, complainedDOB, complainedAge, complainedSex, complainedGrade, complainedSection, complainedAdviser, complainedContact, complainedAddress, 
            complainedMotherName, complainedMotherOccupation, complainedMotherAddress, complainedMotherContact, 
            complainedFatherName, complainedFatherOccupation, complainedFatherAddress, complainedFatherContact, 
            caseDetails, actionTaken, recommendations)
            VALUES 
            ('$victimFirstName', '$victimMiddleName', '$victimLastName', '$victimDOB', '$victimAge', '$victimSex', '$victimGrade','$victimSection', '$victimAdviser', 
            '$motherName', '$motherOccupation', '$motherAddress', '$motherContact', 
            '$fatherName', '$fatherOccupation', '$fatherAddress', '$fatherContact', 
            '$complainantFirstName', '$complainantMiddleName', '$complainantLastName', '$relationshipToVictim', '$complainantContact', '$complainantAddress', 
            '$complainedFirstName', '$complainedMiddleName', '$complainedLastName', '$complainedDOB', '$complainedAge', '$complainedSex', '$complainedGrade', '$complainedSection', '$complainedAdviser', '$complainedContact', '$complainedAddress', 
            '$complainedMotherName', '$complainedMotherOccupation', '$complainedMotherAddress', '$complainedMotherContact', 
            '$complainedFatherName', '$complainedFatherOccupation', '$complainedFatherAddress', '$complainedFatherContact', 
            '$caseDetails', '$actionTaken', '$recommendations')";

    if ($conn->query($sql) === TRUE) {
        $successMessage = "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

include "admin-header.php";
?>

<div class="container p-5">
    <h2 class="mt-4">Complaint Form</h2>
    <?php if (!empty($successMessage)) : ?>
        <div class="alert alert-success mt-4" role="alert">
            <?php echo $successMessage; ?>
        </div>
    <?php endif; ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <div class="container bg-white p-4 rounded-lg mt-4">

        <!-- Victim Section -->
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

    <div class="container bg-white p-4 rounded-lg mt-4">

        <!-- Parents Section -->
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

    <div class="container bg-white p-4 rounded-lg mt-4">

        <!-- Person Complained Of Section -->
        <h4>C. Student Complained Of</h4>
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
        <div class="form-row">

        <div class="form-group col-md-6">
            <label for="complainedGrade">Grade:</label>
            <input type="text" class="form-control" id="complainedGrade" name="complainedGrade">
        </div>
        <div class="form-group col-md-6">
            <label for="complainedSection">Section:</label>
            <input type="text" class="form-control" id="complainedSection" name="complainedSection">
        </div>
        </div>

        <div class="form-group">
            <label for="complainedAdviser">Adviser:</label>
            <input type="text" class="form-control" id="complainedAdviser" name="complainedAdviser">
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

        <!-- Parents of Person Complained Of Section -->
        <h5>Parents:</h5>
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="complainedMotherName">Mother:</label>
                    <input type="text" class="form-control" id="complainedMotherName" name="complainedMotherName">
                </div>
                <div class="form-group">
                    <label for="complainedMotherOccupation">Occupation:</label>
                    <input type="text" class="form-control" id="complainedMotherOccupation" name="complainedMotherOccupation">
                </div>
                <div class="form-group">
                    <label for="complainedMotherAddress">Address:</label>
                    <input type="text" class="form-control" id="complainedMotherAddress" name="complainedMotherAddress">
                </div>
                <div class="form-group">
                    <label for="complainedMotherContact">Contact Number:</label>
                    <input type="text" class="form-control" id="complainedMotherContact" name="complainedMotherContact">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="complainedFatherName">Father:</label>
                    <input type="text" class="form-control" id="complainedFatherName" name="complainedFatherName">
                </div>
                <div class="form-group">
                    <label for="complainedFatherOccupation">Occupation:</label>
                    <input type="text" class="form-control" id="complainedFatherOccupation" name="complainedFatherOccupation">
                </div>
                <div class="form-group">
                    <label for="complainedFatherAddress">Address:</label>
                    <input type="text" class="form-control" id="complainedFatherAddress" name="complainedFatherAddress">
                </div>
                <div class="form-group">
                    <label for="complainedFatherContact">Contact Number:</label>
                    <input type="text" class="form-control" id="complainedFatherContact" name="complainedFatherContact">
                </div>
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

