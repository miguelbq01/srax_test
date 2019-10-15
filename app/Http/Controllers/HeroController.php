<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hero;
use App\HeroRace;
use App\HeroClass;
use App\HeroWeapon;

class HeroController extends Controller
{
    // Mostrar listado de heroes disponibles
    public function index(){
        return Hero::all();
    }

    // Mostrar un heroe especifico por ID
    public function show($id){
        return Hero::find($id);
    }

    // Crear un nuevo heroe
    public function create(Request $request){

        $validatesNames = $this->validateNames($request->all());

        if ($validatesNames === true) {
            return Hero::create($request->all());
        }else {
            return response()-> json([
                "error" => $validatesNames
            ]);
        }
    }

    // Editar un heroe por su ID
    public function update(Request $request, $id){
        $hero = Hero::findOrFail($id);
        $hero->update($request->all());

        return $hero;
    }

    // Eliminar un heroe por su ID
    public function delete(Request $request, $id){
        $hero = Hero::findOrFail($id);
        $hero->delete();

        return 204;
    }

    // Listado de todas las Razas de Heroes existentes
    public function showRaces(){
        return HeroRace::all();
    }

    // Listado de todas las clases de Heroes existentes
    public function showClasses(){
        return HeroClass::all();
    }

    // Listado de todas las armas de Heroes existenes
    public function showWeapons(){
        return HeroWeapon::all();
    }

    // Mostrar cuantos heroes existen
    public function maxNumberHeroes(){
        $count = Hero::all()->count();
        return response()-> json([
            "max_number_heroes" => $count
        ]);
    }

    // Mostrar cual es la Raza mas popular
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

    // Mostrar cual es la Clase mas popular
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

    // Mostrar cual es la Arma mas popular
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

    // Validaciones a los nombres de Heroe
    public function validateNames($request){
        // Verificamos si la clase del heroe es un Half Orc o Dragonborn
        // Si es asi, regresar error si tiene Last Name
        $half_orc_race = HeroRace::where('name', '=', "Half-orc")->first();
        $dragonborn_race = HeroRace::where('name', '=', "Dragonborn")->first();
        
        if ($request['race_id'] === $half_orc_race['id'] || $request['race_id'] === $dragonborn_race['id'] ) {
            if ($request['last_name'] !== "") {
                return "En las clases Half-orc y Dragonborn no deben tener Last Name";
            };
        };
        
        // Si es Elf, Last Name debe ser el First Name invertido
        $elf_race = HeroRace::where('name', '=', "Elf")->first();
        
        if ($request['race_id'] === $elf_race['id'] ) {
            if ($request['last_name'] !== strrev($request['first_name'])) {
                return "En la clase Elf, el Last Name debe ser el First Name invertido.";
            };
        };
        
        // Si es Dwarf, First y Last Name deben de contener al menos una 'R' o 'H'
        $dwarf_race = HeroRace::where('name', '=', "Dwarf")->first();

        if ($request['race_id'] === $dwarf_race['id'] ) {
            $first_name_r = strpos($request['first_name'], "R");
            $first_name_h = strpos($request['first_name'], "H");

            $last_name_r = strpos($request['last_name'], "R");
            $last_name_h = strpos($request['last_name'], "H");

            if ($first_name_r !== false || $first_name_h !== false) {
                if ($last_name_r === false && $last_name_h === false) {
                    return "En la clase Dwarf, el Last Name debe contener una 'R' o una 'H'.";
                }
            }else {
                return "En la clase Dwarf, el First Name debe contener una 'R' o una 'H'.";
            };
        };

        return true;

    }
}
