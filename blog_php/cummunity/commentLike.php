<?php
include "../connect/connect.php";
include "../connect/session.php";

$memberId = $_SESSION["memberId"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["commentId"])) {
    $commentId = (int) $_POST["commentId"];

    // Check if the user has already liked the comment
    $checkStmt = $connect->prepare("SELECT * FROM commentLikes WHERE memberId = ? AND commentId = ?");
    $checkStmt->bind_param("ii", $memberId, $commentId);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    $checkStmt->close();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "error" => "You have already liked this comment."]);
        exit;
    }

    // Increase the number of likes by 1
    $updateStmt = $connect->prepare("UPDATE blogComments SET commentLike = commentLike + 1 WHERE commentId = ?");
    $updateStmt->bind_param("i", $commentId);

    if ($updateStmt->execute()) {
        $updateStmt->close();

        // Get the updated commentLike value
        $likesStmt = $connect->prepare("SELECT commentLike FROM blogComments WHERE commentId = ?");
        $likesStmt->bind_param("i", $commentId);
        $likesStmt->execute();
        $row = $likesStmt->get_result()->fetch_assoc();
        $likesStmt->close();

        $newLikes = $row["commentLike"] ?? 0;

        // Record the like in the commentLikes table
        $insertStmt = $connect->prepare("INSERT INTO commentLikes (memberId, commentId, regTime) VALUES (?, ?, ?)");
        $time = time();
        $insertStmt->bind_param("iii", $memberId, $commentId, $time);

        if ($insertStmt->execute()) {
            echo json_encode(["success" => true, "newLikeCount" => $newLikes]);
            $insertStmt->close();
        } else {
            echo json_encode(["success" => false, "error" => $connect->error]);
        }
    } else {
        echo json_encode(["success" => false, "error" => $connect->error]);
    }
}

?>