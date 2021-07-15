<?php

namespace App\Http\Controllers;

use App\Http\Requests\Model\CreateCarModelRequest;
use App\Http\Requests\Model\UpdateCarModelRequest;
use App\Http\Resources\CarModelBasicResource;
use App\Http\Resources\CarModelResource;
use App\Models\CarModel;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarModelController extends Controller
{
    //
    public function index(Request $request)
    {
        try{
            $carModels = CarModel::all();

            return $this->success('CarModels Retrieved', ['car_models' => CarModelBasicResource::collection($carModels)]); 
        }catch(\Exception $e){
            return $this->error($e->getMessage(), $request->all());
        }
    }

    public function get(Request $request, $id)
    {
        try{
            $carModel = CarModel::find($id);

            if(!$carModel) return $this->error('Car Model not found!', ['id' => $id]); 

            return $this->success('Car Model Retrieved', ['car_model' => new CarModelResource($carModel)]);
            
        }catch(\Exception $e){
            return $this->error($e->getMessage(), $request->all());
        }
    }

    public function create(CreateCarModelRequest $request)
    {
        try{
            DB::beginTransaction();

            $manufacturer = Manufacturer::find($request->manufacturer_id);

            if(!$manufacturer) return $this->error('Manufacturer not found!', $request->all()); 

            $carModel = CarModel::create([
                'name' => $request->name,
                'manufacturer_id' => $request->manufacturer_id
            ]);

            DB::commit();

            return $this->success('Car Model Created', ['car_model' => new CarModelResource($carModel)]);
        }catch(\Exception $e){
            DB::rollBack();
            return $this->error($e->getMessage(), $request->all());
        }
    }

    public function update(UpdateCarModelRequest $request)
    {
        try{
            DB::beginTransaction();
            $carModel = CarModel::find($request->id);

            if(!$carModel) return $this->error('Car Model not found!', $request->all());

            $manufacturer = Manufacturer::find($request->manufacturer_id);

            if(!$manufacturer) return $this->error('Manufacturer not found!', $request->all()); 
            
            $carModel->name = $request->name;
            $carModel->manufacturer_id = $request->manufacturer_id;

            DB::commit();

            return $this->success('Car Model Updated', ['car_model' => new CarModelResource($carModel)]);

        }catch(\Exception $e){
            DB::rollBack();
            return $this->error($e->getMessage(), $request->all());
        }
    }

    public function delete(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $carModel = CarModel::find($request->id);

            if(!$carModel) return $this->error('Car Model not found!', $request->all());

            $carModel->delete();

            DB::commit();

            return $this->success('Car Model Deleted', []);

        }catch(\Exception $e){
            return $this->error($e->getMessage(), $request->all());
        }
    }
}
