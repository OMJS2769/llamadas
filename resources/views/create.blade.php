<!-- Modal -->
<div wire:ignore.self class="modal fade" id="create_registro" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="width:100%;">
                    Llamada en curso
                    <span id="txt_tiempo" class="text-center" style="float:right;"></span>
                </h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>
            @if (!is_null($registro))
                <div class="modal-body">
                    <p>
                        Buenos días mi nombre es <strong>{{ Auth::user()->name }}</strong>,
                        <br>
                        ¿Hablo con <strong>{{ $registro->nombre }}</strong>?
                        <br>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus exercitationem nulla ab
                        dolore
                        obcaecati? Dolorem natus velit voluptatem.
                    </p>
                    <input type="hidden" wire:model="latitud" id="txt_latitud">
                    <input type="hidden" wire:model="longitud" id="txt_longitud">
                    <div class="form-group">
                        <label for="" class="font-weight-bold">Estatus de la llamada</label>
                        <select wire:model="status_id" id="" class="form-control">
                            <option value>--Seleccione una opción--</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->status }}</option>
                            @endforeach
                        </select>
                        @error('status_id')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    @if ($status_id == 2)
                        <div class="form-group">
                            <label for="" class="font-weight-bold">Pregunta 1</label>
                            <select wire:model="respuesta_1" id="" class="form-control">
                                <option value>--Seleccione una opción--</option>
                                <option value="respuesta_1_1">Respuesta 1</option>
                                <option value="respuesta_1_2">Respuesta 2</option>
                            </select>
                            @error('respuesta_1')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="font-weight-bold">Pregunta 2</label>
                            <select wire:model="respuesta_2" id="" class="form-control">
                                <option value>--Seleccione una opción--</option>
                                <option value="respuesta_2_1">Respuesta 1</option>
                                <option value="respuesta_2_1">Respuesta 2</option>
                            </select>
                            @error('respuesta_2')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="font-weight-bold">Pregunta 3</label>
                            <select wire:model="respuesta_3" id="" class="form-control">
                                <option value>--Seleccione una opción--</option>
                                <option value="respuesta_3_1">Respuesta 1</option>
                                <option value="respuesta_3_2">Respuesta 2</option>
                            </select>
                            @error('respuesta_3')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                    <a id="open_phone" href="tel://{{ $openPhone }}" class="btn btn-primary btn-block">Llamar de
                        nuevo</a>
                </div>
            @endif
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <button wire:click="store" type="button" class="btn btn-success btn-block">Registrar llamada</button>
            </div>
        </div>
    </div>
</div>
