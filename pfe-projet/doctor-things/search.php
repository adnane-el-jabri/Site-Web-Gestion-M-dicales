<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
    <style>
        #tbl {
            box-shadow: 1px 1px 10px silver;
            width: 70%;
            /* margin: auto; */
            position: absolute;
            top: 5%;
            right: 5%;
        }

        thead {
            background-color: #10cab7 !important;
            color: white;
            text-align: center;
        }

        tbody {
            text-align: center;
            color: black;
            background-color: white;
            margin-top: 200px;

        }

        td {
            color: black;
            text-align: center;
            margin-top: 70px;
        }

        textarea {
            resize: none;
            height: 100px;
        }

        tr:not(:first-of-type):nth-child(even) {
            background-color: #d1d1d1;
        }

        tr:not(:first-of-type):nth-child(odd) {
            background-color: #fff;
        }
        td button {
            background-color: #10cab7 !important;
            color: #fff !important;
        }
    </style>
</head>

<body>
    <center>
        <form method="post">
            <input style="width:30%;display:inline;margin-top:30px;" class="form-control me-2" type="search"
                name="search" placeholder="search" aria-label="Search">
            <button class="btn btn-outline-primary" type="submit" name="btn-search">chercher</button>
        </form>


        <table class="table" id="tbl" border='1'
            style='position:absolute;top:15%;right:15%;text-align:center padding:20px;color:black'>
            <thead>
                <tr>
                    <th scope='col'>Nom Patient</th>
                    <th scope='col'>Date</th>
                    <th scope='col'>consultation</th>
                    <th scope='col'>Action</th>
                </tr>
            </thead>
            <?php
            include('profil.php');
            if (isset($_POST['btn-search'])) {
                $name = "%" . $_POST['search'] . "%";

                $searc = $bdd->prepare("SELECT patientmed.fn, patientmed.ln, Dates, consultation, docteurmed.id_docteur FROM dossiermed INNER JOIN patientmed ON dossiermed.id_pat=patientmed.id_patient INNER JOIN docteurmed ON dossiermed.id_doct=docteurmed.id_docteur WHERE (docteurmed.id_docteur=:id_docteur) AND (patientmed.fn LIKE :name OR patientmed.ln LIKE :name)");
                $searc->bindParam('id_docteur', $id_docteur);
                $searc->bindParam('name', $name);
                $searc->execute();



                if ($searc->rowCount() > 0) {
                    echo "

            <tbody>";


                    while ($sear = $searc->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td style='padding-top:55px;'>" . $sear['ln'] . " " . $sear['fn'] . "</td>";
                        echo "<td style='padding-top:55px;'>" . $sear['Dates'] . "</td>";
                        echo "<td style='padding-top:20px;'><form method='post'><textarea class='form-control' placeholder='Entrez votre consultation!' id='floatingTextarea' style='color:black' name='texte' cols='60' rows='10'>$sear[consultation]</textarea></form></td>";
                        echo "<td style='padding-top:55px;'><button class='btn' type='submit' name='envoyer'>envoyer</button></td>";
                        echo "</tr>";
                    }


                    echo "</tbody>
            </table>
        
            </center> ";
                } else {
                    echo '<script> alert("ce patient n éxiste pas !")</script>';

                }
            }


            ?>
</body>

</html>