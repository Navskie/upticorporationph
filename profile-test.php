<?php

  session_start();

  $id = $_GET['id'];

  $_SESSION['repli_code'] = $id;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Card</title>

    <!-- <link rel="stylesheet" href="style.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/brands.min.css" integrity="sha512-OivR4OdSsE1onDm/i3J3Hpsm5GmOVvr9r49K3jJ0dnsxVzZgaOJ5MfxEAxCyGrzWozL9uJGKz6un3A7L+redIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700&display=swap");

      * {
        box-sizing: border-box;
      }

      body,
      p {
        margin: 0;
      }

      a {
        color: currentColor;
        text-decoration: none;
      }

      body {
        display: grid;
        place-items: center;
        height: 100vh;

        font-family: "Raleway", sans-serif;
        line-height: 1.5;
      }

      .card {
        width: min-content;
        border-radius: 75px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
        overflow: hidden;

        text-align: center;
      }

      .card__media {
        position: relative;

        display: grid;
        place-items: center;

        height: 200px;
        margin-bottom: 1rem;
        background: linear-gradient(#f60089, #ff1744);
      }

      .card__image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
      }

      .card__wave {
        position: absolute;
        top: 100%;

        height: 24px;
        width: 100%;
      }

      .card__body {
        padding: 2.5rem;
      }

      .card__head {
        font-size: 1.5rem;
        font-weight: 600;
        text-transform: uppercase;
      }

      .card__subhead {
        opacity: 0.75;
      }

      .card__actions {
        display: flex;
        justify-content: center;
      }

      .card__link {
        padding: 1.5rem;
        font-size: 1.25rem;
        transition: color 0.2s ease;
      }

      .card__link:hover {
        cursor: pointer;
        color: #ff1744;
      }

    </style>
  </head>
  <body>
    <div class="card">
      <div class="card__media">
        <img src="/picture.jpg" class="card__image" alt="Profile Picture" />
        <img src="/wave-shape.svg" class="card__wave" alt="" />
      </div>
      <div class="card__body">
        <p class="card__head">Olivia Morgan</p>
        <p class="card__subhead">@oliviamorgan</p>
        <div class="card__actions">
          <a href="#" class="card__link">
            <span class="fa-brands fa-behance"></span>
          </a>
          <a href="#" class="card__link">
            <span class="fa-brands fa-dribbble"></span>
          </a>
          <a href="#" class="card__link">
            <span class="fa-brands fa-facebook-f"></span>
          </a>
          <a href="#" class="card__link">
            <span class="fa-brands fa-instagram"></span>
          </a>
          <a href="#" class="card__link">
            <span class="fa-brands fa-twitter"></span>
          </a>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo
          iusto, hic repudiandae pariatur fuga itaque.
        </p>
      </div>
    </div>
  </body>
</html>
