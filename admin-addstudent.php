<?php
    // Include necessary files
    include 'head.php';
    include 'conn.php';
    include 'admin-header.php';

    // Function to generate a unique username based on current year and incremented number
    function generateUsername($conn) {
        $current_year = date('y'); // Get current year in two-digit format (e.g., 24 for 2024)
        
        // Get the maximum username for the current year from users table
        $query = "SELECT MAX(CAST(SUBSTRING(username, 3) AS UNSIGNED)) AS max_username FROM users WHERE username LIKE ?";
        $like_param = $current_year . '%';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $like_param);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row['max_username']) {
            $next_username = intval($row['max_username']) + 1;
        } else {
            $next_username = 1; // Start from 1 if no username exists for the current year
        }
        
        $username = $current_year . $next_username;
        
        return $username;
    }

    // Function to fetch sections from database
    function fetchSections($conn) {
        $sections = array();
        
        $query = "SELECT id, section_name FROM sections";
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sections[$row['id']] = $row['section_name'];
            }
        }
        
        return $sections;
    }

    // Process form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $section_id = $_POST['section'];

        // Generate username
        $username = generateUsername($conn);

        // Insert into users table
        $insert_user_query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $password = $username;
        $stmt = $conn->prepare($insert_user_query);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $user_id = $stmt->insert_id; // Get the inserted user ID

        // Insert into students table
        $insert_student_query = "INSERT INTO students (first_name, last_name, section_id, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_student_query);
        $stmt->bind_param('ssii', $first_name, $last_name, $section_id, $user_id);
        $stmt->execute();

        echo "Student added successfully!";
    }

    // Fetch sections from database
    $sections = fetchSections($conn);
?>

<!-- HTML Form -->
<form method="POST" action="">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" required><br><br>

    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" required><br><br>

    <label for="section">Section:</label>
    <select id="section" name="section" required>
        <option value="">Select Section</option>
        <?php foreach ($sections as $section_id => $section_name): ?>
            <option value="<?php echo $section_id; ?>"><?php echo $section_name; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Add Student</button>
</form>

<?php
    // Include footer files
    include 'footer.php';
    include 'admin-footer.php';
?>
