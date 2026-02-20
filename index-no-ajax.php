<?php
require __DIR__ . "/functions.php";

applyAjaxDelay();

$contacts = getContacts();
$query = isset($_GET["q"]) ? trim($_GET["q"]) : "";
$filtered = filterContacts($contacts, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
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
            <form class="search" method="get" action="">
                <label for="q">Filter by name</label>
                <div class="search-row">
                    <input type="text" id="q" name="q" placeholder="Type a name" value="<?php echo htmlspecialchars($query, ENT_QUOTES); ?>">
                    <button type="submit">Search</button>
                </div>
            </form>
        </header>

        <section class="list">
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
</body>
</html>
