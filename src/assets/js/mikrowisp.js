function msgbox(e, t, o) {
    if ($(".notydiv").remove(), "danger" == e) var n = '<div data-notify="container" class="notydiv col-xs-11 col-sm-3 alert alert-{0}" role="alert" role="alert"><div class="notydanger"><button type="button" aria-hidden="true" data-notify="dismiss" class="toast-close-button">×</button><div class="toast-message">' + t + "</div></div></div>";
    if ("success" == e) var n = '<div data-notify="container" class="notydiv col-xs-11 col-sm-3 alert alert-{0}" role="alert" role="alert"><div class="notysuccess"><button type="button" aria-hidden="true" data-notify="dismiss" class="toast-close-button">×</button><div class="toast-message">' + t + "</div></div></div>";
    if ("info" == e) var n = '<div data-notify="container" class="notydiv col-xs-11 col-sm-3 alert alert-{0}" role="alert" role="alert"><div class="notyinfo"><button type="button" aria-hidden="true" data-notify="dismiss" class="toast-close-button">×</button><div class="toast-message">' + t + "</div></div></div>";
    if ("loader" == e) {
        e = "success";
        var n = '<div data-notify="container" class="notydiv col-xs-11 col-sm-3 alert alert-{0}" role="alert" role="alert"><div class="notyloader"><button type="button" aria-hidden="true" data-notify="dismiss" class="toast-close-button">×</button><div class="toast-message">' + t + "</div></div></div>"
    }
    o = parseInt(1e3) * parseInt(o), $.notify({
        message: n
    }, {
        type: e,
        delay: o,
        animate: {
            enter: "animated bounceIn",
            exit: "animated fadeOutUp"
        },
        template: n
    })
}

function removelink(e) {
    var t = e;
    return t = t.replace(/<\s*br\/*>/gi, ""), t = t.replace(/<\s*a.*href="(.*?)".*>(.*?)<\/a>/gi, "$2"), t = t.replace(/<\s*\/*.+?>/gi, ""), t = t.replace(/ {2,}/gi, " "), t = t.replace(/\n+\s*/gi, "")
}

function procesaform(e, t, o) {
    $(e).ajaxForm({
        url: t,
        type: "POST",
        delegation: !0,
        success: function(e) {
            $(".notydiv").remove();
            var t = e.split(":");
            "ERROR MYSQL" == t[0] ? msgbox("danger", e, 4) : msgbox("success", "operación Exitosa", 2)
        },
        beforeSubmit: function() {
            o && $(o).modal("hide"), msgbox("loader", "procesando...", 0)
        },
        error: function(e) {
            $(".notydiv").remove(), msgbox("danger", "Error al procesar datos, vuelva a intentar", 4)
        }
    }).submit()
}

function procesar(e, t) {
    msgbox("loader", "procesando...", 0), $.post(e).done(function(e) {
        e ? ($(".notydiv").remove(), msgbox("danger", e, 5)) : ($(".notydiv").remove(), msgbox("success", t, 2))
    })
}

function bytesconver(e) {
    var t = ["Bytes", "KB", "MB", "GB", "TB"];
    if (0 == e) return "0 Byte";
    var o = parseInt(Math.floor(Math.log(e) / Math.log(1024)));
    return Math.round(e / Math.pow(1024, o), 2) + " " + t[o]
}

function generatepass(e) {
    for (var t = "", o = "abcdefghijklmnopqrstuvwxyz0123456789", n = 0; 8 > n; n++) t += o.charAt(Math.floor(Math.random() * o.length));
    $(e).val(t)
}

function generateuser(e) {
    for (var t = "", o = "abcdefghijklmnopqrstuvwxyz0123456789", n = 0; 4 > n; n++) t += o.charAt(Math.floor(Math.random() * o.length));
    $(e).val("user-" + t)
}

