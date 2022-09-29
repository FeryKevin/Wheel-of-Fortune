/* création de la roue */

let theWheel = new Winwheel({

    'canvasId'              : 'canvas', //id
    'numSegments'           : 12, //num part canvas
    'textAlignment'         : 'outer', // police à l'extérieur
    'lineWidth'             : 10, //largeur ligne
    'responsive'            : true, // responsive
    'textFontSize'          : 18, //taille police d'ecriture
    'pointerAngle'          : 90, // pointeur degré
    'segments'              : // création partie du canvas + couleurs segments et polices
    [
        {'fillStyle'        : '#e57373', 'text' : '$20', 'textFillStyle' : '#fff','strokeStyle' : '#fff'},
        {'fillStyle'        : '#ffcdd2', 'text' : 'Not Lucky', 'textFillStyle' : '#fff','strokeStyle' : '#fff'},
        {'fillStyle'        : '#e57373', 'text' : '$10' , 'textFillStyle' : '#fff','strokeStyle' : '#fff'},
        {'fillStyle'        : '#ffcdd2', 'text' : 'Not Lucky' , 'textFillStyle' : '#fff','strokeStyle' : '#fff'},
        {'fillStyle'        : '#e57373', 'text' : '10% OFF' , 'textFillStyle' : '#fff','strokeStyle' : '#fff'},
        {'fillStyle'        : '#ffcdd2', 'text' : 'Not Lucky' , 'textFillStyle' : '#fff','strokeStyle' : '#fff'},
        {'fillStyle'        : '#e57373', 'text' : '20% OFF' , 'textFillStyle' : '#fff', 'strokeStyle' : '#fff'},
        {'fillStyle'        : '#ffcdd2', 'text' : 'Not Lucky' , 'textFillStyle' : '#fff', 'strokeStyle' : '#fff'},
        {'fillStyle'        : '#e57373', 'text' : '30% OFF' , 'textFillStyle' : '#fff', 'strokeStyle' : '#fff'},
        {'fillStyle'        : '#ffcdd2', 'text' : 'Not Lucky' , 'textFillStyle' : '#fff', 'strokeStyle' : '#fff'},
        {'fillStyle'        : '#e57373', 'text' : '$30' , 'textFillStyle' : '#fff','strokeStyle' : '#fff'},
        {'fillStyle'        : '#ffcdd2', 'text' : 'Not Lucky' , 'textFillStyle' : '#fff', 'strokeStyle' : '#fff'},
    ],

    'innerRadius'           : 65, // cercle
    'rotationAngle'         : -14, // rotation de la roue

    /* petit rond noir */

    'pins'                  :
    {
        'fillStyle'         : 'black', // couleur du pins
        'outerRadius'       : 4, // taille du pins
        'margin'            : -4, // placer les pins
        'responsive'        : true, // responsive
        'number'            : 12 // nombre de pins
    },

    /* tourner la roue */

    'animation'      :
    {
        'type'              : 'spinToStop', //type d'animation
        'duration'          : 10, // durée de l'animation
        'spins'             : 6, // nombre de rotation
        'callbackSound'     : playSound, // son
        'callbackFinished'  : alertPrize // pop up
    }

});


/* fonction audio */

let audio = new Audio('audio/tick.mp3');  // Create audio object and load desired file.

function playSound()
{
    // stop and rembobiner the sound
    audio.pause();
    audio.currentTime = 0;

    // play audio
    audio.play();
}

/* fonction alerte / pop up pour résultat */

function alertPrize()
{
    let winningSegment = theWheel.getIndicatedSegment();
    
    alert("Votre prix est : " + winningSegment.text + ".");
}