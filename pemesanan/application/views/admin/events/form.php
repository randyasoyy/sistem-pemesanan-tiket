<h3><?= isset($event) ? 'Edit' : 'Tambah' ?> Event</h3>
<form method="post">
    <input class="form-control mb-2" name="nama_event" placeholder="Nama Event" value="<?= isset($event)?$event->nama_event:'' ?>" required>
    <select class="form-control mb-2" name="kategori" required>
        <option value="konser" <?= (isset($event)&&$event->kategori=='konser')?'selected':'' ?>>Konser</option>
        <option value="bioskop" <?= (isset($event)&&$event->kategori=='bioskop')?'selected':'' ?>>Bioskop</option>
        <option value="transportasi" <?= (isset($event)&&$event->kategori=='transportasi')?'selected':'' ?>>Transportasi</option>
    </select>
    <input class="form-control mb-2" name="lokasi" placeholder="Lokasi" value="<?= isset($event)?$event->lokasi:'' ?>" required>
    <input class="form-control mb-2" type="datetime-local" name="tanggal" value="<?= isset($event)?date('Y-m-d\TH:i',strtotime($event->tanggal)):'' ?>" required>
    <input class="form-control mb-2" type="number" name="harga" placeholder="Harga" value="<?= isset($event)?$event->harga:'' ?>" required>
    <input class="form-control mb-2" type="number" name="stok" placeholder="Stok" value="<?= isset($event)?$event->stok:'' ?>" required>
    <textarea class="form-control mb-2" name="deskripsi" placeholder="Deskripsi"><?= isset($event)?$event->deskripsi:'' ?></textarea>
    <button class="btn btn-primary">Simpan</button>
</form>