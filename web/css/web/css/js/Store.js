document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('saveStore');
    if (btn) {
        btn.addEventListener('click', () => {
            alert('Saving store...');
        });
    }
});
