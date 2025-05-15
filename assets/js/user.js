$(document).ready(function () {
    const table = $('#usersTable').DataTable({
        ajax: {
            url: 'users/list',
            dataSrc: 'data'
        },
        columns: [
            { data: 'name' },
            { data: 'email' },
            { data: 'phone' },
            { data: 'address' },
            { data: 'role' },
            {
                data: 'is_active',
                render: data => data == 1 ? 'Aktif' : 'Nonaktif'
            },
            {
                data: 'id',
                render: function (data) {
                    return `
                        <button onclick="edit(${data})">Edit</button>
                        <button onclick="remove(${data})">Hapus</button>`;
                }
            }
        ]
    });

    $('#userForm').on('submit', function (e) {
        e.preventDefault();
        $.post('users/save', $(this).serialize(), function (res) {
            if (res.status) {
                $('#userModal').modal('hide');
                table.ajax.reload();
            } else {
                alert(res.errors);
            }
        }, 'json');
    });
});

function edit(id) {
    $.get('users/edit/' + id, function (data) {
        // Isi form modal
        $('#userModal').modal('show');
    }, 'json');
}

function remove(id) {
    if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
        $.get('users/delete/' + id, function () {
            $('#userTable').DataTable().ajax.reload();
        });
    }
}
