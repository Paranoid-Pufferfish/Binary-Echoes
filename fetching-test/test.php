<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Chapter Details</title>
</head>
<body>
    <h1>Fetch Chapter Details</h1>
    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="chapterId">Enter Chapter ID:</label>
        <input type="text" id="chapterId" name="chapterId">
        <button type="submit">Fetch Details</button>
    </form>
    <div id="chapterDetails">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["chapterId"])) {
                $chapterId = $_GET["chapterId"];
                $url = "index.php?id=" . urlencode($chapterId);

                $response = file_get_contents($url);
                if ($response !== false) {
                    $data = json_decode($response, true);
                    if ($data !== null && isset($data["id"], $data["description"], $data["journalUrl"])) {
                        echo "<h2>Chapter Details</h2>";
                        echo "<p><strong>ID:</strong> " . $data["id"] . "</p>";
                        echo "<p><strong>Description:</strong> " . $data["description"] . "</p>";
                        echo "<p><strong>Journal URL:</strong> <a href='" . $data["journalUrl"] . "' target='_blank'>" . $data["journalUrl"] . "</a></p>";
                    } else {
                        echo "<p>Error: Invalid chapter data received</p>";
                    }
                } else {
                    echo "<p>Error: Failed to fetch chapter details</p>";
                }
            } else {
                echo "<p>Error: Chapter ID not provided</p>";
            }
        }
        ?>
    </div>
</body>
</html>