function PopupCenter(e, t, o, n) {
    var a = void 0 != window.screenLeft ? window.screenLeft : screen.left,
        i = void 0 != window.screenTop ? window.screenTop : screen.top,
        r = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width,
        s = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height,
        c = r / 2 - o / 2 + a,
        d = s / 2 - n / 2 + i,
        l = window.open(e, t, "scrollbars=yes, width=" + o + ", height=" + n + ", top=" + d + ", left=" + c);
    window.focus && l.focus()
}

function edit_factura(e) {
    msgbox("loader", "procesando...", 0), $.post("datacliente.php?action=editfactura&id=" + e).done(function(e) {
        $(".notydiv").remove(), $("#tmp").html(e)
    })
}

function new_factura(e) {
    msgbox("loader", "procesando...", 0), $.post("datacliente.php?action=newfactura&id=" + e).done(function(e) {
        $(".notydiv").remove(), $("#tmp").html(e)
    })
}

function new_factura_libre(e) {
    msgbox("loader", "procesando...", 0), $.post("datacliente.php?action=newfacturalibre&id=" + e).done(function(e) {
        $(".notydiv").remove(), $("#tmp").html(e)
    })
}

function tag_factura(e, t) {
    $.post("datacliente.php?&id=" + e, {
        action: "tag",
        fecha: t
    }).done(function(e) {
        $("#frm-new-factura #tablafactura tbody").html(JSON.parse(e))
    })
}

function viewmail(e) {
    $.post("datacliente.php", {
        action: "viewmail",
        id: e
    }).done(function(e) {
        $("#tmp").html(e)
    })
}

function newmail(e) {
    $.post("datacliente.php", {
        action: "newmail",
        id: e
    }).done(function(e) {
        $("#tmp").html(e)
    })
}

function newsoporte() {
    $.post("ajaxsoporte.php", {
        action: "new"
    }).done(function(e) {
        $("#tmp").html(e)
    })
}

function edit_pago(e) {
    $.post("ajaxtransacciones.php", {
        action: "editpago",
        id: e
    }).done(function(e) {
        $("#tmp").html(e)
    })
}

function edit_pro(e) {
    $.post("ajaxalmacen.php", {
        action: "editpro",
        id: e
    }).done(function(e) {
        $("#tmp").html(e)
    })
}

function edit_acc(e) {
    $.post("ajaxalmacen.php", {
        action: "editacc",
        id: e
    }).done(function(e) {
        $("#tmp").html(e)
    })
}

function edit_otros(e) {
    $.post("ajaxalmacen.php", {
        action: "editotros",
        id: e
    }).done(function(e) {
        $("#tmp").html(e)
    })
}

function edit_cat(e) {
    $.post("ajaxalmacen.php", {
        action: "editcat",
        id: e
    }).done(function(e) {
        $("#tmp").html(e)
    })
}

function newsms(e) {
    $.post("datacliente.php", {
        action: "newsms",
        id: e
    }).done(function(e) {
        $("#tmp").html(e)
    })
}

function replysms(e) {
    $.post("ajaxsms.php", {
        action: "replysms",
        id: e
    }).done(function(e) {
        $("#tmp").html(e), update_recibidos()
    })
}

function replysms2(e) {
    $.post("ajaxsms.php", {
        action: "replysms",
        id: e
    }).done(function(e) {
        $("#tmp").html(e)
    })
}

function addproducto() {
    $.post("ajaxalmacen.php", {
        action: "newpro"
    }).done(function(e) {
        $("#tmp").html(e)
    })
}

function addsms() {
    $.post("ajaxsms.php", {
        action: "newsms"
    }).done(function(e) {
        $("#tmp").html(e)
    })
}

function updatesys() {
    $.post("utilidades.php", {
        action: "getupdate"
    }).done(function(e) {
        $("#tmpupdate").html(e)
    })
}

function addaccesorio() {
    $.post("ajaxalmacen.php", {
        action: "newacc"
    }).done(function(e) {
        $("#tmp").html(e)
    })
}

function addotros() {
    $.post("ajaxalmacen.php", {
        action: "newotros"
    }).done(function(e) {
        $("#tmp").html(e)
    })
}

function addcategoria() {
    $.post("ajaxalmacen.php", {
        action: "newcat"
    }).done(function(e) {
        $("#tmp").html(e)
    })
}

