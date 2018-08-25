$(function(){
	var pen = new Pen();
	var canvas = $("#canvasid")[0];
	var canvasState = new Canvas(canvas, pen);
	
	$("#colors div[p_color=black]").addClass('active');
	$("#thickness div[p_width=1]").addClass('active');
	$("#shape img[p_shape=general]").addClass('active');
	
	pen.color='black';
	pen.line='1';
	pen.shape='general';
	pen.illustration='';
	
	$("#colors div").click(function(){//選擇畫筆顏色
		$("#colors div").removeClass('active');
		$(this).addClass('active');
		pen.color = $(this).attr('p_color');;
	})
	$("#thickness div").click(function(){//選擇畫筆粗細
		$("#thickness div").removeClass('active');
		$(this).addClass('active');
		pen.line=$(this).attr('p_width');
	})
	$("#shape img").click(function(){//選擇形狀
		$("#shape img").removeClass('active');
		$(this).addClass('active');
		if($(this).attr("type") == "shape"){
			pen.shape=$(this).attr('p_shape');
			pen.illustration='';
			pen.type='shape';
		}else if($(this).attr("type") == "illustration"){
			pen.shape='';
			pen.illustration=$(this).attr('p_shape');
			pen.type='illustration';
		}
	})
	
	$("#save_1").click(function(){//存成圖片檔
		var d=$("#download")[0];
		d.href=$(canvas)[0].toDataURL();
		d.download="img.png";
		d.click();
	})
	$("#save_2").click(function(){//存成編輯檔
		var data={	
			width:canvasState.width,
			height:canvasState.height,
			shapes:canvasState.shapes
		}
		var blob=new Blob([JSON.stringify(data,null,2)]);
		var d=$("#download")[0];
		d.href=URL.createObjectURL(blob);
		d.download="text.txt";
		d.click();
	})
	$("#open1").click(function(){//開啟編輯檔
		$("#open2").trigger('click');
		$("#open1").attr('disabled','disabled');
	})
	$("#open2").change(function(){
		var file=event.target.files[0];
		var reader = new FileReader();
		reader.readAsText(file);
		reader.onload=function(event){
			var text=JSON.parse(event.target.result);
			
			canvasState.height=text.height;
			canvasState.width=text.width;
			for(i=0;i<=text.shapes.length-1;i++){
				var shape = new Shape(
									text.shapes[i].color,
									text.shapes[i].line,  
									text.shapes[i].type,
									text.shapes[i].shape,
									text.shapes[i].illustration,
									text.shapes[i].points,
									text.shapes[i].sx,
									text.shapes[i].sy,
									text.shapes[i].ex,
									text.shapes[i].ey,
									text.shapes[i].x,
									text.shapes[i].y,
									text.shapes[i].xx,
									text.shapes[i].yy,
									text.shapes[i].r
									);
				canvasState.shapes[i]=shape;
				if(i == text.shapes.length-1){
					canvasState.valid=false;
					canvasState.draw(canvasState.ctx);
				}
			}
		};
	})
	
	$("#reappear").click(function(){//重播
		var j ='0'; 
		setInterval(function(){
			if(j != canvasState.imageDatas.length){
				canvasState.ctx.putImageData(canvasState.imageDatas[j],0,0);
				j++;
			}else{
				clearTimeout(i); 
				return false;
			}
		},30)
	})
});

function Pen(){//畫筆的基本屬性
	this.color = 'black'; 	// color
	this.line = 3;			// width
	this.type='shape'		//哪種類型
	this.shape = 'pen';		// 形狀的類型
	this.illustration = '';	// 插圖的類型
}
function Shape(color, line, type, shape, illustration, points, sx, sy, ex, ey, x, y, xx, yy, r){//圖形的基本屬性
	this.color=color||'black'; 	// color
	this.line=line||1;			// width
	this.type=type||'shape';		//哪種類型
	this.shape=shape||'';		// 形狀的類型
	this.illustration=illustration||'';	// 插圖的類型
	
	this.points=points||[];  //畫一般線儲存座標位置
	
	this.x=x||0;
	this.y=y||0;
	this.xx=xx||0;
	this.yy=yy||0;
	
	this.sx=sx||0;
	this.sy=sy||0;
	this.ex=ex||0;
	this.ey=ey||0;
	
	this.r=r||0;
}

