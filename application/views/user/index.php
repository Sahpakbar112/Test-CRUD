<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
    .dataTables_wrapper .dataTables_filter {
        float: right;
    }

    .table img {
        border-radius: 50%;
        object-fit: cover;
    }

    @media (max-width: 576px) {
        .btn-sm {
            margin-bottom: 4px;
            width: 100%;
        }

        td:nth-child(6),
        th:nth-child(6) {
            min-width: 180px;
        }
    }
    </style>
</head>

<body>
    <div class="container py-4">

        <h2 class="mb-4 text-center">User Management</h2>

        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php elseif ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="<?= site_url('user/add') ?>" class="btn btn-primary">Tambah User</a>
        </div>

        <div class="table-responsive">
            <table id="usersTable" class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th style="min-width: 170px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($users as $user): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <?php if ($user->photo): ?>
                            <img src="<?= base_url('assets/uploads/users/' . $user->photo) ?>" width="40" height="40">
                            <?php else: ?>
                            <span class="text-muted">No Photo</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $user->name ?></td>
                        <td><?= $user->role_name ?></td>
                        <td>
                            <?= $user->is_active
                                    ? '<span class="badge bg-success">Active</span>'
                                    : '<span class="badge bg-secondary">Inactive</span>' ?>
                        </td>
                        <td>
                            <a href="<?= site_url("user/detail/" . $user->id) ?>"
                                class="btn btn-sm btn-secondary">Detail</a>
                            <a href="<?= site_url("user/edit/" . $user->id) ?>"
                                class="btn btn-sm btn-info text-white">Edit</a>
                            <button class="btn btn-sm btn-danger" onclick="del(<?= $user->id ?>)">Delete</button>
                            <button class="btn btn-sm btn-warning" onclick="toggle(<?= $user->id ?>)">
                                <?= $user->is_active ? 'Nonaktifkan' : 'Aktifkan' ?>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JS Resources -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            ordering: false,
            language: {
                lengthMenu: "Tampilkan _MENU_",
                search: "Cari:"
            },
            dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'l>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>"
        });

    });

    //function delete
    function del(id) {
        if (confirm('Yakin ingin menghapus user ini?')) {
            $.post(`<?= site_url("user/delete/") ?>${id}`, function(res) {
                if (res.status) {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message || 'Gagal menghapus user.');
                }
            }, 'json').fail(() => alert('Gagal menghubungi server.'));
        }
    }
    //fun toggle activ/non
    function toggle(id) {
        $.get(`<?= site_url("user/toggle_active/") ?>${id}`, function(res) {
            if (res.status) {
                alert(res.message);
                location.reload();
            } else {
                alert('Gagal toggle status user.');
            }
        }, 'json').fail(() => alert('Gagal menghubungi server.'));
    }
    </script>
</body>

</html>