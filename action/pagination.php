<?php
include('../configuration/config.php');

$limitPerPage = 2;

$page = "";
if(isset($_POST['page_no'])) {
    $page = $_POST['page_no'];
}
else {
    $page = 1;
}

$offset = ($page - 1) * $limitPerPage;

$sql = "SELECT * FROM product WHERE category_id = ? LIMIT {$offset},{$limitPerPage}";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", 2);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $output = "<table border='1' cellpadding='8' style='border-collapse: collapse; text-align:center;'>
                <tr style='background-color: wheat;'>
                    <th width='200'>Product ID</th>
                    <th width='200'>Title</th>
                </tr>";

    while($row = $result->fetch_assoc()) {
        $output .= "<tr>
                        <td width='200'>{$row['product_id']}</td>
                        <td width='200'>{$row['title']}</td>
                    </tr>";
    }
    $output .= "</table>";

    $sql1 = "SELECT * FROM product WHERE category=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", 2);
    $stmt->execute();
    $result = $stmt->get_result();
    $totalNoOfRow = $result->num_rows;
    $noOfPages = ceil($totalNoOfRow / $limitPerPage);

    $output .= "<div id='pagination'>";

    for ($i = 1; $i <= $noOfPages; $i++) {
        if ($i == $page) {
            $class = "active";
            $style = "background-color: rgba(0, 133, 0, 0.7);";
        } else {
            $class = "";
            $style = "";
        }
        $output .= "<a class='{$class}' style='{$style}' id='{$i}' href=''>{$i}</a>";
    }
    $output .= '</div>';

    echo $output;
} else {
    echo "<h2>No record found</h2>";
}

?>