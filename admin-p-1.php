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

<div class="container-fluid mt-2 mb-5">
    <div class="container-fluid bg-white pt-4 rounded-lg">
        <div class="row">
            <div class="col-md-4">
                <h2 class="mb-4 font-weight-bold">School Personnel</h2>
            </div>

            <div class="col-md-8">
                <div class="search-wrapper float-right">
                    <div class="input-holder">
                        <input type="text" class="search-input" id="searchInput" placeholder="Type to search">
                        <button class="search-icon"><span></span></button>
                    </div>
                    <button class="close"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-white pt-4 mt-2 rounded-lg">

        <table class="table table-borderless text-center table-hover ">
            <thead>
                <tr>
                    <th style="width:65%;">Name</th>
                    <th style="width:25%;">Position</th>
                    <th style="width:10%;">Select</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_personnel->num_rows > 0) : ?>
                    <?php while ($person = $result_personnel->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo ucwords($person['first_name']) . ' ' . ucwords($person['last_name']); ?></td>
                            <td><?php echo ucwords($person['position']); ?></td>
                            <td>
                                <form action="admin-p-2.php" method="post">
                                    <input type="hidden" name="person_id" value="<?php echo $person['id']; ?>">
                                    <input type="hidden" name="person_type" value="<?php echo $person['type']; ?>">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">Select</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td>No personnel found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php
// Include footer
include "admin-footer.php";
?>