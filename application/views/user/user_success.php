<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Berhasil Tambah Pengguna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <script>
    alert("<?= $message ?>");
    window.location.href = "<?= site_url('users') ?>";
    </script>
</body>

</html>