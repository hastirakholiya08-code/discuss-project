<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="heading">Questions</h2>
            <?php
            include("./common/db.php");

            $uid = isset($_GET["u-id"]) ? $_GET["u-id"] : null;

            if (isset($_GET["c-id"])) {
                $cid = $_GET["c-id"];
                $query = "SELECT * FROM questions WHERE category_id = $cid";
            } else if ($uid) {
                // Use $uid only if it's set
                $query = "SELECT * FROM questions WHERE user_id = $uid";
            } else if (isset($_GET["latest"])) {
                $query = "SELECT * FROM questions ORDER BY id DESC";
            } else if (isset($_GET["search"])) {
                $search = $_GET["search"];
                $search = $conn->real_escape_string($search); 
                $query = "SELECT * FROM questions WHERE `title` LIKE '%$search%'";
            } else {
                $query = "SELECT * FROM questions";
            }

            $result = $conn->query($query);

            foreach ($result as $row) {
                $title = $row['title'];
                $id = $row['id'];
                echo "<div class='row question-list'>
            <h4 class='my-question'><a href='?q-id=$id'>$title</a>";
               echo $uid?"<a href='./server/requests.php?delete=$id'>Delete</a>":NULL;  
  

                echo "</h4></div>";
            }
            ?>
        </div>
        <div class="col-4">
            <?php include("categorylist.php"); ?>
        </div>
    </div>
</div>
