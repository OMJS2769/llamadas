var options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
};

function success(pos) {
    var crd = pos.coords;

    $("#txt_latitud").val(crd.latitude);
    $("#txt_longitud").val(crd.latitude);
};

function error(err) {
    console.warn('ERROR(' + err.code + '): ' + err.message);
};

$(document).ready(function () {

    Livewire.on('create_registro', function () {
        $("#create_registro").modal({
            backdrop: 'static',
            keyboard: false
        });
        iniciarAudio();
        $("#open_phone")[0].click();
    });
    // Livewire.on('dissmisCreate', function (msg) {
    //     $("#create_registro").modal('hide');
    //     alertify.success(msg);
    // });

    Livewire.on('uploadAudio', function () {
        mediaRecorder.stop();
    });
    navigator
        .mediaDevices
        .getUserMedia({ /*video: true,*/ audio: true })
        .then(stream => {
            console.log("Permisos de audio activados")
            //comprobar permisos de ubicación
            navigator.geolocation.getCurrentPosition(function (pos) {
                var crd = pos.coords;
                $("#txt_latitud").val(crd.latitude);
                $("#txt_longitud").val(crd.latitude);
                //Si hay permisos de ubicación se habilita el botón de solicitar llamada
                console.log("permisos de ubicación activados");
                $("#btn_solicitar_llamada").css('display', 'block');
                $('#mensaje_permisos').css('display', 'none');
            }, function (err) {
                console.warn('ERROR(' + err.code + '): ' + err.message);
            }, options);

        })
        .catch(e => {
            console.warn("e: ", e);
        });
});

let tiempoInicio, mediaRecorder, idIntervalo, tiempo_total;
function iniciarAudio() {
    if (navigator.mediaDevices) {
        console.log('getUserMedia supported.');
        var record = document.getElementById("btnRecord");
        var stop = document.getElementById("btnStop");
        var soundClips = document.getElementById("list");
        var tiempo = document.getElementById("txt_tiempo");
        var constraints = { audio: true };
        var chunks = [];

        navigator.mediaDevices.getUserMedia(constraints)
            .then(function (stream) {

                mediaRecorder = new MediaRecorder(stream);
                mediaRecorder.start();
                const segundosATiempo = numeroDeSegundos => {
                    let horas = Math.floor(numeroDeSegundos / 60 / 60);
                    numeroDeSegundos -= horas * 60 * 60;
                    let minutos = Math.floor(numeroDeSegundos / 60);
                    numeroDeSegundos -= minutos * 60;
                    numeroDeSegundos = parseInt(numeroDeSegundos);
                    if (horas < 10) horas = "0" + horas;
                    if (minutos < 10) minutos = "0" + minutos;
                    if (numeroDeSegundos < 10) numeroDeSegundos = "0" + numeroDeSegundos;

                    return `${horas}:${minutos}:${numeroDeSegundos}`;
                };
                const refrescar = () => {
                    tiempo.textContent = segundosATiempo((Date.now() - tiempoInicio) / 1000);
                    tiempo_total = tiempo.textContent;
                }
                const comenzarAContar = () => {
                    tiempoInicio = Date.now();
                    idIntervalo = setInterval(refrescar, 500);
                };
                const detenerConteo = () => {
                    tiempo_total = tiempo.textContent;
                    clearInterval(idIntervalo);
                    tiempoInicio = null;
                    tiempo.textContent = "";
                }
                //iniciar contador
                comenzarAContar();
                console.log(stream);
                mediaRecorder.onstop = function (e) {
                    console.log("Audio detenido");
                    var blob = new Blob(chunks, { 'type': 'audio/ogg; codecs=opus' });
                    chunks = [];
                    var audioURL = URL.createObjectURL(blob);
                    console.log(blob);
                    console.log(audioURL);
                    var formdata = new FormData();
                    formdata.append('audio_blob', blob);
                    formdata.append('registro_id', $("#txt_registro_id").val());
                    formdata.append('tiempo', tiempo_total);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    console.log("Subiendo audio");
                    $.ajax({
                        type: 'POST',
                        url: $("#ruta_upload_audio").val(),
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            console.log(data);
                            if (data == '1') {
                                console.log("Audio almacenado.");
                                $("#create_registro").modal('hide');
                                alertify.success("El registro se almacenó con éxito.");
                            }
                            detenerConteo();
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(JSON.stringify(XMLHttpRequest) + ' ' + textStatus + ' ' + errorThrown);
                        }
                    });
                }

                mediaRecorder.ondataavailable = function (e) {
                    chunks.push(e.data);
                }
            })
            .catch(function (err) {
                console.log('The following error occurred: ' + err);
            })
    }
}

function detenerAudio() {
    if (mediaRecorder != undefined)
        mediaRecorder.stop();
}
