<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chapter Details</title>
</head>
<body>
    <h1>Chapter Details</h1>
    <label for="chapterId">Enter Chapter ID:</label>
    <input type="text" id="chapterId" name="chapterId">
    <button onclick="fetchChapterDetails()">Fetch Details</button>
    <div id="chapterDetails"></div>

    <script>
        // Function to fetch chapter details from the API
        function fetchChapterDetails() {
            const chapterId = document.getElementById('chapterId').value;
            fetch('fetch.php?id=' + chapterId)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch chapter details: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                // Display chapter details
                const chapterDetailsElement = document.getElementById('chapterDetails');
                chapterDetailsElement.innerHTML = `
                    <p><strong>Description:</strong> ${data.Description}</p>
                    <p><strong>Journal URL:</strong> <a href="${data.JournalURL}" target="_blank">${data.JournalURL}</a></p>
                `;
            })
            .catch(error => {
                console.error('Error fetching chapter details:', error.message);
                const chapterDetailsElement = document.getElementById('chapterDetails');
                chapterDetailsElement.innerHTML = `<p>Error fetching chapter details: ${error.message}</p>`;
            });
        }
    </script>
</body>
</html>
