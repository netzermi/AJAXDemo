# PHP Contacts Filter Demo

This project is a small PHP demo that shows three ways to filter a list of contacts stored in a JSON file:

- index-no-ajax.php: Classic server-rendered filtering with full page reloads.
- index-ajax.php: Dynamic filtering using XMLHttpRequest (AJAX).
- index-fetch.php: Dynamic filtering using the Fetch API.

All three pages share the same data source:

- contacts.json: Sample contacts data.

## How It Works

Each page reads contacts.json on the server and filters the list by the query parameter q.

- The no-AJAX page submits a normal GET form, so the whole page reloads.
- The AJAX and Fetch pages send a background request to the same PHP file with ?ajax=1 and replace the results section with the returned HTML.

## Why Compare These Variants

- XMLHttpRequest is the classic way to do AJAX in older codebases.
- Fetch is the modern, promise-based approach used in current browsers.
- The no-AJAX version shows the simplest server-rendered baseline.

## Run Locally

Use PHP's built-in server from the project folder:

php -S localhost:8000

Then open one of these URLs in your browser:

- http://localhost:8000/index-no-ajax.php
- http://localhost:8000/index-ajax.php
- http://localhost:8000/index-fetch.php
