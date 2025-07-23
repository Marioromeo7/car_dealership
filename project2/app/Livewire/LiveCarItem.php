<?php

namespace App\Livewire;

use App\Http\DataTransferObjects\FavoriteDTO;
use App\Http\Requests\favoriteRequest;
use App\services\carService;
use Livewire\Component;

class LiveCarItem extends Component
{
    public $car;
    public $inwatch;

    public $user;

    
    protected CarService $car_service;

    // ✅ Best place to inject services in Livewire
    public function boot(CarService $carService)
    {
        $this->car_service = $carService;
    }
    public function mount($car, $inwatch, $user){
        $this->car = $car;
        $this->inwatch = $inwatch;
        $this->user = $user;
    }
        public function changefavourability(){
        $dto = FavoriteDTO::fromArray([
            'car_id' => $this->car->id,
            'user_id' => $this->user->id,
            'inwatch' => $this->inwatch ? 1 : 0
        ]);
        $this->inwatch = $this->car_service->change_favourite($dto);
        $this->dispatch('msg', $this->inwatch ? 'Car added to watchlist.' : 'Car removed from watchlist.');
        if (url()->previous() === route('car.watchlist')) {
            $this->redirect('/car/watchlist', navigate: true);
        }
    }
    public function render()
    {
        return view('livewire.live-car-item');
    }
}
