        <form wire:submit.prevent="submitForm" class="card add-new-car-form">
        <div class="form-content">
            <div class="form-details">
            <div class="row">
                <div class="col">
                <div class="form-group">
                    <label>Maker</label>
                    <select wire:model="maker"  wire:change="makerChanged($event.target.value)" name="maker">
                    <option value="{{ $makerObj?->id }}">{{ $makerObj?->name }}</option>
                        @foreach ($makers as $mkr)
                            <option value="{{ $mkr->id }}" @selected($mkr->id == $maker)>{{ $mkr->name }}</option>
                        @endforeach
                    </select>
                    {{-- <p class="error-message">This field is required</p> --}}
                </div>
                </div>
                <div class="col">
                <div class="form-group">
                    <label>Model</label>
                    <select wire:model="model" name="model">
                    <option value="{{ $modelObj?->id }}">{{ $modelObj?->name }}</option>
                        @foreach ($models as $model)
                            <option value="{{ $model->id }}">{{ $model->name }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
                <div class="col">
                <div class="form-group">
                    <label>Year</label>
                    <select wire:model="year" name="year">
                    <option value="{{$year}}">Year</option>
                        @for ($year = date('Y'); $year >= 1900; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                </div>
            </div>
            <div class="form-group">
                <label>Car Type</label>
                @foreach ($carTypes->chunk(4) as $chunk)
                <div class="row">
                    @foreach ($chunk as $carType)
                    <div class="col">
                        <label class="inline-radio">
                        <input type="radio" name="car_type" value="{{ $carType->id }}" wire:model="carType" />
                        {{ $carType->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
                @endforeach
            <div class="row">
                <div class="col">
                <div class="form-group">
                    <label>Price</label>
                    <input wire:model="price" type="number" name="price" placeholder="{{ $price }}" />
                </div>
                </div>
                <div class="col">
                <div class="form-group">
                    <label>Vin Code</label>
                    <input wire:model="vin" name="vin" placeholder="Vin Code" />
                </div>
                </div>
                <div class="col">
                <div class="form-group">
                    <label>Mileage (ml)</label>
                    <input wire:model="mileage" type="number" name="mileage" placeholder="{{ $mileage }}" />
                </div>
                </div>
            </div>
            <div class="form-group">
                <label>Fuel Type</label>
                <div class="row">
                @foreach ($fuels->chunk(4) as $chunk)
                <div class="row">
                    @foreach ($chunk as $fuel)
                    <div class="col">
                        <label class="inline-radio">
                        <input wire:model="fuelType" type="radio" name="fuel_type" value="{{ $fuel->id }}" />
                        {{ $fuel->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
                @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col">
                <div class="form-group">
                    <label>State/Region</label>
                    <select wire:model="state" wire:change="stateChanged($event.target.value)" name="state">
                    <option value="{{ $stateObj?->id }}">{{ $stateObj?->name }}</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
                <div class="col">
                <div class="form-group">
                    <label>City</label>
                    <select wire:model="city" name="city">
                    <option value="{{ $city }}">{{ $city }}</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                    </select>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                <div class="form-group">
                    <label>Address</label>
                    <input wire:model="address" value="{{ $car?$car->address:"" }}" name="address" placeholder="{{$car?$car->address:""}}" />
                </div>
                </div>
                <div class="col">
                <div class="form-group">
                    <label>Phone</label>
                    <input wire:model="phone" value="{{ $car?$car->phone:"" }}" name="phone" placeholder="{{$car?$car->phone:""}}" />
                </div>
                </div>
            </div>
            <div class="form-group">
                @foreach (array_chunk($features, 2, true) as $chunk)
                    <div class="row mb-4">
                    @foreach ($chunk as $feature => $value)
                        <div class="col md-3 mb-2">
                        <label class="checkbox me-3"> <!-- margin end (right) -->
                            <input type="checkbox" wire:model="features.{{ $feature }}" />
                            {{-- words(str_replace('_', ' ', $feature)) --}}
                            {{ ucwords(str_replace('_', ' ', $feature)) }}
                        </label>
                        </div>
                    @endforeach
                    </div>
                @endforeach
            </div>
            <div class="form-group">
                <label>Detailed Description</label>
                <textarea wire:model="description" name="description" rows="10" placeholder="{{ $car ? $car->description : '' }}">{{ $car?$car->description:"" }} </textarea>
            </div>
            <div class="form-group">
                <label class="checkbox">
                <input wire:model="published" wire:change="PublishedChanged($event.target.checked)" type="checkbox" />
                Published
                </label>
            </div>
            </>
            @if ($car&&$car->id)
                <div class="form-images">
            <p class="my-large">
                Manage your images
                <a href="{{ route('car.show', $car) }}">From here</a>
            </p>
            <div class="car-form-images">
                @foreach ($car->Images as $image)
                    <a class="car-form-image-preview">
                        <img src="{{ asset($image->url) }}" alt="" />
                    </a>
                @endforeach
            </div>
            </div>
            @endif
        <div class="p-medium" style="width: 100%">
            <div class="flex justify-end gap-1">
            <button type="button" wire:click="resetForm" class="btn btn-default">Reset</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            {{-- <button type="button" wire:click="submitForm" class="btn btn-primary">Submit</button> --}}
            </div>
        </div>
        </form>