<?php
/**
 * Mumer Room - Inquiry Form Component
 * Simple inquiry form for unit availability
 */

$roomTypes = getAllRoomTypes();
$csrfToken = generateCsrfToken();
?>
<div class="booking-form-container" id="bookingFormContainer">
    <div class="booking-card">
        <h3 class="booking-title">Tanya Ketersediaan Unit</h3>

        <form id="inquiryForm" class="booking-form" action="<?php echo WHATSAPP_URL; ?>" method="GET" target="_blank">
            <div class="form-group">
                <label for="inquiry_type">Tipe Unit *</label>
                <select id="inquiry_type" name="unit_type" required>
                    <option value="">Pilih tipe unit</option>
                    <?php foreach ($roomTypes as $type): ?>
                        <option value="<?php echo htmlspecialchars($type['name']); ?>">
                            <?php echo htmlspecialchars($type['name'] . ' - ' . $type['type']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="inquiry_check_in">Rencana Check-in *</label>
                    <input type="date" id="inquiry_check_in" name="check_in" required min="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group">
                    <label for="inquiry_duration">Durasi *</label>
                    <select id="inquiry_duration" name="duration" required>
                        <option value="">Pilih durasi</option>
                        <option value="Harian">Harian</option>
                        <option value="Mingguan">Mingguan</option>
                        <option value="Bulanan">Bulanan</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="inquiry_name">Nama Lengkap *</label>
                <input type="text" id="inquiry_name" name="name" required placeholder="Masukkan nama lengkap Anda">
            </div>

            <div class="form-group">
                <label for="inquiry_phone">Nomor WhatsApp *</label>
                <input type="tel" id="inquiry_phone" name="phone" required placeholder="+62 8xx-xxxx-xxxx">
            </div>

            <div class="form-group">
                <label for="inquiry_message">Pesan Tambahan</label>
                <textarea id="inquiry_message" name="message" rows="3" placeholder="Kebutuhan khusus atau catatan..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg" onclick="sendInquiry(event)">Kirim via WhatsApp</button>

            <p class="booking-note">
                <small>* Anda akan diarahkan ke WhatsApp untuk mengirimkan pertanyaan.</small>
            </p>
        </form>
    </div>
</div>

<script>
function sendInquiry(event) {
    event.preventDefault();

    const unitType = document.getElementById('inquiry_type').value;
    const checkIn = document.getElementById('inquiry_check_in').value;
    const duration = document.getElementById('inquiry_duration').value;
    const name = document.getElementById('inquiry_name').value;
    const phone = document.getElementById('inquiry_phone').value;
    const message = document.getElementById('inquiry_message').value;

    if (!unitType || !checkIn || !duration || !name || !phone) {
        alert('Mohon isi semua kolom yang wajib diisi.');
        return;
    }

    let whatsappMessage = `Halo Mumer Room, saya ingin menanyakan ketersediaan unit.\n\n`;
    whatsappMessage += `Nama: ${name}\n`;
    whatsappMessage += `Nomor WhatsApp: ${phone}\n`;
    whatsappMessage += `Tipe Unit: ${unitType}\n`;
    whatsappMessage += `Tanggal Check-in: ${checkIn}\n`;
    whatsappMessage += `Durasi: ${duration}\n`;
    if (message) {
        whatsappMessage += `Pesan Tambahan: ${message}\n`;
    }
    whatsappMessage += `\nMohon informasi mengenai ketersediaan dan harga.\n\n`;
    whatsappMessage += `Terima kasih.`;

    const whatsappUrl = '<?php echo WHATSAPP_URL; ?>?text=' + encodeURIComponent(whatsappMessage);
    window.open(whatsappUrl, '_blank');
}
</script>
