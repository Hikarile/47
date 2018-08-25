$(function(){
	var pen = new Pen();
	var canvas=$("#canvas")[0];
	var canvasState=new Canvas(canvas,pen);
	
	$("#colors div[p_color=black]").addClass('active');
	$("#lines div[p_line=1]").addClass('active');
	$("#shape img[p_shape=general]").addClass('active');
	
	$("#colors div").click(function(){
		$("#colors div").removeClass('active');
		$(this).addClass('active');
		pen.color=$(this).attr('p_color');
	})
	$("#lines div").click(function(){
		$("#lines div").removeClass('active');
		$(this).addClass('active');
		pen.line=$(this).attr('p_line');
	})
	$("#shape img").click(function(){
		$("#shape img").removeClass('active');
		$(this).addClass('active');
		if($(this).attr('type')=='shape'){
			pen.type='shape';
			pen.shape=$(this).attr('p_shape');
			pen.ill='';
		}
		if($(this).attr('type')=='ill'){
			pen.type='ill';
			pen.shape='';
			pen.ill=$(this).attr('p_shape');
		}
	})
	
	$("#save_1").click(function(){
		var d=$("#download")[0];
		d.href=$(canvas)[0].toDataURL();
		d.download="img.png";
		d.click();
	})	
	$("#save_2").click(function(){
		var data={
			width:canvasState.width,
			height:canvasState.height,
			shapes:canvasState.shapes,
		}
		var blob=new Blob([JSON.stringify(data,null,2)]);
		var d=$("#download")[0];
		d.href=URL.createObjectURL(blob);
		d.download="text.txt";
		d.click();
	})
	$("#open1").click(function(){
		$("#open2").trigger('click');
		$("#open1").attr('disabled','disabled');
	})
	$("#open2").change(function(){
		var file=event.target.files[0];
		var reader=new FileReader();
		reader.readAsText(file);
		reader.onload=function(event){
			var text=JSON.parse(event.target.result);
			
			canvasState.width=text.width;
			canvasState.heigh=text.heigh;
			for(i=0;i<=text.shapes.length-1;i++){
				var shape= new Shape(
									text.shapes[i].color,
									text.shapes[i].line,
									text.shapes[i].type,
									text.shapes[i].shape,
									text.shapes[i].ill,
									text.shapes[i].points,
									text.shapes[i].x,
									text.shapes[i].y,
									text.shapes[i].xx,
									text.shapes[i].yy,
									text.shapes[i].sx,
									text.shapes[i].sy,
									text.shapes[i].ex,
									text.shapes[i].ey,
									text.shapes[i].r
									);
				canvasState.shapes[i]=shape;
				if(i == text.shapes.length-1){
					canvasState.valid=true;
					canvasState.draw(canvasState.ctx);
				}
			}
		};
	})
})

