$(document).ready(function () {
    const token = JSON.parse(localStorage.getItem("token"));
    const session_edit = JSON.parse(localStorage.getItem("session_edit"));

    if (
        session_edit === "" ||
        session_edit === null ||
        session_edit === md5(id_karyawan)
    ) {
        $(".row").find("input").attr("disabled", true);
        $(".row").find("select").attr("disabled", true);
        $(".row").find("textarea").attr("disabled", true);
        btn_update.attr("disabled", true);
        btn_delete.attr("disabled", true);
        btn_edit_gaji.attr("disabled", true);
    }

    function showLoading() {
        const loading = Swal.fire({
            showConfirmButton: false,
            allowOutsideClick: false,
            background: "transparent",
            backdrop: "rgba(0,0,0,0.8)",
            html: '<div class="spinner-grow spinner-grow-lg text-secondary my-3" role="status" style="width: 3rem; height: 3rem;"><span class="visually-hidden">Loading...</span></div>',
        });
        return loading;
    }

    function formatDate(date) {
        let dateObj = new Date(date);
        let day = dateObj.getDate();
        let month = dateObj.getMonth() + 1;
        let year = dateObj.getFullYear();

        return `${day}-${month}-${year}`;
    }

    if (token === null) {
        Swal.fire({
            title: "Akses Ditolak",
            text: "Silahkan login karyawan terlebih dahulu",
            icon: "error",
            confirmButtonText: "Mengerti",
            confirmButtonColor: "#FA896B",
            showConfirmButton: false,
            backdrop: "rgba(0,0,0,1)",
            timer: 2000,
        }).then(function () {
            window.location.href = route_index;
        });
    }

    btn_update.on("click", function (e) {
        e.preventDefault();

        let nama_karyawan = $("#nama_karyawan").val();
        let id_jabatan = $("#nama_jabatan").val();
        let nip = $("#nip").val();
        let nik = $("#nik").val();
        let kk = $("#kk").val();
        let no_telpon = $("#no_telpon").val();
        let alamat = $("#alamat").val();
        let password = $("#password").val();
        // let salt = $("#salt").val();

        // if (password.length < 8) {
        //     showLoading().close();
        //     Swal.fire({
        //         icon: "error",
        //         title: "Gagal",
        //         text: "Password minimal 8 karakter",
        //     });
        //     return;
        // }

        if (
            nama_karyawan == "" ||
            id_jabatan == "" ||
            nip == "" ||
            nik == "" ||
            kk == "" ||
            no_telpon == "" ||
            alamat == ""
        ) {
            Swal.fire({
                icon: "error",
                title: "Gagal",
                text: "Semua inputan harus diisi",
                showConfirmButton: false,
                timer: 1500,
            });
            return;
        }

        $.ajax({
            type: "PUT",
            url: url_update_karyawan,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {
                showLoading();
            },
            dataType: "json",
            data: {
                nama_karyawan: nama_karyawan,
                id_jabatan: id_jabatan,
                nik: nik,
                nip: nip,
                kk: kk,
                no_telpon: no_telpon,
                alamat: alamat,
                password: password ? password : null,
            },
            success: function (response) {
                try {
                    if (response.status === "success") {
                        showLoading().close();
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false,
                        });

                        nama_karyawan = $("#nama_karyawan").val(
                            response.data.nama_karyawan
                        );
                        nama_jabatan = $("#nama_jabatan").val(
                            response.data.id_jabatan
                        );
                        nip = $("#nip").val(response.data.nip);
                        nik = $("#nik").val(response.data.nik);
                        kk = $("#kk").val(response.data.kk);
                        no_telpon = $("#no_telpon").val(
                            response.data.no_telpon
                        );
                        alamat = $("#alamat").val(response.data.alamat);
                        password = $("#password").val("");
                        // salt = $("#salt").val(response.data.salt);

                        localStorage.removeItem("session_edit");
                    }

                    if (response.status === "error") {
                        showLoading().close();
                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: response.message,
                            showConfirmButton: false,
                        });
                        return;
                    }
                } catch (error) {
                    showLoading().close();
                    console.error(error);
                    return;
                }
            },
        });
    });

    btn_delete.on("click", function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: url_delete_karyawan,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    beforeSend: function () {
                        showLoading();
                    },
                    success: function (response) {
                        if (response.status === "success") {
                            showLoading().close();
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil",
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false,
                            }).then(() => {
                                window.location.href = route_index;

                                localStorage.removeItem("session_edit");
                            });
                        }

                        if (response.status === "error") {
                            showLoading().close();
                            Swal.fire({
                                icon: "error",
                                title: "Gagal",
                                text: response.message,
                                showConfirmButton: false,
                            });
                            return;
                        }
                    },
                    error: function (xhr, status, error) {
                        showLoading().close();
                        console.error(xhr.responseText);
                    },
                });
            }
        });
    });

    input_ktp.on("change", function (e) {
        e.preventDefault();

        let imgKtp = $("#imgKtp");
        imgKtp.attr("src", URL.createObjectURL(e.target.files[0]));

        let fileName = $("#fileName");
        fileName.text(e.target.files[0].name);

        var formData = new FormData();
        formData.append("ktp", $(this)[0].files[0]);
        formData.append("_method", "PUT");
        formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

        $.ajax({
            type: "POST",
            url: "{{route('karyawan.update', ['id' => $karyawan->id_karyawan ])}}",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                showLoading();
            },
            success: function (response) {
                if (response.status == "success") {
                    showLoading().close();
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false,
                    });

                    localStorage.removeItem("session_edit");
                } else {
                    showLoading().close();
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: response.message,
                        showConfirmButton: false,
                    });
                }
            },
            error: function (xhr, status, error) {
                showLoading().close();
                console.error(xhr.responseText);
            },
        });
    });

    data_table = table_perizinan.DataTable({
        destroy: true,
        processing: false,
        serverSide: false,
        responsive: true,
        ajax: {
            url: url_get_perizinan,
            type: "GET",
        },
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari Perizinan",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            zeroRecords: "Data Perizinan tidak ditemukan",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            loadingRecords: showLoading(),
        },
        columns: [
            { orderable: false, data: "nama_admin", name: "nama_admin" },
            { orderable: false, data: "perihal", name: "perihal" },
            {
                orderable: false,
                data: "bukti",
                name: "bukti",
                render: function (data, type, row) {
                    return `<p class="fw-bold m-0">${data}</p>`;
                },
            },
            {
                orderable: false,
                data: "created_at",
                name: "created_at",
                render: function (data, type, row) {
                    return formatDate(data);
                },
            },
            {
                orderable: false,
                data: "bukti",
                name: "bukti",
                render: function (data, type, row) {
                    return `<a href="${url_bukti_perizinan}/${data}" target="_blank" class="btn btn-sm btn-info">
                    <i class="ti ti-eye"></i>
                    </a>`;
                },
            },
        ],
        initComplete: function (settings, json) {
            showLoading().close();
        },
    });

    form_perizinan.on("submit", function (e) {
        e.preventDefault();

        let perihal = $("#perihal").val();
        let bukti = $("#bukti")[0].files[0];

        if (perihal == "" || bukti == "") {
            Swal.fire({
                icon: "error",
                title: "Gagal",
                text: "Semua inputan harus diisi",
                showConfirmButton: false,
                timer: 1500,
            });
            return;
        }

        var formData = new FormData();
        formData.append("id_admin", id_admin);
        formData.append("id_karyawan", id_karyawan);
        formData.append("perihal", perihal);
        formData.append("bukti", bukti);

        $.ajax({
            type: "POST",
            url: url_add_perizinan,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                showLoading();
            },
            success: function (response) {
                if (response.status === "success") {
                    showLoading().close();
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false,
                    }).then(function () {
                        modal_perizinan.modal("hide");
                        data_table.ajax.reload();

                        localStorage.setItem(
                            "session_edit",
                            JSON.stringify(md5(response.data.id_karyawan))
                        );

                        $(".row").find("input").attr("disabled", false);
                        $(".row").find("select").attr("disabled", false);
                        $(".row").find("textarea").attr("disabled", false);
                        btn_update.attr("disabled", false);
                        btn_delete.attr("disabled", false);
                        btn_edit_gaji.attr("disabled", false);
                    });
                }

                if (response.status === "error") {
                    showLoading().close();
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: response.message,
                        showConfirmButton: false,
                    });
                    return;
                }
            },
            error: function (xhr, status, error) {
                showLoading().close();
                console.error(xhr.responseText);
            },
        });
    });

    modal_add_gaji.find("#nama_karyawan").val(nama_karyawan);
    modal_edit_gaji.find("#nama_karyawan").val(nama_karyawan);

    btn_add_gaji.on("click", function (e) {
        e.preventDefault();

        let gaji_pokok = modal_add_gaji.find("#gaji_pokok").val();

        if (gaji_pokok == "") {
            Swal.fire({
                icon: "error",
                title: "Gagal",
                text: "Semua inputan harus diisi",
                showConfirmButton: false,
                timer: 1500,
            });
            return;
        }

        $.ajax({
            type: "POST",
            url: url_add_gaji,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                id_karyawan: id_karyawan,
                gaji_pokok: gaji_pokok,
            },
            beforeSend: function () {
                showLoading();
            },
            success: function (response) {
                if (response.status === "success") {
                    showLoading().close();
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false,
                    }).then(function () {
                        modal_add_gaji.modal("hide");
                        window.location.reload();
                        // drawer_gaji
                        //     .find("h6")
                        //     .text(formatRupiah(gaji_pokok, "Rp. "));
                    });
                }

                if (response.status === "error") {
                    showLoading().close();
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: response.message,
                        showConfirmButton: false,
                    });
                    return;
                }
            },
            error: function (xhr, status, error) {
                showLoading().close();
                console.error(xhr.responseText);
            },
        });
    });

    btn_edit_gaji.on("click", function (e) {
        e.preventDefault();

        let gaji_pokok = modal_edit_gaji.find("#gaji_pokok").val();

        if (gaji_pokok == "") {
            Swal.fire({
                icon: "error",
                title: "Gagal",
                text: "Semua inputan harus diisi",
                showConfirmButton: false,
                timer: 1500,
            });
            return;
        }

        $.ajax({
            type: "PUT",
            url: url_edit_gaji + `/${id_slip_gaji}`,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                id_karyawan: id_karyawan,
                gaji_pokok: gaji_pokok,
            },
            beforeSend: function () {
                showLoading();
            },
            success: function (response) {
                if (response.status === "success") {
                    showLoading().close();
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false,
                    }).then(function () {
                        modal_edit_gaji.modal("hide");
                        localStorage.removeItem("session_edit");
                        window.location.reload();
                    });
                }

                if (response.status === "error") {
                    showLoading().close();
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: response.message,
                        showConfirmButton: false,
                    });
                    return;
                }
            },
            error: function (xhr, status, error) {
                showLoading().close();
                console.error(xhr.responseText);
            },
        });
    });
});
