<div class="navbar">
    <a href="/">Trang chủ</a>
    <a href="/public-patients/create" style="background: #28a745; padding: 5px 10px; border-radius: 4px;">Form Đăng ký (Public)</a>
    
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="/dashboard">Dashboard</a>
        <a href="/patients">Bệnh nhân</a>
        <a href="/appointments">Lịch hẹn</a>
        <form action="/logout" method="POST" style="display:inline; float:right;">
            <button type="submit" style="background:transparent; border:none; color:white; font-weight:bold; cursor:pointer;">
                Đăng xuất (<?= e($_SESSION['user_name']) ?>)
            </button>
        </form>
    <?php else: ?>
        <a href="/login" style="float:right;">Đăng nhập</a>
    <?php endif; ?>
    
</div>