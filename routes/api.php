<?php

use Illuminate\Http\Request;

// Heroes Routes
Route::get('heroes', 'HeroController@index');
Route::get('heroes/{id}', 'HeroController@show');

Route::get('show_hero_classes', 'HeroController@showClasses');
Route::get('show_hero_races', 'HeroController@showRaces');
Route::get('show_hero_weapons', 'HeroController@showWeapons');

Route::get('max_number_heroes', 'HeroController@maxNumberHeroes');
Route::get('popular_hero_race', 'HeroController@popularRace');
Route::get('popular_hero_class', 'HeroController@popularClass');
Route::get('popular_hero_weapon', 'HeroController@popularWeapon');

Route::post('heroes', 'HeroController@create');
Route::put('heroes/{id}', 'HeroController@update');
Route::delete('heroes/{id}', 'HeroController@delete');
