<?php

namespace App\Http\Controllers\API\Mobil;

use App\Http\Controllers\Controller;
use App\Http\Resources\BeneficiaryResource;
use App\Http\Requests\DirectoryRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	/**
	 * @description get my directories 
  	 */
  	public function index()
  	{
		$user = Auth::user();
		$directories = $user->directories()->select(['id', 'name', 'code'])->get();
		return BeneficiaryResource::collection($directories);
  	}


  	public function addDirectory(DirectoryRequest $request) 
  	{
		$user = Auth::user();
		$value = $request->validated();
		if(!$user->directories()->exists($value['user_id'])){
			$user->directories()->attach($value['user_id']);
		}
        return response()->json([],204);
    }

  	public function removeDirectory(Request $request)
  	{
		$user = Auth::user();
		$user_id = $request->input('id');
		$user->directories()->detach($user_id);
        return response()->json([],204);
  	}


}