function newin(e) {
    $.post("ajaxingresos.php", {
        action: "new",
        tipo: e
    }).done(function(e) {
        $("#tmp").html(e)
    })
}

function viewreporte(e, t) {
    $("#tmp").empty(), msgbox("loader", "procesando...", 0), $.post("ajaxreporte.php", {
        action: "view",
        id: e,
        al: t
    }).done(function(e) {
        $("#tmp").html(e), $(".notydiv").remove()
    })
}

function resendmail(e) {
    swal({
        title: "¿Esta seguro que desea volver enviar este correo ?",
        text: "Será marcado como No enviado.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Enviar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("datacliente.php", {
            action: "resendmail",
            id: e
        }).done(function(e) {
            updatemail(), msgbox("success", "Correo enviado correctamente", 2)
        })
    })
}

function resendsms(e) {
    swal({
        title: "¿Esta seguro que desea volver enviar este SMS ?",
        text: "Será marcado como Pendiente.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Enviar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("datacliente.php", {
            action: "resendsms",
            id: e
        }).done(function(e) {
            updatesms(), msgbox("success", "Operación exitosa", 2)
        })
    })
}

function correobienvenida(e) {
    swal({
        title: "¿Esta seguro que desea Enviar el correo de Bienvenida ?",
        text: "Correo con los datos del cliente.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Enviar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("datacliente.php", {
            action: "bienvenida",
            id: e
        }).done(function(e) {
            msgbox("success", "Operación exitosa", 2)
        })
    })
}

function delete_factura(e) {
    swal({
        title: "¿Esta seguro que desea eliminar esta factura ?",
        text: "Una factura Eliminada no podrá ser recuperada.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("datacliente.php", {
            action: "eliminar-factura",
            id: e
        }).done(function(e) {
            update_factura(), msgbox("success", "Factura eliminado correctamente", 2)
        })
    })
}

function delete_factura(e) {
    swal({
        title: "¿Esta seguro que desea eliminar esta factura ?",
        text: "Una factura Eliminada no podrá ser recuperada.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("datacliente.php", {
            action: "eliminar-factura",
            id: e
        }).done(function(e) {
            update_factura(), msgbox("success", "Factura eliminado correctamente", 2)
        })
    })
}

function deletepasarela(e) {
	var idpane='.pane'+e;
    swal({
        title: "¿Esta seguro que desea eliminar este Registro ?",
        text: "Se dejará de recibir pagos.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("ajustes.php", {
            action: "deletepasarela",
            id: e
        }).done(function(e) {
			$(".notydiv").remove();
           $(idpane).remove();
        })
    })
}

function delete_pago(e) {
    swal({
        title: "¿Esta seguro que desea eliminar Esta transacción ?",
        text: "Al eliminar una transaccion la Factura pasará como No pagado.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), $.post("formservicios.php", {
            action: "eliminarpago",
            id: e
        }).done(function(e) {
            $(".notydiv").remove(), update_pago(), update_factura(), msgbox("success", "Transacción Eliminado", 2)
        })
    })
}

function retirar_user(e) {
    swal({
        title: "¿Esta seguro que desea Retirar este cliente ?",
        text: "Un cliente retirado es eliminado del mikrotik, pero sus datos quedarán guardados.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Retirar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("formservicios.php", {
            action: "retirar",
            id: e
        }).done(function(e) {
            updatelist(), msgbox("success", "Cliente retirado correctamente", 2)
        })
    })
}

function retirar_user2(e) {
    swal({
        title: "¿Esta seguro que desea Retirar este cliente ?",
        text: "Un cliente retirado es eliminado del mikrotik, pero sus datos quedarán guardados.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Retirar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("formservicios.php", {
            action: "retirar",
            id: e
        }).done(function(e) {
            updatelist_s(), msgbox("success", "Cliente retirado correctamente", 2)
        })
    })
}

