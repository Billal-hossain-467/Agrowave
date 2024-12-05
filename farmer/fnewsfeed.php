<?php
// Function to fetch and parse the news content from a URL
function fetchAgricultureNews($url) {
    // Use file_get_contents() to get the HTML of the page
    $html = file_get_contents($url);

    if ($html === FALSE) {
        return [];
    }

    // Create a new DOMDocument instance and load the HTML content
    $dom = new DOMDocument;
    libxml_use_internal_errors(true); // Suppress warnings for malformed HTML
    $dom->loadHTML($html);
    libxml_clear_errors();

    // Initialize XPath for extracting content
    $xpath = new DOMXPath($dom);

    // XPath to fetch articles (Modify this based on the website structure)
    $articles = $xpath->query('//article'); // General XPath to find article blocks

    $newsData = [];
    foreach ($articles as $article) {
        // Initialize variables to handle missing elements
        $image = 'https://via.placeholder.com/100'; // Fallback image
        $title = 'No Title'; // Default title
        $link = '#'; // Default link
        $source = 'Agriculture News Website';  // Default source
        $date = date('Y-m-d H:i:s');  // Default date if not available

        // Fetch the image URL (adjust the tag or class based on the site)
        $imgTag = $article->getElementsByTagName('img')->item(0);
        if ($imgTag) {
            $image = $imgTag->getAttribute('src') ?? $image; // Use the image URL if it exists
        }

        // Fetch the title (adjust the tag based on the site)
        $titleTag = $article->getElementsByTagName('h2')->item(0); // This may vary based on the website structure
        if ($titleTag) {
            $title = $titleTag->textContent ?? $title; // Use the title if it exists
        }

        // Fetch the link (adjust the tag based on the site)
        $linkTag = $article->getElementsByTagName('a')->item(0); // This may vary
        if ($linkTag) {
            $link = $linkTag->getAttribute('href') ?? $link; // Use the link URL if it exists
        }

        // Store the article details in an array
        $newsData[] = [
            'image' => $image,
            'title' => $title,
            'link' => $link,
            'source' => $source,
            'date' => $date
        ];
    }

    return $newsData;
}


// Define a list of URLs to scrape news from
$urls = [    
   'https://www.agriculture.com/southwest-iowa-farmland-brings-over-usd16-000-per-acre-8704024', 
    'https://www.fwi.co.uk/',
    'https://www.agfundernews.com/'
];

$newsArticles = [];

foreach ($urls as $url) {
    $newsArticles = array_merge($newsArticles, fetchAgricultureNews($url));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agriculture News Feed</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header {
            background-color: #2e7d32;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
        }
        .header p {
            font-size: 1.2em;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .news-articles {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .article {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .article:hover {
            transform: translateY(-5px);
        }
        .article img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .article-content {
            padding: 15px;
        }
        .article h2 {
            font-size: 1.5em;
            margin: 0;
            color: #333;
        }
        .article p {
            color: #555;
            font-size: 1em;
        }
        .article a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #2e7d32;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .article a:hover {
            background-color: #388e3c;
        }
    </style>
</head>
<body>
   
    <div class="header">
        <h1>Agriculture News Feed</h1>
        <p>Stay updated with the latest agriculture news and insights.</p>
    </div>
    <div class="container">
        <div class="news-articles">
            <?php
            if (!empty($newsArticles)) {
                foreach ($newsArticles as $news) {
                    echo "<div class='article'>";
                    echo "<img src='" . htmlspecialchars($news['image']) . "' alt='News Image'>";
                    echo "<div class='article-content'>";
                    echo "<h2>" . htmlspecialchars($news['title']) . "</h2>";
                    echo "<p>" . htmlspecialchars($news['source']) . "</p>";
                    echo "<a href='" . htmlspecialchars($news['link']) . "' target='_blank'>Read More</a>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No agriculture news articles found.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
