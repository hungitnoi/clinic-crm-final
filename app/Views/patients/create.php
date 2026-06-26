<h2>Thêm Bệnh nhân mới</h2>

<form action="/patients/store" method="POST" style="max-width: 500px; background: white; padding: 20px; border-radius: 8px;">
    <div style="margin-bottom: 15px;">
        <label>Họ và Tên *</label>
        <input type="text" name="full_name" value="<?= e(old('full_name')) ?>" style="width: 100%; padding: 8px;">
        <?php if(isset($errors['full_name'])): ?><span style="color:red; font-size: 14px;"><?= $errors['full_name'] ?></span><?php endif; ?>
    </div>
    
    <div style="margin-bottom: 15px;">
        <label>Email *</label>
        <input type="text" name="email" value="<?= e(old('email')) ?>" style="width: 100%; padding: 8px;">
        <?php if(isset($errors['email'])): ?><span style="color:red; font-size: 14px;"><?= $errors['email'] ?></span><?php endif; ?>
    </div>

    <div style="margin-bottom: 15px;">
        <label>Số điện thoại</label>
        <input type="text" name="phone" value="<?= e(old('phone')) ?>" style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label>Giới tính</label>
        <select name="gender" style="width: 100%; padding: 8px;">
            <option value="male" <?= old('gender') === 'male' ? 'selected' : '' ?>>Nam</option>
            <option value="female" <?= old('gender') === 'female' ? 'selected' : '' ?>>Nữ</option>
            <option value="other" <?= old('gender', 'other') === 'other' ? 'selected' : '' ?>>Khác</option>
        </select>
    </div>

    <div style="margin-bottom: 15px;">
        <label>Địa chỉ</label>
        <textarea name="address" style="width: 100%; padding: 8px;"><?= e(old('address')) ?></textarea>
    </div>

    <button type="submit" style="padding: 10px 20px; background: #28a745; color: white; border: none; cursor: pointer;">Lưu thông tin</button>
    <a href="/patients" style="margin-left: 10px;">Hủy</a>
</form>