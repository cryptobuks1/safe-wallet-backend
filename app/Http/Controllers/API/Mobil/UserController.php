<?php

namespace App\Http\Controllers\API\Mobil;

use App\Http\Controllers\Controller;
use App\Http\Resources\BeneficiaryResource;

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
}
