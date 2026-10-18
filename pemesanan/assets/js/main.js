document.addEventListener('DOMContentLoaded', function () {

    
    document.querySelectorAll('[data-toggle-pwd]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const input = document.getElementById(btn.getAttribute('data-toggle-pwd'));
            if (!input) return;
            input.type = input.type === 'password' ? 'text' : 'password';
        });
    });

    
    const inputJumlah = document.getElementById('jumlah');
    const hargaAttr = document.getElementById('harga-satuan');

    if (inputJumlah && hargaAttr) {
        const harga = parseInt(hargaAttr.value);
        const qtyDisplay = document.getElementById('qty_display');
        const totalDisplay = document.getElementById('total_display');

        const updateTotal = function () {
            const qty = parseInt(inputJumlah.value) || 0;
            if (qtyDisplay) qtyDisplay.innerText = qty;
            if (totalDisplay) {
                totalDisplay.innerText = 'Rp ' + (qty * harga).toLocaleString('id-ID');
            }
        };

        inputJumlah.addEventListener('input', updateTotal);
        inputJumlah.addEventListener('change', updateTotal);
        updateTotal();
    }

    
    document.querySelectorAll('[data-confirm]').forEach(function (el) {
        el.addEventListener('click', function (e) {
            if (!confirm(el.getAttribute('data-confirm') || 'Yakin?')) {
                e.preventDefault();
            }
        });
    });

    
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function () {
            document.querySelector('.admin-sidebar').classList.toggle('show');
        });
    }
});