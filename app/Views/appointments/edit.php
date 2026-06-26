<h2>Sửa Lịch hẹn</h2>
<form action="/appointments/update" method="POST" style="max-width: 500px; background: white; padding: 20px;">
    <input type="hidden" name="id" value="<?= e((string)$appt['id']) ?>">

    <label>Mã lịch hẹn *</label><br>
    <input type="text" name="appointment_code" value="<?= e(old('appointment_code', $appt['appointment_code'])) ?>" style="width:100%; margin-bottom:10px;">
    <?php if(isset($errors['appointment_code'])): ?><span style="color:red;"><?= $errors['appointment_code'] ?></span><br><?php endif; ?>

    <label>Tên Bệnh nhân *</label><br>
    <input type="text" name="patient_name" value="<?= e(old('patient_name', $appt['patient_name'])) ?>" style="width:100%; margin-bottom:10px;">

    <label>Số điện thoại</label><br>
    <input type="text" name="patient_phone" value="<?= e(old('patient_phone', $appt['patient_phone'])) ?>" style="width:100%; margin-bottom:10px;">

    <label>Ngày giờ hẹn *</label><br>
    <input type="datetime-local" name="appointment_date" value="<?= e(old('appointment_date', date('Y-m-d\TH:i', strtotime($appt['appointment_date'])))) ?>" style="width:100%; margin-bottom:10px;">

    <label>Trạng thái</label><br>
    <select name="status" style="width:100%; margin-bottom:10px;">
        <option value="pending" <?= old('status', $appt['status'])=='pending' ? 'selected':'' ?>>Chờ xác nhận</option>
        <option value="confirmed" <?= old('status', $appt['status'])=='confirmed' ? 'selected':'' ?>>Đã xác nhận</option>
        <option value="completed" <?= old('status', $appt['status'])=='completed' ? 'selected':'' ?>>Hoàn thành</option>
        <option value="cancelled" <?= old('status', $appt['status'])=='cancelled' ? 'selected':'' ?>>Đã hủy</option>
    </select>

    <label>Ghi chú</label><br>
    <textarea name="notes" style="width:100%; margin-bottom:15px;"><?= e(old('notes', $appt['notes'])) ?></textarea>

    <button type="submit" style="background:#007bff; color:white; padding:10px;">Cập nhật</button>
</form>