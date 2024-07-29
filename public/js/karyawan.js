$(document).ready(function () {
    $('#karyawanModal form').submit(function (e) {
        e.preventDefault(); // Mencegah form dari submit secara default
        
        var formData = $(this).serialize();
        var actionUrl = $(this).attr('action');

        axios.post(actionUrl, formData)
            .then(function (response) {
                // Tanggapan sukses
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.data.message || 'Data berhasil disimpan',
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true
                }).then(() => {
                    $('#karyawanModal').modal('hide');
                    // Refresh data
                    $('#table-data').load(location.href + ' #table-data');
                });
            })
            .catch(function (error) {
                // Tanggapan error
                let errorMessage = 'Terjadi kesalahan!';
                if (error.response && error.response.data && error.response.data.errors) {
                    // Ambil pesan error dari respons server
                    const errors = error.response.data.errors;
                    errorMessage = Object.values(errors).flat().join(', '); // Menggabungkan semua pesan error
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: errorMessage,
                });
            });
    });
});
