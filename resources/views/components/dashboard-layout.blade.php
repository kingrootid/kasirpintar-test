<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets') }}/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/custom.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" integrity="sha512-PT0RvABaDhDQugEbpNMwgYBCnGCiTZMh9yOzUsJHDgl/dMhD9yjHAwoumnUk3JydV3QTcIkNDuN40CJxik5+WQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }} <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if(auth()->user()->role == "DIREKTUR")
            <li class="nav-item">
                <a class="nav-link" href="{{ url('users') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>User Management</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->role !== "STAFF")
            <li class="nav-item">
                <a class="nav-link" href="{{ url('reimbursement') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Reimbursement Management</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ url('request-reimbursement') }}">
                    <i class="fa-solid fa-money-check-dollar fa-fw"></i>
                    <span>Reimbursement</span>
                </a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('assets') }}/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    {{ $slot }}

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ url('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets') }}/js/sb-admin-2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{ $script }}
    <script>
        var token = "{{ csrf_token() }}"
        const url = "{{ url('') }}"

        function openForm(action) {
            $(".action").fadeIn().css('display', 'block');
            $('.card-add').addClass('hide')
            $('.card-edit').addClass('hide')
            $(`.card-${action}`).removeClass('hide');
        }

        function closeForm() {
            $(".action").fadeOut().css('display', 'block');
            $('.card-add').addClass('hide')
            $('.card-edit').addClass('hide')
        }
        $("#add, #edit").submit(function(event) {
            const baseUrl = $(this).attr('action')
            event.preventDefault();
            var form = new FormData(this);
            form.append('_token', token);
            axios.post(baseUrl, form)
                .then(response => {
                    closeForm()
                    if (response.data.status) {
                        setTimeout(function() {
                            swal.fire({
                                text: response.data.message,
                                icon: 'success',
                                buttonsStyling: false,
                                confirmButtonText: 'Ok, got it!',
                                customClass: {
                                    confirmButton: 'btn font-weight-bold btn-primary',
                                },
                            }).then(function() {
                                closeForm()
                                table.ajax.reload();
                            });
                        }, 200);
                    } else {
                        setTimeout(function() {
                            swal.fire({
                                text: response.data.message,
                                icon: 'error',
                                buttonsStyling: false,
                                confirmButtonText: 'Ok lets check',
                                customClass: {
                                    confirmButton: 'btn font-weight-bold btn-danger',
                                },
                            });
                        }, 200);
                    }
                })
                .catch(error => {
                    setTimeout(function() {
                        swal.fire({
                            text: error.response.data.message,
                            icon: 'error',
                            buttonsStyling: false,
                            confirmButtonText: 'Ok lets check',
                            customClass: {
                                confirmButton: 'btn font-weight-bold btn-danger',
                            },
                        });
                    }, 200)
                });
        })

        function edit(moduleName, id) {
            openForm('edit');
            $.ajax({
                type: "POST",
                dataType: "json",
                url: `${url}/data/${moduleName}`,
                data: {
                    _token: token,
                    id
                },
                success: function(data) {
                    for (const prop in data.data) {
                        console.log("🚀 ~ edit ~ prop:", prop)
                        if (prop == "image") {
                            $(".edit-file-preview").attr('src', `${data.data[prop]}`)
                        }
                        if (prop == "deskripsi") {
                            $("#edit_deskripsi").html(data.data[prop])
                        }
                        $(`#edit_${prop}`).val(data.data[prop]);
                    }
                    console.log("🚀 ~ edit ~ data:", data)
                }
            })
        }

        function hapus(moduleName, id) {
            Swal.fire({
                icon: 'question',
                title: 'Konfirmasi',
                text: "Anda yakin menghapus data Tersebut ?",
                showCancelButton: true,
                confirmButtonText: "Iya",
                cancelButtonText: "Tidak",
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var form = new FormData();
                    form.append('_token', token);
                    form.append('id', id)
                    form.append('module', moduleName)
                    axios.post(`${url}/ajax/hapus`, form)
                        .then(response => {
                            if (response.data.status) {
                                setTimeout(function() {
                                    swal.fire({
                                        text: response.data.message,
                                        icon: 'success',
                                        buttonsStyling: false,
                                        confirmButtonText: 'Ok, got it!',
                                        customClass: {
                                            confirmButton: 'btn font-weight-bold btn-primary',
                                        },
                                    }).then(function() {
                                        table.ajax.reload();
                                    });
                                }, 200);
                            } else {
                                setTimeout(function() {
                                    swal.fire({
                                        text: response.data.message,
                                        icon: 'error',
                                        buttonsStyling: false,
                                        confirmButtonText: 'Ok lets check',
                                        customClass: {
                                            confirmButton: 'btn font-weight-bold btn-danger',
                                        },
                                    });
                                }, 200);
                            }
                        })
                        .catch(error => {
                            setTimeout(function() {
                                swal.fire({
                                    text: error.message,
                                    icon: 'error',
                                    buttonsStyling: false,
                                    confirmButtonText: 'Ok lets check',
                                    customClass: {
                                        confirmButton: 'btn font-weight-bold btn-danger',
                                    },
                                });
                            }, 200)
                        });
                }
            });
        }
        const photoInp = $(".file-upload");
        let file;
        photoInp.change(function(e) {
            file = this.files[0];
            const data = $(this).data('type');
            console.log("🚀 ~ photoInp.change ~ data:", data)
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    if (data == "add") {
                        $(".add-file-preview").attr('src', event.target.result)
                    } else if (data == "edit") {
                        $(".edit-file-preview").attr('src', event.target.result)
                    }
                };
                reader.readAsDataURL(file);
            }
        });

        function callendpoint(moduleName, form) {
            axios.post(`${url}/ajax/${moduleName}`, form)
                .then(response => {
                    if (response.data.status) {
                        setTimeout(function() {
                            swal.fire({
                                text: response.data.message,
                                icon: 'success',
                                buttonsStyling: false,
                                confirmButtonText: 'Ok, got it!',
                                customClass: {
                                    confirmButton: 'btn font-weight-bold btn-primary',
                                },
                            }).then(function() {
                                table.ajax.reload();
                            });
                        }, 200);
                    } else {
                        setTimeout(function() {
                            swal.fire({
                                text: response.data.message,
                                icon: 'error',
                                buttonsStyling: false,
                                confirmButtonText: 'Ok lets check',
                                customClass: {
                                    confirmButton: 'btn font-weight-bold btn-danger',
                                },
                            });
                        }, 200);
                    }
                })
                .catch(error => {
                    setTimeout(function() {
                        swal.fire({
                            text: error.message,
                            icon: 'error',
                            buttonsStyling: false,
                            confirmButtonText: 'Ok lets check',
                            customClass: {
                                confirmButton: 'btn font-weight-bold btn-danger',
                            },
                        });
                    }, 200)
                });
        }
    </script>
</body>

</html>