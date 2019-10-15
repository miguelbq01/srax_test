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

        $validateAttributes = $this->validateAttributes($request->all(), "new");
        $validatesNames = $this->validateNames($request->all());
        $validatesClasses = $this->validateClasses($request->all());
        $validateWeapons = $this->validateWeapons($request->all());

        if ($validateAttributes === true) {
            if ($validatesNames === true) {
                if ($validatesClasses === true) {
                    if ($validateWeapons === true) {
                        return Hero::create($request->all());
                    }else{
                        return response()-> json([
                            "error" => $validateWeapons
                        ]);
                    }
                }else{
                    return response()-> json([
                        "error" => $validatesClasses
                    ]);
                }
            }else{
                return response()-> json([
                    "error" => $validatesNames
                ]);
            }
        }else {
            return response()-> json([
                "error" => $validateAttributes
            ]);
        }
    }

    // Editar un heroe por su ID
    public function update(Request $request, $id){
        $validateAttributes = $this->validateAttributes($request->all(), "edit");
        $validatesNames = $this->validateNames($request->all());
        $validatesClasses = $this->validateClasses($request->all());
        $validateWeapons = $this->validateWeapons($request->all());

        if ($validateAttributes === true) {
            if ($validatesNames === true) {
                if ($validatesClasses === true) {
                    if ($validateWeapons === true) {
                        $hero = Hero::findOrFail($id);
                        $hero->update($request->all());

                        return $hero;
                    }else{
                        return response()-> json([
                            "error" => $validateWeapons
                        ]);
                    }
                }else{
                    return response()-> json([
                        "error" => $validatesClasses
                    ]);
                }
            }else{
                return response()-> json([
                    "error" => $validatesNames
                ]);
            }
        }else {
            return response()-> json([
                "error" => $validateAttributes
            ]);
        }
    }

    // Eliminar un heroe por su ID
    public function delete(Request $request, $id){
        $hero = Hero::findOrFail($id);
        $hero->delete();

        return 200;
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
            "race_id" => $popular['race_id'],
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
            "race_id" => $popular['class_id'],
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
            "weapon_id" => $popular['weapon_id'],
            "popular_hero_weapon" => $popular_weapon['name']
        ]);
    }

    // Validaciones a atributos de Heroe
    public function validateAttributes($request, $action){
        // Todos los nuevos heroes empiezan en nivel 1
        if ($action === "new") {
            if ($request['level'] !== 1) {
                return "El nivel de Heroe debe ser 1";
            }
        }

        if ($request['strength'] < 0 || $request['strength'] > 100) {
            return "El atributo Strength no puede ser menor a 0 ni mayor a 100";
        }

        if ($request['intelligence'] < 0 || $request['intelligence'] > 100) {
            return "El atributo Intelligence no puede ser menor a 0 ni mayor a 100";
        }

        if ($request['dexterity'] < 0 || $request['dexterity'] > 100) {
            return "El atributo Dexterity no puede ser menor a 0 ni mayor a 100";
        }

        return true;
    }

    // Validaciones a los nombres de Heroe
    public function validateNames($request){
        // Verificamos si la clase del heroe es un Half Orc o Dragonborn
        // Si es asi, regresar error si tiene Last Name
        $half_orc_race = HeroRace::where('name', '=', "Half-orc")->first();
        $dragonborn_race = HeroRace::where('name', '=', "Dragonborn")->first();
        
        if ($request['race_id'] === $half_orc_race['id'] || $request['race_id'] === $dragonborn_race['id'] ) {
            if ($request['last_name'] != '') {
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

    // Validaciones a las clases de Heroe
    public function validateClasses($request){
        $human_race = HeroRace::where('name', '=', "Human")->first();
        $elf_race = HeroRace::where('name', '=', "Elf")->first();
        $half_elf_race = HeroRace::where('name', '=', "Half-elf")->first();
        $dwarf_race = HeroRace::where('name', '=', "Dwarf")->first();
        $halfling_race = HeroRace::where('name', '=', "Halfling")->first();
        $half_orc_race = HeroRace::where('name', '=', "Half-orc")->first();
        $dragonborn_race = HeroRace::where('name', '=', "Dragonborn")->first();
        
        $paladin_class = HeroClass::where('name', '=', "Paladin")->first();
        $ranger_class = HeroClass::where('name', '=', "Ranger")->first();
        $barbarian_class = HeroClass::where('name', '=', "Barbarian")->first();
        $wizard_class = HeroClass::where('name', '=', "Wizard")->first();
        $cleric_class = HeroClass::where('name', '=', "Cleric")->first();
        $warrior_class = HeroClass::where('name', '=', "Warrior")->first();
        
        // Solo Humans y Half-elves pueden ser Paladins
        if ($request['class_id'] === $paladin_class['id']) {
            if ($request['race_id'] !== $human_race['id'] && $request['race_id'] !== $half_elf_race['id'] ) {
                return "Solo Humans y Half-elves pueden ser Paladins.";
            }
        }

        // Dwarf no pueden ser Rangers
        if ($request['race_id'] === $dwarf_race['id']) {
            if ($request['class_id'] === $ranger_class['id']) {
                return "Dwarf no pueden ser Rangers.";
            }
        }

        // Elf, Half-Elf y Halfling no pueden ser Barbarian
        if ($request['race_id'] === $elf_race['id'] || $request['race_id'] === $half_elf_race['id'] || $request['race_id'] === $halfling_race['id']) {
            if ($request['class_id'] === $barbarian_class['id']) {
                return "Elf, Half-Elf y Halfling no pueden ser Barbarian.";
            }
        }

        // Half-orc y Dwarf no pueden ser Wizard
        if ($request['race_id'] === $half_orc_race['id'] || $request['race_id'] === $dwarf_race['id']) {
            if ($request['class_id'] === $wizard_class['id']) {
                return "Half-orc y Dwarf no pueden ser Wizard.";
            }
        }

        // Dragonborn y Half-orc no pueden ser Cleric
        if ($request['race_id'] === $dragonborn_race['id'] || $request['race_id'] === $half_orc_race['id']) {
            if ($request['class_id'] === $cleric_class['id']) {
                return "Dragonborn y Half-orc no pueden ser Cleric.";
            }
        }

        // Elf no puede ser Warrior
        if ($request['race_id'] !== $elf_race['id']) {
            if ($request['class_id'] === $warrior_class['id']) {
                return "Elf no puede ser Warrior.";
            }
        }

        return true;
    }

    // Validaciones a las armas de Heroe
    public function validateWeapons($request){
        $paladin_class = HeroClass::where('name', '=', "Paladin")->first();
        $ranger_class = HeroClass::where('name', '=', "Ranger")->first();
        $barbarian_class = HeroClass::where('name', '=', "Barbarian")->first();
        $wizard_class = HeroClass::where('name', '=', "Wizard")->first();
        $cleric_class = HeroClass::where('name', '=', "Cleric")->first();
        $thief_class = HeroClass::where('name', '=', "Thief")->first();

        $sword = HeroWeapon::where('name', '=', "Sword")->first();
        $staff = HeroWeapon::where('name', '=', "Staff")->first();
        $hammer = HeroWeapon::where('name', '=', "Hammer")->first();
        $bow_arrows = HeroWeapon::where('name', '=', "Bow and Arrows")->first();

        // Paladin solo puede usar Sword
        if ($request['class_id'] === $paladin_class['id']) {
            if ($request['weapon_id'] !== $sword['id']) {
                return "Paladin solo puede usar Sword.";
            }
        }

        // Ranger solo puede usar Bow and Arrows
        if ($request['class_id'] === $ranger_class['id']) {
            if ($request['weapon_id'] !== $bow_arrows['id']) {
                return "Ranger solo puede usar Bow and Arrows.";
            }
        }

        // Barbarian no puede usar Bow and Arrows o Staff
        if ($request['class_id'] === $barbarian_class['id']) {
            if ($request['weapon_id'] === $bow_arrows['id'] || $request['weapon_id'] === $staff['id']) {
                return "Barbarian no puede usar Bow and Arrows o Staff.";
            }
        }

        // Wizard y Cleric solo pueden usar Staff
        if ($request['class_id'] === $wizard_class['id'] || $request['class_id'] === $cleric_class['id']) {
            if ($request['weapon_id'] !== $staff['id']) {
                return "Wizard y Cleric solo pueden usar Staff.";
            }
        }

        // Thief no puede usar Hammer
        if ($request['class_id'] === $thief_class['id']) {
            if ($request['weapon_id'] === $hammer['id']) {
                return "Thief no puede usar Hammer.";
            }
        }

        return true;
    }
}
