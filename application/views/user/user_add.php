<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Pengguna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php $CI =& get_instance(); ?>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Tambah Pengguna Baru</h4>
                    </div>
                    <div class="card-body">

                        <!-- Menampilkan error validasi -->
                        <?php if (validation_errors()): ?>
                        <div class="alert alert-danger">
                            <?= validation_errors(); ?>
                        </div>
                        <?php endif; ?>

                        <!-- Menampilkan error upload -->
                        <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <?= $error; ?>
                        </div>
                        <?php endif; ?>

                        <?php if ($CI->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <?= $CI->session->flashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php endif; ?>

                        <?php if ($CI->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <?= $CI->session->flashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php endif; ?>


                        <form action="<?= site_url('user/add') ?>" method="post" enctype="multipart/form-data"
                            id="userForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="<?= set_value('name') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone:</label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                    value="<?= set_value('phone') ?>" maxlength="14" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="<?= set_value('email') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat:</label>
                                <textarea name="address" id="address" class="form-control" rows="3"
                                    required><?= set_value('address') ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="role_id" class="form-label">Role:</label>
                                <select name="role_id" class="form-select" required>
                                    <?php foreach ($roles as $role): ?>
                                    <option value="<?= $role->id ?>"><?= $role->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo:</label>
                                <input type="file" name="photo" class="form-control">
                            </div>

                            <div class="text-end">
                                <a href="<?= site_url('users') ?>" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Tambah</button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  JavaScript Validation -->
    <script>
    document.getElementById('userForm').addEventListener('submit', function(e) {
        const name = document.getElementById('name').value;
        const phone = document.getElementById('phone').value;

        const namePattern = /^[A-Za-z\s]+$/;
        const phonePattern = /^\d{1,14}$/;

        if (!namePattern.test(name)) {
            alert("Nama tidak boleh mengandung angka atau karakter khusus.");
            e.preventDefault();
            return;
        }

        if (!phonePattern.test(phone)) {
            alert("Nomor telepon hanya boleh angka.");
            e.preventDefault();
            return;
        }
    });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>