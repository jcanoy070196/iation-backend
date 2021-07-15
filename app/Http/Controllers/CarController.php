<?php

namespace App\Http\Controllers;

use App\Http\Requests\Car\CreateCarRequest;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Http\Resources\CarBasicResource;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    //
    public function index(Request $request)
    {
        try{
            $cars = Car::all();

            return $this->success('Cars Retrieved', ['cars' => CarBasicResource::collection($cars)]); 
        }catch(\Exception $e){
            return $this->error($e->getMessage(), $request->all());
        }
    }

    public function get(Request $request, $id)
    {
        try{
            $car = Car::find($id);
            if(!$car) return $this->error('Car not found!', ['id' => $id]); 

            return $this->success('Car Retrieved', ['car' => new CarResource($car)]);
        }catch(\Exception $e){
            return $this->error($e->getMessage(), $request->all());
        }
    }

    public function create(CreateCarRequest $request)
    {
        try{
            DB::beginTransaction();

            $carModel = CarModel::find($request->car_model_id);
            if(!$carModel) return $this->error('Car Model not found!', $request->all()); 

            $color = Color::find($request->color_id);
            if(!$color) return $this->error('Color not found!', $request->all()); 

            $car = Car::create([
                'name' => $request->name,
                'car_model_id' => $request->car_model_id,
                'color_id' => $request->color_id,
                'user_id' => auth()->user()->id
            ]);

            DB::commit();

            return $this->success('Car Created', ['car' => new CarResource($car)]);
        }catch(\Exception $e){
            DB::rollBack();
            return $this->error($e->getMessage(), $request->all());
        }
    }

    public function update(UpdateCarRequest $request)
    {
        try{
            DB::beginTransaction();

            $car = Car::find($request->id);
            if(!$car) return $this->error('Car not found!', $request->all());

            $carModel = CarModel::find($request->car_model_id);
            if(!$carModel) return $this->error('Car Model not found!', $request->all()); 

            $color = Color::find($request->color_id);
            if(!$color) return $this->error('Color not found!', $request->all()); 
            
            $car->name = $request->name;
            $car->car_model_id = $request->car_model_id;
            $car->color_id = $request->color_id;

            DB::commit();

            return $this->success('Car Updated', ['car' => new CarResource($car)]);
        }catch(\Exception $e){
            DB::rollBack();
            return $this->error($e->getMessage(), $request->all());
        }
    }

    public function delete(Request $request, $id)
    {
        try{
            DB::beginTransaction();

            $car = Car::find($request->id);
            if(!$car) return $this->error('Car not found!', $request->all());

            $car->delete();

            DB::commit();

            return $this->success('Car Deleted', []);
        }catch(\Exception $e){
            return $this->error($e->getMessage(), $request->all());
        }
    }
}
