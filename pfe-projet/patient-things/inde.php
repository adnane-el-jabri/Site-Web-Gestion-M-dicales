<?php 
session_start();
echo $_SESSION['id_patient'];
?>
<html>
  <head>
    <style>
      .container {
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        height: 100vh;
        font-size: 36px;
        font-weight: bold;
        text-align: center;
      }
      .connBtn {
        background-color: green;
        padding: 10px 15px;
        color: white;
        border: none;
        font-size: 24px;
        border-radius: 12px;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <p>Votre compte a été crée bienvenue !</p>
      <a href="../home-page.html"><button class="connBtn">Connexion</button></a>
    </div>
  </body>
</html>