function reinstalar_user(e) {
    swal({
        title: "¿Esta seguro que desea volver a este cliente ?",
        text: "Para completar la activación necesita agregar un plan o Ip al cliente.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Volver activar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("formservicios.php", {
            action: "reinstalar",
            id: e
        }).done(function(e) {
            updatelist_r(), updatelist(), msgbox("success", "Cliente reinstalado correctamente", 2)
        })
    })
}

function delete_accesorio(e) {
    swal({
        title: "¿Esta seguro que desea eliminar este Accesorio ?",
        text: "Una vez eliminado no podrá ser recuperado.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("ajaxalmacen.php", {
            action: "deletepro",
            id: e
        }).done(function(e) {
            update_accesorio(), msgbox("success", "Accesorio eliminado correctamente", 2)
        })
    })
}

function delete_doc(e, t) {
    swal({
        title: "¿Esta seguro que desea eliminar este Documento ?",
        text: "Una vez eliminado no podrá ser recuperado.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("datacliente.php", {
            action: "deletedoc",
            id: e
        }).done(function(t) {
            var o = ".trdoc" + e;
            $(o).remove(), msgbox("success", "Documento eliminado correctamente", 2)
        })
    })
}

function delete_otros(e) {
    swal({
        title: "¿Esta seguro que desea eliminar este Servicio ?",
        text: "Una vez eliminado no podrá ser recuperado.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("ajaxalmacen.php", {
            action: "deleteotros",
            id: e
        }).done(function(e) {
            update_otros(), msgbox("success", "Servicio eliminado correctamente", 2)
        })
    })
}

function resentsms(e) {
    swal({
        title: "¿Esta seguro que desea Volver enviar el mensaje ?",
        text: "Enviar mismo mensaje.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Enviar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("ajaxsms.php", {
            action: "resentsms",
            id: e
        }).done(function(e) {
            update_enviados(), msgbox("success", "Mensaje enviado correctamente", 2)
        })
    })
}

function mail_factura(e) {
    msgbox("loader", "Creando factura...", 0), $.post("facturaview.php?action=crear2&id=" + e + "&token=" + CryptoJS.MD5(e)).done(function(e) {
        update_factura(), e.trim() ? msgbox("danger", e, 5) : msgbox("success", "Correo enviado Correctamente", 3)
    })
}

function down_factura(e) {
    msgbox("loader", "Creando PDF...", 3), $("#printframe").remove();
    var t = $("<iframe></iframe>");
    t.attr("id", "printframe").attr("name", "printframe").attr("src", "about:blank").css("width", "0").css("height", "0").css("position", "absolute").css("left", "-9999px").appendTo($("body:first"));
    var o = "facturaview.php?action=descargar&id=" + e + "&token=" + CryptoJS.MD5(e);
    null != t && null != o && (t.attr("src", o), t.load(function() {}))
}

function down_file() {
    $("#downframe").remove();
    var e = $("<iframe></iframe>");
    e.attr("id", "downframe").attr("name", "downframe").attr("src", "about:blank").css("width", "0").css("height", "0").css("position", "absolute").css("left", "-9999px").appendTo($("body:first"));
    var t = "facturas/Mikrowisp.zip";
    null != e && null != t && (e.attr("src", t), e.load(function() {}))
}

function anulado_factura(e) {
    swal({
        title: "¿Esta seguro que desea Anular esta factura ?",
        text: "Una factura Anulada no podrá ser recuperada.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Anular!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("datacliente.php", {
            action: "anular-factura",
            id: e
        }).done(function(e) {
            update_factura(), msgbox("success", "Factura Anulada correctamente", 2)
        })
    })
}

function delete_saldo(e) {
    swal({
        title: "¿Esta seguro que desea eliminar esta saldo ?",
        text: "Si elimina un saldo, este será retirado de la factura destino.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("datacliente.php", {
            action: "eliminar-saldo",
            id: e
        }).done(function(e) {
            update_saldo(), msgbox("success", "Saldo eliminado correctamente", 2)
        })
    })
}

