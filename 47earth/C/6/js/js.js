$(function(){
	var pen=new Pen();
	var canvas=$("#canvas")[0];
	var canvasstart=new Canvas(canvas,pen);
	
	$("#color div[color=black]").addClass('aaa');
	$("#line div[line=1]").addClass('aaa');
	$("#shape img[shape=general]").addClass('aaa');
	
	$("#color div").click(function(){
		$("#color div").removeClass('aaa');
		$(this).addClass('aaa');
		pen.color=$(this).attr('color');
	})
	$("#line div").click(function(){
		$("#line div").removeClass('aaa');
		$(this).addClass('aaa');
		pen.line=$(this).attr('line');
	})
	$("#shape img").click(function(){
		$("#shape img").removeClass('aaa');
		$(this).addClass('aaa');
		if($(this).attr('type')=="shape"){
			pen.type=$(this).attr('type');
			pen.shape=$(this).attr('shape');
			pen.ill=='';
		}if($(this).attr('type')=="ill"){
			pen.type=$(this).attr('type');
			pen.shape='';
			pen.ill=$(this).attr('shape');
		}
	})
	
	$("#save1").click(function(){
		var d=$("#download")[0];
		d.href=$(canvas)[0].toDataURL();
		d.download="img.png";
		d.click();
	})
	$("#save2").click(function(){
		var data={
			width:canvasstart.width,
			height:canvasstart.height,
			shapes:canvasstart.shapes
		}
		var blob=new Blob([JSON.stringify(data,null,2)]);
		var d=$("#download")[0];
		d.hewf=URL.createObjectURL(blob);
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
			
			canvasstart.width=text.width;
			canvasstart.height=text.height;
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
									text.shapes[i].ex,
									text.shapes[i].ey,
									text.shapes[i].r
									)
				canvasstart.shapes[i]=shape;
				if(i == text.shapes.length-1){
					canvasstart.valid=true;
					canvasstart.draw();
				}
			}
		};
	})
	$("#again").click(function(){//重播
		var j ='0'; 
		setInterval(function(){
			canvasstart.notdrow=false;
			if(j != canvasstart.imahedata.length){
				canvasstart.ctx.putImageData(canvasstart.imahedata[j],0,0);
				j++;
			}else{
				clearTimeout(i); 
				canvasstart.notdrow=true;
				return false;
			}
		},30)
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
	if(this.type=="shape"){
		ctx.lineWidth=this.line;
		ctx.strokeStyle=this.color;
		ctx.beginPath();
		
		switch(this.shape){
			case"general":
				ctx.moveTo(this.x,this.y);
				for(j=0;j<this.points.length;j++){
					ctx.lineTo(this.points[j].x,this.points[j].y);
					ctx.moveTo(this.points[j].x,this.points[j].y);
				}
				break;
			case"line":
				ctx.moveTo(this.x,this.y);
				ctx.lineTo(this.xx,this.yy);
				break;
			case"arc":
				ctx.arc(this.x,this.y,this.r,0,2*Math.PI,true);
				break;
			case"three":
				var a=2*Math.PI/3;
				var r=Math.PI/6;
				for(j=0;j<=3;j++){
					x=this.x+Math.cos(j*a+r)*this.r;
					var y=this.y+Math.sin(j*a+r)*this.r;
					ctx.lineTo(x,y);
					ctx.moveTo(x,y);
				}
				break;
			case"four":
				var a=2*Math.PI/4;
				var r=Math.PI/4;
				for(j=0;j<=4;j++){
					x=this.x+Math.cos(j*a+r)*this.r;
					var y=this.y+Math.sin(j*a+r)*this.r;
					ctx.lineTo(x,y);
					ctx.moveTo(x,y);
				}
				break;
			case"six":
				var a=2*Math.PI/6;
				var r=Math.PI/2;
				for(j=0;j<=6;j++){
					x=this.x+Math.cos(j*a+r)*this.r;
					var y=this.y+Math.sin(j*a+r)*this.r;
					ctx.lineTo(x,y);
					ctx.moveTo(x,y);
				}
				break;
			case"star":
				var x=this.x;
				var y=this.y;
				var d=-90;
				var dd=-54;
				for(j=0;j<6;j++){
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
	}if(this.type=="ill"){
		ctx.drawImage($("img[shape="+this.ill+"]")[0],this.sx,this.sy,this.ex-this.sx,this.ey-this.sy);
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
	this.mousex='';
	this.mousey='';
	this.select='';
	
	this.imahedata=[];
	this.shapes=[];
	
	this.mousedown=false;
	this.mousemove=false;
	this.mousezoom=false;
	this.valid=true;
	this.notdrow=true;
	
	if(this.notdrow){
		var tcanvas=this;
		$(canvas).mousedown(function(e){
			var mouse=tcanvas.getmouse(e);
			
			if(tcanvas.pen.type=="shape" && tcanvas.pen.shape=="no"){
				for(i=tcanvas.shapes.length-1;i>=0;i--){
					shape=tcanvas.shapes[i];
					if(mouse.x>=shape.sx && mouse.y>=shape.sy && mouse.x<=shape.ex & mouse.y<=shape.ey){
						tcanvas.select=shape;
						tcanvas.mousex=mouse.x;
						tcanvas.mousey=mouse.y;
						tcanvas.mousezoom=false;
						tcanvas.mousedown=tcanvas.mousemove=tcanvas.valid=true;
						if(shape.shape!='line' && shape.shape!='general'){
							if(mouse.x>=(shape.ex-15) && mouse.y>=(shape.ey-15) && mouse.x<=shape.ex && mouse.x<=shape.ex){
								tcanvas.mousezoom=true;
							}
						}
						
						return;
					}
				}
			}if(tcanvas.pen.type=="shape" && tcanvas.pen.shape!="no"){
				var shape=new Shape();
				
				shape.color=tcanvas.pen.color;
				shape.line=tcanvas.pen.line;
				shape.type=tcanvas.pen.type;
				shape.shape=tcanvas.pen.shape;
				
				shape.x=mouse.x;
				shape.y=mouse.y;
				if(tcanvas.pen.shape=="general"){
					shape.sx=mouse.x;
					shape.sy=mouse.y;
					shape.points.push(mouse);
				}if(tcanvas.pen.shape=="line"){
					shape.xx=mouse.x;
					shape.yy=mouse.y;
				}
				
				tcanvas.select=shape;
				tcanvas.addshape(shape);
				tcanvas.mousemove=tcanvas.mousezoom=false;
				tcanvas.mousedown=tcanvas.valid=true;
				return;
			}if(tcanvas.pen.type=="ill"){
				var shape=new Shape();
				
				shape.type=tcanvas.pen.type;
				shape.ill=tcanvas.pen.ill;
				
				shape.sx=shape.x=mouse.x;
				shape.sy=shape.y=mouse.y;
				shape.ex=shape.sx+$("img[shape="+tcanvas.pen.ill+"]").width();
				shape.ey=shape.sy+$("img[shape="+tcanvas.pen.ill+"]").height();
				
				tcanvas.select=shape;
				tcanvas.addshape(shape);
				tcanvas.mousemove=tcanvas.mousezoom=false;
				tcanvas.mousedown=tcanvas.valid=true;
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
						if(mouse.x>=(shape.sx+20) && mouse.y>=(shape.sy+20)){
							shape.r=shape.r+x;
							shape.sx=shape.sx-x;
							shape.sy=shape.sy-x;
							shape.ex=shape.ex+x;
							shape.ey=shape.ey+x;
						}
					}else{
						shape.x=shape.x+x;
						shape.y=shape.y+y;
						if(shape.shape=='line'){
							shape.xx=shape.xx+x;
							shape.yy=shape.yy+y;
						}if(shape.shape=='general'){
							for(i=0;i<=shape.points.length-1;i++){
								shape.points[i].x=shape.points[i].x+x;
								shape.points[i].y=shape.points[i].y+y;
							}
						}
						shape.sx=shape.sx+x;
						shape.sy=shape.sy+y;
						shape.ex=shape.ex+x;
						shape.ey=shape.ey+y;
					}
					
				}if(tcanvas.pen.type=="shape" && tcanvas.pen.shape!="no"){
					if(tcanvas.pen.shape=="arc" || tcanvas.pen.shape=="three" || tcanvas.pen.shape=="four" || tcanvas.pen.shape=="six" || tcanvas.pen.shape=="star" ){
						shape.r=Math.pow((shape.x-mouse.x)*(shape.x-mouse.x)+(shape.y-mouse.y)*(shape.y-mouse.y),0.5);
					}
					if(tcanvas.pen.shape=="general"){
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
					if(tcanvas.pen.shape=="line"){
						shape.xx=mouse.x;
						shape.yy=mouse.y;
					}
				}if(tcanvas.pen.type=="ill"){
					shape.x=shape.sx=mouse.x;
					shape.y=shape.sy=mouse.y;
					shape.ex=shape.sx+$("img[shape="+tcanvas.pen.ill+"]").width();
					shape.ey=shape.sy+$("img[shape="+tcanvas.pen.ill+"]").height();
				}
				tcanvas.valid=true;
			}
		}).mouseup(function(e){
			var shape=tcanvas.select;
			if(tcanvas.pen.shape=="arc" || tcanvas.pen.shape=="three" || tcanvas.pen.shape=="four" || tcanvas.pen.shape=="six" || tcanvas.pen.shape=="star" ){
				shape.sx=shape.x-shape.r;
				shape.sy=shape.y-shape.r;
				shape.ex=shape.x+shape.r;
				shape.ey=shape.y+shape.r;
			}
			if(tcanvas.pen.shape=="line"){
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
				}if(x1>x2){
					shape.sx=x2;
					shape.ex=x1;
				}if(y1>y2){
					shape.sy=y2;
					shape.ey=y1;
				}
			}
			tcanvas.select='';
			tcanvas.mousemove=tcanvas.valid=tcanvas.mousedown=tcanvas.mousezoom=false;
		})
	}
	setInterval(function(){
		tcanvas.draw();
	},30)
}
Canvas.prototype.getmouse=function(e){
	var x=e.pageX-$(".body").position().left-200-3;
	var y=e.pageY-$(".body").position().top-100-3;
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
	ctx.lineCap="round";
	ctx.fillStyle="white";
	ctx.fillRect(0,0,$("#canvas").width(),$("#canvas").height());
}
Canvas.prototype.draw=function(){
	if(this.valid){
		this.clear();
		var ctx=this.ctx;
		var shapes=this.shapes;
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
			ctx.strokeRect(x1,y1,x2,y2);
			if(shape.shape!='line' && shape.shape!='general'){
				ctx.fillRect(shape.ex,shape.ey,-15,-15);
			}
			
			ctx.closePath();
			ctx.stroke();
		}
		image=ctx.getImageData(0,0,this.width,this.height);
        this.imahedata.push(image);
		
		this.valid=false;
	}
}