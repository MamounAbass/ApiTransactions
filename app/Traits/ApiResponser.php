<?php
namespace App\Traits;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponser
{
    public function successResponse($data,$code)
    {
        return response()->json($data,$code);
    }
    public function errorResponse($message,$code)
    {
        return response()->json(['error'=>$message,'code'=>$code],$code);
    }
    public function showAll(Collection $collection , $code =200)
    {
        return $this->successResponse(['data'=>$collection],$code);
    }
    public function showOne(Model $model , $code =200)
    {
        return $this->successResponse(['data'=>$model],$code);
    }
}