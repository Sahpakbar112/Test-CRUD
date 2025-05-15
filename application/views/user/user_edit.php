<!DOCTYPE html>
<!-- //user_edit.php -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container py-5">
        <h2>Edit User</h2>
        <form action="<?= site_url('users/update') ?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $user->id ?>">
            <div class="mb-3">
                <label>Role</label>
                <select name="role_id" class="form-control" required>
                    <?php foreach ($roles as $role): ?>
                    <option value="<?= $role->id ?>" <?= $user->role_id == $role->id ? 'selected' : '' ?>>
                        <?= $role->name ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?= $user->name ?>" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= $user->email ?>" required>
            </div>
            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="<?= $user->phone ?>" required>
            </div>
            <div class="mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control"><?= $user->address ?></textarea>
            </div>
            <div class="mb-3">
                <label>Photo</label><br>
                <?php if ($user->photo): ?>
                <img src="<?= base_url('assets/uploads/users/' . $user->photo) ?>" width="60" class="mb-2"><br>
                <?php endif; ?>
                <input type="file" name="photo" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="<?= site_url('user') ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $('#form-update').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: '<?= site_url('user/update') ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(res) {
                if (res.status) {
                    alert('Update berhasil!');

                    window.location.href = "<?= site_url('user') ?>";
                    location.reload();
                } else {
                    alert(res.error || 'Update gagal!');
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat update data.');
            }
        });
    });
    </script>

</body>

</html>