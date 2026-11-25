<?php
// =====================================================
// users/index.php — menampilkan data pengguna
// =====================================================
require __DIR__ . '/../config/app.php';
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/functions.php';

$pageTitle = 'Data Pengguna';
$activeMenu = 'users';

// Query: ambil users, urut berdasarkan nama
$sql = "SELECT nama, username, role, created_at 
        FROM users 
        ORDER BY nama ASC";

// Jalankan query, lalu ambil semua baris menjadi array
$daftarUsers = $pdo->query($sql)->fetchAll();

require __DIR__ . '/../includes/header.php';
?>

<section class="card">
    <div class="card-header">
        <h2>Daftar Pengguna</h2>
        <span class="badge badge-info"><?= count($daftarUsers) ?> pengguna</span>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($daftarUsers as $u): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= e($u['nama']) ?></td>
                    <td><?= e($u['username']) ?></td>
                    <td>
                        <span class="badge <?= $u['role'] === 'admin' ? 'badge-info' : 'badge-success' ?>">
                            <?= e($u['role']) ?>
                        </span>
                    </td>
                    <td><?= date('d-m-Y H:i', strtotime($u['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>