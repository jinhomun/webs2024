<?php
include "../connect/connect.php";
include "../connect/session.php";

$memberId = $_SESSION["memberId"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["blogId"])) {
    $blogId = (int) $_POST["blogId"];

    // Check if the user has already liked the comment
    $checkStmt = $connect->prepare("SELECT * FROM blogsLikes WHERE memberId = ? AND blogId = ?");
    $checkStmt->bind_param("ii", $memberId, $blogId);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    $checkStmt->close();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "error" => "You have already liked this comment."]);
        exit;
    }

    // Increase the number of likes by 1
    $updateStmt = $connect->prepare("UPDATE blogs SET blogLike = blogLike + 1 WHERE blogId = ?");
    $updateStmt->bind_param("i", $blogId);

    if ($updateStmt->execute()) {
        $updateStmt->close();

        // Get the updated blogLike value
        $likesStmt = $connect->prepare("SELECT blogLike FROM blogs WHERE blogId = ?");
        $likesStmt->bind_param("i", $blogId);
        $likesStmt->execute();
        $row = $likesStmt->get_result()->fetch_assoc();
        $likesStmt->close();

        $newLikes = $row["blogLike"] ?? 0;

        // Record the like in the commentLikes table
        $insertStmt = $connect->prepare("INSERT INTO blogsLikes (memberId, blogId, regTime) VALUES (?, ?, ?)");
        $time = time();
        $insertStmt->bind_param("iii", $memberId, $blogId, $time);

        if ($insertStmt->execute()) {
            echo json_encode(["success" => true, "blogLikeCount" => $newLikes]);
            $insertStmt->close();
        } else {
            echo json_encode(["success" => false, "error" => $connect->error]);
        }
    } else {
        echo json_encode(["success" => false, "error" => $connect->error]);
    }
}

?>