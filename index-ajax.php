<?php
require __DIR__ . "/functions.php";

$contacts = getContacts();
$query = isset($_GET["q"]) ? trim($_GET["q"]) : "";
$filtered = filterContacts($contacts, $query);

if (isset($_GET["ajax"]) && $_GET["ajax"] === "1") {
    sleep(1);
    header("Content-Type: text/html; charset=UTF-8");
    if (count($filtered) === 0) {
        echo '<p class="empty">No contacts found. Try a different name.</p>';
    } else {
        echo '<div class="grid">';
        foreach ($filtered as $contact) {
            $name = htmlspecialchars($contact["name"], ENT_QUOTES);
            $phone = htmlspecialchars($contact["phone"], ENT_QUOTES);
            $email = htmlspecialchars($contact["email"], ENT_QUOTES);
            echo '<article class="card">';
            echo '<h2>' . $name . '</h2>';
            echo '<p>' . $phone . '</p>';
            echo '<p>' . $email . '</p>';
            echo '</article>';
        }
        echo '</div>';
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts (AJAX)</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="page">
        <header class="hero">
            <div>
                <p class="eyebrow">Simple PHP Contacts</p>
                <h1>Address Book</h1>
                <p class="subtitle">Search the list of sample contacts by name.</p>
            </div>
            <form class="search" method="get" action="" id="searchForm">
                <label for="q">Filter by name</label>
                <div class="search-row">
                    <input type="text" id="q" name="q" placeholder="Type a name" value="<?php echo htmlspecialchars($query, ENT_QUOTES); ?>" autocomplete="off">
                    <button type="submit">Search</button>
                </div>
            </form>
        </header>

        <section class="list" id="results">
            <?php if (count($filtered) === 0): ?>
                <p class="empty">No contacts found. Try a different name.</p>
            <?php else: ?>
                <div class="grid">
                    <?php foreach ($filtered as $contact): ?>
                        <article class="card">
                            <h2><?php echo htmlspecialchars($contact["name"], ENT_QUOTES); ?></h2>
                            <p><?php echo htmlspecialchars($contact["phone"], ENT_QUOTES); ?></p>
                            <p><?php echo htmlspecialchars($contact["email"], ENT_QUOTES); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <script>
        (function () {
            var input = document.getElementById("q");
            var form = document.getElementById("searchForm");
            var results = document.getElementById("results");
            var timer = null;

            function fetchResults() {
                var query = encodeURIComponent(input.value.trim());
                var request = new XMLHttpRequest();
                request.open("GET", "index-ajax.php?ajax=1&q=" + query, true);
                request.onreadystatechange = function () {
                    if (request.readyState === 4 && request.status === 200) {
                        results.innerHTML = request.responseText;
                    }
                };
                request.send();
            }

            form.addEventListener("submit", function (event) {
                event.preventDefault();
                fetchResults();
            });

            input.addEventListener("input", function () {
                if (timer) {
                    clearTimeout(timer);
                }
                timer = setTimeout(fetchResults, 200);
            });
        })();
    </script>
</body>
</html>
