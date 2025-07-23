<?php

namespace App\Livewire;
use App\Http\DataTransferObjects\CarDTO;
use App\Models\Car;
use App\Models\carType;
use App\Models\city;
use App\Models\FuelType;
use App\Models\maker;
use App\Models\model;
use App\services\carService;
use Livewire\Component;
use \App\Models\State; // Ensure the correct namespace is used for State model

class CreateEditForm extends Component
{
//     protected ?carService $car_service=null;
//     protected function carService(): carService
// {
//     return $this->car_service ??= app(carService::class);
// }

    public $published;
    public $published_at = null;
    public $selectedFeatures = [];
    public $description;
    public  $car=null;
    public $state;
    public $city;
    public $cityObj;
    public $maker;
    public $makerObj;
    public $model;
    public $modelObj;
    public $year;
    public $carType;
    public $price;
    public $fuelType;
    public $vin;
    public $mileage;
    public $states;
    public $makers;
    public $models;
    public $cities;
    public $fuels;
    public $carTypes;
    public $stateObj;
    public $phone;
    public $address;
    public $features = [
        'air_conditioning' => false,
        'abs' => false,
        'power_windows' => false,
        'power_door_locks' => false,
        'cruise_control' => false,
        'leather_seats' => false,
        'remote_start' => false,
        'gps_navigation' => false,
        'bluetooth_connectivity' => false,
        'rear_parking_sensors' => false,
        'heater_seats' => false,
        'climate_control' => false
    ];
    public function mount(Car $car = null, carService $car_service)
    {
        $this->car_service = $car_service;
        $this->description = $car ? $car->description : "";
        $this->phone = $car ? $car->phone : "";
        $this->address = $car ? $car->address : "";
        $this->selectedFeatures = $car ? array_keys($car->features ?? []) : [];
        $this->published = $car ? $car->published_at !== null : false;
        $this->car = $car;
        $this->city = $car ? $car->city_id : "";
        $this->cityObj = $this->city ? city::find($this->city) : null;
        $this->state = $this->city ? city::find($this->city)->state_id : "";
        $this->stateObj = $this->state ? State::find($this->state) : null;
        $this->maker = $car ? $car->maker_id : "";
        $this->makerObj = $car ? maker::find($this->maker) : null;
        $this->model = $car ? $car->model_id : "";
        $this->modelObj = $car ? model::find($car->model_id) : null;
        $this->year = $car ? $car->year : "";
        $this->carType = $car ? $car->car_type_id : "";
        $this->price = $car ? $car->price : "";
        $this->fuelType = $car ? $car->fuel_type_id : "";
        $this->vin = $car ? $car->vin : "";
        $this->mileage = $car ? $car->mileage : "";
        $this->models = $this->maker ? maker::find($this->maker)?->models ?? [] : [];
        $this->cities = $this->state ? state::find($this->state)?->cities ?? [] : [];
        $this->states = State::all();
        $this->makers = maker::all();
        $this->fuels = FuelType::all();
        $this->carTypes = carType::all();
        $this->features = $this->car ?( $this->car->id ? $this->car->CarFeature->only(['air_conditioning', 'abs', 'power_windows', 'power_door_locks', 'cruise_control','leather_seats','remote_start','gps_navigation','bluetooth_connectivity','rear_parking_sensors','heater_seats','climate_control']) : [
            'air_conditioning' => false,
            'abs' => false,
            'power_windows' => false,
            'power_door_locks' => false,
            'cruise_control' => false,
            'leather_seats' => false,
            'remote_start' => false,
            'gps_navigation' => false,
            'bluetooth_connectivity' => false,
            'rear_parking_sensors' => false,
            'heater_seats' => false,
            'climate_control' => false
        ] ) : [
            'air_conditioning' => false,
            'abs' => false,
            'power_windows' => false,
            'power_door_locks' => false,
            'cruise_control' => false,
            'leather_seats' => false,
            'remote_start' => false,
            'gps_navigation' => false,
            'bluetooth_connectivity' => false,
            'rear_parking_sensors' => false,
            'heater_seats' => false,
            'climate_control' => false
        ];
        $this->features = collect($this->features)
            ->map(fn($v) => (bool) $v)
            ->toArray();
    }
    protected function car_service()
{
    return app(\App\Services\CarService::class);
}
    public function resetForm()
    {
        $this->reset(['description','phone','address','features', 'vin', 'mileage', 'state', 'maker', 'model', 'year', 'carType', 'price', 'fuelType', 'city']);
        $this->selectedFeatures = [];
        $this->published = false;
        $this->published_at = null;
    }
    public function submitForm()
    {
        $this->validate([
            'state' => 'required',
            'maker' => 'required',
            'model' => 'required',
            'year' => 'required',
            'carType' => 'required',
            'price' => 'required|numeric|min:0',
            'fuelType' => 'required',
            'city' => 'required',
        ]);
        // Save the car data logic here...
        if ($this->car&&$this->car->id) {
            $this->car_service()->editCar(
                CarDTO::fromArray([
                    'description' => $this->description,
                    'phone' => $this->phone,
                    'address' => $this->address,
                    'make' => $this->maker,
                    'model' => $this->model,
                    'year' => $this->year,
                    'car_type' => $this->carType,
                    'price' => $this->price,
                    'fuel_type' => $this->fuelType,
                    'city' => $this->city,
                    'vin' => $this->vin,
                    'mileage' => $this->mileage,
                    'published_at' => $this->published_at ? $this->published_at->toDate() : null,
                    'user_id' => 1 // Assuming user ID 1 is the logged-in user
                ]), $this->car, $this->features);
            // $this->car->update([
            //     'description' => $this->description,
            //     'phone' => $this->phone,
            //     'address' => $this->address,
            //     'maker_id' => $this->maker,
            //     'model_id' => $this->model,
            //     'year' => $this->year,
            //     'car_type_id' => $this->carType,
            //     'price' => $this->price,
            //     'fuel_type_id' => $this->fuelType,
            //     'city_id' => $this->city,
            //     'vin' => $this->vin,
            //     'mileage' => $this->mileage,
            //     'published_at' => $this->published_at,
            //     'user_id' => $this->car->user_id,
            // ]);
        } else {
            // Create a new car instance
            $this->car_service()->createCar(
                CarDTO::fromArray([
                    'description' => $this->description,
                    'phone' => $this->phone,
                    'address' => $this->address,
                    'make' => $this->maker,
                    'model' => $this->model,
                    'year' => $this->year,
                    'car_type' => $this->carType,
                    'price' => $this->price,
                    'fuel_type' => $this->fuelType,
                    'city' => $this->city,
                    'vin' => $this->vin,
                    'mileage' => $this->mileage,
                    'published_at' => $this->published_at ? $this->published_at->toDate() : null,
                    'user_id' => 1 // Assuming user ID 1 is the logged-in user
                ]), $this->features
            );
            // $this->car = Car::create([
            //     'description' => $this->description,
            //     'phone' => $this->phone,
            //     'address' => $this->address,
            //     'maker_id' => $this->maker,
            //     'model_id' => $this->model,
            //     'year' => $this->year,
            //     'car_type_id' => $this->carType,
            //     'price' => $this->price,
            //     'fuel_type_id' => $this->fuelType,
            //     'city_id' => $this->city,
            //     'vin' => $this->vin,
            //     'mileage' => $this->mileage,
            //     'published_at' => $this->published_at ? $this->published_at->toDate() : null,
            //     'user_id' => 1
            // ]);
        }
        session()->flash('message', 'Car created successfully.');
        return redirect()->route('car.index');
    }
    public function render()
    {
        return view('livewire.create-edit-form');
    }
        public function updatedState($value)
    {
        $this->cities = city::where('state_id', $value)->get();
        $this->city = '';
    }

    public function updatedMaker($value)
    {
        $this->models = model::where('maker_id', $value)->get();
        $this->model = '';
    }
    public function makerChanged($value)
{
    $this->maker = $value;

    // Do whatever you need here
}
    public function stateChanged($value)
    {
        $this->state = $value;
        // $this->cities = city::where('state_id', $value)->get();
        // $this->city = '';
    }
    public function PublishedChanged($value)
{
    $this->published_at = $value ? now() : null;
}
//     public function selectedFeaturesChanged($value)
//     {
//         $this->selectedFeatures->add($value);
//         $this->features = array_fill_keys($this->selectedFeatures, true);
//         // You can handle the selected features logic here if needed
// }
}