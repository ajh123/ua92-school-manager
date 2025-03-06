<?php
include "../db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St Alphonsus Primary School</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/containers.css">
    <link rel="stylesheet" href="assets/css/nav.css">
</head>
<body>
    <nav class="navbar" aria-label="Main navigation">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="contact.html">Contact Us</a></li>
        </ul>
    </nav>
    <header class="header flex-container">
        <img class="fixed" src="assets/images/logo.png" alt="St Alphonsus Primary School logo">
        <div class="flex-item">
            <b style="font-size: 2em;">St Alphonsus Primary School</b>
            <p>We are the best <b>Outstanding</b> Primary School in the United Kingdom.</p>
        </div>
    </header>
    <main>
        <section class="section">
            <h2>What do we do</h2>
            <p>We teach classes part of the following year groups:</p>
            <ul>
                <li>Reception</li>
                <li>Year 1</li>
                <li>Year 2</li>
                <li>Year 3</li>
                <li>Year 4</li>
                <li>Year 5</li>
                <li>Year 6</li>
            </ul>
            <p>We teach a variety of subjects including, English, Maths, Geography, History, and Religion.</p>
        </section>
        <section class="section">
            <h2>Who are we?</h2>
            <div class="flex-container">
                <div class="flex-item">
                    <p>Our school is ran by a strong team of staff and teachers headed by our wonderful Head Teacher.</p>
                    <p>In 2025 our Head Teacher won a <b>platinum National Teaching Award.</b></p>
                </div>
                <img class="fixed" src="assets/images/head.jpg" alt="St Alphonsus Primary School Head Teacher">
            </div>
        </section>
    </main>
</body>
</html>