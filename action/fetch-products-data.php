<?php
include('../configuration/config.php');

if (isset($_POST['action'])) {
    $limitPerPage = 2;

    $categoryID = $_POST['categoryID'];
    $pageNo = $_POST['pageNo'];

    $offset = ($pageNo - 1) * $limitPerPage;

    $sql = "SELECT * FROM product WHERE category_id = {$categoryID} ";

    if (isset($_POST['priceRange']) && !empty($_POST['priceRange'])) {
        $priceRange = $_POST['priceRange'];

        $count = 0;
        foreach ($priceRange as $range) {
            $rangeArray = explode(' - ', $range);
            if ($count === 0) {
                $sql .= "AND (price BETWEEN {$rangeArray[0]} AND {$rangeArray[1]}) ";
                $count++;
            } else {
                $sql .= "OR (price BETWEEN {$rangeArray[0]} AND {$rangeArray[1]}) ";
            }
        }
    }

    if (isset($_POST['brand']) && !empty($_POST['brand'])) {
        $brand = $_POST['brand'];
        $brands = implode(',', $brand);
        $sql .= "AND brand IN ('{$brands}') ";
    }

    $sql .= "LIMIT {$offset}, {$limitPerPage}";

    // Products fetching and showing
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $cards = '<div class="row pb-3" style="width:100%;">';

        while ($row = $result->fetch_assoc()) {
            $images = explode(',', $row['image']);

            $cards .= '<div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                                    <div class="card product-item border-0 mb-4">
                                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0" style="height:250px;">
                                            <img class="img-fluid w-100" src="./' . $images[0] . '" style="object-fit:contain; height:250px;" alt="Product">
                                        </div>
                                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3 px-3">
                                            <h6 class="text-truncate mb-3">' . $row['title'] . '</h6>
                                            <div class="d-flex justify-content-center">
                                                <h6>&#x20b9 ' . ($row['price'] - ($row['price'] * $row['discount'] / 100)) . '</h6>
                                                <h6 class="text-muted ml-2"><del>&#x20b9 ' . $row['price'] . '</del></h6>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between bg-light border">
                                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                        </div>
                                    </div>
                                </div>';
        }
        $cards .= '</div>';


        // Pagination
        $sql1 = "SELECT * FROM product WHERE category_id = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("i", $categoryID);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        if ($result1->num_rows > 0) {
            $totalNoOfRows = $result1->num_rows;
            $totalPages = ceil($totalNoOfRows / $limitPerPage);

            $pagination = '';

            $pagination .= '<div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mb-3">
                                <li class="page-item">';
            $hrefPrev = '';
            $disabled = '';
            if ($pageNo == 1) {
                $disabled = 'disabled';
            } else {
                $hrefPrev = 'products.php?cid=' . $categoryID . '&page_no=' . ($pageNo - 1);
            }

            $pagination .= '<li class="page-item ' . $disabled . '">
                                <a class="page-link" href="' . $hrefPrev . '" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>';

            for ($i = 1; $i <= $totalPages; $i++) {
                ($pageNo == $i) ? $active = 'active' : $active = '';

                $pagination .= '<li class="page-item ' . $active . '"><a class="page-link" href="products.php?cid=' . $categoryID . '&page_no=' . $i . '">' . $i . '</a></li>';
            }

            $hrefNext = '';
            $disabled = '';
            if ($pageNo == $totalPages) {
                $disabled = 'disabled';
            } else {
                $hrefNext = 'products.php?cid=' . $categoryID . '&page_no=' . ($pageNo + 1);
            }

            $pagination .= '<li class="page-item ' . $disabled . '">
                                    <a class="page-link" href="' . $hrefNext . '" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>';
        }

        echo $cards . $pagination;
    } else {
        echo "<h4>No Product found in this range for this category</h4>";
    }
}
