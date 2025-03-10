<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus Primary School | Contact Us</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css"
    >
    <script src="/assets/js/nav.js" defer></script>
</head>
<body>
    <nav class="navbar is-link" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
                St Alphonsus Primary School
            </a>
            <a role="button" class="has-text-white navbar-burger" aria-label="menu" aria-expanded="false" data-target="mainNavbar">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="mainNavbar" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="/index.php">
                    Home
                </a>
                <a class="navbar-item" href="/contact.php">
                    Contact Us
                </a>
            </div>
            <div class="navbar-end">
                <a class="navbar-item" href="/portal/index.php">
                    Portal
                </a>
            </div>
        </div>
    </nav>
    <main>
        <div class="section">
            <div class="container">
                <h2>Contact Us</h2>
                <form>
                    <div class="field">
                        <label class="label" for="email">Your email</label>
                        <input class="input" name="email" type="email" required>
                    </div>
                    <div class="field">
                        <label class="label" for="message">Your message</label>
                        <textarea class="input" name="message" required></textarea>
                    </div>
                    <div class="control">
                        <button class="button is-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>