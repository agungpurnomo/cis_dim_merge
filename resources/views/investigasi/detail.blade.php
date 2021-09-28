@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.3/css/rowGroup.dataTables.min.css">
@endsection

@section('js_after')
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/oneui.app.js') }}"></script>
    <script src="{{ asset('js/plugins/es6-promise/es6-promise.auto.min.js') }}"></script>
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  
    
    
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.colVis.min.js') }}"></script>

    <!-- <script src="{{ asset('js/plugins/es6-promise/es6-promise.auto.min.js') }}"></script>
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script> -->
    <!-- Page JS Code -->
    <!-- <script src="{{ asset('js/pages/tables_datatables.js') }}"></script> -->
    <script>One.helpersOnLoad(['js-flatpickr']);</script>
    <script src="{{ asset('js/pages/be_comp_dialogs.min.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- UPLOAD FOTO -->
    <script type="text/javascript">
    $('body').on("click",".btn-upload",function(){
        var id = $(this).attr("id");
        console.log(id);
        $(".btn-upload").attr("id",id);
        $("#modal-upload").modal("show");
    });

    $(document).ready(function (e) {
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#multiple-image-preview-ajax').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            let TotalImages = $('#images')[0].files.length; //Total Images
            let images = $('#images')[0];
            for (let i = 0; i < TotalImages; i++) {
                formData.append('images' + i, images.files[i]);
            }
            formData.append('TotalImages', TotalImages);
            $.ajax({
                type:'POST',
                url: "{{ url('upload')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    One.helpers('jq-notify', 
                    {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil diupload!'});
                    $("#modal-upload").modal("hide");
                    $('.show-multiple-image-preview').html("")
                    },
                error: function(data){
                console.log(data);
                }
            });
        });
    });
    </script>

    <script>
        $(document).ready(function()
        {   
            listUpdate()
        });

        //LIST UPDATE INVESTIGASI
        function listUpdate(){
            var html = '<div></div>';
            var id = $(this).attr("id");
            console.log(id);
            $('.js-dataTable-list').dataTable({
                pageLength: 10,
                lengthMenu: [[10, 20, 30, 40], [10, 20, 30, 40]],
                autoWidth: false,
                ajax: '{{ url("getdetail") }}'+ '/' + id,
                columns: [
                    {data: 'DT_RowIndex' , name: 'id', width: '5%'},
                    {data: 'update_investigasi', name: 'update_investigasi'},
                    {data: 'kategori_investigasi', name: 'kategori_investigasi'},
                    {data: 'tanggal', name: 'tanggal'},
                    {data: 'action', name: 'action', orderable: false, searchable: true,width: '5%' },
                ],
                order: [[2, 'asc']],
                rowGroup: {
                    dataSrc: 'kategori_investigasi'
                }
            });
        }

        //EDIT MODAL UPDATE INVEST
        //Edit & Update
        $('body').on("click",".btn-edit",function(){
            var id = $(this).attr("id");
            $('#form_result').html('');
            console.log(id);
            $.ajax({
                url: "/updateinvestigasi/"+id+"/edit",
                method: "GET",
                dataType : "json",
                success:function(html){
                    $("#modal-editupdateinvest").modal("show")
                    $("#id").val(html.data.id)
                    $("#edittgl").val(html.data.tanggal)
                    $("#editket").val(html.data.update_investigasi)
                }
            });
        });

        $("#editFormInvest").on("submit",function(e){
            e.preventDefault()
            var id = $("#id").val()
            var dt = $(this).serialize();
            console.log(id);
            console.log(dt);
            $.ajax({
                url: "/updateinvestigasi/"+id,
                method: "PATCH",
                data: $(this).serialize(),
                success:function(){
                    $('.js-dataTable-list').DataTable().ajax.reload();
                    $("#modal-editupdateinvest").modal("hide")
                    One.helpers('jq-notify', 
                        {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil diupdate!'});
                }
            })
        })
        //Edit & Update



        $('body').on("click",".btn-delete",function(){
            var ids = $(this).attr("id");
            var id = $('#id').text();
            console.log(id);
            // console.log(ids);
            $(".btn-destroy").attr("id",id);
            $("#destroy-modalLabel").text("Yakin Hapus Data :");
            $("#modal-delete").modal("show");
        });

        $(".btn-destroy").on("click",function(){
            var ids = $(this).attr("id")
            var id = $('#id').text();
            $.ajax({
                // url: "investigasi/"+id,
                url: "{{ route('investigasi') }}"+ '/' + id,
                method : 'DELETE',
                success:function(){
                    $("#modal-delete").modal("hide")   
                    One.helpers('jq-notify', 
                    {type: 'danger', icon: 'fa fa-check me-1', message: 'Berhasil dihapus!'});
                    window.location.href = "/investigasi";
                },
                error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                alert('Jenis klaim tidak bisa dihapus! Sudah digunakan di investigasi');
                },
            });
        })

        $("#createForm").on("submit",function(e){
            e.preventDefault()
            var data = $(this).serialize();
            console.log(data);
            $.ajax({
                url: "{{route('polislain.store')}}",
                method: "POST",
                data: $(this).serialize(),
                success:function(){
                    $("#modal-add").modal("hide")
                    $('.js-dataTable').DataTable().ajax.reload();
                    One.helpers('jq-notify', 
                    {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil disimpan!'});
                }
            })
        })

        //end edit updateinvest

        //delete updateinest
        $('body').on("click",".btn-delete-update",function(){
            var id = $(this).attr("id");
            var kd = $(this).attr("id");
            console.log(id);
            $(".btn-destroy-update").attr("id",id);
            $("#destroy-modalLabel").text("Yakin Hapus Data :" +id);
            $("#modal-delete-update").modal("show");
        });
        $(".btn-destroy-update").on("click",function(){
            var id = $(this).attr("id")
            console.log(id);
            $.ajax({
                url: "/updateinvestigasi/"+id,
                method : 'DELETE',
                success:function(){
                    $("#modal-delete-update").modal("hide")
                    $('.js-dataTable-list').DataTable().ajax.reload();
                    One.helpers('jq-notify', 
                    {type: 'danger', icon: 'fa fa-check me-1', message: 'Berhasil dihapus!'});
                },
                error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                alert('Update investigasi gagal dihapus');
                },
            });
        })
        //end delepe update

        //approve
        $('body').on("click",".btn-send-approve",function(){
            var id = $('#id').text();
            $('#form_result').html('');
            console.log(id);
            $.ajax({
                url: "/sendApprove/"+id,
                method: "GET",
                dataType : "json",
                success:function(html){
                    $("#modal-send-approve").modal("show")
                    $("#id").val(html.data.id)
                }
            });
        });

        $("#getsendapprove").on("submit",function(e){
            e.preventDefault()
            var id = $("#id").val()
            var dt = $(this).serialize();
            console.log(id);
            console.log(dt);
            $.ajax({
                url: "/editsendApprove/"+id,
                method: "PATCH",
                data: $(this).serialize(),
                success:function(){
                    $("#modal-send-approve").modal("hide");
                    One.helpers('jq-notify', 
                        {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil diupdate!'});
                }
            })
        })
        //end approve
    </script>
    
    
    <script type="text/javascript">
        //GET POLIS
        var id = $('#id').text();
        console.log(id);
        $('.js-dataTable').dataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false,
            ajax: '{{ url("getpolis") }}'+ '/' + id,
            columns: [
                {data: 'DT_RowIndex' , name: 'id', width: '5%'},
                {data: 'nm_perusahaan', name: 'nm_perusahaan', width: '25%'},
                {data: 'issued_polis', name: 'issued_polis'},
                {data: 'up', name: 'up', width: '15%'},
                {data: 'action', name: 'action', orderable: false, searchable: true,width: '5%' },
            ],
        });

        //Delete Polis
        $('body').on("click",".btn-delete-polis",function(){
            var id = $(this).attr("id");
            var kd = $(this).attr("id");
            $(".btn-destroy-polis").attr("id",id);
            $("#destroy-modalLabel").text("Yakin Hapus Data :" +id);
            $("#modal-delete-polis").modal("show");
        });
        $(".btn-destroy-polis").on("click",function(){
            var id = $(this).attr("id")
            console.log(id);
            $.ajax({
                url: "/polislain/"+id,
                method : 'DELETE',
                success:function(){
                    $("#modal-delete-polis").modal("hide")
                    $('.js-dataTable').DataTable().ajax.reload();
                    One.helpers('jq-notify', 
                    {type: 'danger', icon: 'fa fa-check me-1', message: 'Berhasil dihapus!'});
                },
                error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                alert('Polis lain gagal dihapus');
                },
            });
        });
        //End delete Polis

        //GET KESIMPULAN
        var id = $('#id').text();
        console.log(id);
        $('.js-dataTable-kesimpulan').dataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false,
            ajax: '{{ url("getkesimpulan") }}'+ '/' + id,
            columns: [
                {data: 'DT_RowIndex' , name: 'id', width: '1%'},
                {data: 'kesimpulan', name: 'kesimpulan'},
                {data: 'action', name: 'action', orderable: false, searchable: true,width: '1%' },
            ],
        });
        

        $("#createKesimpulan").on("submit",function(e){
            e.preventDefault()
            var data = $(this).serialize();
            console.log(data);
            $.ajax({
                url: "{{url('addkesimpulan')}}",
                method: "POST",
                data: $(this).serialize(),
                success:function(){
                    $("#modal-add-kesimpulan").modal("hide")
                    $('.js-dataTable-kesimpulan').DataTable().ajax.reload();
                    One.helpers('jq-notify', 
                    {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil disimpan!'});
                }
            })
        })
        
         $('body').on("click",".btn-delete-kesimpulan",function(){
            var id = $(this).attr("id");
            var kd = $(this).attr("id");
            $(".btn-destroy-kesimpulan").attr("id",id);
            $("#destroy-modalLabel").text("Yakin Hapus Data :" +id);
            $("#modal-delete-kesimpulan").modal("show");
        });

         $(".btn-destroy-kesimpulan").on("click",function(){
            var id = $(this).attr("id")
            console.log(id);
            $.ajax({
                url: "/delkesimpulan/"+id,
                method : 'DELETE',
                success:function(){
                    $("#modal-delete-kesimpulan").modal("hide")
                   $('.js-dataTable-kesimpulan').DataTable().ajax.reload();
                    One.helpers('jq-notify', 
                    {type: 'danger', icon: 'fa fa-check me-1', message: 'Berhasil dihapus!'});
                },
                error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                alert('Kesimpulan gagal dihapus');
                },
            });
        });

         $('body').on("click",".btn-edit-kesimpulan",function(){
            var id = $(this).attr("id");
            $.ajax({
                url : "/getidkesimpulan/"+id,
                type : 'GET',
                dataType : "json",
                success :function(data){
                        $('#kesimpulan_id').val(data.id);
                        $('#editkesimpulan').val(data.kesimpulan);
                        $("#modal-edit-kesimpulan").modal("show");
                },
            
            });
        });

        $("#upKesimpulan").on("submit",function(e){
            var id = $(this).attr("id");
            e.preventDefault()
            var data = $(this).serialize();
            console.log(data);
            $.ajax({
                url: "/updatekesimpulan/"+id,
                 method: "PATCH",
                data: $(this).serialize(),
                success:function(){
                    $("#modal-edit-kesimpulan").modal("hide")
                    $('.js-dataTable-kesimpulan').DataTable().ajax.reload();
                    One.helpers('jq-notify', 
                    {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil diupdate!'});
                }
            })
        });
        //end kesimpulan
        
        //get rekomendasi
        var id = $('#id').text();
        console.log(id);
        $('.js-dataTable-rekomendasi').dataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false,
            ajax: '{{ url("getrekomendasi") }}'+ '/' + id,
            columns: [
                {data: 'DT_RowIndex' , name: 'id', width: '1%'},
                {data: 'rekomendasi', name: 'rekomendasi'},
                {data: 'action', name: 'action', orderable: false, searchable: true,width: '1%' },
            ],
        });

        $("#createrekomndasi").on("submit",function(e){
            e.preventDefault()
            var data = $(this).serialize();
            console.log(data);
            $.ajax({
                url: "{{url('addrekomendasi')}}",
                method: "POST",
                data: $(this).serialize(),
                success:function(){
                    $("#modal-add-rekomendasi").modal("hide")
                    $('.js-dataTable-rekomendasi').DataTable().ajax.reload();
                    One.helpers('jq-notify', 
                    {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil disimpan!'});
                }
            })
        })
        
         $('body').on("click",".btn-delete-rekomendasi",function(){
            var id = $(this).attr("id");
            var kd = $(this).attr("id");
            $(".btn-destroy-rekomendasi").attr("id",id);
            $("#destroy-modalLabel").text("Yakin Hapus Data :" +id);
            $("#modal-delete-rekomendasi").modal("show");
        });

         $(".btn-destroy-rekomendasi").on("click",function(){
            var id = $(this).attr("id")
            console.log(id);
            $.ajax({
                url: "/delrekomendasi/"+id,
                method : 'DELETE',
                success:function(){
                    $("#modal-delete-rekomendasi").modal("hide")
                   $('.js-dataTable-rekomendasi').DataTable().ajax.reload();
                    One.helpers('jq-notify', 
                    {type: 'danger', icon: 'fa fa-check me-1', message: 'Berhasil dihapus!'});
                },
                error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                alert('Kesimpulan gagal dihapus');
                },
            });
        });

         $('body').on("click",".btn-edit-rekomendasi",function(){
            var id = $(this).attr("id");
            $.ajax({
                url : "/getidrekomendasi/"+id,
                type : 'GET',
                dataType : "json",
                success :function(data){
                        $('#rekomendasi_id').val(data.id);
                        $('#editrekomendasi').val(data.rekomendasi);
                        $("#modal-edit-rekomendasi").modal("show");
                },
            
            });
        });

        $("#uprekomendasi").on("submit",function(e){
            var id = $(this).attr("id");
            e.preventDefault()
            var data = $(this).serialize();
            console.log(data);
            $.ajax({
                url: "/updaterekomendasi/"+id,
                 method: "PATCH",
                data: $(this).serialize(),
                success:function(){
                    $("#modal-edit-rekomendasi").modal("hide")
                    $('.js-dataTable-rekomendasi').DataTable().ajax.reload();
                    One.helpers('jq-notify', 
                    {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil diupdate!'});
                }
            })
        });
        //end rekomendasi
        
    
        //temuan
        var id = $('#id').text();
        console.log(id);
        $('.js-dataTable-temuan').dataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false,
            ajax: '{{ url("gettemuan") }}'+ '/' + id,
            columns: [
                {data: 'DT_RowIndex' , name: 'id', width: '1%'},
                {data: 'temuan', name: 'temuan'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'action', name: 'action', orderable: false, searchable: true,width: '1%' },
            ],
        });

        $("#createTemuan").on("submit",function(e){
            e.preventDefault()
            var data = $(this).serialize();
            console.log(data);
            $.ajax({
                url: "{{url('addtemuan')}}",
                method: "POST",
                data: $(this).serialize(),
                success:function(){
                    $("#modal-add-temuan").modal("hide")
                    $('.js-dataTable-temuan').DataTable().ajax.reload();
                    One.helpers('jq-notify', 
                    {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil disimpan!'});
                }
            })
        })
        
         $('body').on("click",".btn-delete-temuan",function(){
            var id = $(this).attr("id");
            var kd = $(this).attr("id");
            $(".btn-destroy-temuan").attr("id",id);
            $("#destroy-modalLabel").text("Yakin Hapus Data :" +id);
            $("#modal-delete-temuan").modal("show");
        });

         $(".btn-destroy-temuan").on("click",function(){
            var id = $(this).attr("id")
            console.log(id);
            $.ajax({
                url: "/deltemuan/"+id,
                method : 'DELETE',
                success:function(){
                    $("#modal-delete-temuan").modal("hide")
                   $('.js-dataTable-temuan').DataTable().ajax.reload();
                    One.helpers('jq-notify', 
                    {type: 'danger', icon: 'fa fa-check me-1', message: 'Berhasil dihapus!'});
                },
                error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                alert('Kesimpulan gagal dihapus');
                },
            });
        });

         $('body').on("click",".btn-edit-temuan",function(){
            var id = $(this).attr("id");
            $.ajax({
                url : "/getidtemuan/"+id,
                type : 'GET',
                dataType : "json",
                success :function(data){
                        $('#temuan_id').val(data.id);
                        $('#edittemuan').val(data.temuan);
                        $('#temuan_tanggal').val(data.tanggal);
                        $("#modal-edit-temuan").modal("show");
                },
            
            });
        });

        $("#uptemuan").on("submit",function(e){
            var id = $(this).attr("id");
            e.preventDefault()
            var data = $(this).serialize();
            console.log(data);
            $.ajax({
                url: "/updatetemuan/"+id,
                 method: "PATCH",
                data: $(this).serialize(),
                success:function(){
                    $("#modal-edit-temuan").modal("hide")
                    $('.js-dataTable-temuan').DataTable().ajax.reload();
                    One.helpers('jq-notify', 
                    {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil diupdate!'});
                }
            })
        });
        // End temuan

        //Uang Diselamatkan
            var id = $('#id').text();
            console.log(id);
            $('.js-dataTable-uang-pertanggungan').dataTable({
                pageLength: 5,
                lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
                autoWidth: false,
                ajax: '{{ url("getuangdiselamatkan") }}'+ '/' + id,
                columns: [
                    {data: 'DT_RowIndex' , name: 'id', width: '1%'},
                    {data: 'nominal', name: 'nominal'},
                    {data: 'keterangan', name: 'keterangan'},
                    {data: 'action', name: 'action', orderable: false, searchable: true,width: '1%' },
                ],
            });


            $("#createuangpertanggungan").on("submit",function(e){
            e.preventDefault()
            var data = $(this).serialize();
            console.log(data);
            $.ajax({
                url: "{{url('adduangpertanggungan')}}",
                method: "POST",
                data: $(this).serialize(),
                success:function(){
                    $("#modal-add-uangpertanggungan").modal("hide")
                    $('.js-dataTable-uang-pertanggungan').DataTable().ajax.reload();
                    One.helpers('jq-notify', 
                    {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil disimpan!'});
                }
            })
        })
        
         $('body').on("click",".btn-delete-uangpertanggungan",function(){
            var id = $(this).attr("id");
            var kd = $(this).attr("id");
            $(".btn-destroy-uangpertanggungan").attr("id",id);
            $("#destroy-modalLabel").text("Yakin Hapus Data :" +id);
            $("#modal-delete-uangpertanggungan").modal("show");
        });

         $(".btn-destroy-uangpertanggungan").on("click",function(){
            var id = $(this).attr("id")
            console.log(id);
            $.ajax({
                url: "/deluangpertanggungan/"+id,
                method : 'DELETE',
                success:function(){
                    $("#modal-delete-uangpertanggungan").modal("hide")
                    $('.js-dataTable-uang-pertanggungan').DataTable().ajax.reload();
                    One.helpers('jq-notify', 
                    {type: 'danger', icon: 'fa fa-check me-1', message: 'Berhasil dihapus!'});
                },
                error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                alert('Kesimpulan gagal dihapus');
                },
            });
        });

         $('body').on("click",".btn-edit-uangpertanggungan",function(){
            var id = $(this).attr("id");
            $.ajax({
                url : "/getiduangpertanggungan/"+id,
                type : 'GET',
                dataType : "json",
                success :function(data){
                        $('#id_uang').val(data.id);
                        $('#edit_nominal').val(data.nominal);
                        $('#edit_keterangan').val(data.keterangan);
                        $("#modal-edit-uangpertanggungan").modal("show");
                },
            
            });
        });

        $("#upuangpertanggungan").on("submit",function(e){
            var id = $(this).attr("id");
            e.preventDefault()
            var data = $(this).serialize();
            console.log(data);
            $.ajax({
                url: "/updateuangpertanggungan/"+id,
                 method: "PATCH",
                data: $(this).serialize(),
                success:function(){
                    $("#modal-edit-uangpertanggungan").modal("hide")
                    $('.js-dataTable-uang-pertanggungan').DataTable().ajax.reload();
                    One.helpers('jq-notify', 
                    {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil diupdate!'});
                }
            })
        });
        //End Uang Diselamatkan 

        $(".btn-cetak-akhir").on("click",function(){
            var id = $('#id').text();
            console.log(id);
            window.open('{{ url("/investigasi/generate/") }}'+ '/' + id,'_blank');
        })

        $(".btn-cetak-sementara--").on("click",function(){
            var id = $('#id').text();
            console.log(id);
            window.open("{{ route('generate',$detail->id)}}",'_blank');
        })
    </script>

@endsection

@section('content')
    <!-- Hero -->
    <span id="form_result"></span>
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h2 class="h3 fw-bold mb-2">
                        Detail Investigasi
                    </h2>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        No Case : {{$detail->no_case}} | Status : 
                        @if ($detail->status =='0')
                            <span class="fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning fs-sm">In Progress</span>
                        
                        @endif
                        @if ($detail->status =='1')
                            <span class="fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success fs-sm">Completed</span>
                        @endif
                        @if ($detail->status =='2')
                            <span class="fw-semibold d-inline-block py-1 px-3 rounded-pill bg-info-light text-info fs-sm">Wait Approved</span>
                        @endif
                        <p id="id" hidden>{{$detail->id}}</p>
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{route('investigasi')}}">Investigasi</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Detail
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        
        <div class="row push">
            <div class="col-lg-12 text-center">
                @if ($detail->status =='0')
                <a href="{{ route('updateinvestigasi.show',$detail->id)}}" class="btn btn-alt-success me-1 btn-sm">
                    <i class="fa fa-plus text-info me-1"></i>Update Investigasi</a>
                <a href="/investigasi/{{$detail->id}}/edit" class="btn btn-alt-info btn-sm mr-2" >
                    <i class="fa fa-pencil-alt text-info me-1"></i>Edit Informasi</button>
                </a>
                <button type="button" class="btn btn-alt-danger me-1 btn-sm btn-delete">
                    <i class="fa fa-fw fa-times me-1"></i>Hapus
                </button>
                @endif
                @if ($detail->status =='1')
                <button type="button" class="btn btn-alt-warning  btn-sm">Cancel Closed</button>
                @endif
                

                
         
            </div>
                     
        </div>


        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    CLAIM WORKSHEET
                </h3>
            </div>

            <div class="block-content block-content-full">
                <form action="" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter">
                            <thead>
                                <tr>
                                <th style="width:40%;">INFORMASI KLAIM</th>
                                <th>Ket</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw fs-sm">No Case</td>
                                    <td class="fw fs-sm">{{$detail->no_case}}</td> 
                                </tr>
                                <tr>
                                    <td class="fw fs-sm">Tanggal Registrasi</td>
                                    <td class="fw fs-sm">{{$detail->tgl_registrasi}}</td>
                                </tr>
                                <tr>
                                    <td class="fw fs-sm">Nama Perusahaan</td>
                                    <td class="fw fs-sm">{{$detail->nm_perusahaan}}</td>
                                </tr>
                                <tr>
                                    <td class="fw fs-sm">Mata Uang</td>
                                    <td class="fw fs-sm">{{$detail->matauang}}</td>
                                </tr>
                                <tr>
                                    <td class="fw fs-sm">No Polis</td>
                                    <td class="fw fs-sm">{{$detail->no_polis}}</td>
                                </tr>
                                <tr>
                                    <td class="fw fs-sm">Nama Tertanggung</td>
                                    <td class="fw fs-sm">{{$detail->nm_tertanggung}}</td>
                                </tr>
                                <tr>
                                    <td class="fw fs-sm">Nama Pemegang Polis</td>
                                    <td class="fw fs-sm">{{$detail->nm_pemegang_polis}}</td>
                                </tr>
                                <tr>
                                <td class="fw fs-sm">Nama Agen</td>
                                <td class="fw fs-sm">{{$detail->nm_agen}}</td>
                                </tr>
                                <tr>
                                <td class="fw fs-sm">Uang Pertanggungan</td>
                                <td class="fw fs-sm">{{$detail->matauang}} @currency($detail->uang_pertanggungan)</td>
                                </tr>
                                <tr>
                                <td class="fw fs-sm">Tanggal SPAJ</td>
                                <td class="fw fs-sm">{{$detail->tgl_spaj}}</td>
                                </tr>
                                <tr>
                                <td class="fw fs-sm">Tgl Efektif Polis</td>
                                <td class="fw fs-sm">{{$detail->tgl_efektif_polis}}</td>
                                </tr>
                                <tr>
                                <td class="fw fs-sm">Usia Polis</td>
                                <td class="fw fs-sm">{{$detail->usia_polis}}</td>
                                </tr>
                                <tr>
                                <td class="fw fs-sm">Premi</td>
                                <td class="fw fs-sm">{{$detail->matauang}} @currency($detail->premi)</td>
                                </tr>
                                <tr>
                                <td class="fw fs-sm">Total Premi</td>
                                <td class="fw fs-sm">{{$detail->matauang}} @currency($detail->total_premi)</td>
                                </tr>
                                <tr>
                                <td class="fw fs-sm">Alamat Tertanggung</td>
                                <td class="fw fs-sm">{{$detail->alamat_tertanggung}}</td>
                                </tr>
                            </tbody>
                        </table>  
                    
                        <table class="table table-bordered table-striped table-vcenter">
                            <thead>
                                <tr>
                                <th style="width:40%;">INFORMASI POLIS</th>
                                <th>Ket</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td class="fw fs-sm">Jenis Klaim</td>
                                <td class="fw fs-sm">{{$detail->jenis_klaim}}</td>
                                </tr>
                                <tr>
                                <td class="fw fs-sm">Tempat Meninggal</td>
                                <td class="fw fs-sm">{{$detail->tempat_meninggal}}</td> 
                                </tr>
                                <tr>
                                <td class="fw fs-sm">Tanggal Meninggal</td>
                                <td class="fw fs-sm">{{$detail->tgl_meninggal}}</td>
                                </tr>
                                <tr>
                                <td class="fw fs-sm">Tanggal Di Rawat </td>
                                <td class="fw fs-sm">{{$detail->tgl_dirawat_dr}} s.d {{$detail->tgl_dirawat_smp}}</td>
                                </tr>
                                <tr>
                                <td class="fw fs-sm">Diagnosa Utama</td>
                                <td class="fw fs-sm">{{$detail->diagnosa_utama}}</td>
                                </tr>
                                <tr>
                                <td class="fw fs-sm">Tempat Perawatan</td>
                                <td class="fw fs-sm">{{$detail->tempat_perawatan}}</td>
                                </tr>
                                <tr>
                                <td class="fw fs-sm">Area Investigasi</td>
                                <td class="fw fs-sm">{{$detail->area_investigasi}}</td>
                                </tr>
                                <tr>
                                <td class="fw fs-sm">Provinsi</td>
                                <td class="fw fs-sm">{{$detail->provinsi}}</td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered table-striped table-vcenter">
                            <thead>
                                <tr>
                                <th>TAMBAHAN INFORMASI LAINNYA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td class="fw fs-sm">{{$detail->informasi_lain}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </form>
            </div>    
        </div>
        
        
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    KEPEMILIKAN POLIS LAIN
                </h3>
                <button type="button" class="btn btn-alt-info btn-sm" aria-haspopup="true" aria-expanded="false" data-bs-toggle="modal" data-bs-target="#modal-add">
                    <i class="fa fa-plus text-info me-1"></i>Add Polis Lain
                </button>              
            </div>

            <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter js-dataTable fs-sm">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>Nama Perusahaan</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Issued Polis</th>
                            <th>UP</th>
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>       
        </div>

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    HASIL INVESTIGASI
                </h3>
                <a href="{{ route('updateinvestigasi.show',$detail->id)}}" class="btn btn-alt-success me-1 btn-sm">
                    <i class="fa fa-plus text-info me-1"></i>Update Investigasi</a>              
            </div>

            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-list fs-sm">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 80px;">#</th>
                                <th>Update</th>
                                <th>Kategori</th>
                                <th class="d-none d-sm-table-cell" style="width: 10%;">Tgl</th>
                                <th style="width: 15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>    
        </div>

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    TEMUAN KASUS
                </h3>
                <button type="button" type="button" class="btn btn-alt-primary  btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-temuan">
                    <i class="fa fa-plus text-info me-1"></i>Temuan</button>              
            </div>

            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-temuan fs-sm">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 30px;">#</th>
                                <th>Temuan</th>
                                <th>Tanggal</th>
                                <th style="width: 15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>    
        </div>

         <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    UANG PERTANGGUNGAN DISELAMATKAN
                </h3>
                <button type="button" type="button" class="btn btn-alt-primary  btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-uangpertanggungan">
                    <i class="fa fa-plus text-info me-1"></i>Uang Pertanggungan Diselamatkan</button>              
            </div>

            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-uang-pertanggungan fs-sm">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 30px;">#</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                                <th style="width: 15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>    
        </div>

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    KESIMPULAN INVESTIGASI
                </h3>
                <button type="button" type="button" class="btn btn-alt-primary  btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-kesimpulan">
                    <i class="fa fa-plus text-info me-1"></i>Tambah Kesimpulan</button>              
            </div>

            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-kesimpulan fs-sm">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 30px;">#</th>
                                <th>Kesimpulan</th>
                                <th style="width: 15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>    
        </div>

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    REKOMENDASI KEPUTUSAN KLAIM
                </h3>
                <button type="button" type="button" class="btn btn-alt-primary  btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-rekomendasi">
                    <i class="fa fa-plus text-info me-1"></i>Tambah Rekomendasi</button>               
            </div>

            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-rekomendasi fs-sm">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 30px;">#</th>
                                <th>Rekomendasi</th>
                                <th style="width: 15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>    
        </div>



        <div class="row push">
            <div class="col-lg-12 text-center">
                <!-- <a href="" class="btn btn-alt-primary me-1 btn-sm btn-cetak-sementara"><i class="fa fa-print text-info me-1"></i>Generate Report Sementara</a> -->
                
                <button type="submit" class="btn btn-alt-primary me-1 btn-sm btn-cetak-akhir"><i class="fa fa-print text-info me-1"></i>Generate Report Akhir</button>
                <a href="{{ route('generate',$detail->id)}}" class="btn btn-alt-primary me-1 btn-sm btn-cetak-sementara"><i class="fa fa-print text-info me-1"></i>Generate Report Sementara</a>
                
                @if ($detail->status =='0')
                    <a class="btn btn-alt-primary me-1 btn-sm btn-send-approve"><i class="fa fa-arrow-alt-circle-right text-success me-1"></i>Send to Approve</a>
                @endif
                @if ($detail->status =='2')
                    <a class="btn btn-alt-primary me-1 btn-sm btn-cancel-send"><i class="fa fa-arrow-alt-circle-right text-warning me-1"></i>Cancel Send to Approve</a>
                @endif
            </div>             
        </div>

        
    </div>
        
   
    
    <!-- modal delete -->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-vcenter" role="document">
            <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                <h3 class="block-title">Hapus Data</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
                </div>
                <div class="block-content fs-sm text-center">
                    <h3>Data hasil investigasi semua akan ikut terhapus!</h3>
                    <h5>Yakin tetap akan menghapus data?</h5>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-sm btn-danger btn-destroy">Tetap Hapus</button>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- END Small Block Modal -->

    <!-- modal-add polis lain-->
    <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Tambah data polis lain</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <form id="createForm">
                        <div class="form-floating mb-4">
                            <input hidden type="text" value="{{$detail->id}}" id="investigasi_id" name="investigasi_id">
                            <select class="form-select"  id="asuransi_id" name="asuransi_id">
                                <option selected="">pilih asuransi</option>
                                @foreach ($asuransi as $item)
                                <option value="{{$item->id}}" data-kd_value="{{$item->kd_perusahaan}}">{{$item->kd_perusahaan}} - {{$item->nm_perusahaan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-floating mb-4">
                        <input type="text" class="js-flatpickr form-control" id="issued_polis" name="issued_polis" placeholder="Y-m-d">
                            <label for="example-text-input-floating">Polis Issued</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="number" autocomplete="off" class="form-control" id="up" name="up">
                            <label for="example-textarea-floating">UP</label>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary btn-store">Simpan</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- END modal add polis lain -->

     <!-- modal delete polis-->
     <div class="modal fade" id="modal-delete-polis" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-vcenter" role="document">
            <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                <h3 class="block-title">Hapus Data</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
                </div>
                <div class="block-content fs-sm text-center">
                    <h5>Yakin akan menghapus data?</h5>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-sm btn-danger btn-destroy-polis">Hapus</button>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- END Small Block Modal -->

     <!-- modal delete update-->
     <div class="modal fade" id="modal-delete-update" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-vcenter" role="document">
            <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                <h3 class="block-title">Hapus Data</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
                </div>
                <div class="block-content fs-sm text-center">
                    <h5>Yakin akan menghapus data?</h5>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-sm btn-danger btn-destroy-update">Hapus</button>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- END Small Block Modal -->

    <!-- modal upload foto -->
    <div class="modal fade" id="modal-upload" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Upload File</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                    <form id="multiple-image-preview-ajax" method="POST"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
                        @csrf
                        <div class="row push">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input required class="form-control" type="file" name="images[]" id="images" placeholder="Choose images" multiple >
                                </div>
                            @error('images')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="mt-1 text-center">
                                <div class="show-multiple-image-preview"> </div>
                            </div>  
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-alt-primary mt-2" id="submit">Upload</button>
                        </div>
                    </div>     
                    </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- end modal upload foto -->

    <!--modal edit updateinvest-->
    <div class="modal fade" id="modal-editupdateinvest" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Ubah data Asuransi</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <span id="form_result"></span>
                        <form action="" id="editFormInvest" method="POST" class="js-validation" onsubmit="return false;">
                        <div class="mb-4">
                            <label class="form-label" for="example-text-input">Tanggal Update Investigasi</label>
                            <input type="text" class="js-flatpickr form-control" id="edittgl" name="tanggal" placeholder="Y-m-d">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="example-text-input">Keterangan</label>
                            <textarea type="text" class="form-control" rows="10" id="editket" name="update_investigasi"></textarea>
                        </div>

                        <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-sm btn-primary btn-update-invest">Update</button>
                            </form>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
    <!-- end -->

    <!-- modal send approve-->
    <div class="modal fade" id="modal-send-approve" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-vcenter" role="document">
            <div class="modal-content">
                <span id="form_result"></span>
                <form id="getsendapprove">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                    <h3 class="block-title">Approve Investigasi</h3>
                    <input type="text" value="2" name="status" id="status" hidden>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                    </div>
                    <div class="block-content fs-sm text-center">
                        <h5>Klik kirim untuk persetujuan approve!</h5>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-danger btn-getsend-approve">Kirim</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Small Block Modal -->

     <!-- modal-add temuan-->
    <div class="modal fade" id="modal-add-temuan" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Tambah Temuan</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form id="createTemuan">
                    <div class="block-content fs-sm">
                        <div class="form-floating mb-4">
                            <input type="text" class="js-flatpickr form-control" id="tanggal" name="tanggal" placeholder="Y-m-d">
                            <label for="example-textarea-floating">Tanggal</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input hidden type="text" value="{{$detail->id}}" id="investigasi_id" name="investigasi_id">
                            <textarea class="form-control" id="temuan" name="temuan" rows="4" cols="50"></textarea>
                            <label for="example-textarea-floating">Temuan</label>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary btn-add-temuan">Simpan</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- END modal add temuan -->

      <!-- modal-edit temuan-->
    <div class="modal fade" id="modal-edit-temuan" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Edit Temuan Kasus</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <form id="uptemuan">
                        <div class="form-floating mb-4">
                            <input type="text" class="js-flatpickr form-control" id="temuan_tanggal" name="tanggal" placeholder="Y-m-d">
                            <label for="example-textarea-floating">Tanggal</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input hidden type="text" id="temuan_id" name="id">
                            <textarea class="form-control" id="edittemuan" name="temuan" rows="4" cols="50"></textarea>
                            <label for="example-textarea-floating">Kesimpualan Investigasi</label>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary btn-update-kesimpulan">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END modal add temuan -->

     <!-- modal delete temuan-->
     <div class="modal fade" id="modal-delete-temuan" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-vcenter" role="document">
            <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                <h3 class="block-title">Hapus Data</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
                </div>
                <div class="block-content fs-sm text-center">
                    <h5>Yakin akan menghapus data?</h5>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-sm btn-danger btn-destroy-temuan">Hapus</button>
                </div>
            </div>
            </div>
        </div>
    </div>
     <!-- END modal delete temuan-->

     
     <!-- modal-add uangpertanggungan-->
    <div class="modal fade" id="modal-add-uangpertanggungan" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Tambah Uang Pertanggungan</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form id="createuangpertanggungan">
                    <div class="block-content fs-sm">
                        <div class="form-floating mb-4">
                            <input hidden type="text" value="{{$detail->id}}" id="investigasi_id" name="investigasi_id">
                            <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Y-m-d">
                            <label for="example-textarea-floating">Nominal</label>
                        </div>
                        <div class="form-floating mb-4">
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="4" cols="50"></textarea>
                            <label for="example-textarea-floating">Keterangan</label>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary btn-add-uangpertanggungan">Simpan</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- END modal add uangpertanggungan -->

      <!-- modal-edit uangpertanggungan-->
    <div class="modal fade" id="modal-edit-uangpertanggungan" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Edit Kesimpualan Investigasi</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <form id="upuangpertanggungan">
                            <div class="form-floating mb-4">
                                <input hidden type="text" id="id_uang" name="id">
                                <input type="text" class="form-control" id="edit_nominal" name="nominal" placeholder="Y-m-d">
                                <label for="example-textarea-floating">Nominal</label>
                            </div>
                            <div class="form-floating mb-4">
                                <textarea class="form-control" id="edit_keterangan" name="keterangan" rows="4" cols="50"></textarea>
                                <label for="example-textarea-floating">Keterangan</label>
                            </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary btn-update-uangpertanggungan">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END modal add uangpertanggungan -->

     <!-- modal delete uangpertanggungan-->
     <div class="modal fade" id="modal-delete-uangpertanggungan" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-vcenter" role="document">
            <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                <h3 class="block-title">Hapus Data</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
                </div>
                <div class="block-content fs-sm text-center">
                    <h5>Yakin akan menghapus data?</h5>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-sm btn-danger btn-destroy-uangpertanggungan">Hapus</button>
                </div>
            </div>
            </div>
        </div>
    </div>
     <!-- END modal delete uangpertanggungan-->

    <!-- modal-add Kesimpulan-->
    <div class="modal fade" id="modal-add-kesimpulan" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Tambah Kesimpualan Investigasi</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <form id="createKesimpulan">
                        <div class="form-floating mb-4">
                            <input hidden type="text" value="{{$detail->id}}" id="investigasi_id" name="investigasi_id">
                            <textarea class="form-control" id="kesimpulan" name="kesimpulan" rows="4" cols="50"></textarea>
                            <label for="example-textarea-floating">Kesimpualan Investigasi</label>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary btn-store">Simpan</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- END modal add Kesimpulan -->

      <!-- modal-edit Kesimpulan-->
    <div class="modal fade" id="modal-edit-kesimpulan" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Edit Uang Pertanggungan Diselamatkan</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <form id="upKesimpulan">
                        <div class="form-floating mb-4">
                            <input hidden type="text" id="kesimpulan_id" name="id">
                            <textarea class="form-control" id="editkesimpulan" name="kesimpulan" rows="4" cols="50"></textarea>
                            <label for="example-textarea-floating">Kesimpualan Investigasi</label>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary btn-update-kesimpulan">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END modal add Kesimpulan -->

     <!-- modal delete kesimpulan-->
     <div class="modal fade" id="modal-delete-kesimpulan" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-vcenter" role="document">
            <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                <h3 class="block-title">Hapus Data</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
                </div>
                <div class="block-content fs-sm text-center">
                    <h5>Yakin akan menghapus data?</h5>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-sm btn-danger btn-destroy-kesimpulan">Hapus</button>
                </div>
            </div>
            </div>
        </div>
    </div>
     <!-- END modal delete kesimpulan-->

     
      <!-- modal-add rekomendasi-->
    <div class="modal fade" id="modal-add-rekomendasi" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Tambah Kesimpualan Investigasi</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <form id="createrekomndasi">
                        <div class="form-floating mb-4">
                            <input hidden type="text" value="{{$detail->id}}" id="investigasi_id" name="investigasi_id">
                            <textarea class="form-control" id="rekomendasi" name="rekomendasi" rows="4" cols="50"></textarea>
                            <label for="example-textarea-floating">Kesimpualan Investigasi</label>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary btn-add-rekomendasi">Simpan</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- END modal add rekomendasi -->

      <!-- modal-edit rekomendasi-->
    <div class="modal fade" id="modal-edit-rekomendasi" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Edit Rekomendasi</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                        <form id="uprekomendasi">
                        <div class="form-floating mb-4">
                            <input hidden type="text" id="rekomendasi_id" name="id">
                            <textarea class="form-control" id="editrekomendasi" name="rekomendasi" rows="4" cols="50"></textarea>
                            <label for="example-textarea-floating">Kesimpualan Investigasi</label>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary btn-update-rekomendasi">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END modal edit rekomendasi -->

     <!-- modal delete rekomendasi-->
     <div class="modal fade" id="modal-delete-rekomendasi" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog modal-vcenter" role="document">
            <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                <h3 class="block-title">Hapus Data</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
                </div>
                <div class="block-content fs-sm text-center">
                    <h5>Yakin akan menghapus data?</h5>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-sm btn-danger btn-destroy-rekomendasi">Hapus</button>
                </div>
            </div>
            </div>
        </div>
    </div>
     <!-- END modal delete rekomendasi-->


@endsection
