<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\books as books;

class BooksController extends Controller
{
    public function reset(){
		$id=array();
		$books=books::all();
		foreach($books as $book){
			$id[]=$book->id;
		}
		foreach($id as $key=>$val){
			books::first($val[$key])->delete();
		}
		$return=json_encode([
			'status'=>'succes',
			'date'=>'OK'
		]);
		return $return;
	}
	
	public function add(Request $post){
		$books=books::all();
		foreach($books as $book){
			if($book->isbn == $post->isbn){
				$return=([
					'status'=>'fail',
					'data'=>'ISBN duplocate'
				]);
				return response()->json($return,409);
			}
		}
		
		if(strlen($post->isbn) != 13){
			$return=([
				'status'=>'fail',
				'data'=>'ISBN error'
			]);
			return response()->json($return,400);
		}else{
			$s='';
			$ooo='';
			for($i=0;$i<=11;$i++){
				$text='';
				if($i == 1){
					$text=substr($post->isbn,$i,1);
					$s=$s+$text*1;
					$ooo++;
				}else{
					$text=substr($post->isbn,$i,1);
					if($ooo == ''){
						$s=$s+$text*1;
						$ooo++;
					}else{
						$s=$s+$text*3;
						$ooo='';
					}
				}
			}
		}
		$verification=substr($post->isbn,12,1);
		$r=$s%10;
		$n=10-$r;
		if($n != $verification){
			$return=([
				'status'=>'fail',
				'data'=>'ISBN error'
			]);
			return response()->json($return,400);
		}
		
		if(sizeof($_REQUEST) != 2){
			$return=([
				'status'=>'fail',
				'data'=>'input error'
			]);
			return response()->json($return,400);
		}
		
		$a =new books;
		$a->name=$post->name;
		$a->isbn=$post->isbn;
		$a->save();
		
		$return=([
			'status'=>'scueess',
			'data'=>$a->id
		]);
		return response()->json($return);
	}
	
	public function inquire($id=''){
		if($id != ''){
			if(is_numeric($id)){
				$book=books::where('id',$id)->first();
				if(isset($book)){
					$return=([
						'id'=>$book->id,
						'name'=>$book->name,
						'isbn'=>$book->isbn
					]);
					return response()->json($return);
				}else{
					$return=([
						'status'=>'fail',
						'data'=>'book not found'
					]);
					return response()->json($return,404);
				}
			}else{
				$return=([
					'status'=>'fail',
					'data'=>'403 Forbidden'
				]);
				return response()->json($return,403);
			}
		}else{
			$books=books::all();
			$return =array();
			foreach($books as $book){
				$return[]=[
					'id'=>$book->id,
					'name'=>$book->name,
					'isbn'=>$book->isbn
				];
			}
			return response()->json($return);
		}
	}
	
	public function fix($id=''){
		$books=books::find($id);
		if(isset($books)){
			if(isset($post->isbn)){
				$books=books::all();
				foreach($books as $book){
					if($book->isbn == $post->isbn){
						$return=([
							'status'=>'fail',
							'data'=>'ISBN duplocate'
						]);
						return response()->json($return,409);
					}
				}
				
				if(sizeof($_REQUEST) != 2){
					$return=([
						'status'=>'fail',
						'data'=>'input error'
					]);
					return response()->json($return,400);
				}
				
				if(strlen($post->isbn) != 13){
					$return=([
						'status'=>'fail',
						'data'=>'ISBN error'
					]);
					return response()->json($return,400);
				}else{
					$s='';
					$ooo='';
					for($i=0;$i<=11;$i++){
						$text='';
						if($i == 1){
							$text=substr($post->isbn,$i,1);
							$s=$s+$text*1;
							$ooo++;
						}else{
							$text=substr($post->isbn,$i,1);
							if($ooo == ''){
								$s=$s+$text*1;
								$ooo++;
							}else{
								$s=$s+$text*3;
								$ooo='';
							}
						}
					}
				}
				$verification=substr($post->isbn,12,1);
				$r=$s%10;
				$n=10-$r;
				if($n != $verification){
					$return=([
						'status'=>'fail',
						'data'=>'ISBN error'
					]);
					return response()->json($return,400);
				}
			}
			
			$books=books::find($id);
			if($post->name!='' & $post->isbn==''){
				$books->name=$post->name;
				$books->save();
			}
			if($post->name=='' & $post->isbn!=''){
				$books=books::find($id);
				$books->isbn=$post->isbn;
				$books->save();
			}
			if($post->name!='' & $post->isbn!=''){
				$books->name=$post->name;
				$books->isbn=$post->isbn;
				$books->save();
			}
		}else{
			$return=([
				'status'=>'fail',
				'data'=>'book id not found'
			]);
			return response()->json($return,404);
		}
	}
	
	public function d($id=''){
		$books=books::find($id);
		if(isset($books)){
			$books->delete($id);
			$return=([
				'status'=>'success',
				'data'=>'OK'
			]);
			return response()->json($return);
		}else{
			$return=([
				'status'=>'fail',
				'data'=>'book id not found'
			]);
			return response()->json($return,404);
		}
	}
}
