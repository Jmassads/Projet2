=== m1.MiniWeather ===
Contributors: maennchen1.de
Tags: weather, widget, cloud, cloudiness, conditions, current conditions, current weather, frost, gauge, heat index, local weather, meteo, rain, snow, temperature, temp, weather by city, weather widget
Requires at least: 4.0
Tested up to: 4.9
Requires PHP: 5.4
Stable tag: 0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin easily displays a weather widget (icon + temperature) with a destination of your choice.

== Description ==
This plugin easily displays a weather widget with a destination of your choice. No PHP or Shortcode, just a widget.
It caches the requests to the weather database in given intervals.
You will need a free account at https://home.openweathermap.org/users/sign_up .

Font-Icons by Erik Flowers: https://erikflowers.github.io/weather-icons/

== Installation ==
1. upload the folder `m1.miniweather` to your directory (`wp-config/plugins/`)
1. activate the plugin 
1. get a free OpenWeatherMap-account (for API-use): https://home.openweathermap.org/users/sign_up
1. register an OpenWeatherMap app
1. search your location, copy longitude & langitude
1. place the widget in your sidebar
1. add your API-key, longitude & langitude from OpenWeatherMap to m1.MiniWeather widget

== Screenshots ==
1. example screenshot
2. find longitude (e.g. 13.41053) & latitude (e.g. 52.524368)
3. WordPress backend, Widget m1.MiniWeather


== Changelog ==
= 0.3 =
* fix: display "C" or "F"
* PHP7 compatibility

= 0.2 =
* initial release