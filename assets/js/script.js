$(document).ready(function(){
    //First Sub Menu Show
    $("#first").click(function(){
        if($(".menu-first").css("display") == "none"){
            $(".menu-first").css("display","block");
        }
        else {
            $(".menu-first").css("display","none");
        }
        
    });

    //Second Sub Menu Show
    $("#second").click(function(){
        if($(".menu-second").css("display") == "none"){
            $(".menu-second").css("display","block");
        }
        else {
            $(".menu-second").css("display","none");
        }
        
    });

    //Third Sub Menu Show
    $("#third").click(function(){
        if($(".menu-third").css("display") == "none"){
            $(".menu-third").css("display","block");
        }
        else {
            $(".menu-third").css("display","none");
        }
        
    });

    //Fourth Sub Menu Show
    $("#fourth").click(function(){
        if($(".menu-fourth").css("display") == "none"){
            $(".menu-fourth").css("display","block");
        }
        else {
            $(".menu-fourth").css("display","none");
        }
        
    });

    //Fifth Sub Menu Show
    $("#fifth").click(function(){
        if($(".menu-fifth").css("display") == "none"){
            $(".menu-fifth").css("display","block");
        }
        else {
            $(".menu-fifth").css("display","none");
        }
        
    });

    //Sixth Sub Menu Show
    $("#sixth").click(function(){
        if($(".menu-sixth").css("display") == "none"){
            $(".menu-sixth").css("display","block");
        }
        else {
            $(".menu-sixth").css("display","none");
        }
        
    });

    //Seventh Sub Menu Show
    $("#seventh").click(function(){
        if($(".menu-seventh").css("display") == "none"){
            $(".menu-seventh").css("display","block");
        }
        else {
            $(".menu-seventh").css("display","none");
        }
        
    });

    //Konfirmasi Delete Pekerja/TKJP/MK
    $('.konfirmDelete').click(function(){
        var id = $(this).attr("data-id");
        swal({
            title: "Konfirmasi",
            text: "Apakah anda yakin ingin menghapus data tersebut ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Hapus",
            cancelButtonText: "Keluar",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    window.location.href = "hapus-data-pekerja-"+id;
                }
                else {
                    window.location.href = "";
                }
        });
    });

    //Konfirmasi Delete DCU
    $('.konfirmDeleteDCU').click(function(){
        var id = $(this).attr("data-id");
        swal({
            title: "Konfirmasi",
            text: "Apakah anda yakin ingin menghapus data tersebut ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Hapus",
            cancelButtonText: "Keluar",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    window.location.href = "hapus-data-checkup-"+id;
                }
                else {
                    window.location.href = "";
                }
        });
    });

    //Konfirmasi Delete Pekerja/TKJP/MK
    $('.konfirmDeleteVisitor').click(function(){
        var id = $(this).attr("data-id");
        swal({
            title: "Konfirmasi",
            text: "Apakah anda yakin ingin menghapus data tersebut ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Hapus",
            cancelButtonText: "Keluar",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    window.location.href = "hapus-data-visitor-"+id;
                }
                else {
                    window.location.href = "";
                }
        });
    });

    //Konfirmasi Delete DCU
    $('.konfirmDeleteDCUVisitor').click(function(){
        var id = $(this).attr("data-id");
        swal({
            title: "Konfirmasi",
            text: "Apakah anda yakin ingin menghapus data tersebut ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Hapus",
            cancelButtonText: "Keluar",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    window.location.href = "hapus-data-checkup-visitor-"+id;
                }
                else {
                    window.location.href = "";
                }
        });
    });

    //Konfirmasi Delete DCU
    $('.konfirmDeleteUser').click(function(){
        var id = $(this).attr("data-id");
        swal({
            title: "Konfirmasi",
            text: "Apakah anda yakin ingin menghapus data tersebut ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Hapus",
            cancelButtonText: "Keluar",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    window.location.href = "hapus-data-pengguna-"+id;
                }
                else {
                    window.location.href = "";
                }
        });
    });

    //Konfirmasi Delete Perusahaan
    $('.konfirmDeletePerusahaan').click(function(){
        var id = $(this).attr("data-id");
        swal({
            title: "Konfirmasi",
            text: "Apakah anda yakin ingin menghapus data tersebut ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Hapus",
            cancelButtonText: "Keluar",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    window.location.href = "hapus-data-perusahaan-"+id;
                }
                else {
                    window.location.href = "";
                }
        });
    });

    //Konfirmasi Delete Fungsi
    $('.konfirmDeleteFungsi').click(function(){
        var id = $(this).attr("data-id");
        swal({
            title: "Konfirmasi",
            text: "Apakah anda yakin ingin menghapus data tersebut ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Hapus",
            cancelButtonText: "Keluar",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    window.location.href = "hapus-data-fungsi-"+id;
                }
                else {
                    window.location.href = "";
                }
        });
    });


});