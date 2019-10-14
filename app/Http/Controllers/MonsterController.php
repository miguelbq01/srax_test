<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Monster;
use App\MonsterRace;
use App\MonsterAbility;
use App\MonsterPower;

class MonsterController extends Controller
{
    public function index(){
        return Monster::all();
    }

    public function show($id){
        return Monster::find($id);
    }

    public function create(Request $request){
        return Monster::create($request->all());
    }

    public function update(Request $request, $id){
        $monster = Monster::findOrFail($id);
        $monster->update($request->all());

        return $monster;
    }

    public function delete(Request $request, $id){
        $monster = Monster::findOrFail($id);
        $monster->delete();

        return 204;
    }

    public function maxNumberMonster(){
        $count = Monster::all()->count();
        return response()-> json([
            "max_number_monsters" => $count
        ]);
    }

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
}
