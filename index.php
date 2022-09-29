<?php 

require('connexion.php');

/* déclaration des variables php */

$name = $phone = $email = "";
$nameError = $phoneError = $emailError = $emailExiste = "";
$isSuccess = false;

/* contrôle des champs du formulaire */

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = verifyInput($_POST["name"]);
    $phone = verifyInput($_POST["phone"]);
    $email = verifyInput($_POST["email"]);
    $isSuccess = true;

    if(empty($name))
    {
        $nameError = "Veuillez saisir votre nom.";
        $isSuccess = false;
    }

    if(empty(!isPhone($phone)))
    {
        $phoneError = "Veuillez saisir un numéro de téléphone valide : 06 00 00 00 00";
        $isSuccess = false;
    }
    
    if(!isEmail($email))
    {
        $emailError = "Veuillez saisir un e-mail valide.";
        $isSuccess = false;
    }
 
    
    /* insert et select dans la base de donnée */

    if($isSuccess) 
    {
        $db = connect();
        
        $req = $db->prepare("SELECT COUNT(*) FROM personne WHERE email = :email");
        $req->execute(array('email' => $email));
        $results = $req->fetch();
        
        if($results[0] == 0)
        {
            $statement = $db->prepare("INSERT INTO personne (name, phone, email) values(?, ?, ?)");
            $statement->execute(array($name, $phone, $email));
            $db = disconnect();
        }
        else
        {
            $emailExiste = "Erreur : l'email a déjà été utilisé.";
            $isSuccess = false;
        }
        
        $db = disconnect();
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Exercice Stage</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js" integrity="sha512-DkPsH9LzNzZaZjCszwKrooKwgjArJDiEjA5tTgr3YX4E6TYv93ICS8T41yFHJnnSmGpnf0Mvb5NhScYbwvhn2w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="js/Winwheel.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        
        <section id="projet">
            <div class="container">
                <div class="row">
                    
                    <!-- création canvas -->
                    
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div id="canvas-container">
                            <canvas 
                                id="canvas" 
                                width="490" 
                                height="490" 
                                data-responsiveMinWidth="180" 
                                data-responsiveScaleHeight="true" 
                                data-responsiveMargin="50">
                            </canvas>

                            <!-- image pointeur -->
                            
                            <img id="prize-pointeur" src="image/fleche.PNG" alt="fleche">
                        </div>
                    </div>
                    
                    <!-- création zone de texte et formulaire -->
                    
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        
                        <!-- texte -->
                        
                        <p class="p1">SPIN TO WIN!</p>
                        <p class="p2">- Try your lucky to get discount coupon.<p>
                        <p class="p2">- 1 spin per email.<p>
                        <p class="p2">- No cheating.<p>
                        
                        
                        <!-- formulaire -->
                        
                        <form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                            
                            <!-- inputs -->
                            
                            <input type="text" id="name" name="name" class="form-control" placeholder="Please enter your name" value="<?php echo $name; ?>">
                            <p style="color:black; font-style:italic;"><?php echo $nameError; ?></p>

                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Please enter your phone number" value="<?php echo $phone; ?>">
                            <p style="color:black; font-style:italic;"><?php echo $phoneError; ?></p>

                            <input type="text" id="email" name="email" class="form-control" placeholder="Please enter your email" value="<?php echo $email; ?>">
                            <p style="color:black; font-style:italic;"><?php echo $emailError; ?></p>
                            <p style="color:black; font-style:italic;"><?php echo $emailExiste; ?></p>
                            
                            <!-- boutons -->
                            
                            <button type="submit" id="button" value="envoyer">TRY YOUR LUCKY</button>
                            
                            <input type="checkbox" id="agree" name="agree" class="agree"><label for="agree">&emsp;<span class="checkboxtext"><span style="color:white">I agree with the </span>term and condition</span></label>
                            
                        </form>
                        
                        <p class="p2">Never &emsp; Remind later &emsp; No thanks</p>
                        
                    </div>
                    
                    <!-- script js -->
                    
                    <script src="js/app.js"></script>
                    
                    <!-- bouton lancer la roue qui apparait seulement si le formulaire a été rempli avec succès -->
                    
                    <p style="display:<?php if($isSuccess) echo 'block'; else echo 'none';?>"><button onclick="theWheel.startAnimation();">Lancer la roue (1 essai)</button></p>

                </div>
            </div>   
        </section>
        
    </body>
</html>