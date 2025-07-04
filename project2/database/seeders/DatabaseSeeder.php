<?php

namespace Database\Seeders;

use App\Models\car;
use App\Models\carFeature;
use App\Models\carImage;
use App\Models\carType;
use App\Models\city;
use App\Models\FuelType;
use App\Models\maker;
use App\Models\model;
use App\Models\state;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        carType::factory()->sequence(
            ['name'=>'Sedan'],
            ['name'=>'Hatchback'],
            ['name'=>'SUV'],
            ['name'=>'Pickup Truck'],
            ['name'=>'Minivan'],
            ['name'=>'Jeep'],
            ['name'=>'Coupe'],
            ['name'=>'Crossover'],
            ['name'=>'Sports Car']
        )->count(9)->create();

        FuelType::factory()->sequence(
            ['name'=>'Gasoline'],
            ['name'=>'Diesel'],
            ['name'=>'Electric'],
            ['name'=>'Hybrid']
        )->count(4)->create();
        $states = [
            'Alabama' => ['Birmingham', 'Montgomery', 'Mobile', 'Huntsville', 'Tuscaloosa'],
            'Alaska' => ['Anchorage', 'Fairbanks', 'Juneau', 'Wasilla', 'Sitka'],
            'Arizona' => ['Phoenix', 'Tucson', 'Mesa', 'Chandler', 'Scottsdale'],
            'Arkansas' => ['Little Rock', 'Fort Smith', 'Fayetteville', 'Springdale', 'Jonesboro'],
            'California' => ['Los Angeles', 'San Diego', 'San Jose', 'San Francisco', 'Fresno', 'Sacramento', 'Long Beach', 'Oakland', 'Bakersfield'],
            'Colorado' => ['Denver', 'Colorado Springs', 'Aurora', 'Fort Collins', 'Lakewood'],
            'Connecticut' => ['Bridgeport', 'New Haven', 'Stamford', 'Hartford', 'Waterbury'],
            'Delaware' => ['Wilmington', 'Dover', 'Newark', 'Middletown', 'Smyrna'],
            'Florida' => ['Jacksonville', 'Miami', 'Tampa', 'Orlando', 'St. Petersburg', 'Hialeah', 'Tallahassee', 'Fort Lauderdale'],
            'Georgia' => ['Atlanta', 'Augusta', 'Columbus', 'Savannah', 'Athens'],
            'Hawaii' => ['Honolulu', 'Hilo', 'Kailua', 'Kaneohe', 'Pearl City'],
            'Idaho' => ['Boise', 'Meridian', 'Nampa', 'Idaho Falls', 'Pocatello'],
            'Illinois' => ['Chicago', 'Aurora', 'Naperville', 'Joliet', 'Rockford'],
            'Indiana' => ['Indianapolis', 'Fort Wayne', 'Evansville', 'South Bend', 'Carmel'],
            'Iowa' => ['Des Moines', 'Cedar Rapids', 'Davenport', 'Sioux City', 'Iowa City'],
            'Kansas' => ['Wichita', 'Overland Park', 'Kansas City', 'Olathe', 'Topeka'],
            'Kentucky' => ['Louisville', 'Lexington', 'Bowling Green', 'Owensboro', 'Covington'],
            'Louisiana' => ['New Orleans', 'Baton Rouge', 'Shreveport', 'Lafayette', 'Lake Charles'],
            'Maine' => ['Portland', 'Lewiston', 'Bangor', 'South Portland', 'Auburn'],
            'Maryland' => ['Baltimore', 'Frederick', 'Rockville', 'Gaithersburg', 'Bowie'],
            'Massachusetts' => ['Boston', 'Worcester', 'Springfield', 'Lowell', 'Cambridge'],
            'Michigan' => ['Detroit', 'Grand Rapids', 'Warren', 'Sterling Heights', 'Ann Arbor'],
            'Minnesota' => ['Minneapolis', 'St. Paul', 'Rochester', 'Duluth', 'Bloomington'],
            'Mississippi' => ['Jackson', 'Gulfport', 'Southaven', 'Hattiesburg', 'Biloxi'],
            'Missouri' => ['Kansas City', 'St. Louis', 'Springfield', 'Columbia', 'Independence'],
            'Montana' => ['Billings', 'Missoula', 'Great Falls', 'Bozeman', 'Butte'],
            'Nebraska' => ['Omaha', 'Lincoln', 'Bellevue', 'Grand Island', 'Kearney'],
            'Nevada' => ['Las Vegas', 'Henderson', 'Reno', 'North Las Vegas', 'Sparks'],
            'New Hampshire' => ['Manchester', 'Nashua', 'Concord', 'Dover', 'Rochester'],
            'New Jersey' => ['Newark', 'Jersey City', 'Paterson', 'Elizabeth', 'Edison'],
            'New Mexico' => ['Albuquerque', 'Las Cruces', 'Rio Rancho', 'Santa Fe', 'Roswell'],
            'New York' => ['New York City', 'Buffalo', 'Rochester', 'Yonkers', 'Syracuse'],
            'North Carolina' => ['Charlotte', 'Raleigh', 'Greensboro', 'Durham', 'Winston-Salem'],
            'North Dakota' => ['Fargo', 'Bismarck', 'Grand Forks', 'Minot', 'West Fargo'],
            'Ohio' => ['Columbus', 'Cleveland', 'Cincinnati', 'Toledo', 'Akron'],
            'Oklahoma' => ['Oklahoma City', 'Tulsa', 'Norman', 'Broken Arrow', 'Lawton'],
            'Oregon' => ['Portland', 'Eugene', 'Salem', 'Gresham', 'Hillsboro'],
            'Pennsylvania' => ['Philadelphia', 'Pittsburgh', 'Allentown', 'Erie', 'Reading'],
            'Rhode Island' => ['Providence', 'Warwick', 'Cranston', 'Pawtucket', 'East Providence'],
            'South Carolina' => ['Columbia', 'Charleston', 'North Charleston', 'Mount Pleasant', 'Rock Hill'],
            'South Dakota' => ['Sioux Falls', 'Rapid City', 'Aberdeen', 'Brookings', 'Watertown'],
            'Tennessee' => ['Memphis', 'Nashville', 'Knoxville', 'Chattanooga', 'Clarksville'],
            'Texas' => ['Houston', 'San Antonio', 'Dallas', 'Austin', 'Fort Worth', 'El Paso', 'Arlington', 'Corpus Christi'],
            'Utah' => ['Salt Lake City', 'West Valley City', 'Provo', 'West Jordan', 'Orem'],
            'Vermont' => ['Burlington', 'South Burlington', 'Rutland', 'Barre', 'Montpelier'],
            'Virginia' => ['Virginia Beach', 'Norfolk', 'Chesapeake', 'Richmond', 'Newport News'],
            'Washington' => ['Seattle', 'Spokane', 'Tacoma', 'Vancouver', 'Bellevue'],
            'West Virginia' => ['Charleston', 'Huntington', 'Morgantown', 'Parkersburg', 'Wheeling'],
            'Wisconsin' => ['Milwaukee', 'Madison', 'Green Bay', 'Kenosha', 'Racine'],
            'Wyoming' => ['Cheyenne', 'Casper', 'Laramie', 'Gillette', 'Rock Springs'],
        ];
    foreach ($states as $state=>$cities) {
        state::factory()->state(['name'=>$state])
            ->has(city::factory()->count(count($cities))->sequence(...array_map(fn($city)=>['name'=>$city],$cities)))
            ->create();
    }
        $carMakers = [
            'Toyota' => ['Corolla', 'Camry', 'RAV4', 'Highlander', 'Prius', 'Yaris', 'Land Cruiser', 'Tacoma'],
            'Honda' => ['Civic', 'Accord', 'CR-V', 'Pilot', 'Fit', 'HR-V', 'Odyssey', 'Ridgeline'],
            'Ford' => ['F-150', 'Mustang', 'Explorer', 'Escape', 'Focus', 'Fusion', 'Edge', 'Bronco'],
            'Chevrolet' => ['Silverado', 'Malibu', 'Equinox', 'Tahoe', 'Camaro', 'Traverse', 'Impala', 'Colorado'],
            'BMW' => ['3 Series', '5 Series', 'X3', 'X5', '7 Series', 'M3', 'X1', 'i3'],
            'Mercedes-Benz' => ['C-Class', 'E-Class', 'GLC', 'GLE', 'S-Class', 'A-Class', 'GLA', 'CLA'],
            'Nissan' => ['Altima', 'Sentra', 'Rogue', 'Murano', 'Maxima', 'Pathfinder', 'Versa', 'Frontier'],
            'Hyundai' => ['Elantra', 'Sonata', 'Tucson', 'Santa Fe', 'Accent', 'Palisade', 'Kona', 'Venue'],
            'Kia' => ['Rio', 'Forte', 'Optima', 'Sportage', 'Sorento', 'Telluride', 'Soul', 'Stinger'],
            'Volkswagen' => ['Golf', 'Passat', 'Jetta', 'Tiguan', 'Atlas', 'Beetle', 'Touareg', 'Arteon'],
            'Audi' => ['A3', 'A4', 'A6', 'Q3', 'Q5', 'Q7', 'TT', 'RS5'],
            'Lexus' => ['IS', 'ES', 'RX', 'NX', 'GS', 'GX', 'LX', 'RC'],
            'Mazda' => ['Mazda3', 'Mazda6', 'CX-3', 'CX-5', 'CX-9', 'MX-5 Miata'],
            'Subaru' => ['Impreza', 'Legacy', 'Forester', 'Outback', 'Crosstrek', 'WRX', 'BRZ'],
            'Jeep' => ['Wrangler', 'Grand Cherokee', 'Cherokee', 'Compass', 'Renegade', 'Gladiator'],
            'Tesla' => ['Model S', 'Model 3', 'Model X', 'Model Y', 'Cybertruck', 'Roadster'],
            'Peugeot' => ['208', '308', '2008', '3008', '5008', '508'],
            'Renault' => ['Clio', 'Megane', 'Captur', 'Kadjar', 'Talisman', 'Scenic'],
            'Fiat' => ['500', 'Panda', 'Tipo', 'Punto', 'Doblo'],
            'Skoda' => ['Octavia', 'Superb', 'Fabia', 'Kodiaq', 'Kamiq'],
            'Volvo' => ['S60', 'S90', 'XC40', 'XC60', 'XC90', 'V60', 'V90'],
            'Land Rover' => ['Range Rover', 'Range Rover Evoque', 'Discovery', 'Defender', 'Range Rover Sport'],
            'Mitsubishi' => ['Lancer', 'Outlander', 'Eclipse Cross', 'Pajero', 'Mirage', 'ASX'],
            'Porsche' => ['911', 'Cayenne', 'Panamera', 'Macan', 'Taycan', '718 Cayman'],
            'Jaguar' => ['XE', 'XF', 'F-Pace', 'E-Pace', 'F-Type', 'XJ'],
            'Alfa Romeo' => ['Giulia', 'Stelvio', 'MiTo', 'Giulietta'],
        ];
        foreach ($carMakers as $make=>$modes) {
            maker::factory()->state(['name'=>$make])
                ->has(model::factory()->count(count($modes))->sequence(...array_map(fn($mode)=>['name'=>$mode],$modes)))
                ->create();
        }
        User::factory()->count(3)->create();
        User::factory()->count(2)->has(car::factory()->count(50)->has(carImage::factory()->count(3)->sequence(fn(Sequence $sequence)=>['position'=>$sequence->index%3+1]),'Images')->hasCarFeature(),'favouriteCars')->create();

    }
}
