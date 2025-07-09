<x-app-layout>
    @props(['$makers','$states','$types','$fuels'])
        <main>
      <div class="container-small">
        <h1 class="car-details-page-title">Add new car</h1>
        <form
          action="{{route('car.store')}}"
          method="POST"
          enctype="multipart/form-data"
          class="card add-new-car-form"
        >
          <div class="form-content">
            <div class="form-details">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>Maker</label>
                    <select name="maker_id" onchange="this.form.submit()">
                      <option value="">Maker</option>
                        @foreach($makers as $maker)
                            <option value="{{$maker->id}}" {{request('maker_id')==$maker->id?'selected':''}}>{{$maker->name}}</option>
                        @endforeach
                    </select>
                    <p class="error-message">This field is required</p>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Model</label>
                    <select>
                      <option value="">Model</option>
                        @foreach($maker->models as $model)
                            <option value="{{$model->id}}">{{$model->name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Year</label>
                    <select>
                      <option value="">Year</option>
                        @for($i=1990;$i<=now()->year;$i++)
                      <option value="{{$i}}">{{$i}}</option> @endfor
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Car Type</label>
                <div class="row">
                    @foreach($types as $type)
                  <div class="col">
                    <label class="inline-radio">
                      <input type="radio" name="car_type" value="{{$type->id}}" />
                        {{$type->name}}
                    </label>
                  </div>@endforeach
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" placeholder="Price" name="price" />
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Vin Code</label>
                    <input placeholder="Vin Code"  name="vin"/>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Mileage (ml)</label>
                    <input placeholder="Mileage" name="mileage"/>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Fuel Type</label>
                <div class="row">
                    @foreach($fuels as $fuel)
                  <div class="col">
                    <label class="inline-radio">
                      <input type="radio" name="fuel_type" value="{{$fuel->id}}" />
                        {{$fuel->id}}
                    </label>
                  </div>@endforeach
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>State/Region</label>
                    <select name="state_id" onchange="this.form.submit()">
                      <option value="">State/Region</option>
                        @foreach($states as $state)
                            <option value="{{$state->id}}" {{old('state_id')==$state->id?'selected':''}}>{{$state->name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>City</label>
                    <select>
                      <option value="">City</option>
                        @foreach($state->cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}
                            </option>
                        @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>Address</label>
                    <input placeholder="Address" name="address"/>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Phone</label>
                    <input placeholder="Phone" name="phone"/>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col">
                    <label class="checkbox">
                      <input
                        type="checkbox"
                        name="air_conditioning"
                        value="1"
                      />
                      Air Conditioning
                    </label>

                    <label class="checkbox">
                      <input type="checkbox" name="power_windows" value="1" />
                      Power Windows
                    </label>

                    <label class="checkbox">
                      <input
                        type="checkbox"
                        name="power_door_locks"
                        value="1"
                      />
                      Power Door Locks
                    </label>

                    <label class="checkbox">
                      <input type="checkbox" name="abs" value="1" />
                      ABS
                    </label>

                    <label class="checkbox">
                      <input type="checkbox" name="cruise_control" value="1" />
                      Cruise Control
                    </label>

                    <label class="checkbox">
                      <input
                        type="checkbox"
                        name="bluetooth_connectivity"
                        value="1"
                      />
                      Bluetooth Connectivity
                    </label>
                  </div>
                  <div class="col">
                    <label class="checkbox">
                      <input type="checkbox" name="remote_start" value="1" />
                      Remote Start
                    </label>

                    <label class="checkbox">
                      <input type="checkbox" name="gps_navigation" value="1" />
                      GPS Navigation System
                    </label>

                    <label class="checkbox">
                      <input type="checkbox" name="heated_seats" value="1" />
                      Heated Seats
                    </label>

                    <label class="checkbox">
                      <input type="checkbox" name="climate_control" value="1" />
                      Climate Control
                    </label>

                    <label class="checkbox">
                      <input
                        type="checkbox"
                        name="rear_parking_sensors"
                        value="1"
                      />
                      Rear Parking Sensors
                    </label>

                    <label class="checkbox">
                      <input type="checkbox" name="leather_seats" value="1" />
                      Leather Seats
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Detailed Description</label>
                <textarea rows="10" name="description"></textarea>
              </div>
              <div class="form-group">
                <label class="checkbox">
                  <input type="checkbox" name="published" value="0" />
                  Published
                </label>
              </div>
            </div>
            <div class="form-images">
              <div class="form-image-upload">
                <div class="upload-placeholder">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 48px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                    />
                  </svg>
                </div>
                <input id="carFormImageUpload" type="file" multiple />
              </div>
              <div id="imagePreviews" class="car-form-images"></div>
            </div>
          </div>
          <div class="p-medium" style="width: 100%">
            <div class="flex justify-end gap-1">
              <button type="button" class="btn btn-default">Reset</button>
              <button class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </main>

</x-app-layout>
