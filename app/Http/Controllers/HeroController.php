<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hero;
use App\HeroRace;
use App\HeroClass;
use App\HeroWeapon;

class HeroController extends Controller
{
    public function index(){
        return Hero::all();
    }

    public function show($id){
        return Hero::find($id);
    }

    public function create(Request $request){
        return Hero::create($request->all());
    }

    public function update(Request $request, $id){
        $hero = Hero::findOrFail($id);
        $hero->update($request->all());

        return $hero;
    }

    public function delete(Request $request, $id){
        $hero = Hero::findOrFail($id);
        $hero->delete();

        return 204;
    }

    public function maxNumberHeroes(){
        $count = Hero::all()->count();
        return response()-> json([
            "max_number_heroes" => $count
        ]);
    }

    public function popularRace(){
        $popular = Hero::selectRaw('count(race_id) as race, race_id')
                ->orderBy('race', 'desc')
                ->groupBy('race_id')
                ->limit(1)
                ->firstOrFail();
        
        $popular_race = HeroRace::find($popular['race_id']);

        return response()-> json([
            "popular_hero_race" => $popular_race['name']
        ]);
    }

    public function popularClass(){
        $popular = Hero::selectRaw('count(class_id) as class, class_id')
                ->orderBy('class', 'desc')
                ->groupBy('class_id')
                ->limit(1)
                ->firstOrFail();
        
        $popular_class = HeroClass::find($popular['class_id']);

        return response()-> json([
            "popular_hero_class" => $popular_class['name']
        ]);
    }

    public function popularWeapon(){
        $popular = Hero::selectRaw('count(weapon_id) as weapon, weapon_id')
                ->orderBy('weapon', 'desc')
                ->groupBy('weapon_id')
                ->limit(1)
                ->firstOrFail();
        
        $popular_weapon = HeroWeapon::find($popular['weapon_id']);

        return response()-> json([
            "popular_hero_weapon" => $popular_weapon['name']
        ]);
    }
}
