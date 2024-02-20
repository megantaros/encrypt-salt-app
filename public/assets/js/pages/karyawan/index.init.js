$(document).ready(function () {
    localStorage.setItem("token", null);

    data_table = table_karyawan.DataTable({
        destroy: true,
        processing: false,
        serverSide: false,
        responsive: true,
        ajax: {
            url: url_get_karyawan,
            type: "GET",
        },
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari Karyawan",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            zeroRecords: "Data Karyawan tidak ditemukan",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            loadingRecords: showLoading(),
        },
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            {
                orderable: false,
                data: "nama_karyawan",
            },
            {
                orderable: false,
                data: "nama_jabatan",
            },
            {
                orderable: false,
                data: "created_at",
                render: function (data) {
                    return formatDate(data);
                },
            },
            {
                orderable: false,
                data: {
                    id: "id_karyawan",
                    nik: "nik",
                },
                render: function (data) {
                    return `
                    <button class="btn btn-sm btn-info btn-lihat" data-id="${data.id_karyawan}" data-nik="${data.nik}">
                        <i class="ti ti-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-warning btn-edit" data-id="${data.id_karyawan}" data-nik="${data.nik}">
                        <i class="ti ti-edit"></i>
                    </button>
                    `;
                },
            },
        ],
        drawCallback: function (settings) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
        initComplete: function (settings, json) {
            showLoading().close();
        },
    });

    function formatDate(date) {
        let dateObj = new Date(date);
        let day = dateObj.getDate();
        let month = dateObj.getMonth() + 1;
        let year = dateObj.getFullYear();

        return `${day}-${month}-${year}`;
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

    $(modal_add_karyawan)
        .find(".btn-add-karyawan")
        .on("click", async function (e) {
            e.preventDefault();

            let nama_karyawan = $(modal_add_karyawan)
                .find("#nama_karyawan")
                .val();
            let nik = $(modal_add_karyawan).find("#nik").val();
            let kk = $(modal_add_karyawan).find("#kk").val();
            let nip = $(modal_add_karyawan).find("#nip").val();
            let no_telpon = $(modal_add_karyawan).find("#no_telpon").val();
            let alamat = $(modal_add_karyawan).find("#alamat").val();
            let id_jabatan = $(modal_add_karyawan).find("#id_jabatan").val();
            let ktp = $(modal_add_karyawan).find("#ktp")[0].files[0];
            let password = $(modal_add_karyawan).find("#password").val();
            let password_confirmation = $(modal_add_karyawan)
                .find("#password_confirmation")
                .val();

            let formData = new FormData();
            formData.append("nama_karyawan", nama_karyawan);
            formData.append("nik", nik);
            formData.append("kk", kk);
            formData.append("nip", nip);
            formData.append("no_telpon", no_telpon);
            formData.append("alamat", alamat);
            formData.append("id_jabatan", id_jabatan);
            formData.append("ktp", ktp);
            formData.append("password", password);

            if (password !== password_confirmation) {
                Swal.fire({
                    title: "Gagal!",
                    text: "Password tidak sama!",
                    icon: "error",
                    showConfirmButton: false,
                });
                return;
            }

            if (ktp.size > 2000000) {
                Swal.fire({
                    title: "Gagal!",
                    text: "Ukuran file tidak boleh lebih dari 2MB!",
                    icon: "error",
                    showConfirmButton: false,
                });
                return;
            }

            $.ajax({
                type: "POST",
                url: url_add_karyawan,
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                beforeSend: function () {
                    showLoading();
                },
                success: function (response) {
                    if (response.status === "error") {
                        showLoading().close();
                        Swal.fire({
                            title: "Gagal!",
                            text: response.message,
                            icon: "error",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        return;
                    }

                    showLoading().close();
                    Swal.fire({
                        title: "Berhasil!",
                        text: response.message,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(() => {
                        $(modal_add_karyawan).find("#nama_karyawan").val("");
                        $(modal_add_karyawan).find("#nik").val("");
                        $(modal_add_karyawan).find("#kk").val("");
                        $(modal_add_karyawan).find("#nip").val("");
                        $(modal_add_karyawan).find("#no_telpon").val("");
                        $(modal_add_karyawan).find("#alamat").val("");
                        $(modal_add_karyawan).find("#id_jabatan").val("");
                        $(modal_add_karyawan).find("#ktp").val("");
                        $(modal_add_karyawan).find("#password").val("");
                        $(modal_add_karyawan)
                            .find("#password_confirmation")
                            .val("");
                        $(modal_add_karyawan).modal("hide");
                        data_table.ajax.reload();
                    });
                },
                error: function (xhr, status, error) {
                    modal_add_karyawan.modal("hide");
                    console.log(xhr.responseJSON);
                },
            });
        });

    table_karyawan.on("click", ".btn-lihat", function () {
        let id_karyawan = $(this).data("id");
        let nik = $(this).data("nik");

        modal_show_karyawan.find("#id_karyawan").val(id_karyawan);
        modal_show_karyawan.find("#nik").val(nik);
        modal_show_karyawan.modal("show");
    });

    table_karyawan.on("click", ".btn-edit", function () {
        let id_karyawan = $(this).data("id");
        let nik = $(this).data("nik");

        modal_edit_karyawan.find("#id_karyawan").val(id_karyawan);
        modal_edit_karyawan.find("#nik").val(nik);
        modal_edit_karyawan.modal("show");
    });

    table_karyawan.on("click", ".btn-delete", function () {
        let id_karyawan = $(this).data("id");
        let nik = $(this).data("nik");

        modal_delete_karyawan.find("#id_karyawan").val(id_karyawan);
        modal_delete_karyawan.find("#nik").val(nik);
        modal_delete_karyawan.modal("show");
    });

    async function ajaxAttempt(nik, password) {
        return new Promise((resolve, reject) => {
            try {
                $.ajax({
                    type: "POST",
                    url: url_login_karyawan,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    beforeSend: function () {
                        showLoading();
                    },
                    data: {
                        nik: nik,
                        password: password,
                    },
                    success: function (response) {
                        resolve(response);
                    },
                });
            } catch (error) {
                reject(error);
            }
        });
    }

    modal_show_karyawan.on("click", ".btn-login", function (e) {
        e.preventDefault();

        let id_karyawan = modal_show_karyawan.find("#id_karyawan").val();
        let nik = modal_show_karyawan.find("#nik").val();
        let password = modal_show_karyawan.find("#password").val();

        if (password === "") {
            Swal.fire({
                title: "Gagal!",
                text: "Password harus diisi!",
                icon: "error",
                showConfirmButton: false,
            });
            return;
        }

        ajaxAttempt(nik, password, modal_show_karyawan)
            .then((response) => {
                if (response.status === "success") {
                    console.log(response);
                    showLoading().close();
                    Swal.fire({
                        title: "Berhasil!",
                        text: response.message,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(() => {
                        modal_show_karyawan.find("#password").val("");
                        modal_show_karyawan.modal("hide");
                        window.location.href =
                            url_show_karyawan + "/" + id_karyawan;
                    });
                    localStorage.setItem(
                        "token",
                        JSON.stringify(response.token)
                    );
                } else {
                    showLoading().close();
                    Swal.fire({
                        title: "Gagal!",
                        text: response.message,
                        icon: "error",
                        showConfirmButton: false,
                    }).then(() => {
                        modal_show_karyawan.find("#password").val("");
                        modal_show_karyawan.modal("hide");
                    });
                }
            })
            .catch((err) => {
                showLoading().close();
                console.log(err);
            });
    });

    modal_edit_karyawan.on("click", ".btn-login", function (e) {
        e.preventDefault();

        let id_karyawan = modal_edit_karyawan.find("#id_karyawan").val();
        let nik = modal_edit_karyawan.find("#nik").val();
        let password = modal_edit_karyawan.find("#password").val();

        if (password === "") {
            Swal.fire({
                title: "Gagal!",
                text: "Password harus diisi!",
                icon: "error",
                showConfirmButton: false,
            });
            return;
        }

        ajaxAttempt(nik, password, modal_edit_karyawan)
            .then((response) => {
                if (response.status === "success") {
                    showLoading().close();
                    Swal.fire({
                        title: "Berhasil!",
                        text: response.message,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(() => {
                        modal_edit_karyawan.find("#password").val("");
                        modal_edit_karyawan.modal("hide");
                        window.location.href =
                            url_edit_karyawan + "/" + id_karyawan;
                    });

                    localStorage.setItem(
                        "token",
                        JSON.stringify(response.token)
                    );
                } else {
                    showLoading().close();
                    Swal.fire({
                        title: "Gagal!",
                        text: response.message,
                        icon: "error",
                        showConfirmButton: false,
                    }).then(() => {
                        modal_edit_karyawan.find("#password").val("");
                        modal_edit_karyawan.modal("hide");
                    });
                }
            })
            .catch((err) => {
                showLoading().close();
                console.log(err);
            });
    });

    // modal_delete_karyawan.on("click", ".btn-login", function (e) {
    //     e.preventDefault();

    //     let id_karyawan = modal_delete_karyawan.find("#id_karyawan").val();
    //     let nik = modal_delete_karyawan.find("#nik").val();
    //     let password = modal_delete_karyawan.find("#password").val();

    //     if (password === "") {
    //         Swal.fire({
    //             title: "Gagal!",
    //             text: "Password harus diisi!",
    //             icon: "error",
    //             showConfirmButton: false,
    //         });
    //         return;
    //     }

    //     ajaxAttempt(nik, password, modal_delete_karyawan)
    //         .then((response) => {
    //             if (response.status === "success") {
    //                 $.ajax({
    //                     type: "GET",
    //                     url: url_delete_karyawan + "/" + id_karyawan,
    //                     headers: {
    //                         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
    //                             "content"
    //                         ),
    //                     },
    //                     success: function (response) {
    //                         if (response.status === "error") {
    //                             showLoading().close();
    //                             Swal.fire({
    //                                 title: "Gagal!",
    //                                 text: response.message,
    //                                 icon: "error",
    //                                 showConfirmButton: false,
    //                             }).then(() => {
    //                                 modal_delete_karyawan
    //                                     .find("#password")
    //                                     .val("");
    //                                 modal_delete_karyawan.modal("hide");
    //                             });
    //                         }

    //                         if (response.status === "success") {
    //                             showLoading().close();
    //                             Swal.fire({
    //                                 title: "Berhasil!",
    //                                 text: response.message,
    //                                 icon: "success",
    //                                 showConfirmButton: false,
    //                                 timer: 1500,
    //                             }).then(() => {
    //                                 modal_delete_karyawan
    //                                     .find("#password")
    //                                     .val("");
    //                                 modal_delete_karyawan.modal("hide");
    //                                 data_table.ajax.reload();
    //                             });
    //                         }
    //                     },
    //                 });
    //             } else {
    //                 showLoading().close();
    //                 Swal.fire({
    //                     title: "Gagal!",
    //                     text: response.message,
    //                     icon: "error",
    //                     showConfirmButton: false,
    //                 }).then(() => {
    //                     modal_delete_karyawan.find("#password").val("");
    //                     modal_delete_karyawan.modal("hide");
    //                 });
    //             }
    //         })
    //         .catch((err) => {
    //             showLoading().close();
    //             console.log(err);
    //         });
    // });
});
