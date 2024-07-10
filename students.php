<?php 
include "head.php";
include "nav-counselor.php";
?>
<?php
include "conn.php";

// Define default sorting order
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';

// Define sorting icon class for Sex column
$sexSortIcon = $sort === 'sex' ? 'bi bi-caret-up-fill' : 'bi bi-caret-down';

// Construct SQL query based on sorting order
$sql = "SELECT * FROM users";

// Apply sorting if requested for Sex column
if ($sort === 'sex') {
    $sql .= " ORDER BY sex ASC";
}

$result = $conn->query($sql);

?>
<style>
    #dataTable tr {
        border-bottom: 1px solid #ccc;
    }

    #dataTable td {
        padding: 10px 0;

    
    }
</style>

<section style="padding-left: 30px; padding-right:30px;">
    <div class="container-fluid mt-4 mb-4">
        <div class="row mb-2">
            <div class="col-md-7 rounded p-2 float-left" style="color: #202A5B;">
                <h2 class="font-weight-bold">STUDENTS DATA</h2>
            </div>
            <div class="col-md-5 rounded p-2 float-right" style="color: #202A5B; position: relative;">
                <div style="position: absolute; left: 25px; top: 45%; transform: translateY(-50%);">
                    <i class="bi bi-search"></i>
                </div>
                <input type="text" class="form-control rounded-pill pl-5" id="searchInput" placeholder="Search..." style="padding-right: 40px;">
            </div>
        </div>
        
        <div class="row bg-light rounded">
            <div class="col-md-10">
                <h3 class="font-weight-bold pl-2 pt-4">Personal Information</h3>
            </div>
            <div class="col-md-2 rounded p-2 float-right pt-4" style="color: #202A5B;">
                <button onclick="window.print();" class="btn btn-primary"><i class="bi bi-printer mr-2"></i>Print</button>
                <button class="btn btn-danger"><i class="bi bi-trash"></i>Delete</button>
            </div>
            <div class="container bg-light text-center" style="height: 430px; overflow-y: auto;padding-bottom: 15px;">
                <form id="deleteForm" action="delete.php" method="post">
                    <div style="overflow-x:auto;">
                        <table id="dataTable" class="border-0 text-center" style="width:100%; table-layout: fixed;">
                            <colgroup>
                                <col style="width: 2%;">
                                <col style="width: 40%;">
                                <col style="width: 8%;">
                                <col style="width: 8%;">
                                <col style="width: 8%;">
                                <col style="width: 15%;">
                            </colgroup>

                            <tr>
                                <th></th>
                                <th>Full Name</th>
                                <th>Sex<a href="?sort=sex"> <i class="<?= $sexSortIcon ?>"></i></a></th>
                                <th>Age</th>
                                <th>Grade</th>
                                <th>Section</th>
                                <th>Contact Number</th>
                            </tr>

                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $birthdate = new DateTime($row['birthdate']);
                                    $today = new DateTime();
                                    $age = $birthdate->diff($today)->y;


                                    echo "<tr class='data-row'>"; // Add class 'data-row' for easier targeting
                                    echo "<td><input type='checkbox' name='selectedRows[]' value='" . $row["username"] . "'></td>";
                                    echo "<td>" . ucfirst($row["last_name"]) . ", " . ucfirst($row["first_name"]) . " " . ucfirst($row["middle_name"]) . "</td>";
                                    echo "<td>" . ucfirst($row["sex"]) . "</td>";
                                    echo "<td>" . $age . "</td>";
                                    echo "<td>" . ucfirst($row["grade"]) . "</td>";
                                    echo "<td>" . ucfirst($row["section"]) . "</td>";
                                    echo "<td>" . ucfirst($row["contact_number"]) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>No data available</td></tr>";
                            }
                            ?>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>

    document.getElementById("searchInput").addEventListener("input", function() {
        var searchText = this.value.toLowerCase();

        var rows = document.querySelectorAll("#dataTable .data-row");

        for (var i = 0; i < rows.length; i++) {
            var found = false;
            var cells = rows[i].getElementsByTagName("td");

            // Loop through each cell in the row
            for (var j = 1; j < cells.length; j++) { // Start from 1 to skip the profile picture column
                var cellText = cells[j].innerText.toLowerCase();
                if (cellText.includes(searchText)) {
                    found = true;
                    break; // If found in any column, break the loop
                }
            }

            if (found) {
                rows[i].classList.remove("hidden"); // Show the row
            } else {
                rows[i].classList.add("hidden"); // Hide the row
            }
        }
    });
</script>
<?php
include "footer.php";
?>