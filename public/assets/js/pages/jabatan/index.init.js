$(document).ready(function () {
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

    data_table = table_jabatan.DataTable({
        destroy: true,
        processing: false,
        serverSide: false,
        responsive: true,
        ajax: {
            url: url_get_jabatan,
            type: "GET",
        },
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari Jabatan",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            zeroRecords: "Data Jabatan tidak ditemukan",
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
                data: "id_jabatan",
                render: function (data) {
                    return `
                    <button class="btn btn-sm btn-warning btn-edit" data-id="${data}">
                        <i class="ti ti-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-danger btn-delete" data-id="${data}">
                        <i class="ti ti-trash"></i>
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

    modal_add_jabatan.on("click", ".btn-add-jabatan", async (e) => {
        e.preventDefault();

        let nama_jabatan = modal_add_jabatan.find("#nama_jabatan").val();

        if (nama_jabatan == "") {
            Swal.fire({
                title: "Gagal!",
                text: "Nama jabatan tidak boleh kosong",
                icon: "error",
                showConfirmButton: false,
            });
            return;
        }

        let formData = new FormData();
        formData.append("nama_jabatan", nama_jabatan);

        $.ajax({
            type: "POST",
            url: url_add_jabatan,
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
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
                    modal_add_jabatan.modal("hide");
                    data_table.ajax.reload();
                });
            },
            error: function (xhr, status, error) {
                modal_add_jabatan.modal("hide");
                console.log(xhr.responseJSON);
            },
        });
    });

    table_jabatan.on("click", ".btn-edit", async function () {
        showLoading();
        let id_jabatan = $(this).data("id");

        let response = await fetch(url_show_jabatan + `/${id_jabatan}`);
        let data = await response.json();

        if (data) {
            showLoading().close();
            modal_edit_jabatan.find("#id_jabatan").val(id_jabatan);
            modal_edit_jabatan
                .find("#nama_jabatan")
                .val(data.data.nama_jabatan);
            modal_edit_jabatan.modal("show");
        }
    });

    modal_edit_jabatan.on("click", ".btn-edit-jabatan", async (e) => {
        e.preventDefault();

        let id_jabatan = modal_edit_jabatan.find("#id_jabatan").val();
        let nama_jabatan = modal_edit_jabatan.find("#nama_jabatan").val();

        if (nama_jabatan == "") {
            Swal.fire({
                title: "Gagal!",
                text: "Nama jabatan tidak boleh kosong",
                icon: "error",
                showConfirmButton: false,
            });
            return;
        }

        let formData = new FormData();
        formData.append("_method", "PUT");
        formData.append("nama_jabatan", nama_jabatan);

        $.ajax({
            type: "POST",
            url: url_edit_jabatan + `/${id_jabatan}`,
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
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
                    modal_edit_jabatan.modal("hide");
                    data_table.ajax.reload();
                });
            },
            error: function (xhr, status, error) {
                modal_edit_jabatan.modal("hide");
                console.log(xhr.responseJSON);
            },
        });
    });

    table_jabatan.on("click", ".btn-delete", function () {
        let id_jabatan = $(this).data("id");

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: url_delete_jabatan + `/${id_jabatan}`,
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
                            data_table.ajax.reload();
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseJSON);
                    },
                });
            }
        });
    });
});
