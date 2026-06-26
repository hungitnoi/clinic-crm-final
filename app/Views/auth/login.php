<div style="max-width: 400px; margin: 0 auto;">
    <h2>Đăng nhập Hệ thống</h2>
    <form action="/login" method="POST">
        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Email:</label>
            <input type="email" name="email" value="<?= e(old('email')) ?>" required 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>
        
        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Mật khẩu:</label>
            <input type="password" name="password" required 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>
        
        <button type="submit" style="width: 100%; padding: 10px; background: #1a73e8; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
            Đăng nhập
        </button>
    </form>
</div>