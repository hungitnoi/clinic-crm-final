<h2>Thêm Lịch hẹn</h2>
<form action="/appointments/store" method="POST" style="max-width: 500px; background: white; padding: 20px;">
    <label>Mã lịch hẹn *</label><br>
    <input type="text" name="appointment_code" value="<?= e(old('appointment_code')) ?>" style="width:100%; margin-bottom:10px;">
    <?php if(isset($errors['appointment_code'])): ?><span style="color:red;"><?= $errors['appointment_code'] ?></span><br><?php endif; ?>

    <label>Tên Bệnh nhân *</label><br>
    <input type="text" name="patient_name" value="<?= e(old('patient_name')) ?>" style="width:100%; margin-bottom:10px;">

    <label>Số điện thoại</label><br>
    <input type="text" name="patient_phone" value="<?= e(old('patient_phone')) ?>" style="width:100%; margin-bottom:10px;">

    <label>Ngày giờ hẹn * (VD: 2026-07-20 08:30:00)</label><br>
    <input type="datetime-local" name="appointment_date" value="<?= e(old('appointment_date')) ?>" style="width:100%; margin-bottom:10px;">

    <label>Trạng thái</label><br>
    <select name="status" style="width:100%; margin-bottom:10px;">
        <option value="pending">Chờ xác nhận</option>
        <option value="confirmed">Đã xác nhận</option>
        <option value="completed">Hoàn thành</option>
        <option value="cancelled">Đã hủy</option>
    </select>

    <label>Ghi chú</label><br>
    <textarea name="notes" style="width:100%; margin-bottom:15px;"><?= e(old('notes')) ?></textarea>

    <button type="submit" style="background:#007bff; color:white; padding:10px;">Lưu</button>
</form>