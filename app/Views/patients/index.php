<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Danh sách Bệnh nhân</h2>
    <a href="/patients/create" style="background: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;">+ Thêm mới</a>
</div>

<form method="GET" action="/patients" style="margin-bottom: 20px;">
    <input type="text" name="q" value="<?= e($keyword ?? '') ?>" placeholder="Tên, email, số điện thoại..." style="padding: 8px; width: 300px;">
    <button type="submit" style="padding: 8px 15px;">Tìm kiếm</button>
    <?php if(!empty($keyword)): ?>
        <a href="/patients" style="margin-left: 10px; color: red;">Xóa lọc</a>
    <?php endif; ?>
</form>

<table border="1" width="100%" cellpadding="10" style="border-collapse: collapse; background: white;">
    <tr style="background: #f8f9fa;">
        <th>ID</th>
        <th>Họ và Tên</th>
        <th>Email</th>
        <th>SĐT</th>
        <th>Ngày tạo</th>
        <th>Hành động</th>
    </tr>
    <?php if(empty($patients)): ?>
        <tr><td colspan="6" style="text-align:center;">Không tìm thấy dữ liệu.</td></tr>
    <?php else: ?>
        <?php foreach ($patients as $p): ?>
        <tr>
            <td><?= e((string)$p['id']) ?></td>
            <td><?= e($p['full_name']) ?></td>
            <td><?= e($p['email']) ?></td>
            <td><?= e($p['phone']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($p['created_at'])) ?></td>
            <td>
                <a href="/patients/edit?id=<?= $p['id'] ?>">Sửa</a>
            <td>
                <a href="/patients/edit?id=<?= $p['id'] ?>" style="margin-right: 10px;">Sửa</a>
                
                <form action="/patients/delete" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bệnh nhân này không?');">
                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                    <button type="submit" style="background:none; border:none; color:red; cursor:pointer; text-decoration:underline; padding:0; font-size: 16px;">Xóa</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<?php if (isset($totalPages) && $totalPages > 1): ?>
    <div style="margin-top: 20px;">
        Trang: 
        <?php for($i = 1; $i <= $totalPages; $i++): ?>
            <?php if($i === $page): ?>
                <strong style="margin: 0 5px; color: red;"><?= $i ?></strong>
            <?php else: ?>
                <a href="/patients?q=<?= urlencode($keyword ?? '') ?>&sort=<?= e($sort ?? 'created_at') ?>&dir=<?= e($dir ?? 'desc') ?>&page=<?= $i ?>" style="margin: 0 5px;"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
<?php endif; ?>