function delete_soporte(e) {
    swal({
        title: "¿Esta seguro que desea eliminar Este ticket ?",
        text: "No podrá Recuperar este ticket una vez eliminado.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("ajaxsoporte.php", {
            action: "deletetk",
            id: e
        }).done(function(e) {
            update_soporte(), update_cerrado(), update_reply(), msgbox("success", "Ticket eliminado correctamente", 2)
        })
    })
}

function delete_ingresos(e) {
    swal({
        title: "¿Esta seguro que desea eliminar Este registro ?",
        text: "",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("ajaxingresos.php", {
            action: "delete",
            id: e
        }).done(function(e) {
            update_ingresos(), update_egresos(), msgbox("success", "Registro eliminado correctamente", 2)
        })
    })
}

function delete_alquiler(e) {
    swal({
        title: "¿Esta seguro que desea eliminar Este producto ?",
        text: "Al eliminar el producto volverá estar disponible en el almacén.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), $.post("formservicios.php", {
            action: "eliminarp",
            id: e
        }).done(function(e) {
            $(".notydiv").remove(), updatelistrecurrente(), msgbox("success", "Producto Eliminado", 2)
        })
    })
}

function delete_pago(e) {
    swal({
        title: "¿Esta seguro que desea eliminar Esta transacción ?",
        text: "Al eliminar una transaccion la Factura pasará como No pagado.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), $.post("formservicios.php", {
            action: "eliminarpago",
            id: e
        }).done(function(e) {
            $(".notydiv").remove(), update_pago(), update_factura(), msgbox("success", "Transacción Eliminado", 2)
        })
    })
}

function delete_proximo(e) {
    swal({
        title: "¿Esta seguro que desea eliminar Este producto ?",
        text: "Al eliminar el producto volverá estar disponible en el almacén.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("formservicios.php", {
            action: "eliminarp2",
            id: e
        }).done(function(e) {
            $(".notydiv").remove(), upproximo(), msgbox("success", "Producto Eliminado", 2)
        })
    })
}

function tkdelete(e) {
    swal({
        title: "¿Esta seguro que desea eliminar esta Respuesta ?",
        text: "Si elimina una respuesta también será eliminados los archivos adjuntos.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("ajaxsoporte.php", {
            action: "delete-reply",
            id: e
        }).done(function(t) {
            $(".tk-" + e).hide("slow", function() {
                $("." + e).remove()
            }), msgbox("success", "Respuesta Eliminada correctamente", 2)
        })
    })
}

function extradelete(e) {
    swal({
        title: "¿Esta seguro que desea eliminar este Campo ?",
        text: "Al eliminar este campo, tambien será eliminado su contenido en los reportes de pagos.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("ajustes.php", {
            action: "eliminar-campo",
            id: e
        }).done(function(e) {
            extrainput(), msgbox("success", "Campo eliminado correctamente", 2)
        })
    })
}

function delete_banner(e) {
    swal({
        title: "¿Esta seguro que desea eliminar este Banner ?",
        text: "Elimnar Banner del panel cliente.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("ajustes.php", {
            action: "eliminar-banner",
            id: e
        }).done(function(e) {
            tabbaner(), msgbox("success", "Campo eliminado correctamente", 2)
        })
    })
}

function removeaviso(e) {
    swal({
        title: "¿Esta seguro que desea eliminar los anuncios seleccionado?",
        text: "Serán eliminado del sistema y de Mikrotik.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("ajaxanuncios.php", {
            action: "eliminar",
            id: e
        }).done(function(e) {
            update_anuncios(), msgbox("success", "Anuncios eliminados correctamente", 2)
        })
    })
}

function closetk(e) {
    swal({
        title: "¿Esta seguro que desea dar por solucionado este ticket. ?",
        text: "Cerrar ticket para marcar como Cerrado.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Cerrar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("ajaxsoporte.php", {
            action: "close-tk",
            id: e
        }).done(function(e) {
            msgbox("success", "Ticket cerrado correctamente", 2), $("#linktemporal").attr("href", "#soporte/"), $("#linktemporal").trigger("click")
        })
    })
}

