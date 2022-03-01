<div>
    <div class="container">
        <div class="row justify-content-center">
            <div wire:ignore class="col-md-8">
                <div class="card">
                    <div class="card-header font-weight-bol">Inicio</div>
                    <div class="card-body">
                        <button id="btn_solicitar_llamada" wire:click="solicitarLlamada"
                            class="btn btn-primary btn-block" style="display:none;">
                            Solicitar llamada
                        </button>
                        <h3 id="mensaje_permisos">
                            Debe aceptar todos los permisos antes de iniciar
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('create')
    <input type="hidden" id="txt_registro_id" wire:model="registro_id">
    <input type="hidden" value="{{ route('upload_audio') }}" id="ruta_upload_audio">
</div>
