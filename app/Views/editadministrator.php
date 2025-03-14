    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Administrator</title>
    </head>
    <body>
    <h2>Edit Administrator</h2>
    <form action="/registeradministrator/update/<?= $user['id']?>" method="post">
        <input type="text" name="name" id="inputname" value="<?= $user['name'] ?>">
        <input type="text" name="adminname" id="inputadminname" value="<?= $user['adminname'] ?>">
        <input type="text" name="role" id="inputrole" value="<?= $user['role'] ?>">
        <input type="text" name="password" id="inputpassword" placeholder="Masukkan password baru" required>
        <button type="submit">Simpan</button>
    </form>
    </body>
    </html>