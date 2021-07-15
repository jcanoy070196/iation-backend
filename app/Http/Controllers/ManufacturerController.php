<?php

namespace App\Http\Controllers;

use App\Http\Requests\Manufacturer\CreateManufacturerRequest;
use App\Http\Requests\Manufacturer\UpdateManufacturerRequest;
use App\Http\Resources\ManufacturerResource;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManufacturerController extends Controller
{
    public function index(Request $request)
    {
        try{
            $manufacturers = Manufacturer::all();

            return $this->success('Manufacturers Retrieved', ['manufacturers' => ManufacturerResource::collection($manufacturers)]); 
        }catch(\Exception $e){
            return $this->error($e->getMessage(), $request->all());
        }
    }

    public function get(Request $request, $id)
    {
        try{
            $manufacturer = Manufacturer::find($id);

            if(!$manufacturer) return $this->error('Manufacturer not found!', ['id' => $id]); 

            return $this->success('Manufacturer Retrieved', ['manufacturer' => new ManufacturerResource($manufacturer)]);
            
        }catch(\Exception $e){
            return $this->error($e->getMessage(), $request->all());
        }
    }

    public function create(CreateManufacturerRequest $request)
    {
        try{
            DB::beginTransaction();

            $manufacturer = Manufacturer::create([
                'name' => $request->name
            ]);

            DB::commit();

            return $this->success('Manufacturer Created', ['manufacturer' => new ManufacturerResource($manufacturer)]);
        }catch(\Exception $e){
            DB::rollBack();
            return $this->error($e->getMessage(), $request->all());
        }
    }

    public function update(UpdateManufacturerRequest $request)
    {
        try{
            DB::beginTransaction();
            $manufacturer = Manufacturer::find($request->id);

            if(!$manufacturer) return $this->error('Manufacturer not found!', $request->all());
            
            $manufacturer->name = $request->name;

            DB::commit();

            return $this->success('Manufacturer Updated', ['manufacturer' => new ManufacturerResource($manufacturer)]);

        }catch(\Exception $e){
            DB::rollBack();
            return $this->error($e->getMessage(), $request->all());
        }
    }

    public function delete(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $manufacturer = Manufacturer::find($request->id);

            if(!$manufacturer) return $this->error('Manufacturer not found!', $request->all());

            $manufacturer->delete();

            DB::commit();

            return $this->success('Manufacturer Deleted', []);

        }catch(\Exception $e){
            return $this->error($e->getMessage(), $request->all());
        }
    }
}
