<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- penting untuk mobile -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
    @media (max-width: 576px) {
        img.preview-photo {
            width: 100px !important;
            height: auto;
        }
    }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Edit User</h4>
            </div>
            <div class="card-body">
                <form id="form-update" action="<?= site_url('users/update') ?>" method="post"
                    enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $user->id ?>">

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role_id" class="form-select" required>
                            <?php foreach ($roles as $role): ?>
                            <option value="<?= $role->id ?>" <?= $user->role_id == $role->id ? 'selected' : '' ?>>
                                <?= $role->name ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="<?= $user->name ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $user->email ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?= $user->phone ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control"><?= $user->address ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Photo</label><br>
                        <?php if ($user->photo): ?>
                        <img src="<?= base_url('assets/uploads/users/' . $user->photo) ?>" class="mb-2 preview-photo"
                            width="80"><br>
                        <?php endif; ?>
                        <input type="file" name="photo" class="form-control">
                    </div>

                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-between">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="<?= site_url('user') ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery + Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#form-update').on('submit', function(e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);

            // Validasi sederhana sebelum kirim
            const name = form.name.value.trim();
            const email = form.email.value.trim();
            const phone = form.phone.value.trim();

            if (!name || !email || !phone) {
                alert("Nama, email, dan nomor telepon wajib diisi!");
                return;
            }

            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status) {
                        alert('Update berhasil!');
                        window.location.href = "<?= site_url('user') ?>";
                    } else {
                        alert(res.error || 'Update gagal!');
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan saat update data.');
                }
            });
        });
    });
    </script>
</body>

</html>