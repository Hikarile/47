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
		var download=$('#download');
		var d=download[0];
		
		var data=$(canvas)[0].toDataURL();
		d.href=data;
		d.download="image.jpg";
		d.click();
	})
	$("#save_2").click(function(){//存成編輯檔
		var debug={
			height:canvasState.height,
			width:canvasState.width,
			shapes:canvasState.shapes
		};
		
		var blob=new Blob([JSON.stringify(debug,null,2)],{type:'text/txt'});
		var url = URL.createObjectURL(blob);
		
		var d=$('#download')[0];
		d.href=url
		d.download="text.txt";
		d.click();
	})
	$("#open").change(function(){//開啟編輯檔
		openfile(canvasState,this,event)
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

function openfile(canvasState,odj,ev){//讀檔
	var file=ev.target.files[0];
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
								text.shapes[i].w,
								text.shapes[i].h
								);
			canvasState.shapes[i]=shape;
			if(i == text.shapes.length-1){
				canvasState.valid=false;
				canvasState.draw(canvasState.ctx);
			}
		}
	};
}

function Pen(){//畫筆的基本屬性
	this.color = 'black'; 	// color
	this.line = 3;			// width
	this.type='shape'		//哪種類型
	this.shape = 'pen';		// 形狀的類型
	this.illustration = '';	// 插圖的類型
}
function Shape(color, line, type, shape, illustration,points,sx,sy,ex,ey, x, y, w, h){//圖形的基本屬性
	this.color=color||'black'; 	// color
	this.line=line||1;			// width
	this.type=type||'shape';		//哪種類型
	this.shape=shape||'';		// 形狀的類型
	this.illustration=illustration||'';	// 插圖的類型
	
	this.points=points||[];  //畫一般線儲存座標位置
	
	this.x=x||0;
	this.y=y||0;
	
	this.sx=sx||0;
	this.sy=sy||0;
	this.ex=ex||0;
	this.ey=ey||0;
	
	this.w=w||1;
	this.h=h||1;
}

