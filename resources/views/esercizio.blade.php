@php
    
$passengers = [
    [
    "id" => 1,
    "passengerName" => "Freddie Mercury",
    "isVegetarianOrVegan" => false,
    "connectedFlights" => 2,
    ],
    [
    "id" => 2,
    "passengerName" => "Amy Winehouse",
    "isVegetarianOrVegan" => true,
    "connectedFlights" => 4,
    ],
    [
    "id" => 3,
    "passengerName" => "Kurt Cobain",
    "isVegetarianOrVegan" => true,
    "connectedFlights" => 3,
    ],
    [
    "id" => 3,
    "passengerName" => "Michael Jackson",
    "isVegetarianOrVegan" => true,
    "connectedFlights" => 1,
    ],
];

$onlynames=[];

foreach ($passengers as $passenger) {


    # code...
    if ($passenger['isVegetarianOrVegan']) {
        # code...
        $onlynames[]=$passenger['passengerName'];
    }


        

}

var_dump($onlynames)



@endphp