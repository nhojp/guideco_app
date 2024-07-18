<?php
// Include the database connection
include "conn.php";

// Include the header
include "head.php";

// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['admin_id'])) {
    // Redirect if not logged in
    header('Location: index.php');
    exit;
}

// Fetch all teachers and guards
$sql_personnel = "SELECT 'teacher' as type, id, first_name, last_name, position FROM teachers
                  UNION ALL
                  SELECT 'guard' as type, id, first_name, last_name, position FROM guards";
$result_personnel = $conn->query($sql_personnel);

include "admin-header.php";
?>

<div class="container mt-5">
    <h2 class="mb-4">List of Teachers and Guards</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Position</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result_personnel->num_rows > 0) : ?>
                <?php while ($person = $result_personnel->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $person['first_name']; ?></td>
                        <td><?php echo $person['last_name']; ?></td>
                        <td><?php echo $person['position']; ?></td>
                        <td>
                            <form action="admin-p-2.php" method="post">
                                <input type="hidden" name="person_id" value="<?php echo $person['id']; ?>">
                                <input type="hidden" name="person_type" value="<?php echo $person['type']; ?>">
                                <button type="submit" class="btn btn-primary">View Victims</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">No personnel found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
// Include footer
include "admin-footer.php";
?>
