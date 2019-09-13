<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TestManagement;
use App\Http\Requests\TestManagementUpdate;
use DB;
use App\test_management;
use Illuminate\Support\Str;

class ApiTestManagement extends Controller
{
    //
    public function insert_test_data(TestManagement $request)
    {
    	$validated = $request->validated();

    	$chk = DB::table('test_managements')
    				->where('slug_title',Str::slug($request->name,' '))
    				->exists();
    	if($chk)
    	{
    		return response()->json('failed',401);
    	}

    	$data = new test_management();

    	$data->title = $request->name;
    	$data->price = $request->test_price;
    	$data->slug_title = Str::slug($request->name,' ');
    	$data->created_by = $request->created_by;
    	$data->updated_by = $request->created_by;

    	if($data->save())
    	{
    		return response()->json([
    			'message' => 'success'
    		]);
    	}
    }

    public function get_test_data()
    {
    	$data = DB::table('test_managements')
                ->orderBy('id','desc')
                ->paginate(5);

    	return response()->json($data);
    }

    public function delete_data(Request $request)
    {
        DB::table('test_managements')
            ->where('id',$request->id)
            ->delete();

        return response()->json([
            'message' => 'succesfully deleted'
        ]);
    }

    public function update_data(TestManagementUpdate $request)
    {
        $validated = $request->validated();

        $chk = DB::table('test_managements')
                    ->where('slug_title',Str::slug($request->name,' '))
                    ->exists();
        if($chk)
        {
            return response()->json('failed',401);
        }

        DB::table('test_managements')
            ->where('id',$request->update_id)
            ->update([
                'title' => $request->name,
                'price' => $request->test_price,
                'slug_title' => Str::slug($request->name,' '),
                'updated_by' => $request->updated_by
            ]);

        return response()->json([
            'message' => 'succesfully updated'
        ]);
    }
}