function closetk2(e) {
    swal({
        title: "¿Esta seguro que desea dar por solucionado este ticket. ?",
        text: "Cerrar ticket para marcar como Cerrado.",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Cerrar!",
        closeOnConfirm: !0
    }, function() {
        $(".notydiv").remove(), msgbox("loader", "procesando...", 0), $.post("ajaxsoporte.php", {
            action: "close-tk",
            id: e
        }).done(function(e) {
            msgbox("success", "Ticket cerrado correctamente", 2), update_soporte(), update_cerrado(), update_reply()
        })
    })
}

function print_instalacion(e) {
    if ($.browser.webkit) {
        msgbox("loader", "Creando Hoja de instalación...", 4), $("#printframe").remove();
        var t = $("<iframe></iframe>");
        t.attr("id", "printframe").attr("name", "printframe").attr("src", "about:blank").css("width", "0").css("height", "0").css("position", "absolute").css("left", "-9999px").appendTo($("body:first"));
        var o = "pdfinstall.php?id=" + e;
        null != t && null != o && (t.attr("src", o), t.load(function() {
            $(".notydiv").remove();
            var e = $("#printframe")[0],
                t = e.contentWindow ? e.contentWindow : e.contentDocument.defaultView;
            t.focus(), t.print()
        }))
    } else {
        $("#framefirefox").remove(), $("#modalprint .modal-body").html('<div class="loaderprint"><i class="fa fa-spinner fa-lg fa-pulse"></i> Cargando...</div>'), $("#modalprint").modal("show");
        var t = $("<iframe></iframe>");
        t.attr("id", "framefirefox").attr("name", "framefirefox").css("display", "none").attr("src", "about:blank").appendTo($("#modalprint .modal-body"));
        var o = "pdfinstall.php?id=" + e;
        null != t && null != o && (t.attr("src", o), t.load(function() {
            $("#framefirefox").show(), $(".loaderprint").hide()
        }))
    }
}

function print_recibo(e) {
    if ($.browser.webkit) {
        msgbox("loader", "Creando Recibo PDF...", 4), $("#printframe").remove();
        var t = $("<iframe></iframe>");
        t.attr("id", "printframe").attr("name", "printframe").attr("src", "about:blank").css("width", "0").css("height", "0").css("position", "absolute").css("left", "-9999px").appendTo($("body:first"));
        var o = "printcomprobante.php?action=recibo&id=" + e;
        null != t && null != o && (t.attr("src", o), t.load(function() {
            $(".notydiv").remove();
            var e = $("#printframe")[0],
                t = e.contentWindow ? e.contentWindow : e.contentDocument.defaultView;
            t.focus(), t.print()
        }))
    } else {
        $("#framefirefox").remove(), $("#modalprint .modal-body").html('<div class="loaderprint"><i class="fa fa-spinner fa-lg fa-pulse"></i> Cargando Comprobante...</div>'), $("#modalprint").modal("show");
        var t = $("<iframe></iframe>");
        t.attr("id", "framefirefox").attr("name", "framefirefox").css("display", "none").attr("src", "about:blank").appendTo($("#modalprint .modal-body"));
        var o = "printcomprobante.php?action=recibo&id=" + e;
        null != t && null != o && (t.attr("src", o), t.load(function() {
            $("#framefirefox").show(), $(".loaderprint").hide()
        }))
    }
}

function print_recibo2(e) {
    if ($.browser.webkit) {
        msgbox("loader", "Creando Recibo PDF...", 4), $("#printframe").remove();
        var t = $("<iframe></iframe>");
        t.attr("id", "printframe").attr("name", "printframe").attr("src", "about:blank").css("width", "0").css("height", "0").css("position", "absolute").css("left", "-9999px").appendTo($("body:first"));
        var o = "printcomprobante.php?action=recibosaldo&id=" + e;
        null != t && null != o && (t.attr("src", o), t.load(function() {
            $(".notydiv").remove();
            var e = $("#printframe")[0],
                t = e.contentWindow ? e.contentWindow : e.contentDocument.defaultView;
            t.focus(), t.print()
        }))
    } else {
        $("#framefirefox").remove(), $("#modalprint .modal-body").html('<div class="loaderprint"><i class="fa fa-spinner fa-lg fa-pulse"></i> Cargando Comprobante...</div>'), $("#modalprint").modal("show");
        var t = $("<iframe></iframe>");
        t.attr("id", "framefirefox").attr("name", "framefirefox").css("display", "none").attr("src", "about:blank").appendTo($("#modalprint .modal-body"));
        var o = "printcomprobante.php?action=recibosaldo&id=" + e;
        null != t && null != o && (t.attr("src", o), t.load(function() {
            $("#framefirefox").show(), $(".loaderprint").hide()
        }))
    }
}

