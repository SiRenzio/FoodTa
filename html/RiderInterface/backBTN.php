<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Button</title>
    <style>
        body {
            font-family: 'Roboto Slab', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        /* Back Button */
        .backBTN {
            position: absolute;
            right: 20px;
            top: 80px;
            display: flex;
            align-items: center;
            gap: 15px;
            font-family: 'Roboto Slab', sans-serif;
            font-weight: 600;
            font-size: 0.9rem;
            color: #ffffff;
            background-color: #003c25;
            border-radius: 30px;
            padding: 5px 15px;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.3s ease, opacity 0.3s ease;
            z-index: 50;
        }

        .backBTN img {
            width: 35px;
            height: 35px;
        }

        .backBTN:hover {
            transform: scale(1.05);
            opacity: 0.8;
        }

        .backBTN.left {
            left: 20px;
            right: unset;
        }
    </style>
</head>
<body>
    <?php
        $btnPosition = isset($position) ? $position : '';
    ?>
    <a class="backBTN <?php echo $btnPosition; ?>" href="<?php echo $backLink; ?>">
        Back
        <img src="images/backButton.png" alt="Back Icon">
    </a>
</body>
</html>
