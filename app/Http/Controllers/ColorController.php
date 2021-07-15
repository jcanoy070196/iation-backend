<?php

namespace App\Http\Controllers;

use App\Http\Requests\Color\CreateColorRequest;
use App\Http\Requests\Color\UpdateColorRequest;
use App\Http\Resources\ColorResource;
use App\Models\Color;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColorController extends Controller
{
    //
    public function index(Request $request)
    {
        try{
            $colors = Color::all();

            return $this->success('Colors Retrieved', ['colors' => ColorResource::collection($colors)]); 
        }catch(\Exception $e){
            return $this->error($e->getMessage(), $request->all());
        }
    }

    public function get(Request $request, $id)
    {
        try{
            $color = Color::find($id);

            if(!$color) return $this->error('Color not found!', ['id' => $id]); 

            return $this->success('Color Retrieved', ['color' => new ColorResource($color)]);
            
        }catch(\Exception $e){
            return $this->error($e->getMessage(), $request->all());
        }
    }

    public function create(CreateColorRequest $request)
    {
        try{
            DB::beginTransaction();

            $color = Color::create([
                'name' => $request->name
            ]);

            DB::commit();

            return $this->success('Color Created', ['color' => new ColorResource($color)]);
        }catch(\Exception $e){
            DB::rollBack();
            return $this->error($e->getMessage(), $request->all());
        }
    }

    public function update(UpdateColorRequest $request)
    {
        try{
            DB::beginTransaction();
            $color = Color::find($request->id);

            if(!$color) return $this->error('Color not found!', $request->all());
            
            $color->name = $request->name;

            DB::commit();

            return $this->success('Color Updated', ['color' => new ColorResource($color)]);

        }catch(\Exception $e){
            DB::rollBack();
            return $this->error($e->getMessage(), $request->all());
        }
    }

    public function delete(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $color = Color::find($request->id);

            if(!$color) return $this->error('Color not found!', $request->all());

            $color->delete();

            DB::commit();

            return $this->success('Color Deleted', []);

        }catch(\Exception $e){
            return $this->error($e->getMessage(), $request->all());
        }
    }
}
