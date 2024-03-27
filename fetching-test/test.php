<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Chapter Details</title>
</head>
<body>
    <h1>Fetch Chapter Details</h1>
    <label for="chapterId">Enter Chapter ID:</label>
    <input type="text" id="chapterId" name="chapterId">
    <button id="fetchdetail">Fetch Details</button>
    <div id="chapterDetails"></div>

    <script>
     const boutton = document.getElementById('fetchdetail');
        function fetchChapterDetails() {
            const chapterId = document.getElementById('chapterId').value;
            const url = 'index.php?id=${chapterId}';

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch chapter details');
                    }
                    return response.json();
                })
                .then(data => {
                    // Check if the response data contains the expected fields
                    if (!data || !data.id || !data.description || !data.journalUrl) {
                        throw new Error('Invalid chapter data received');
                    }

                    // Display chapter details
                    const chapterDetailsElement = document.getElementById('chapterDetails');
                    chapterDetailsElement.innerHTML = '
                        <h2>Chapter Details</h2>
                        <p><strong>ID:</strong> ${data.id}</p>
                        <p><strong>Description:</strong> ${data.description}</p>
                        <p><strong>Journal URL:</strong> <a href="${data.journalUrl}" target="_blank">${data.journalUrl}</a></p>
                    ';
                })
                .catch(error => {
                    console.error('Error fetching chapter details:', error);
                    const chapterDetailsElement = document.getElementById('chapterDetails');
                    chapterDetailsElement.innerHTML = '<p>Error fetching chapter details: ${error.message}</p>';
                });
        }
boutton.addEventListener("click", fetchChapterDetails);
    </script>
</body>
</html>
