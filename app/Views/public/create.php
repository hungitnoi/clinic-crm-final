<div style="max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <h2 style="text-align: center; color: #1a73e8;">Đăng Ký Khám Bệnh Trực Tuyến</h2>
    <p style="text-align: center; margin-bottom: 20px;">Vui lòng điền thông tin bên dưới. Dữ liệu của bạn được bảo mật tuyệt đối.</p>

    <form action="/public-patients/store" method="POST">
        <div style="display:none;">
            <label>If you are human, leave this blank:</label>
            <input type="text" name="website_url" value="">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Họ và Tên *</label>
            <input type="text" name="full_name" value="<?= e(old('full_name')) ?>" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            <?php if(isset($errors['full_name'])): ?><span style="color:red; font-size: 14px;"><?= $errors['full_name'] ?></span><?php endif; ?>
        </div>
        
        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Email *</label>
            <input type="text" name="email" value="<?= e(old('email')) ?>" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            <?php if(isset($errors['email'])): ?><span style="color:red; font-size: 14px;"><?= $errors['email'] ?></span><?php endif; ?>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Số điện thoại</label>
            <input type="text" name="phone" value="<?= e(old('phone')) ?>" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Giới tính</label>
            <select name="gender" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                <option value="male" <?= old('gender') === 'male' ? 'selected' : '' ?>>Nam</option>
                <option value="female" <?= old('gender') === 'female' ? 'selected' : '' ?>>Nữ</option>
                <option value="other" <?= old('gender', 'other') === 'other' ? 'selected' : '' ?>>Khác</option>
            </select>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Địa chỉ</label>
            <textarea name="address" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"><?= e(old('address')) ?></textarea>
        </div>

        <button type="submit" style="width: 100%; padding: 12px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold;">
            Gửi Đăng Ký
        </button>
    </form>
</div>