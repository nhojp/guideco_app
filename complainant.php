<!DOCTYPE html>
<html>
<head>
    <title>Incident Report Form</title>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection
        $servername = "your_server_name";
        $username = "your_username";
        $password = "your_password";
        $dbname = "your_database_name";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO incident_reports 
            (victim_name, dob, age, sex, grade_section, adviser, mother_name, mother_occupation, mother_address, mother_contact, father_name, father_occupation, father_address, father_contact, complainant_name, relationship, complainant_address, complainant_contact, personnel_name, personnel_dob, personnel_age, personnel_sex, designation, personnel_address, personnel_contact, student_name, student_dob, student_age, student_sex, student_grade_section, student_adviser, guardian_mother_name, guardian_mother_age, guardian_mother_occupation, guardian_mother_address, guardian_mother_contact, guardian_father_name, guardian_father_age, guardian_father_occupation, guardian_father_address, guardian_father_contact, case_details, action_taken, recommendations) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssissssssssssssssssssssssssssssssssssssssssss", 
            $victim_name, $dob, $age, $sex, $grade_section, $adviser, $mother_name, $mother_occupation, $mother_address, $mother_contact, $father_name, $father_occupation, $father_address, $father_contact, $complainant_name, $relationship, $complainant_address, $complainant_contact, $personnel_name, $personnel_dob, $personnel_age, $personnel_sex, $designation, $personnel_address, $personnel_contact, $student_name, $student_dob, $student_age, $student_sex, $student_grade_section, $student_adviser, $guardian_mother_name, $guardian_mother_age, $guardian_mother_occupation, $guardian_mother_address, $guardian_mother_contact, $guardian_father_name, $guardian_father_age, $guardian_father_occupation, $guardian_father_address, $guardian_father_contact, $case_details, $action_taken, $recommendations);

        // Set parameters and execute
        $victim_name = $_POST['victim_name'];
        $dob = $_POST['dob'];
        $age = $_POST['age'];
        $sex = $_POST['sex'];
        $grade_section = $_POST['grade_section'];
        $adviser = $_POST['adviser'];
        
        $mother_name = $_POST['mother_name'];
        $mother_occupation = $_POST['mother_occupation'];
        $mother_address = $_POST['mother_address'];
        $mother_contact = $_POST['mother_contact'];
        
        $father_name = $_POST['father_name'];
        $father_occupation = $_POST['father_occupation'];
        $father_address = $_POST['father_address'];
        $father_contact = $_POST['father_contact'];
        
        $complainant_name = $_POST['complainant_name'];
        $relationship = $_POST['relationship'];
        $complainant_address = $_POST['complainant_address'];
        $complainant_contact = $_POST['complainant_contact'];

        $personnel_name = $_POST['personnel_name'];
        $personnel_dob = $_POST['personnel_dob'];
        $personnel_age = $_POST['personnel_age'];
        $personnel_sex = $_POST['personnel_sex'];
        $designation = $_POST['designation'];
        $personnel_address = $_POST['personnel_address'];
        $personnel_contact = $_POST['personnel_contact'];

        $student_name = $_POST['student_name'];
        $student_dob = $_POST['student_dob'];
        $student_age = $_POST['student_age'];
        $student_sex = $_POST['student_sex'];
        $student_grade_section = $_POST['student_grade_section'];
        $student_adviser = $_POST['student_adviser'];

        $guardian_mother_name = $_POST['guardian_mother_name'];
        $guardian_mother_age = $_POST['guardian_mother_age'];
        $guardian_mother_occupation = $_POST['guardian_mother_occupation'];
        $guardian_mother_address = $_POST['guardian_mother_address'];
        $guardian_mother_contact = $_POST['guardian_mother_contact'];

        $guardian_father_name = $_POST['guardian_father_name'];
        $guardian_father_age = $_POST['guardian_father_age'];
        $guardian_father_occupation = $_POST['guardian_father_occupation'];
        $guardian_father_address = $_POST['guardian_father_address'];
        $guardian_father_contact = $_POST['guardian_father_contact'];

        $case_details = $_POST['case_details'];
        $action_taken = $_POST['action_taken'];
        $recommendations = $_POST['recommendations'];

        $stmt->execute();

        echo "New records created successfully";

        $stmt->close();
        $conn->close();
    } else {
    ?>
        <h2>Incident Report Form</h2>
        <form action="" method="post">
            <fieldset>
                <legend>A. Victim</legend>
                
                <label for="victim_name">Name:</label><br>
                <input type="text" id="victim_name" name="victim_name"><br><br>
                
                <label for="dob">Date of Birth:</label><br>
                <input type="date" id="dob" name="dob"><br><br>
                
                <label for="age">Age:</label><br>
                <input type="number" id="age" name="age"><br><br>
                
                <label for="sex">Sex:</label><br>
                <input type="text" id="sex" name="sex"><br><br>
                
                <label for="grade_section">Gr./Yr. and Section:</label><br>
                <input type="text" id="grade_section" name="grade_section"><br><br>
                
                <label for="adviser">Adviser:</label><br>
                <input type="text" id="adviser" name="adviser"><br><br>
                
                <h3>Parents</h3>
                <h4>Mother</h4>
                
                <label for="mother_name">Name:</label><br>
                <input type="text" id="mother_name" name="mother_name"><br><br>
                
                <label for="mother_occupation">Occupation:</label><br>
                <input type="text" id="mother_occupation" name="mother_occupation"><br><br>
                
                <label for="mother_address">Address:</label><br>
                <input type="text" id="mother_address" name="mother_address"><br><br>
                
                <label for="mother_contact">Contact Number:</label><br>
                <input type="text" id="mother_contact" name="mother_contact"><br><br>
                
                <h4>Father</h4>
                
                <label for="father_name">Name:</label><br>
                <input type="text" id="father_name" name="father_name"><br><br>
                
                <label for="father_occupation">Occupation:</label><br>
                <input type="text" id="father_occupation" name="father_occupation"><br><br>
                
                <label for="father_address">Address:</label><br>
                <input type="text" id="father_address" name="father_address"><br><br>
                
                <label for="father_contact">Contact Number:</label><br>
                <input type="text" id="father_contact" name="father_contact"><br><br>
                
            </fieldset>
            
            <fieldset>
                <legend>B. Complainant</legend>
                
                <label for="complainant_name">Name:</label><br>
                <input type="text" id="complainant_name" name="complainant_name"><br><br>
                
                <label for="relationship">Relationship to Victim:</label><br>
                <input type="text" id="relationship" name="relationship"><br><br>
                
                <label for="complainant_address">Address:</label><br>
                <input type="text" id="complainant_address" name="complainant_address"><br><br>
                
                <label for="complainant_contact">Contact Number:</label><br>
                <input type="text" id="complainant_contact" name="complainant_contact"><br><br>
                
            </fieldset>
            
            <fieldset>
                <legend>C-1. Person Complained Of (School Personnel)</legend>
                
                <label for="personnel_name">Name:</label><br>
                <input type="text" id="personnel_name" name="personnel_name"><br><br>
                
                <label for="personnel_dob">Date of Birth:</label><br>
                <input type="date" id="personnel_dob" name="personnel_dob"><br><br>
                
                <label for="personnel_age">Age:</label><br>
                <input type="number" id="personnel_age" name="personnel_age"><br><br>
                
                <label for="personnel_sex">Sex:</label><br>
                <input type="text" id="personnel_sex" name="personnel_sex"><br><br>
                
                <label for="designation">Designation/Position:</label><br>
                <input type="text" id="designation" name="designation"><br><br>
                
                <label for="personnel_address">Address:</label><br>
                <input type="text" id="personnel_address" name="personnel_address"><br><br>
                
                <label for="personnel_contact">Contact Number:</label><br>
                <input type="text" id="personnel_contact" name="personnel_contact"><br><br>
                
            </fieldset>
            
            <fieldset>
                <legend>C-2. Person Complained Of (Student)</legend>
                
                <label for="student_name">Name:</label><br>
                <input type="text" id="student_name" name="student_name"><br><br>
                
                <label for="student_dob">Date of Birth:</label><br>
                <input type="date" id="student_dob" name="student_dob"><br><br>
                
                <label for="student_age">Age:</label><br>
                <input type="number" id="student_age" name="student_age"><br><br>
                
                <label for="student_sex">Sex:</label><br>
                <input type="text" id="student_sex" name="student_sex"><br><br>
                
                <label for="student_grade_section">Gr./Yr. and Section:</label><br>
                <input type="text" id="student_grade_section" name="student_grade_section"><br><br>
                
                <label for="student_adviser">Adviser:</label><br>
                <input type="text" id="student_adviser" name="student_adviser"><br><br>
                
            </fieldset>
            
            <fieldset>
                <legend>D. Parents/Guardian</legend>
                
                <h4>Mother</h4>
                
                <label for="guardian_mother_name">Name:</label><br>
                <input type="text" id="guardian_mother_name" name="guardian_mother_name"><br><br>
                
                <label for="guardian_mother_age">Age:</label><br>
                <input type="number" id="guardian_mother_age" name="guardian_mother_age"><br><br>
                
                <label for="guardian_mother_occupation">Occupation:</label><br>
                <input type="text" id="guardian_mother_occupation" name="guardian_mother_occupation"><br><br>
                
                <label for="guardian_mother_address">Address:</label><br>
                <input type="text" id="guardian_mother_address" name="guardian_mother_address"><br><br>
                
                <label for="guardian_mother_contact">Contact Number:</label><br>
                <input type="text" id="guardian_mother_contact" name="guardian_mother_contact"><br><br>
                
                <h4>Father</h4>
                
                <label for="guardian_father_name">Name:</label><br>
                <input type="text" id="guardian_father_name" name="guardian_father_name"><br><br>
                
                <label for="guardian_father_age">Age:</label><br>
                <input type="number" id="guardian_father_age" name="guardian_father_age"><br><br>
                
                <label for="guardian_father_occupation">Occupation:</label><br>
                <input type="text" id="guardian_father_occupation" name="guardian_father_occupation"><br><br>
                
                <label for="guardian_father_address">Address:</label><br>
                <input type="text" id="guardian_father_address" name="guardian_father_address"><br><br>
                
                <label for="guardian_father_contact">Contact Number:</label><br>
                <input type="text" id="guardian_father_contact" name="guardian_father_contact"><br><br>
                
            </fieldset>
            
            <fieldset>
                <legend>E. Case Details</legend>
                
                <label for="case_details">Details of the Case:</label><br>
                <textarea id="case_details" name="case_details"></textarea><br><br>
                
                <label for="action_taken">Action Taken:</label><br>
                <textarea id="action_taken" name="action_taken"></textarea><br><br>
                
                <label for="recommendations">Recommendations:</label><br>
                <textarea id="recommendations" name="recommendations"></textarea><br><br>
                
            </fieldset>
            
            <input type="submit" value="Submit">
        </form>
    <?php
    }
    ?>
</body>
</html>
