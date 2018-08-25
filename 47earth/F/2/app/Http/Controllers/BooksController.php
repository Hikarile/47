<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
	public function reset()//清空
	{
		Book::truncate();
        return response()->json(['status' => 'success', 'data' => 'OK']);
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//一次撈出全部
    {
        $books = Book::all();
        return response()->json($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//新增
    {
		$book = Book::all();
		foreach($book as $key => $val){
			if($val['isbn'] == $request['isbn']){
				return response()->json(['status' => 'fail', 'data' =>'ISBN duplicate'],409);
			}
		}
		
		if (array_diff_key($request->all(),['name' => '', 'isbn' => ''])) {
            return response()->json(['status'=>'fail','data'=>'input error'],400);
        }
		
		if(strlen($request['isbn']) != 13) {
            return response()->json(['status'=>'fail','data'=>'ISBN ersror'],400);
        }
		
		$s='';
		$ooo='';
		for($i=0;$i<=11;$i++){
			$text='';
			if($i == 1){
				$text=substr($request->isbn,$i,1);
				$s=$s+$text*1;
				$ooo++;
			}else{
				$text=substr($request->isbn,$i,1);
				if($ooo == ''){
					$s=$s+$text*1;
					$ooo++;
				}else{
					$s=$s+$text*3;
					$ooo='';
				}
			}
		}
		$verification=substr($request->isbn,12,1);
		$r=$s%10;
		$n=10-$r;
		if($n != $verification){
			return response()->json(['status'=>'fail','data'=>'ISBN error'],400);
		}
		
		$book = Book::create($request->all());
		return response()->json(['status' => 'success', 'data' =>$book->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)//抓資料,不存在的路徑,找不到id
    {
        if (!is_numeric($id)){
            return response()->json(['status' => 'fail', 'data' => '403 Forbidden'], 403);
        }
        $book = Book::findOrFail($id);
        return response()->json($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//修改
    {
        $book = Book::findOrFail($id);
		
		$book = Book::all();
		foreach($book as $key => $val){
			if($val['isbn'] == $request['isbn']){
				return response()->json(['status' => 'fail', 'data' =>'ISBN duplicate'],409);
			}
		}
		
		if (array_diff_key($request->all(),['name' => '', 'isbn' => ''])) {
            return response()->json(['status'=>'fail','data'=>'input error'],400);
        }
		
		if(strlen($request['isbn']) != 13) {
            return response()->json(['status'=>'fail','data'=>'ISBN ersror'],400);
        }
		
		$s='';
		$ooo='';
		for($i=0;$i<=11;$i++){
			$text='';
			if($i == 1){
				$text=substr($request->isbn,$i,1);
				$s=$s+$text*1;
				$ooo++;
			}else{
				$text=substr($request->isbn,$i,1);
				if($ooo == ''){
					$s=$s+$text*1;
					$ooo++;
				}else{
					$s=$s+$text*3;
					$ooo='';
				}
			}
		}
		$verification=substr($request->isbn,12,1);
		$r=$s%10;
		$n=10-$r;
		if($n != $verification){
			return response()->json(['status'=>'fail','data'=>'ISBN error'],400);
		}
		
		
		$book->update($request->all());
        return response()->json(['status' => 'success', 'data' => 'OK']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)//刪除
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(['status' => 'success', 'data' => 'OK']);
    }
	
	
}
