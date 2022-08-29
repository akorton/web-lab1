const canvas = document.getElementById("canvas");
const ctx = canvas.getContext('2d');
const width = canvas.clientWidth;
const height = canvas.clientHeight;
canvas.width = width;
canvas.height = height;
const maxCoord = 4;
const offsetX = 50;
const offsetY = 30;
const steps = {'x': (width - offsetX) / (2*maxCoord), 'y': (height - offsetY) / (2*maxCoord)};
const origin = {'x': offsetX / 2 + maxCoord * steps['x'], 'y': offsetY / 2 + maxCoord * steps['y']};
const radiusButtons = document.getElementsByName('radius');
const yButton = document.getElementById('y');

let setUp = ()=>{
    ctx.moveTo(origin.x - steps.x * 4, origin.y);
    ctx.lineTo(origin.x + steps.x * 4, origin.y);
    ctx.moveTo(origin.x, origin.y - steps.y * 4);
    ctx.lineTo(origin.x, origin.y + steps.y * 4);
    ctx.stroke();
};

let draw = (r)=>{
    ctx.clearRect(0, 0, width, height);
    setUp();
    ctx.fillStyle = '#0000FF';
    drawRect(r);
    drawTriangle(r);
    drawQuaterCircle(r);
    ctx.beginPath();
};
let drawRect = (r)=>{
    ctx.fillRect(origin.x - r * steps.x / 2, origin.y, r*steps.x / 2, r*steps.y);
}
let drawTriangle = (r)=>{
    ctx.beginPath();
    ctx.moveTo(origin.x, origin.y);
    ctx.lineTo(origin.x, origin.y - r * steps.y / 2);
    ctx.lineTo(origin.x + r * steps.x, origin.y);
    ctx.closePath();
    ctx.fill();
}

let drawQuaterCircle = (r)=>{
    ctx.beginPath();
    ctx.moveTo(origin.x, origin.y);
    ctx.arc(origin.x, origin.y, r*steps.x, Math.PI, Math.PI * 3 / 2);
    ctx.fill();
}

setUp();
radiusButtons.forEach((btn)=>{
    btn.addEventListener('click', (e)=>(draw(btn.value)));
});

yButton.addEventListener('input', (e)=>{
    let integerValue = +yButton.value;
    if (Number.isNaN(integerValue) && yButton.value != '-'){
        yButton.value = yButton.value.substring(0, yButton.value.length - 1);
    }
    else if (integerValue > 3 || integerValue < -3){
        yButton.value = yButton.value.substring(0, yButton.value.length - 1);
    }
});