Shape.prototype.draw=function(ctx){//繪製形狀
	if (this.type == 'shape'){//畫線
		ctx.lineWidth = this.line;//線條粗細
		ctx.strokeStyle = this.color;//顏色
		ctx.beginPath();
		
		switch (this.shape) {
			case 'general'://一般
				ctx.moveTo(this.x, this.y);
				for (var i = 0; i <this.points.length; i++) {
					var x = this.points[i].x;
					var y = this.points[i].y;
					ctx.lineTo(x,y);
					ctx.moveTo(x,y);
				}
				break;
			case 'line'://直線
				ctx.moveTo(this.x,this.y);
				ctx.lineTo(this.xx,this.yy);
				break;
			case 'round'://圓形
				ctx.arc(this.x,this.y,this.r,0,2*Math.PI,true);
				break;
			case 'rectangle'://正方形
				var angle=2*Math.PI/4;
				var rotate=Math.PI/4;
				for(i=0;i<=4;i++){
					var x=this.x+Math.cos(i*angle+rotate)*this.r;
					var y=this.y+Math.sin(i*angle+rotate)*this.r;
					ctx.lineTo(x,y);
					ctx.moveTo(x,y);
				}
				break;
			case 'polygon'://六邊形
				var angle=2*Math.PI/6;
				var rotate=Math.PI/2;
				for(i=0;i<=6;i++){
					var x=this.x+Math.cos(i*angle+rotate)*this.r;
					var y=this.y+Math.sin(i*angle+rotate)*this.r;
					ctx.lineTo(x,y);
					ctx.moveTo(x,y);
				}
				break;
			case 'triangle'://三角形
				var angle=2*Math.PI/3;
				var rotate=Math.PI/6;
				for(i=0;i<=3;i++){
					var x=this.x+Math.cos(i*angle+rotate)*this.r;
					var y=this.y+Math.sin(i*angle+rotate)*this.r;
					ctx.lineTo(x,y);
					ctx.moveTo(x,y);
				}
				break;
			case 'star'://星星
				var x=this.x;
				var y=this.y;
				
				var d=-90;
				var dd=-54;
				for(i=0;i<=5;i++){
					xx=x+this.r*Math.cos(d/180*Math.PI);
					yy=y+this.r*Math.sin(d/180*Math.PI);
					
					xxx=x+(this.r/2)*Math.cos(dd/180*Math.PI);
					yyy=y+(this.r/2)*Math.sin(dd/180*Math.PI);
					
					d+=72;
					dd+=72;
					
					ctx.lineTo(xx,yy);
					ctx.lineTo(xxx,yyy);
				}
				break;
		}
		ctx.closePath();
		ctx.stroke();
	}else if (this.type == "illustration") {//蓋章
        ctx.drawImage($("img[p_shape="+this.illustration+"]")[0],this.sx, this.sy, this.ex-this.sx, this.ey-this.sy);
    }
}