function print_factura(e) {
    if ($.browser.webkit) {
        msgbox("loader", "Creando Factura PDF...", 4), $("#printframe").remove();
        var t = $("<iframe></iframe>");
        t.attr("id", "printframe").attr("name", "printframe").attr("src", "about:blank").css("width", "0").css("height", "0").css("position", "absolute").css("left", "-9999px").appendTo($("body:first"));
        var o = "facturaview.php?id=" + e + "&token=" + CryptoJS.MD5(e);
        null != t && null != o && (t.attr("src", o), t.load(function() {
            $(".notydiv").remove();
            var e = $("#printframe")[0],
                t = e.contentWindow ? e.contentWindow : e.contentDocument.defaultView;
            t.focus(), t.print()
        }))
    } else {
        $("#framefirefox").remove(), $("#modalprint .modal-body").html('<div class="loaderprint"><i class="fa fa-spinner fa-lg fa-pulse"></i> Cargando Comprobante...</div>'), $("#modalprint").modal("show");
        var t = $("<iframe></iframe>");
        t.attr("id", "framefirefox").attr("name", "framefirefox").css("display", "none").attr("src", "about:blank").appendTo($("#modalprint .modal-body"));
        var o = "facturaview.php?id=" + e + "&token=" + CryptoJS.MD5(e);
        null != t && null != o && (t.attr("src", o), t.load(function() {
            $("#framefirefox").show(), $(".loaderprint").hide()
        }))
    }
}! function(e) {
    function t(t) {
        var n = e.Deferred();
        if ("undefined" == typeof t && (t = window.location.hash), "undefined" == typeof t) {
            var r = window.location.pathname,
                s = r.substring(r.lastIndexOf("/") + 1);
            t = s.replace(i, "")
        }
        return "" == t ? (t = "#home/", o(t).done(function(t) {
            e("#tmp").empty(), e("#bodysystem").empty().off(), n.resolve(t)
        }).fail(function() {
            n.reject("<p>La página no existe.</p>")
        })) : t !== a && (a = t, o(t).done(function(t) {
            e("#tmp").empty(), e("#bodysystem").empty().off(), n.resolve(t)
        }).fail(function() {
            n.reject("<p>La página no existe.</p>")
        })), n.promise()
    }

    function o(t) {
        "undefined" != typeof timechar && clearTimeout(timechar);
        var o = t.replace("#", "");
        return o = o.replace(/--/g, "="), o = o.replace("/", ".php?"), o = o.replace(/:/g, "/"), e.ajax({
            url: o,
            async: !0,
            dataType: "html",
            beforeSend: function(t) {
                e("#bodysystem").html('<div class="ibox"><div class="ibox-content"><div class="icoloader"><i class="fa fa-spinner fa-lg fa-pulse"></i> Cargando...</div></div></div>')
            }
        })
    }
    var n = e("#bodysystem"),
        a = "",
        i = ".php";
    window.location;
    e(".ajaxurl").on("click", function(o) {

if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
if($("body").hasClass("sidebar-open")){
$( ".sidebar-toggle" ).trigger( "click" );
}
}
        var a = e(this).attr("href");
        o.preventDefault(), t(a).done(function() {
            window.location.href = a
        }).fail(function() {
            window.location.href = "#error"
        }).always(function(t) {
            n.empty().off(), e("#tmp").empty(), n.html(t)
        })
    }), t().always(function(t) {
        n.empty(), e("#tmp").empty(), n.html(t)
    }), e(window).on("hashchange", function() {
        t().fail(function() {
            window.location.href = "#error"
        }).always(function(t) {
            n.empty().off(), e("#tmp").empty(), n.html(t)
        })
    })
}(jQuery), jQuery.extend(jQuery.fn.dataTableExt.oSort, {
    "date-uk-pre": function(e) {
        if (null == e || "" == e) return 0;
        var t = e.split("/");
        return 1 * (t[2] + t[1] + t[0])
    },
    "date-uk-asc": function(e, t) {
        return t > e ? -1 : e > t ? 1 : 0
    },
    "date-uk-desc": function(e, t) {
        return t > e ? 1 : e > t ? -1 : 0
    }
}), jQuery.extend(jQuery.fn.dataTableExt.oSort, {
    "ip-address-pre": function(e) {
		var ip_address = $(e).html();
		var t;
		var o; 
		if(!ip_address){
		var n = e.split(".");
		}else{
		var n = ip_address.split(".");	
		}
			
        
		
            a = e.split(":"),
            i = "",
            r = "";
        if (4 == n.length)
            for (t = 0; t < n.length; t++) o = n[t], i += 1 == o.length ? "00" + o : 2 == o.length ? "0" + o : o;
        else if (a.length > 0) {
            var s = 0;
            for (t = 0; t < a.length; t++) o = a[t], t > 0 && (r += ":"), 0 === o.length ? s += 0 : 1 == o.length ? (r += "000" + o, s += 4) : 2 == o.length ? (r += "00" + o, s += 4) : 3 == o.length ? (r += "0" + o, s += 4) : (r += o, s += 4);
            a = r.split(":");
            var c = 0;
            for (t = 0; t < a.length; t++)
                if (o = a[t], 0 === o.length && 0 === c)
                    for (var d = 0; 32 - s > d; d++) i += "0", c = 1;
                else i += o
        }
        return i
    },
    "ip-address-asc": function(e, t) {
        return t > e ? -1 : e > t ? 1 : 0
    },
    "ip-address-desc": function(e, t) {
        return t > e ? 1 : e > t ? -1 : 0
    }
}), jQuery.extend(jQuery.fn.dataTableExt.oSort, {
    "date-euro-pre": function(e) {
        var t;
        if ("" !== $.trim(e)) {
            var o = $.trim(e).split(" "),
                n = void 0 != o[1] ? o[1].split(":") : [0, 0, 0],
                a = o[0].split("/");
            t = 1 * (a[2] + a[1] + a[0] + n[0] + n[1] + n[2])
        } else t = 1 / 0;
        return t
    },
    "date-euro-asc": function(e, t) {
        return e - t
    },
    "date-euro-desc": function(e, t) {
        return t - e
    }
}), $(document).on("keypress", "form input", function(e) {
    return 13 != e.keyCode
}), $(document).keydown(function(e) {
    e.ctrlKey && 66 === e.which && $(".btsearch").trigger("click")
});
function test(){
 $('#list-personal .bt-removeuser,.bt-eliminar-tabla').prop('disabled', true);
 $('#frm_dropbox #token').prop('readonly', true);
 $('#frm_dropbox #token').val('gTNL4GGfRAABBBAAAEc9mMjolypKkptML_TAAAvg1Ome5CCCRaxYptusEabHW');
  $('#frm_dropbox .text-center').remove();
 
 $('a[href="#ajustes/action--googlemaps"]').remove();
  $('a[href="#servidor/"]').remove();
 $('#list-personal .bt-disable').prop('disabled', true);
 $('#edit-personal #txt-password').prop('readonly', true);
 $('#edit-router #txt-contrasena').prop('readonly', true);
 $('#edit-router #txt-ip').prop('readonly', true);
 $('#edit-router #txt-contrasena').removeAttr( "onfocus" );
 $('#edit-router #txt-ip').removeAttr( "onfocus" );
 
 $('#edit-personal #txt-password').prop('readonly', true);
 
 
 
 
}
var testtime=setInterval(function(){ test(); }, 1000);