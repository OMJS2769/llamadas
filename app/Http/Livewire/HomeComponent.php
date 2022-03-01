<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Registro;
use App\Models\RegistroStatus;
use App\Models\UserRegistro;

class HomeComponent extends Component
{
    public $registro = null;
    public $statuses;
    public $openPhone;

    public
        $registro_id,
        $status_id,
        $respuesta_1,
        $respuesta_2,
        $respuesta_3,
        $latitud,
        $longitud;

    public function mount()
    {
        $this->statuses = RegistroStatus::where('id', '!=', 1)->get();
    }

    public function render()
    {
        return view('livewire.home-component');
    }

    public function solicitarLlamada()
    {
        $this->registro = Registro::inRandomOrder()
            //where status XXXXX
            ->first();
        $this->openPhone = $this->registro->telefono;
        $this->emit('create_registro');
    }

    public function store()
    {
        $campos = ['status_id' => 'required'];
        $mensajes = ['status_id.required' => 'El estatus es obligatorio.'];

        if ($this->status_id == 2) {
            $campos = $campos + [
                'respuesta_1' => 'required',
                'respuesta_2' => 'required',
                'respuesta_3' => 'required',
            ];
            $mensajes = $mensajes + [
                'respuesta_1.required' => 'Por favor responda esta pregunta',
                'respuesta_2.required' => 'Por favor responda esta pregunta',
                'respuesta_3.required' => 'Por favor responda esta pregunta',
            ];
        }
        $this->validate($campos, $mensajes);

        $userRegistro = UserRegistro::create([
            'user_id' => \Auth::user()->id,
            'registro_id' => $this->registro->id,
            'status_id' => $this->status_id,
            'latitud' => null,
            'longitud' => null,
            'respuesta_1' => $this->respuesta_1,
            'respuesta_2' => $this->respuesta_2,
            'respuesta_3' => $this->respuesta_3,
            'latitud' => $this->latitud,
            'longitud' => $this->longitud
        ]);
        if ($userRegistro) {
            $this->registro_id = $userRegistro->id;
            $this->registro->status_id = $this->status_id;
            $this->registro->save();
            $this->default();
            $this->emit('uploadAudio');
            //$this->emit('dissmisCreate', 'Llamada registrada');
        }
    }

    public function default()
    {
        $this->registro = null;
        $this->status_id = null;
        $this->respuesta_1 = null;
        $this->respuesta_2 = null;
        $this->respuesta_3 = null;
    }
}