function Pen(){
	this.color='black';
	this.line='1';
	this.type='shape';
	this.shape='general';
	this.ill='';
}
function Shape(color,line,type,shape,ill,points,x,y,xx,yy,sx,sy,ex,ey,r){
	this.color=color||"black";
	this.line=line||"1";
	this.type=type||"shape";
	this.shape=shape||'';
	this.ill=ill||'';
	
	this.points=points||[];
	
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
Shape.prototype.draw=function(ctx){
	if(this.type=='shape'){
		ctx.lineWidth=this.line;
		ctx.strokeStyle=this.color;
		ctx.beginPath();
		
		switch(this.shape){
			case'general':
				ctx.moveTo(this.x,this,y);
				for(j = 0 ; j<this.points.length ; j ++){
					var x=this.points[j].x;
					var y=this.points[j].y;
					ctx.lineTo(x,y);
					ctx.moveTo(x,y);
				}
				break;
			case'line':
				ctx.moveTo(this.x,this.y);
				ctx.lineTo(this.xx,this.yy);
				break;
			case'arc':
				ctx.arc(this.x,this.y,this.r,0,2*Math.PI,true);
				break;
			case'three':
				var a=2*Math.PI/3;
				var r=Math.PI/6;
				for(j=0;j<=3;j++){
					var x=this.x+Math.cos(j*a+r)*this.r;
					var y=this.y+Math.sin(j*a+r)*this.r;
					ctx.lineTo(x,y);
					ctx.moveTo(x,y);
				}
				break;
			case'four':
				var a=2*Math.PI/4;
				var r=Math.PI/4;
				for(j=0;j<=4;j++){
					var x=this.x+Math.cos(j*a+r)*this.r;
					var y=this.y+Math.sin(j*a+r)*this.r;
					ctx.lineTo(x,y);
					ctx.moveTo(x,y);
				}
				break;
			case'six':
				var a=2*Math.PI/6;
				var r=Math.PI/2;
				for(j=0;j<=6;j++){
					var x=this.x+Math.cos(j*a+r)*this.r;
					var y=this.y+Math.sin(j*a+r)*this.r;
					ctx.lineTo(x,y);
					ctx.moveTo(x,y);
				}
				break;
			case'start':
				var x= this.x;
				var y= this.y;
				
				var d=-90;
				var dd=-54;
				for(j=0;j<=5;j++){
					xx=x+Math.cos(d/180*Math.PI)*this.r;
					yy=y+Math.sin(d/180*Math.PI)*this.r;
					
					xxx=x+Math.cos(dd/180*Math.PI)*(this.r/2);
					yyy=y+Math.sin(dd/180*Math.PI)*(this.r/2);
					
					d+=72;
					dd+=72;
					
					ctx.lineTo(xx,yy);
					ctx.lineTo(xxx,yyy);
				}
				break;
		}
		ctx.closePath();
		ctx.stroke();
	}else if(this.type=='ill'){
		ctx.drawImage($("img[p_shape="+this.ill+"]")[0],this.sx,this.sy,this.ex-this.sx,this.ey-this.sy);
	}
}

function Canvas(canvas,pen){
	var ctx=canvas.getContext('2d');
	ctx.lineCap="round";
	ctx.fillStyle="white";
	ctx.fillRect(0,0,$("#canvas").width(),$("#canvas").height());
	
	this.ctx=ctx;
	this.pen=pen;
	this.width=$("#canvas").width();
	this.height=$("#canvas").height();
	this.select='';
	this.mousex='';
	this.mousey='';
	
	this.shapes=[];  
	this.imagedatas=[];
	
	this.drawmode=false;
	this.mousemove=false;
	this.mousezoom=false;
	this.valid=true;
	
	var tcanvas=this;
	$(canvas).mousedown(function(e){
		var mouse=tcanvas.getmouse(e);
		if(tcanvas.pen.type=="shape" && tcanvas.pen.shape=="no"){//滑鼠
			for(i=tcanvas.shapes.length-1;i>=0;i--){
				shape=tcanvas.shapes[i];
				if(mouse.x>=shape.sx && mouse.y>=shape.sy && mouse.x<=shape.ex && mouse.y<=shape.ey){
					tcanvas.select=shape;
					tcanvas.mousex=mouse.x;
					tcanvas.mousey=mouse.y;
					
					tcanvas.mousezoom=false;
					tcanvas.drawmode=tcanvas.mousemove=tcanvas.valid=true;
					if(shape.shape!='line' && shape.shape!='general'){
						if(mouse.x>=(shape.ex-15) && mouse.y>=(shape.ey-15) && mouse.x<=shape.ex && mouse.y<=shape.ey){
							tcanvas.mousezoom=true;
						}
					}
					return;
				}
			}
		}else if(tcanvas.pen.type=="shape"){//形狀
			var shape=new Shape;
			shape.color=tcanvas.pen.color;
			shape.line=tcanvas.pen.line;
			shape.type=tcanvas.pen.type;
			shape.shape=tcanvas.pen.shape;
			
			shape.x=mouse.x;
			shape.y=mouse.y;
			
			if(shape.shape=="line"){
				shape.xx=mouse.x;
				shape.yy=mouse.y;
			}
			if(shape.shape=="general"){
				shape.sx=mouse.x;
				shape.sy=mouse.y;
				shape.points.push(mouse);
			}
			
			tcanvas.select=shape;
			tcanvas.addshape(shape);
			tcanvas.valid=true;
			tcanvas.mousezoom=tcanvas.mousemove=false;
			tcanvas.drawmode=true;
			return;
		}else{//圖片
			var shape=new Shape;
			
			shape.type=tcanvas.pen.type;
			shape.ill=tcanvas.pen.ill;
			
			shape.sx=shape.x=mouse.x;
			shape.sy=shape.y=mouse.y;
			shape.ex=mouse.x+$("img[p_shape="+tcanvas.pen.ill+"]").width();
			shape.ey=mouse.y+$("img[p_shape="+tcanvas.pen.ill+"]").height();
			
			tcanvas.select=shape;
			tcanvas.addshape(shape);
			tcanvas.valid=true;
			tcanvas.mousezoom=tcanvas.mousemove=false;
			tcanvas.drawmode=true;
			return;
		}
	}).mousemove(function(e){
		if(tcanvas.drawmode){
			var mouse=tcanvas.getmouse(e);
			var shape=tcanvas.select;
			
			if(tcanvas.pen.type=="shape" && tcanvas.pen.shape=="no"){
				var x=mouse.x-tcanvas.mousex;
				var y=mouse.y-tcanvas.mousey;
				tcanvas.mousex=mouse.x;
				tcanvas.mousey=mouse.y;
				
				if(tcanvas.mousezoom){
					if(shape.sx+20<=mouse.x && shape.sy+20<=mouse.y){
						shape.r=shape.r+x;
						
						shape.sx=shape.sx-x;
						shape.sy=shape.sy-x;
						
						shape.ex=shape.ex+x;
						shape.ey=shape.ey+x;
					}
				}else{
					if(shape.shape=='general'){
						shape.x=shape.x+x;
						shape.y=shape.y+y;
						shape.sx=shape.sx+x;
						shape.sy=shape.sy+y;
						shape.ex=shape.ex+x;
						shape.ey=shape.ey+y;
						for(i=0;i<shape.points.length;i++){
							shape.points[i].x=shape.points[i].x+x;
							shape.points[i].y=shape.points[i].y+y;
						}
					}else{
						shape.x=shape.x+x;
						shape.y=shape.y+y;
						if(shape.shape=='line'){
							shape.xx=shape.xx+x;
							shape.yy=shape.yy+y;
						}
						shape.sx=shape.sx+x;
						shape.sy=shape.sy+y;
						shape.ex=shape.ex+x;
						shape.ey=shape.ey+y;
					}
				}
			}else if(tcanvas.pen.type=="shape" && tcanvas.pen.shape!="no"){
				if(shape.shape=="arc" || shape.shape=="three" || shape.shape=="four" || shape.shape=="six" || shape.shape=="start"){
					shape.r=Math.pow((shape.x-mouse.x)*(shape.x-mouse.x)+(shape.y-mouse.y)*(shape.y-mouse.y),0.5);
				}
				if(shape.shape=="line"){
					shape.xx=mouse.x;
					shape.yy=mouse.y;
				}
				if(shape.shape=="general"){
					if(mouse.x<=shape.sx){
						shape.sx=mouse.x;
					}if(mouse.y<=shape.sy){
						shape.sy=mouse.y;
					}
					if(mouse.x>=shape.ex){
						shape.ex=mouse.x;
					}if(mouse.y>=shape.ey){
						shape.ey=mouse.y;
					}
					shape.points.push(mouse);
				}
			}
			if(tcanvas.pen.type=="ill"){
				shape.x=shape.sx=mouse.x;
				shape.y=shape.sy=mouse.y;
				shape.ex=shape.x+$("img[p_shape="+tcanvas.pen.ill+"]").width();
				shape.ey=shape.y+$("img[p_shape="+tcanvas.pen.ill+"]").height();
			}
			tcanvas.valid = true;
		}
	}).mouseup(function(e){
		var shape=tcanvas.select;
		if(shape.shape=="arc" || shape.shape=="three" || shape.shape=="four" || shape.shape=="six" || shape.shape=="start"){
			shape.sx=shape.x-shape.r;
			shape.sy=shape.y-shape.r;
			shape.ex=shape.x+shape.r;
			shape.ey=shape.y+shape.r;
		}else if(shape.shape=="line"){
			var x1=shape.x;
			var y1=shape.y;
			var x2=shape.xx;
			var y2=shape.yy;
			if(x1<x2){
				shape.sx=x1;
				shape.ex=x2;
			}if(y1<y2){
				shape.sy=y1;
				shape.ey=y2;
			}
			if(x1>x2){
				shape.sx=x2;
				shape.ex=x1;
			}if(y1>y2){
				shape.sy=y2;
				shape.ey=y1;
			}
		}
		tcanvas.drawmode=false;
		tcanvas.mousemove=false;
		tcanvas.mousezoom=false;
		tcanvas.select='';
	});
	
	setInterval(function(){
		tcanvas.draw();
	},30)
}

Canvas.prototype.getmouse=function(e){
	x=e.pageX-$(".body").position().left-200-3;
	y=e.pageY-$(".body").position().top-100-3;
	return {
		x:x,
		y:y
	}
}
Canvas.prototype.addshape=function(shape){
	this.shapes.push(shape);
	this.valid=true;
}

Canvas.prototype.clear=function(){
	var ctx=this.ctx;
	ctx.lineCap="round";
	ctx.fillStyle="white";
	ctx.fillRect(0,0,$("#canvas").width(),$("#canvas").height());
}
Canvas.prototype.draw=function(){
	if(this.valid){
		this.clear();
		
		var ctx = this.ctx;
		var shapes = this.shapes;
		
		for(i=0;i<shapes.length;i++){
			shapes[i].draw(ctx);
		}
		
		if(this.mousemove){
			var shape=this.select;
			ctx.lineWidth='1';
			ctx.strokeStyle='red';
			ctx.fillStyle='red';
			ctx.beginPath();
			
			var x1=shape.sx;
			var y1=shape.sy;
			var x2=shape.ex-shape.sx;
			var y2=shape.ey-shape.sy;
			console.log(shape);
			ctx.strokeRect(x1,y1,x2,y2);
			if(shape.shape!='line' && shape.shape!='general'){
				ctx.fillRect(x1+x2,y1+y2,-15,-15);
			}
			
			ctx.closePath();
			ctx.stroke();
		}
		
		image=this.ctx.getImageData(0,0,this.width,this.height);
        this.imagedatas.push(image);
		this.valid = false;
	}
}
