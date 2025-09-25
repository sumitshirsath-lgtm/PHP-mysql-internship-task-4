<?php include 'auth.php'; ?>
<?php
include 'db.php';
$limit = 5; // records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM students WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%' LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #2c3e50, #4ca1af);
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
        }
        h2 {
            text-align: center;
            margin: 25px 0;
            font-weight: 600;
            font-size: 32px; /* increased */
        }
        .container {
            width: 90%;
            margin: auto;
            background-color: rgba(0,0,0,0.7);
            padding: 30px; /* increased */
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.4);
            backdrop-filter: blur(5px);
        }
        .search-clear {
            text-align: center;
            margin-bottom: 20px; /* slightly more space */
        }
        input[type="text"] {
            padding: 12px; /* bigger input */
            border-radius: 8px;
            border: none;
            width: 220px;
            font-size: 16px; /* increased */
        }
        button {
            padding: 12px 18px; /* bigger buttons */
            border: none;
            border-radius: 8px;
            color: #fff;
            cursor: pointer;
            font-weight: 500;
            font-size: 16px; /* increased */
            transition: transform 0.2s, box-shadow 0.2s, background-color 0.2s;
            margin-left: 5px;
        }
        button.search-btn { background-color: #28a745; }
        button.clear-btn { background-color: #555; }
        button.edit-btn { background-color: #4e9cff; }
        button.delete-btn { background-color: #ff6b6b; }
        button.edit-btn:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            background-color: #1e90ff;
        }
        button.delete-btn:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            background-color: #e63946;
        }
        button.add-btn {
            background-color: #ffb400;
        }
        button.add-btn:hover {
            background-color: #ffa000;
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .top-actions {
            text-align: left;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0,0,0,0.3);
            background-color: rgba(255,255,255,0.1);
            font-size: 16px; /* increased */
            animation: fadeIn 0.8s ease-in-out;
        }
        th, td {
            padding: 14px 20px; /* increased padding */
            text-align: center;
        }
        th {
            background-color: rgba(255,255,255,0.2);
            font-weight: 600;
        }
        th:first-child { border-top-left-radius: 15px; }
        th:last-child { border-top-right-radius: 15px; }
        tr:last-child td:first-child { border-bottom-left-radius: 15px; }
        tr:last-child td:last-child { border-bottom-right-radius: 15px; }

        tr:nth-child(even) { background-color: rgba(255,255,255,0.05); }
        tr:hover { background-color: rgba(255,255,255,0.2); transition: 0.3s; }

        .pagination {
            text-align: center;
            margin-top: 25px;
        }
        .pagination a {
            color: #fff;
            padding: 12px 16px; /* bigger */
            margin: 0 5px;
            background-color: rgba(255,255,255,0.2);
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px; /* increased */
            transition: 0.3s;
        }
        .pagination a:hover { background-color: rgba(255,255,255,0.4); }
        .pagination a.active { background-color: #ff69b4; box-shadow: 0 5px 15px rgba(0,0,0,0.3); }

        .logout {
            position: absolute;
            top: 20px;
            right: 40px;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            background-color: #ff4b5c;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 15px; /* readable */
            transition: 0.3s;
        }
        .logout:hover { background-color: #ff1c33; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px);}
            to { opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>
    <a href="logout.php" class="logout">Logout</a>

    <h2>Student Records</h2>
    <div class="container">
        <div class="search-clear">
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="search-btn">Search</button>
                <button type="button" onclick="window.location='index.php';" class="clear-btn">Clear</button>
            </form>
        </div>

        <div class="top-actions">
            <a href="add.php"><button class="add-btn">+ Add Student</button></a>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            <?php
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>
                            <a href='edit.php?id={$row['id']}'><button class='edit-btn'>Edit</button></a>
                            <a href='delete.php?id={$row['id']}'><button class='delete-btn'>Delete</button></a>
                        </td>
                    </tr>";
            }
            ?>
        </table>

        <div class="pagination">
            <?php
            $countSql = "SELECT COUNT(*) AS total FROM students WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%'";
            $countResult = mysqli_query($conn, $countSql);
            $totalRecords = mysqli_fetch_assoc($countResult)['total'];
            $totalPages = ceil($totalRecords / $limit);

            if($page > 1){
                $prev = $page - 1;
                echo "<a href='?page=$prev&search=$search'>Previous</a>";
            }

            for($i=1; $i<=$totalPages; $i++){
                $active = ($i == $page) ? 'active' : '';
                echo "<a class='$active' href='?page=$i&search=$search'>$i</a>";
            }

            if($page < $totalPages){
                $next = $page + 1;
                echo "<a href='?page=$next&search=$search'>Next</a>";
            }
            ?>
        </div>
    </div>
</body>
</html>
