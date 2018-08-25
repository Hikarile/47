$(function(){
	var pen=new Pen();
	var canvas=$("#canvas")[0];
	var canvasState = new Canvas(canvas, pen);
	
	$("#colors div[p_color=black]").addClass('aa');
	$("#lines div[p_line=1]").addClass('aa');
	$("#shape img[p_shape=general]").addClass('aa');
	
	$("#colors div").click(function(){
		$("#colors div").removeClass('aa');
		$(this).addClass('aa');
		pen.color=$(this).attr('p_color');
	})
	$("#lines div").click(function(){
		$("#lines div").removeClass('aa');
		$(this).addClass('aa');
		pen.line=$(this).attr('p_line');
	})
	$("#shape img").click(function(){
		$("#shape img").removeClass('aa');
		$(this).addClass('aa');
		if($(this).attr('type')=='shape'){
			pen.type=$(this).attr('type');
			pen.shape=$(this).attr('p_shape');
			pen.ill='';
		}
		if($(this).attr('type')=='ill'){
			pen.type=$(this).attr('type');
			pen.shape='';
			pen.ill=$(this).attr('p_shape');
		}
	})
	
	$("#save1").click(function(){
		var d =$("#download")[0];
		d.href=$(canvas)[0].toDataURL();
		d.download="img.png";
		d.click();
	})
	$("#save2").click(function(){
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
	$("#open1").click(function(){
		$("#open2").trigger('click');
	})
	$("#open2").change(function(){
		var file=event.target.files[0];
		var reader=new FileReader();
		reader.readAsText(file);
		reader.onload=function(event){
			var text=JSON.parse(event.target.result);
			canvasState.width=text.width;
			canvasState.height=text.height;
			for(i=0;i<=text.shapes.length-1;i++){
				var shape=new Shape(
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
								text.shapes[i].sx,
								text.shapes[i].sy,
								text.shapes[i].r
								)
				canvasState.shapes[i]=shape;
				if(i==text.shapes.length-1){
					canvasState.valid=true;
					canvasState.draw(canvasState.ctx);
				}
			}
		};
	})
})
function Pen(){
	this.line='1';
	this.color='black';
	this.type='shape';
	this.shape='general';
	this.ill='';
}
function Shape(color,line,type,shape,ill,points,x,y,xx,yy,sx,sy,ex,ey,r){
	this.color=color||'';
	this.line=line||'';
	this.type=type||'';
	this.shape=shape||'';
	this.ill=ill||'';
	
	this.points=points||[];
	
	this.x=x||'';
	this.y=y||'';
	this.xx=xx||'';
	this.yy=yy||'';
	this.sx=sx||'';
	this.sy=sy||'';
	this.ex=ex||'';
	this.ey=ey||'';
	this.r=r||'';
}
Shape.prototype.draw=function(ctx){
	if(this.type=='shape'){
		ctx.lineWidth = this.line;
		ctx.strokeStyle = this.color;
		ctx.beginPath();
		
		switch(this.shape){
			case 'general':
				ctx.moveTo(this.x,this.y);
				for(i=0;i<this.points.length;i++){
					var x = this.points[i].x;
					var y = this.points[i].y;
					ctx.lineTo(x,y);
					ctx.moveTo(x,y);
				}
				break;
			case 'line':
				ctx.moveTo(this.x,this.y);
				ctx.lineTo(this.xx,this.yy);
				break;
			case 'arc':
				ctx.arc(this.x,this.y,this.r,0,Math.PI*2,true);
				break;
			case 'three':
				var a=2*Math.PI/3;
				var r=Math.PI/6;
				for(i=0;i<=3;i++){
					var x=this.x+Math.cos(i*a+r)*this.r;
					var y=this.y+Math.sin(i*a+r)*this.r;
					ctx.lineTo(x,y);
					ctx.moveTo(x,y);
				}
				break;
			case 'four':
				var a=2*Math.PI/4;
				var r=Math.PI/4;
				for(i=0;i<=4;i++){
					var x=this.x+Math.cos(i*a+r)*this.r;
					var y=this.y+Math.sin(i*a+r)*this.r;
					ctx.lineTo(x,y);
					ctx.moveTo(x,y);
				}
				break;
			case 'six':
				var a=2*Math.PI/6;
				var r=Math.PI/2;
				for(i=0;i<=6;i++){
					var x=this.x+Math.cos(i*a+r)*this.r;
					var y=this.y+Math.sin(i*a+r)*this.r;
					ctx.lineTo(x,y);
					ctx.moveTo(x,y);
				}
				break;
			case 'star':
				var x=this.x;
				var y=this.y;
				var d=-90;
				var dd=-54;
				for(i=0;i<=5;i++){
					var xx=x+Math.cos(d/180*Math.PI)*this.r;
					var yy=y+Math.sin(d/180*Math.PI)*this.r;
					
					var xxx=x+Math.cos(dd/180*Math.PI)*(this.r/2);
					var yyy=y+Math.sin(dd/180*Math.PI)*(this.r/2);
					
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
	ctx.lineCap='round';
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
	this.imagedata=[];
	
	this.valid=true;
	this.mousedown=false;
	this.mousemove=false;
	this.mousezoom=false;
	
	var tcanvas=this;
	$(canvas).mousedown(function(e){
		var mouse=tcanvas.getmouse(e);
		
		if(tcanvas.pen.type=="shape" && tcanvas.pen.shape=="no"){
			for(i=tcanvas.shapes.length-1;i>=0;i--){
				shape=tcanvas.shapes[i];
				if(mouse.x>=shape.sx && mouse.y>=shape.sy && mouse.x<=shape.ex && mouse.y<=shape.ey){
					tcanvas.mousex=mouse.x;
					tcanvas.mousey=mouse.y;
					tcanvas.select=shape;
					tcanvas.mousezoom=false;
					tcanvas.mousemove=tcanvas.mousedown=tcanvas.valid=true;
					if(shape.shape!='line' && shape.shape!='general'){
						if(mouse.x>=(shape.ex-15) && mouse.y>=(shape.ey-15) && mouse.x<=shape.ex && mouse.y<=shape.ey){
							tcanvas.mousezoom=true;
						}
					}
					return;
				}
			}
			
		}if(tcanvas.pen.type=="shape" && tcanvas.pen.shape!="no"){
			var shape=new Shape;
			
			shape.color=tcanvas.pen.color;
			shape.line=tcanvas.pen.line;
			shape.type=tcanvas.pen.type;
			shape.shape=tcanvas.pen.shape;
			shape.ill='';
			
			shape.x=mouse.x;
			shape.y=mouse.y;
			
			if(tcanvas.pen.shape =="general"){
				shape.sx=mouse.x;
				shape.sy=mouse.y;
				shape.points.push(mouse);
			}else if(tcanvas.pen.shape =="line"){
				shape.xx=mouse.x;
				shape.yy=mouse.y;
			}
			
			tcanvas.select=shape;
			tcanvas.addshape(shape);
			tcanvas.mousedown=tcanvas.valid=true;
			tcanvas.mousemove=tcanvas.mousezoom=false;
			return;
		}if(tcanvas.pen.type=="ill"){
			var shape= new Shape;
			
			shape.type=tcanvas.pen.type;
			shape.shape='';
			shape.ill=tcanvas.pen.ill;
			
			shape.x=shape.sx=mouse.x;
			shape.y=shape.sy=mouse.y;
			shape.ex=mouse.x+$("img[p_shape"+tcanvas.pen.shape+"]").width();
			shape.ey=mouse.y+$("img[p_shape"+tcanvas.pen.shape+"]").height();
			
			tcanvas.select=shape;
			tcanvas.addshape(shape);
			tcanvas.mousedown=tcanvas.valid=true;
			tcanvas.mousemove=tcanvas.mousezoom=false;
			return;
		}
	}).mousemove(function(e){
		if(tcanvas.mousedown){
			var mouse=tcanvas.getmouse(e);
			var shape=tcanvas.select;
			
			if(tcanvas.pen.type=="shape" && tcanvas.pen.shape=="no"){
				var x=mouse.x-tcanvas.mousex;
				var y=mouse.y-tcanvas.mousey;
				tcanvas.mousex=mouse.x;
				tcanvas.mousey=mouse.y;
				
				if(tcanvas.mousezoom){
					if(mouse.x>=shape.sx+20 && mouse.y>=shape.sy+20){
						shape.r=shape.r+x;
						shape.sx=shape.sx-x;
						shape.sy=shape.sy-x;
						shape.ex=shape.ex+x;
						shape.ey=shape.ey+x;
					}
				}else{
					shape.x=shape.x+x;
					shape.y=shape.y+y;
					
					if(shape.shape=="general"){
						for(i=0;i<shape.points.length;i++){
							shape.points[i].x=shape.points[i].x+x;
							shape.points[i].y=shape.points[i].y+y;
						}
					}if(shape.shape=="line"){
						shape.xx=shape.xx+x;
						shape.yy=shape.yy+y;
					}
					
					shape.sx=shape.sx+x;
					shape.sy=shape.sy+y;
					shape.ex=shape.ex+x;
					shape.ey=shape.ey+y;
				}
				
			}if(tcanvas.pen.type=="shape" && tcanvas.pen.shape!="no"){
				if(shape.shape=="arc" || shape.shape=="four" || shape.shape=="three" || shape.shape=="six" || shape.shape=="star"){
					shape.r=Math.pow((mouse.x-shape.x)*(mouse.x-shape.x)+(mouse.y-shape.y)*(mouse.y-shape.y),0.5);
				}
				if(shape.shape=="line"){
					shape.xx=mouse.x;
					shape.yy=mouse.y;
				}
				if(shape.shape=="general"){
					if(mouse.x<shape.sx){
						shape.sx=mouse.x;
					}if(mouse.y<shape.sy){
						shape.sy=mouse.y;
					}if(mouse.x>shape.ex){
						shape.ex=mouse.x;
					}if(mouse.y>shape.ey){
						shape.ey=mouse.y;
					}
					shape.points.push(mouse);
				}
			}if(tcanvas.pen.type=="ill"){
				shape.x=shape.sx=mouse.x;
				shape.y=shape.sy=mouse.y;
				shape.ex=mouse.x+$("img[p_shape"+tcanvas.pen.shape+"]").width();
				shape.ey=mouse.y+$("img[p_shape"+tcanvas.pen.shape+"]").height();	
			}
			tcanvas.valid=true;
		}
	}).mouseup(function(e){
		var shape=tcanvas.select;
		if(tcanvas.pen.shape=="arc" || tcanvas.pen.shape=="four" || tcanvas.pen.shape=="three" || tcanvas.pen.shape=="six" || tcanvas.pen.shape=="star"){
			shape.sx=shape.x-shape.r;
			shape.sy=shape.y-shape.r;
			shape.ex=shape.x+shape.r;
			shape.ey=shape.y+shape.r;
		}if(tcanvas.pen.shape=="line"){
			if(shape.x<shape.xx){
				shape.sx=shape.x;
				shape.ex=shape.xx;
			}if(shape.y<shape.yy){
				shape.sy=shape.y;
				shape.ey=shape.yy;
			}if(shape.x>shape.xx){
				shape.ex=shape.x;
				shape.sx=shape.xx;
			}if(shape.y>shape.yy){
				shape.ey=shape.y;
				shape.sy=shape.yy;
			}
		}
		tcanvas.select='';
		tcanvas.mousedown=tcanvas.valid=tcanvas.mousemove=tcanvas.mousezoom=false;
	});
	setInterval(function(){
		tcanvas.draw();
	},30)
}
Canvas.prototype.getmouse=function(e){
	x=e.pageX-$(".body").position().left-200-2;
	y=e.pageY-$(".body").position().top-100-2;
	return{
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
	ctx.lineCap='round';
	ctx.fillStyle="white";
	ctx.fillRect(0,0,$("#canvas").width(),$("#canvas").height());
}
Canvas.prototype.draw=function(){
	if(this.valid){
		this.clear();
		var ctx=this.ctx;
		var shapes=this.shapes;
		
		for(j=0;j<shapes.length;j++){
			shapes[j].draw(ctx);
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
			
			ctx.strokeRect(x1,y1,x2,y2);
			if(shape.shape!='line' && shape.shape!='general'){
				ctx.fillRect(shape.ex,shape.ey,-15,-15);
			}
			
			ctx.closePath();
			ctx.stroke();
		}
		this.valid=false;
	}
}