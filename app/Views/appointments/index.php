<div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
    <h2>Danh sách Lịch hẹn</h2>
    <a href="/appointments/create" style="background:#28a745; color:white; padding:10px 15px; text-decoration:none; border-radius:4px;">+ Thêm mới</a>
</div>

<form method="GET" action="/appointments" style="margin-bottom: 20px;">
    <input type="text" name="q" value="<?= e($keyword ?? '') ?>" placeholder="Mã lịch hẹn, tên bệnh nhân..." style="padding: 8px; width: 300px;">
    <button type="submit" style="padding: 8px 15px;">Tìm kiếm</button>
</form>

<table border="1" width="100%" cellpadding="10" style="border-collapse: collapse; background: white;">
    <tr style="background: #f8f9fa;">
        <th>ID</th><th>Mã lịch</th><th>Bệnh nhân</th><th>Ngày hẹn</th><th>Trạng thái</th><th>Hành động</th>
    </tr>
    <?php foreach ($appointments as $a): ?>
    <tr>
        <td><?= e((string)$a['id']) ?></td>
        <td><strong><?= e($a['appointment_code']) ?></strong></td>
        <td><?= e($a['patient_name']) ?> <br><small><?= e($a['patient_phone']) ?></small></td>
        <td><?= date('d/m/Y H:i', strtotime($a['appointment_date'])) ?></td>
        <td><?= e(strtoupper($a['status'])) ?></td>
        <td>
            <a href="/appointments/edit?id=<?= $a['id'] ?>" style="margin-right:10px; text-decoration:none;">Sửa</a>
            <form action="/appointments/delete" method="POST" style="display:inline;" onsubmit="return confirm('Xóa lịch hẹn này?');">
                <input type="hidden" name="id" value="<?= $a['id'] ?>">
                <button type="submit" style="background:none; border:none; color:red; cursor:pointer; font-weight:bold;">Xóa</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php if (isset($totalPages) && $totalPages > 1): ?>
    <div style="margin-top: 20px;">Trang: 
        <?php for($i=1; $i<=$totalPages; $i++): ?>
            <a href="/appointments?page=<?= $i ?>" style="<?= $i===$page ? 'color:red; font-weight:bold;' : '' ?> margin:0 5px;"><?= $i ?></a>
        <?php endfor; ?>
    </div>
<?php endif; ?>