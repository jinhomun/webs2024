<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    if (isset($_GET['blogId'])) {
        $blogId = $_GET['blogId'];
        // 댓글 삭제 쿼리를 실행합니다.
        $deleteSql = "DELETE FROM blogComments WHERE blogId = '$blogId'";
        $connect->query($deleteSql);

        // 좋아요 데이터를 삭제합니다.
        $sql = "DELETE FROM blogsLikes WHERE blogId = {$blogId}";
        $connect->query($sql);

        // 삭제하려는 게시물의 레코드를 가져옵니다.
        $sql = "SELECT blogId FROM blogs WHERE blogId = {$blogId}";
        $result = $connect->query($sql);

        if ($result && $result->num_rows > 0) {
            $info = $result->fetch_array(MYSQLI_ASSOC);
            $blogIdToDelete = $info['blogId'];


            // 게시물을 삭제합니다.
            $sql = "DELETE FROM blogs WHERE blogId = {$blogIdToDelete}";
            $connect->query($sql);

            // 삭제된 게시물보다 큰 번호의 게시물들의 번호를 하나씩 감소시킵니다.
            $sql = "UPDATE blogs SET blogId = blogId - 1 WHERE blogId > {$blogIdToDelete}";
            $connect->query($sql);

            // 새로운 게시물의 번호를 설정합니다.
            $nextBlogId = $blogIdToDelete;

            $sql = "ALTER TABLE blogs MODIFY blogId INT AUTO_INCREMENT PRIMARY KEY";
            $connect->query($sql);

            // 현재 가장 큰 게시물 번호를 가져옵니다.
            $sql = "SELECT MAX(blogId) AS maxId FROM blogs";
            $result = $connect->query($sql);

            if ($result && $result->num_rows > 0) {
                $info = $result->fetch_array(MYSQLI_ASSOC);
                $maxBlogId = $info['maxId'];

                // 다음 게시물 번호를 설정합니다.
                $nextBlogId = $maxBlogId + 1;

                // 이제 새로운 게시물을 작성할 수 있습니다.
                // $nextBlogId를 사용하여 다음 게시물의 번호를 설정하세요.
            }

            echo "<script>alert('게시물이 삭제되었습니다.');</script>";
        } else {
            echo "<script>alert('게시물을 찾을 수 없습니다.');</script>";
        }
    } else {
        echo "<script>alert('잘못된 요청입니다.');</script>";
    }
    ?>

    <script>
    location.href = "cummunity.php";
    </script>
</body>

</html>