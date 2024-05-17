<?php

function getWeather($city, $country, $apiKey) {
    $url = "http://api.openweathermap.org/data/2.5/weather?q={$city},{$country}&appid={$apiKey}&units=metric";

    $response = file_get_contents($url);
    if ($response === FALSE) {
        die("Error fetching data.");
    }

    $weatherData = json_decode($response, true);

    if ($weatherData['cod'] !== 200) {
        die("Error: " . $weatherData['message']);
    }

    return $weatherData;
}

echo "Enter city: ";
$city = trim(fgets(STDIN));

echo "Enter country: ";
$country = trim(fgets(STDIN));

$apiKey = 'bb4288cd74a0b0212d76e1331acac78a';

$weatherData = getWeather($city, $country, $apiKey);

$temperature = $weatherData['main']['temp'];
$feelsLike = $weatherData['main']['feels_like'];
$description = $weatherData['weather'][0]['description'];
$windSpeed = $weatherData['wind']['speed'] * 3.6;

echo "Weather in {$city}, {$country}:\n";
echo "Temperature: {$temperature}°C\n";
echo "Feels Like: {$feelsLike}°C\n";
echo "Description: {$description}\n";
echo "Wind Speed: {$windSpeed} km/h\n";