Shape.prototype.draw=function(ctx){//繪製形狀
	if (this.type == 'shape'){//畫線
		ctx.lineWidth = this.line;//線條粗細
		ctx.strokeStyle = this.color;//顏色
		ctx.beginPath();
		
		switch (this.shape) {
			case 'general':
				ctx.moveTo(this.x, this.y);
				for (var i = 0; i <this.points.length; i++) {
					var x = this.points[i].x;
					var y = this.points[i].y;
					ctx.lineTo(x,y);
					ctx.moveTo(x,y);
				}
				break;
			case 'line':
				ctx.moveTo(this.sx, this.sy);
				ctx.lineTo(this.sx + this.w,  this.sy + this.h);
				break;
			case 'round':
				var e_x = this.sx + this.w / 2;
				var e_y = this.sy + this.h / 2;
				
				var size = Math.abs(this.w/2);
				
				ctx.arc(e_x,e_y,size,0,2*Math.PI,true);
				break;
			case 'rectangle':
				ctx.strokeRect(this.sx,this.sy,this.w,this.h);
				break;
			case 'polygon':
				var e_x = this.sx + this.w / 2;
				var e_y = this.sy + this.h / 2;
				
				var size = Math.abs(this.w / 2);
				for (var i = 0; i <= 6; i++) {
					var x = Math.cos((i*60)/180* Math.PI)*size+e_x;
					var y = Math.sin((i*60)/180* Math.PI)*size+e_y;
					ctx.lineTo(x, y);
					ctx.moveTo(x, y);
				}
				break;
			case 'triangle':
				var e_x = this.sx + this.w / 2;
				var e_y = this.sy + this.h / 2;
				
				var size =-(Math.abs(this.w / 2));
				
				var d=0;
				var dd=120;
				for(i=0;i<3;i++){
					var x = Math.cos((90+d)/180*Math.PI)*size+e_x;
					var y = Math.sin((90+d)/180*Math.PI)*size+e_y;
					ctx.lineTo(x, y);
					d+=dd;
				}
				break;
			case 'star':
				var x = this.sx + this.w / 2;
				var y = this.sy + this.h / 2;
				
				w=Math.abs(this.w/2);
				ww=w/2;
				
				var d=-90;
				var dd=-54;
				for(i=0;i<=5;i++){
					xx=x+w*Math.cos(d/180*Math.PI);
					yy=y+w*Math.sin(d/180*Math.PI);
					
					xxx=x+ww*Math.cos(dd/180*Math.PI);
					yyy=y+ww*Math.sin(dd/180*Math.PI);
					
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
        ctx.drawImage($("img[p_shape="+this.illustration+"]")[0], this.x, this.y, this.w, this.h);
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
                for(i=tcanvas.shapes.length-1;i>=0;i--) {
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
							if(mouse.x>=(parseInt(shape.ex)-parseInt(15)) && mouse.y>=(parseInt(shape.ey)-parseInt(15))  && mouse.x<=shape.ex&& mouse.y<=shape.ey){
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
				shape.sx = mouse.x;
				shape.sy = mouse.y;
				
				if(shape.shape == 'general'){
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
			shape.w = $("img[p_shape="+shape.illustration+"]").width();
			shape.h = $("img[p_shape="+shape.illustration+"]").width();
			shape.ex = shape.sx+shape.w;
			shape.ey = shape.sy+shape.h;
			
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
						if(parseInt(shape.sx)+parseInt(20)<=mouse.x && parseInt(shape.sy)+parseInt(20)<=mouse.y){
							if(shape.shape =='rectangle'){
								shape.w=shape.w+x;
								shape.h=shape.h+y;
								shape.ex=shape.ex+x;
								shape.ey=shape.ey+y;
							}else{
								shape.w=shape.w+x;
								shape.h=shape.w;
								shape.ex=shape.ex+x;
								shape.ey=shape.ey+x;
							}
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
							shape.x=shape.x+x;
							shape.y=shape.y+y;
							
							shape.sx=shape.sx+x;
							shape.sy=shape.sy+y;
							
							shape.ex=shape.ex+x;
							shape.ey=shape.ey+y;
						}
					}
				}else{//形狀
					if(shape.shape == 'general'){
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
						
						shape.w=shape.ex-shape.sx;
						shape.h=shape.ey-shape.sy;
						
						shape.points.push(mouse);
					}if(shape.shape == 'line' || shape.shape == 'rectangle'){
						shape.ex=mouse.x;
						shape.ey=mouse.y;
						
						shape.w=Math.abs(shape.ex-shape.sx);
						shape.h=Math.abs(shape.ey-shape.sy);
					}if(shape.shape == 'polygon' || shape.shape == 'star' ||shape.shape == 'triangle' || shape.shape == 'round'){
						shape.w=Math.abs(mouse.x-shape.x);
						shape.h=Math.abs(shape.w);
						
						var r=(mouse.x-shape.x)/2;
						
						shape.sy=shape.y;
						shape.sx=shape.x;
						
						shape.ey=parseInt(shape.sy)+parseInt(r*2);
						shape.ex=parseInt(shape.sx)+parseInt(r*2);
					}
				}
			}else{//印章
				shape.x = mouse.x;
                shape.y = mouse.y;
				
				shape.sx = mouse.x;
                shape.sy = mouse.y;
				
				shape.ex = shape.sx+shape.w;
                shape.ey = shape.sy+shape.h;
			}
			
			tcanvas.valid = false;
		}
	}).mouseup(function(e){
		shape=tcanvas.select;
		if(shape.shape == 'polygon' || shape.shape == 'star' ||shape.shape == 'triangle' || shape.shape == 'round'){
			shape.x=shape.sx;
			shape.y=shape.sy;
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
	x=e.pageX-$(".body").position().left-200-3
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
			
			x1=parseInt(shape.sx)-parseInt(Math.abs(shape.line))-parseInt(2);
			y1=parseInt(shape.sy)-parseInt(Math.abs(shape.line))-parseInt(2);
			x2=parseInt(shape.w)+(parseInt(Math.abs(shape.line))*2)+parseInt(4);
			y2=parseInt(shape.h)+(parseInt(Math.abs(shape.line))*2)+parseInt(4);
			ctx.strokeRect(x1,y1,x2,y2);
			ctx.strokeRect(parseInt(x1)+parseInt(x2),parseInt(y1)+parseInt(y2),-15,-15);
			
			ctx.fill();
			ctx.closePath();
			ctx.stroke();
		}
		image=this.ctx.getImageData(0,this.width,this.height);
        this.imageDataspush(image);
		
		this.valid = true;
	}
}
