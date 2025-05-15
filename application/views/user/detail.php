<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Detail User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
    .user-photo {
        max-width: 200px;
        border-radius: 10px;
    }

    .card {
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table th {
        width: 150px;
        white-space: nowrap;
    }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Detail User</h2>
            <a href="<?= site_url('user') ?>" class="btn btn-outline-secondary">← Kembali</a>
        </div>

        <div class="card p-4">
            <div class="row g-4 align-items-start">
                <!-- Data User -->
                <div class="col-lg-8 col-md-7">
                    <table class="table table-borderless">
                        <tr>
                            <th>Nama</th>
                            <td><?= $user->name ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $user->email ?></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td><?= $user->phone ?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td><?= $user->role_name ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <?php if ($user->is_active): ?>
                                <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                <span class="badge bg-secondary">Inactive</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td><?= date('d M Y H:i', strtotime($user->created_at)) ?></td>
                        </tr>
                    </table>
                </div>

                <!-- Foto User -->
                <div class="col-lg-4 col-md-5 text-center">
                    <?php if ($user->photo): ?>
                    <img src="<?= base_url('assets/uploads/users/' . $user->photo) ?>" class="img-fluid user-photo"
                        alt="User Photo">
                    <?php else: ?>
                    <div class="bg-light border rounded p-4">
                        <span class="text-muted">No Photo</span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>