function Canvas(canvas,pen){//此function是物件化的畫布
	var ctx=canvas.getContext('2d');
	ctx.lineCap = 'round';//塗白顏色
	ctx.fillStyle="white";//塗白防止圖片背景透明
	ctx.fillRect(0,0,$("#canvasid").width(),$("#canvasid").height());//塗白範圍
	
	this.ctx=canvas.getContext('2d');//畫圖
	this.pen=pen;//畫筆
	this.width=$("#canvasid").width();//畫布寬
	this.height=$("#canvasid").height();//畫布高
	this.select='';//選到甚麼形狀或圖形
	this.mousex='';
	this.mousex='';
	
	this.shapes=[];//要繪製的東西的集合
	this.imageDatas=[];//重播
	
	this.drawMode=false;//有沒有下筆
	this.mousemove=false;//是不是箭頭圖片
	this.mousezoom=false;
	this.valid=false;//設置為true時，畫布將重繪所有內容
	
	var tcanvas = this;
	$(canvas).mousedown(function(e){
		var mouse=tcanvas.getMouse(e);
		
		if(tcanvas.pen.type=='shape'){//形狀
			if(tcanvas.pen.shape == 'nono'){//鼠標
                for(i=tcanvas.shapes.length-1;i>=0;i--){
                    var shape = tcanvas.shapes[i];
					if(mouse.x>=shape.sx && mouse.y>=shape.sy  && mouse.x<=shape.ex&& mouse.y<=shape.ey){
						tcanvas.mousex=mouse.x;
						tcanvas.mousey=mouse.y;
						
						tcanvas.select=shape;
						tcanvas.valid=false 
						tcanvas.mousemove=true;
						tcanvas.mousezoom=false;
						this.drawMode=true;
						
						if(shape.shape != 'general' && shape.shape != 'line'){
							if(mouse.x>=(shape.ex-15) && mouse.y>=(shape.ey-15) && mouse.x<=shape.ex&& mouse.y<=shape.ey){
								tcanvas.mousezoom=true;
							}
						}
						return;
					}
                }
			}else{//形狀
				var shape = new Shape;
				shape.color = tcanvas.pen.color;
				shape.line = tcanvas.pen.line;
				shape.type = tcanvas.pen.type;
				shape.shape = tcanvas.pen.shape;
				
				shape.x = mouse.x;
				shape.y = mouse.y;
				
				if(shape.shape == 'line'){
					shape.xx = mouse.x;
					shape.yy = mouse.y;
				}
				if(shape.shape == 'general'){
					shape.sx = mouse.x;
					shape.sy = mouse.y;
					shape.points.push(mouse);
				}
				
				tcanvas.select=shape;
				tcanvas.addShape(shape);
				tcanvas.valid = false;
				tcanvas.mousemove = false;
				this.drawMode=true;
				return;
			}
		}else{//印章
			var shape = new Shape;
			
			shape.type=tcanvas.pen.type;
			shape.illustration=tcanvas.pen.illustration;
			
			shape.x = mouse.x;
			shape.y = mouse.y;
			
			shape.sx = mouse.x;
			shape.sy = mouse.y;
			shape.ex = shape.sx+$("img[p_shape="+shape.illustration+"]").width();
			shape.ey = shape.sy+$("img[p_shape="+shape.illustration+"]").width();
			
			tcanvas.select=shape;
			tcanvas.addShape(shape);
			tcanvas.valid = false;
			tcanvas.mousemove = false;
			this.drawMode=true;
			return;
		}
	}).mousemove(function(e){
		if(this.drawMode){
			var mouse=tcanvas.getMouse(e);
			var shape=tcanvas.select;
			
			if(tcanvas.pen.type=='shape'){//形狀	
				if(tcanvas.pen.shape == 'nono'){//鼠標
					var x=mouse.x-tcanvas.mousex;
					var y=mouse.y-tcanvas.mousey;
					tcanvas.mousex=mouse.x;
					tcanvas.mousey=mouse.y;
					
					if(tcanvas.mousezoom){//縮放
						if(shape.sx+20<=mouse.x && shape.sy+20<=mouse.y){
								shape.r=shape.r+x;
								
								shape.sx=shape.sx-x;
								shape.sy=shape.sy-x;
								
								shape.ex=shape.ex+x;
								shape.ey=shape.ey+x;
						}
					}else{//移動
						if(shape.shape=='general'){
							shape.x=shape.x+x;
							shape.y=shape.y+y;
							for(i=0;i<=shape.points.length-1;i++){
								shape.points[i].x=shape.points[i].x+x;
								shape.points[i].y=shape.points[i].y+y;
							}
							shape.sx=shape.sx+x;
							shape.sy=shape.sy+y;
							shape.ex=shape.ex+x;
							shape.ey=shape.ey+y;
						}else{
							if(shape.shape=='line'){
								shape.xx=shape.xx+x;
								shape.yy=shape.yy+y;
							}
							shape.x=shape.x+x;
							shape.y=shape.y+y;
							
							shape.sx=shape.sx+x;
							shape.sy=shape.sy+y;
							
							shape.ex=shape.ex+x;
							shape.ey=shape.ey+y;
						}
					}
				}else{//形狀
					if(shape.shape == 'round' || shape.shape == 'rectangle' ||shape.shape == 'triangle' ||shape.shape == 'polygon' || shape.shape == 'star'){
						shape.r=Math.pow(((shape.x-mouse.x)*(shape.x-mouse.x)+(shape.y-mouse.y)*(shape.y-mouse.y)),0.5);
					}
					if(shape.shape == 'line'){//直線
						shape.xx=mouse.x;
						shape.yy=mouse.y;
					}
					if(shape.shape == 'general'){//一般
						if(mouse.x<=shape.sx){
							shape.sx=mouse.x;
						}
						if(mouse.y<=shape.sy){
							shape.sy=mouse.y;
						}
						if(mouse.x>=shape.ex){
							shape.ex=mouse.x;
						}
						if(mouse.y>=shape.ey){
							shape.ey=mouse.y;
						}
						shape.points.push(mouse);
					}
				}
			}else{//印章
				shape.x=mouse.x;
                shape.y=mouse.y;
				shape.sx = mouse.x;
				shape.sy = mouse.y;
				shape.ex = shape.sx+$("img[p_shape="+shape.illustration+"]").width();
				shape.ey = shape.sy+$("img[p_shape="+shape.illustration+"]").width();
			}
			tcanvas.valid = false;
		}
	}).mouseup(function(e){
		var shape=tcanvas.select;
		if(shape.shape == 'round' || shape.shape == 'rectangle' ||shape.shape == 'triangle' ||shape.shape == 'polygon' || shape.shape == 'star'){
			shape.sx=shape.x-shape.r;
			shape.sy=shape.y-shape.r;
			shape.ex=shape.x+shape.r;
			shape.ey=shape.y+shape.r;
		}else if(shape.shape == 'line'){
			var x1=shape.x;
			var y1=shape.y;
			var x2=shape.xx;
			var y2=shape.yy;
			if(x1<x2){
				shape.sx=x1;
				shape.ex=x2;
			}
			if(y1<y2){
				shape.sy=y1;
				shape.ey=y2;
			}
			if(x1>x2){
				shape.sx=x2;
				shape.ex=x1;
			}
			if(y1>y2){
				shape.sy=y2;
				shape.ey=y1;
			}
		}
		
		this.drawMode=false;
		this.mousemove=false;
		this.mousezoom=false;
		tcanvas.select='';
	});
	
	setInterval(function(){
		tcanvas.draw();
	},30)
}

