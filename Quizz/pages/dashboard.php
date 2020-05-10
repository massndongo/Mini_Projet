<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Rendu visuel</h2>
    <div class="canvas1">
        <h4>Representation graphique des utilisateurs</h4>
        <canvas id="canvas1"></canvas>
    </div>
    <div class="canvas2">
        <h4>Representation graphique des types de réponses</h4>
    </div>
    <script>
        function pie(ctx,w,h,datalist) {
            var radius = (h/2)-5;
            var centerx = w/2;
            var centery = h/2;
            var total = 0;
            for(x=0; x<datalist.length; x++){
                total += datalist[x];
            };
            var lastend = 0;
            var offset = Math.PI/2;
            for(x=0; x<datalist.length; x++){
                var thispart = datalist[x];
                ctx.beginPath();
                ctx.fillStyle = colist[x];
                ctx.moveTo(centerx, centery);
                var arcsector = Math.PI*(2*thispart/total);
                ctx.arc(centerx, centery, radius, lastend-offset, lastend+arcsector-offset, false);
                ctx.lineTo(centerx, centery);
                ctx.fill();
                ctx.closePath();
                lastend += arcsector;
            };
        }
        var datalist = new Array(80,20);
        var colist = new Array('blue','red');
        var canvas = document.getElementById("canvas1");
        var ctx = canvas.getContext('2d');
        pie(ctx, 350, 150, datalist);
    </script>
</body>
</html>