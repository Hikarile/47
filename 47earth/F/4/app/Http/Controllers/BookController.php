<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
	public function reset()
    {
        Book::truncate();
		return response()->json(['status'=>'succes','data'=>'OK']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
    public function store(Request $request)
    {
		$xml=simplexml_load_string($request->getContent());
		$json=json_encode($xml);
		$array=json_decode($json,TRUE);
		dd($array);
		exit();
		
		if(array_diff_key($request->all(),['name'=>'','isbn'=>''])){
			return response()->json(['status'=>'fail','data'=>'input error'],400);
		}
		
		$book=Book::where('isbn',$request['isbn'])->get();
		if(count($book) > 0){
			return response()->json(['status'=>'fail','data'=>'ISBN duplicate'],409);
		}
		
		$s='';
		$o='';
		for($i=0;$i<=11;$i++){
			$text='';
			if($i == 0){
				$text=substr($request->isbn,$i,1);
				$s=$s+$text*1;
				$o++;
			}else{
				$text=substr($request->isbn,$i,1);
				if($o == ''){
					$s=$s+$text*1;
					$o++;
				}else{
					$s=$s+$text*3;
					$o='';
				}
			}
		}
		$verification=substr($request->isbn,12,1);
		$r=$s%10;
		$n=10-$r;
		if($n != $verification){
			return response()->json(['status'=>'fail','data'=>'ISBN error'],400);
		}
		
        $book=Book::create($request->all());
		return response()->json(['status'=>'scueess','id'=>$book['id']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function update(Request $request, $id)
    {
		$book = Book::findOrFail($id);
		 
		 if(array_diff_key($request->all(),['name'=>'','isbn'=>''])){
			return response()->json(['status'=>'fail','data'=>'input error'],400);
		}
		 
		 if($request['isbn']!=''){
			$book=Book::where('isbn',$request['isbn'])->get();
			if(count($book) > 0){
				return response()->json(['status'=>'fail','data'=>'ISBN duplicate'],409);
			}
			
			$s='';
			$o='';
			for($i=0;$i<=11;$i++){
				$text='';
				if($i == 0){
					$text=substr($request->isbn,$i,1);
					$s=$s+$text*1;
					$o++;
				}else{
					$text=substr($request->isbn,$i,1);
					if($o == ''){
						$s=$s+$text*1;
						$o++;
					}else{
						$s=$s+$text*3;
						$o='';
					}
				}
			}
			$verification=substr($request->isbn,12,1);
			$r=$s%10;
			$n=10-$r;
			if($n != $verification){
				return response()->json(['status'=>'fail','data'=>'ISBN error'],400);
			}
		}
		$book->update($request->all());
		return response()->json(['status'=>'success','data'=>'OK']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(['status' => 'success', 'data' => 'OK']);
    }
}
