=== Ventus - Weather Map Widget & Shortcode ===
Contributors: davidmatthew
Tags: weather map, weather forecast, windy, weather, map, forecast, ventus
Requires at least: 5.0
Tested up to: 6.0
Requires PHP: 7.0
Stable tag: 1.3.0
License: GPL-3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt

Easily customise and embed the windy.com widget as a native WordPress widget or shortcode.

== Description ==
Ventus allows you to easily embed the [windy.com](https://www.windy.com) widget on your website, in the form of a native WordPress widget (accessible from Appearance > Widgets) or as a simple shortcode. 

It is a lightweight plugin built using an object-oriented approach, and follows [Wordpress Coding Standards](https://github.com/WordPress/WordPress-Coding-Standards).

= Features =
* Set the overlay to either clouds, CO concentration, radar/lightning, rain, sea temperature, snow cover, standard temperature, waves, or wind.
* Use either Celsius or Fahrenheit as the temperature scale.
* Set the width, height and border-radius using responsive (%) and/or fixed (px) values.
* Manually define longitude and latitude for precise location coordinates.
* Choose from 8 levels of zoom (min. 3, max. 11).
* Show or hide pressure isolines, the map marker and spot forecast.
* Choose from the following wind measurement units: beaufort (bft), kilometers per hour (km/h), knots (kt), meters per second (m/s) and miles per hour (mph).

= Shortcodes =
The shortcode accepts up to 13 attributes. You can simply use `[ventus]` and it will work (or the old shortcode `[weather-map]` which will continue to work), but you will most likely want to customise the remaining attributes yourself.

An example of a fully filled-out shortcode would be:

`[ventus width="100%" height="350px" radius="20px" lat="53.199" lon="-7.603" zoom="4" layer="wind" scale="C" units="knots" pressure="true"  marker="true" forecast="true" time="12"]`. 

The attributes can be set as follows:

* The `width` attribute accepts any valid CSS property for width.
* The `height` attribute accepts any valid CSS property for height.
* The `radius` attribute accepts any valid CSS property for border-radius.
* The `lat` attribute must contain a string of digits to three decimal places, in the range of -90 to +90 (e.g. "53.199"). 
* The `lon` attribute must also contain a string of digits to three decimal places, in the range of -180 to +180 (e.g. "-120.894"). 
* The `zoom` attribute must contain a number between 3 and 11 (inclusive).
* The `layer` attribute accepts the following values: clouds, cosc (CO concentration), radar, rain, snowcover, sst (sea temperature), temp (standard temperature), waves and wind.
* The `scale` attribute accepts either "C" or "F", defining Celsius and Fahrenheit respectively.
* The `units` attribute accepts the following values: bft (beaufort), km/h (kilometers per hour), kt (knots), m/s (meters per second) and mph (miles per hour).
* The `pressure` attribute can be set to true to display pressure isolines, otherwise the isolines will remain hidden.
* The `marker` attribute can also be set to true, otherwise it will remain hidden.
* The `forecast` attribute can be set to true to display the spot forecast, otherwise it will remain hidden.
* The `time` attribute accepts the following values: now (the default), 12 (12 hours from now) and 24 (24 hours from now).

Note that in the case of an invalid value, a default value will be used instead.

== Installation ==
1. No special set-up required - just click install and activate, and you're good to go!
2. If you manually download the plugin, just unzip to the WordPress plugins folder and the plugin will be automatically detected. It can then be activated as normal.

== Frequently Asked Questions ==
= How do I set the latitude and longitude?

The easiest (and recommended) way to do this is to go straight to [windy.com](https://www.windy.com). Once there, take note of the URL. It will contain the latitude and longitude in its parameters, and if you zoom in, it will also contain the zoom level. For example, the sample parameters I use as defaults are: latitude 53.199, longitude -7.603, and a zoom level of 5. These would show in the URL in the following format: [windy.com/?53.199,-7.603,5](https://www.windy.com).

= Why not just embed the iframe directly from [windy.com](https://www.windy.com) instead of using this plugin? =

If you'd prefer to do this, that's great - no problem! However, this plugin was created to make the iframe that [windy.com](https://www.windy.com) kindly provide even more useful. To that end, it offers the following advantages:

* While an iframe can be inserted directly into a page or post, you can't insert an iframe directly into the WordPress widgets area (which is how most themes allow you to set the content for site sidebars and footers etc). This plugin allows you to do precisely that.
* And even in the case of an iframe inserted into a page or post, the generated code can often confuse people who don't have any technical/programming experience. The shortcode provided by this plugin simplifies this considerably, making it readable and easy to customise by anyone.
* You can change the default overlay from wind to either clouds, CO concentration, sea temperature, snow cover, standard temperature, radar/lightning, rain, or waves.
* Width and height can be set to responsive (percentage-based) as well as fixed (pixel-based) values.

== Screenshots ==
1. The wind layer, zoomed in over the west of Ireland. We talk a lot about the weather here. :)
2. The temperature layer, zoomed in over São Paulo, Brazil.
3. The CO (carbon monoxide) concentration layer, zoomed in over China.
4. The waves layer, zoomed in over the Atlantic Ocean.
5. The widget view from the admin area (Appearance > Widgets).

== Changelog ==

= 1.3.0 =
* Added feature to define border-radius (rounded corners).
* Added feature for the spot forecast time (from now, 12 hours from now, or 24 hours from now).
* Updated widget UI to use less space.
* Updated the FAQ section.
* Updated existing translations.
* Added Turkish translation (thanks for tansi for the assistance!).

= 1.2.0 =
* Added Spot Forecast feature.
* Added Brazilian Portuguese translation.

= 1.1.0 =
* Re-named plugin from 'Weather Map Widget' to 'Ventus - Weather Map Widget & Shortcode'.
* Added new shortcode alias `[ventus]` (the old shortcode `[weather-map]` has been maintained for backwards-compatibility).
* Added four new layers to select from: CO Concentration (cosc), Sea Temperature (sst), Snow Cover (snowcover) and Waves (waves).
* Added general translation support and a French translation.
* Added ability to choose from the following wind measurement units: beaufort (bft), kilometers per hour (km/h), knots (kt), meters per second (m/s) and miles per hour (mph).
* Added ability to show/hide the map marker.
* Added ability to show/hide to show hide pressure isolines.
* Re-factored code (classes, package names, text domain etc) to reflect new plugin name.

= 1.0.1 =
* Fixed issue with zoom levels when using shortcode.

= 1.0.0 =
* Initial release.
