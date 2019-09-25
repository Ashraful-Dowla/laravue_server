<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddDepartment;
use App\Http\Requests\DepartmentUpdate;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Department extends Controller
{
    //
    public function addDepartments(AddDepartment $request)
    {
    	$validated = $request->validated();

    	$chk = DB::table('departments')
    				->where('slug_department_name',Str::slug($request->department_name,' '))
    				->exists();
    	if($chk)
    	{
    		return response()->json('failed',401);
    	}

    	DB::table('departments')
    		->insert([
    			'department_name' => $request->department_name,
    			'description' => $request->description,
    			'status' => $request->status,
    			'created_at' => Carbon::now()->toDateTimeString(),
    			'updated_at' => Carbon::now()->toDateTimeString(),
    			'created_by' => $request->created_by,
    			'updated_by' => $request->created_by,
    			'slug_department_name' => Str::slug($request->department_name,' ')
    		]);

    	return response()->json([
    		'message' => 'successfully created'
    	]);

    }

    public function getDepartmentData()
    {
    	$data = DB::table('departments')
    				->orderBy('id','desc')
                	->paginate(5);
    	
    	return response()->json($data);
    }


    public function updateData(DepartmentUpdate $request)
    {
    	$validated = $request->validated();

        DB::table('departments')
            ->where('id',$request->update_id)
            ->update([
                'department_name' => $request->department_name,
                'description' => $request->description,
                'status' => $request->status,
                'updated_at' => Carbon::now()->toDateTimeString(),
                'slug_department_name' => Str::slug($request->department_name,' '),
                'updated_by' => $request->updated_by
            ]);

        return response()->json([
            'message' => 'succesfully updated'
        ]);
    }

    public function deleteData(Request $request)
    {

        DB::table('departments')
            ->where('id',$request->id)
            ->delete();

        return response()->json([
            'message' => 'succesfully deleted'
        ]);
    }
}
