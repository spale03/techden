<?php
include 'database.php';
include 'adminchecker.php';


$sql = "SELECT * FROM users WHERE user_ID != :user_ID ";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":user_ID", $_SESSION["user_ID"]);

$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * from slika";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$slike = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * from racunari";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$racunarirez = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="style/admin.css">
<?php include 'head.php'; ?>

<body>
    <?php include 'header.php'; ?>
    <main>
        <?php if (isset($_GET['error'])): ?>
            <h1 style="color:red;">Greska u dodavanju slike!</h1>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <h1 style="color:green;">Uspesno dodavanje slike!</h1>
        <?php endif; ?>
        <div class="kontejner-user">
            <div class="kontejner-user-izmeni">
                <table class="tabela-user">
                    <tbody>
                        <tr>
                            <th>user_ID</th>
                            <th>username</th>
                            <th>password</th>
                            <th>email</th>
                            <th>is_admin</th>
                            <th>update</th>
                            <th>delete</th>
                        </tr>
                        <?php foreach ($res as $user):
                            $checked = '';
                            if ($user['is_admin'] == 1):
                                $checked = 'checked';
                            endif;
                            ?>
                            <tr>
                                <form>
                                    <input type="hidden" name="user_ID" id="id" value="<?= $user['user_ID'] ?>">
                                    <td>
                                        <?= $user['user_ID'] ?>
                                    </td>
                                    <td><input type="text" name="username" id="id" value="<?= $user['username'] ?>"></td>
                                    <td><input type="text" name="password" id="id" value="<?= $user['password'] ?>"></td>
                                    <td><input type="email" name="email" id="id" value="<?= $user['email'] ?>"></td>
                                    <td><input type="checkbox" name="is_admin" id="id" <?= $checked ?>></td>

                                    <td><button formmethod="post" formaction="updateuser.php" type="submit">Update
                                            user</button>
                                    </td>
                                    <td><button formmethod="post" formaction="deleteuser.php" type="submit">Delete
                                            user</button>
                                    </td>
                                </form>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="kontejner-user-novi">
                <table class="tabela-user-novi">
                    <tbody>
                        <tr>
                            <th>username</th>
                            <th>password</th>
                            <th>email</th>
                            <th>is_admin</th>
                            <th>confirm</th>
                        </tr>
                        <tr>
                            <form action="dodaj_korisnika.php" method="post">
                                <input type="hidden" name="administrator" value="1">
                                <td><input type="text" name="username" id="username"></td>
                                <td><input type="text" name="password" id="password"></td>
                                <td><input type="email" name="email" id="email"></td>
                                <td><input type="checkbox" name="is_admin" id="is_admin"></td>
                                <td><button type="submit">create</button></td>
                            </form>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="kontejner-proizvod">
            <div class="kontejner-proizvod-izmeni">
                <table>
                    <tbody>
                        <tr>
                            <th>Naziv</th>
                            <th>Cena</th>
                            <th>Pregledi</th>
                            <th>Kupovine</th>
                            <th>Slika</th>
                            <th>Izmeni</th>
                            <th>Obrisi</th>
                            
                        </tr>
                        <?php foreach ($racunarirez as $racunar): ?>
                            <tr>
                                <form>
                                    <td><input type="text" name="naziv" value="<?= $racunar['naziv'] ?>"></td>
                                    <td><input type="number" name="cena" value="<?= $racunar['cena'] ?>"></td>
                                    <td><input type="number" name="broj_pregleda" value="<?= $racunar['broj_pregleda'] ?>"></td>
                                    <td><input type="number" name="broj_kupovina" value="<?= $racunar['broj_kupovina'] ?>"></td>
                                    
                                    <td>
                                        <select name="slika">
                                            <?php foreach ($slike as $slicica):
                                                ?>
                                                <option selected="true" style='display: none'></option>
                                                <option value="<?= $slicica['naziv'] ?>">
                                                    <?= $slicica['naziv'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <input type="hidden" name="racunar_ID" value="<?= $racunar['racunar_ID']; ?>">
                                    <input type="hidden" name="izmeni" value="1">
                                    <td><button type="submit" formaction="dodaj_racunar.php"
                                            formmethod="post">Izmeni</button></td>
                                    <td><button type="submit" formaction="obrisi_racunar.php"
                                            formmethod="post">Obrisi</button></td>
                                </form>
                            </tr>


                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="kontejner-proizvod-novi">
                <table>
                    <tbody>
                        <tr>
                            <th>Naziv</th>
                            <th>Cena</th>
                            <th>Pregledi</th>
                            <th>Kupovine</th>
                            <th>Slika</th>

                        </tr>
                        <tr>
                            <form action="dodaj_racunar.php" method="post">
                                <td><input type="text" name="naziv"></td>
                                <td><input type="number" name="cena"></td>
                                <td><input type="number" name="broj_pregleda"></td>
                                <td><input type="number" name="broj_kupovina"></td>
                                <td><select name="slika">
                                        <?php foreach ($slike as $slicica):
                                            ?>

                                            <option value="<?= $slicica['naziv'] ?>">
                                                <?= $slicica['naziv'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select></td>
                                <td><button type="submit">dodaj</button></td>
                            </form>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="kontejner-slika-nova">
            <!-- Mora imati enctype multipart/form-data -->
            <!-- https://www.php.net/manual/en/features.file-upload.common-pitfalls.php -->
            <form enctype="multipart/form-data" action="dodaj_sliku.php" method="POST">
                <!-- MAX_FILE_SIZE Po PHP manualu mora da se prosledi vrednost za upload -->
                <!-- https://www.php.net/manual/en/features.file-upload.post-method.php -->
                <input type="hidden" name="MAX_FILE_SIZE" value="40000000" />
                <label>
                    Dodaj sliku:
                    <input name="slika" type="file" accept="image/*"/>
                </label>
                <input type="submit" value="Dodaj" />
            </form>
        </div>
        <div class="container-import-export">

            <form id="import_id" enctype="multipart/form-data" action="fileparser.php" method="POST">
                <input type="hidden" name="MAX_FILE_SIZE" value="4000000" />
                <label for="xml_id">
                    <p>Import XML</p>
                    <input type="file" name="xml" id="xml_id" accept=".xml">
                </label>
                <input type="submit" value="import">
            </form>

            <form id="export_id" action="fileparser.php" method="GET">
                <label form="export_id">
                    <p>Export XML</p>

                    <input type="submit" value="export">
                </label>
            </form>

        </div>
    
    
    
    
    </main>

</body>

</html>