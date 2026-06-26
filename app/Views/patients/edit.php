<h2>Sửa thông tin Bệnh nhân</h2>

<form action="/patients/update" method="POST" style="max-width: 500px; background: white; padding: 20px; border-radius: 8px;">
    <input type="hidden" name="id" value="<?= e((string)$patient['id']) ?>">

    <div style="margin-bottom: 15px;">
        <label>Họ và Tên *</label>
        <input type="text" name="full_name" value="<?= e(old('full_name', $patient['full_name'])) ?>" style="width: 100%; padding: 8px;">
        <?php if(isset($errors['full_name'])): ?><span style="color:red; font-size: 14px;"><?= $errors['full_name'] ?></span><?php endif; ?>
    </div>
    
    <div style="margin-bottom: 15px;">
        <label>Email *</label>
        <input type="text" name="email" value="<?= e(old('email', $patient['email'])) ?>" style="width: 100%; padding: 8px;">
        <?php if(isset($errors['email'])): ?><span style="color:red; font-size: 14px;"><?= $errors['email'] ?></span><?php endif; ?>
    </div>

    <div style="margin-bottom: 15px;">
        <label>Số điện thoại</label>
        <input type="text" name="phone" value="<?= e(old('phone', $patient['phone'])) ?>" style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label>Giới tính</label>
        <select name="gender" style="width: 100%; padding: 8px;">
            <option value="male" <?= old('gender', $patient['gender']) === 'male' ? 'selected' : '' ?>>Nam</option>
            <option value="female" <?= old('gender', $patient['gender']) === 'female' ? 'selected' : '' ?>>Nữ</option>
            <option value="other" <?= old('gender', $patient['gender']) === 'other' ? 'selected' : '' ?>>Khác</option>
        </select>
    </div>

    <div style="margin-bottom: 15px;">
        <label>Địa chỉ</label>
        <textarea name="address" style="width: 100%; padding: 8px;"><?= e(old('address', $patient['address'])) ?></textarea>
    </div>

    <button type="submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer;">Cập nhật thông tin</button>
    <a href="/patients" style="margin-left: 10px;">Hủy</a>
</form>