Canvas.prototype.getMouse = function(e){//得到滑鼠的位置
	x=e.pageX-$(".body").	().left-200-3
	y=e.pageY-$(".body").position().top-100-3
	return{
		x:x,
		y:y
	}
}
Canvas.prototype.addShape = function(shape){//在畫布中添加一個Shape
	this.shapes.push(shape);
	this.valid = false;
}


Canvas.prototype.clear = function(){//清除繪製的畫布
	var ctx = this.ctx;
	ctx.lineCap = 'round';
	ctx.fillStyle="white";//塗白防止圖片背景透明
	ctx.fillRect(0,0,$("#canvasid").width(),$("#canvasid").height());
}
Canvas.prototype.draw = function() {//畫畫布
	if (!this.valid){
		this.clear();
		
		var ctx = this.ctx;
		var shapes = this.shapes;
		
		for(i=0;i<shapes.length;i++){
			shapes[i].draw(ctx);
		}
		if(this.mousemove){
			var shape = this.select;
			ctx.strokeStyle='red';
			ctx.lineWidth='1';
			ctx.beginPath();
			
			x1=shape.sx;
			y1=shape.sy;
			x2=shape.ex-shape.sx;
			y2=shape.ey-shape.sy;
			
			ctx.strokeRect(x1,y1,x2,y2);
			ctx.strokeRect(x1+x2,y1+y2,-10,-10);
			
			ctx.closePath();
			ctx.stroke();
		}
		image=ctx.getImageData(0,0,this.width,this.height);
        this.imageDatas.push(image);
		
		this.valid = true;
	}
}
