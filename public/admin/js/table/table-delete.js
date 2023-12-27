document.addEventListener("DOMContentLoaded", function () {
    const tableBtnDelete = document.getElementById('table-btn-delete');
    const tableFormDelete = document.getElementById('table-form-delete');

    tableBtnDelete.addEventListener('click', function (e) {
        e.preventDefault();
        const isConfirmed = window.confirm('Bạn có chắc chắn muốn xóa bàn này ?');

        if (isConfirmed) {
            tableFormDelete.submit(); // Gửi biểu mẫu xóa nếu người dùng đồng ý.
        }
    });
});
