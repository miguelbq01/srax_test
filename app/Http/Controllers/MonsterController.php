<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Monster;
use App\MonsterRace;
use App\MonsterAbility;
use App\MonsterPower;

class MonsterController extends Controller
{
    // Mostrar listado de monstruos disponibles
    public function index(){
        return Monster::all();
    }

    // Mostrar un monstruo especifico por ID
    public function show($id){
        return Monster::find($id);
    }

    // Crear un nuevo monstruo
    public function create(Request $request){

        // Validamos los atributos del monstruo (name, strength, intelligence, dexterity)
        $validateAttributes = $this->validateAttributes($request->all(), "new");
        // Validamos las abilidades agregadas, que correspondan a la raza adecuada
        $validateAbilities = $this->validateAbilities($request->all());

        if ($validateAttributes === true) {
            if ($validateAbilities === true) {
                $json = $request->all();
    
                // Nivel de Monstruo depende de las abilidades que se agreguen
                $json['level'] = (count($json['abilities']) * 2) - 1;
                
                $monster = Monster::create($json);

                foreach ($json['abilities'] as $ability)  {
                    $monster_ability = new MonsterAbility;
                    $monster_ability->monster_id = $monster['id'];
                    $monster_ability->power_id = $ability;
                    $monster_ability->save();
                }

                return $monster;
            }else{
                return response()-> json([
                    "error" => $validateAbilities
                ]);
            }
        }else{
            return response()-> json([
                "error" => $validateAttributes
            ]);
        }
    }

    // Editar un monstruo por ID
    public function update(Request $request, $id){
        // Validamos los atributos del monstruo (name, strength, intelligence, dexterity)
        $validateAttributes = $this->validateAttributes($request->all(), "new");
        // Validamos las abilidades agregadas, que correspondan a la raza adecuada
        $validateAbilities = $this->validateAbilities($request->all());

        if ($validateAttributes === true) {
            if ($validateAbilities === true) {
                $json = $request->all();
                
                // Nivel de Monstruo depende de las abilidades que se agreguen
                $json['level'] = (count($json['abilities']) * 2) - 1;
                
                $monster = Monster::findOrFail($id);
                $monster->update($json);

                return $monster;
            }else{
                return response()-> json([
                    "error" => $validateAbilities
                ]);
            }
        }else{
            return response()-> json([
                "error" => $validateAttributes
            ]);
        }
    }

    // Eliminar un monstruo por ID
    public function delete(Request $request, $id){
        $monster = Monster::findOrFail($id);
        $monster->delete();

        return 204;
    }

    // Mostrar cuantos monstruos existen
    public function maxNumberMonster(){
        $count = Monster::all()->count();
        return response()-> json([
            "max_number_monsters" => $count
        ]);
    }

    // Mostrar cual es la Raza mas popular
    public function popularRace(){
        $popular = Monster::selectRaw('count(race_id) as race, race_id')
                ->orderBy('race', 'desc')
                ->groupBy('race_id')
                ->limit(1)
                ->firstOrFail();
        
        $popular_race = MonsterRace::find($popular['race_id']);

        return response()-> json([
            "popular_monster_race" => $popular_race['name']
        ]);
    }

    // Mostrar cual es la abilidad mas popular
    public function popularAbility(){
        $popular = MonsterAbility::selectRaw('count(power_id) as power_count, power_id')
                ->orderBy('power_count', 'desc')
                ->groupBy('power_id')
                ->limit(1)
                ->firstOrFail();
        
        $popular_ability = MonsterPower::find($popular['power_id']);

        return response()-> json([
            "popular_monster_ability" => $popular_ability['name']
        ]);
    }

    // Validaciones a atributos de Monstruo
    public function validateAttributes($request, $action){
        // Todos los nuevos monstruos empiezan en nivel 1
        if ($action === "new") {
            if ($request['level'] !== 1) {
                return "El nivel de Monstruo debe ser 1";
            }
        }

        if ($request['name'] == '') {
            return "El nombre no puede estar vacio.";
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

    // Validaciones a las abilidades de Monstruo
    public function validateAbilities($request){
        $beholder_race = MonsterRace::where('name', '=', "Beholder")->first();
        $mind_flayer_race = MonsterRace::where('name', '=', "Mind Flayer")->first();
        $owlbear_race = MonsterRace::where('name', '=', "Owlbear")->first();
        $dragons_race = MonsterRace::where('name', '=', "Dragons")->first();
        $cloud_giant_race = MonsterRace::where('name', '=', "Cloud Giant")->first();
        $storm_giant_race = MonsterRace::where('name', '=', "Storm Giant")->first();
        $umber_hulk_race = MonsterRace::where('name', '=', "Umber Hulk")->first();
        $yuan_ti_race = MonsterRace::where('name', '=', "Yuan-ti")->first();
        $gelatinous_cube_race = MonsterRace::where('name', '=', "Gelatinous Cube")->first();
        $drow_race = MonsterRace::where('name', '=', "Drow")->first();
        $kobold_race = MonsterRace::where('name', '=', "Kobold")->first();

        $shadow_ball = MonsterPower::where('name', '=', "Shadow Ball")->first();
        $aerial_ace = MonsterPower::where('name', '=', "Aerial Ace")->first();
        $surf = MonsterPower::where('name', '=', "Surf")->first();
        $double_team = MonsterPower::where('name', '=', "Double Team")->first();
        $crunch = MonsterPower::where('name', '=', "Crunch")->first();
        $giga_drain = MonsterPower::where('name', '=', "Giga Drain")->first();

        // Solo Beholder y Mind Flayer pueden usar Shadow Ball
        if ($request['race_id'] !== $beholder_race['id'] && $request['race_id'] !== $mind_flayer_race['id'] ) {
            if (in_array($shadow_ball['id'], $request["abilities"])) {
                return "Solo Beholder y Mind Flayer pueden usar Shadow Ball.";
            }
        }

        // Solo Owlbear, Dragons, Cloud Giant, Storm Gieant y Umber Hulk pueden usar Aerial Ace
        if ($request['race_id'] !== $owlbear_race['id'] && $request['race_id'] !== $dragons_race['id'] && 
            $request['race_id'] !== $cloud_giant_race['id'] && $request['race_id'] !== $storm_giant_race['id'] && 
            $request['race_id'] !== $umber_hulk_race['id'] ) {
            if (in_array($aerial_ace['id'], $request["abilities"])) {
                return "Solo Owlbear, Dragons, Cloud Giant, Storm Gieant y Umber Hulk pueden usar Aerial Ace.";
            }
        }

        // Solo Yuan-ti, Gelatinous Cube y Drow pueden usar Surf
        if ($request['race_id'] !== $yuan_ti_race['id'] && $request['race_id'] !== $gelatinous_cube_race['id'] && 
            $request['race_id'] !== $drow_race['id'] ) {
            if (in_array($surf['id'], $request["abilities"])) {
                return "Solo Yuan-ti, Gelatinous Cube y Drow pueden usar Surf.";
            }
        }

        // Kobold solo puede usar Double Team y Crunch
        if ($request['race_id'] === $kobold_race['id']) {
            if (in_array($double_team['id'], $request["abilities"])) {
                return "Solo Beholder y Mind Flayer pueden usar Shadow Ball.";
            }
        }

        return true;
    }
}
