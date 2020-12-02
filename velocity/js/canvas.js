var canvas = {

    context: '',
    radius: 2,
    drawing: false,

    signature: function() {

        this.context = document.getElementById("canvas").getContext('2d');
        this.context.lineWidth = this.radius * 2;

    },

    putPoint: function(clientX, clientY) {
        this.context.lineTo(clientX, clientY);
        this.context.stroke();
        this.context.beginPath();
        this.context.arc(clientX, clientY, this.radius, 0, Math.PI * 2);
        this.context.fill();
        this.context.beginPath();
        this.context.moveTo(clientX, clientY);
    }
}

/*à l'appui sur le clic dans la zone du canvas, drawing devient true*/
$('#canvas').on('mousedown', function(e) {

    canvas.context.beginPath();
    canvas.drawing = true;

});

/*si drawing est true, on créer un point la où la souris passe*/
$('#canvas').on('mousemove', function(e) {

    if (canvas.drawing) {
        canvas.putPoint(e.offsetX, e.offsetY);
    }

});

/*au relachement du clic devient false*/
$('#canvas').on('mouseup', function() {
    
    canvas.drawing = false;

});

/* RESPONSIVE */
document.getElementById("canvas").addEventListener('touchstart', function(e) {
    e.preventDefault();
    var rect = canvas.getBoundingClientRect();
    var clientX = e.touches[0].clientX - rect.left;
    var clientY = e.touches[0].clientY - rect.top;
    canvas.putPoint(clientX, clientY);
}, {
    passive: true
});
document.getElementById("canvas").addEventListener('touchmove', function(e) {
    var rect = canvas.getBoundingClientRect();
    var clientX = e.touches[0].clientX - rect.left;
    var clientY = e.touches[0].clientY - rect.top;
    canvas.putPoint(clientX, clientY);
}, {
    passive: true
});
document.getElementById("canvas").addEventListener('touchend', function() {
    canvas.context.beginPath();
});