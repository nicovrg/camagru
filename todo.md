## Today:

# Stuff to do:
    ## Compulsory:
        mail:
            - token system
                - password renew
                - new account validation
                - nouveau commentaire sur photo (add or remove feature of mail ...)
            - generate a random string => send mail with random => enter random validation

        webcam:
            - check mix canvas in php
            - upload images
            - add filters
            - add sidebar
            - shoot only available when filter add

        security:
            - check router and htmlspecialchar
            - <script type='text/javascript'>alert('THE GAME');</script>
            - Déconnectez vous. Une fois que vous avez la possibilité de vous authentifier, essayez de vous loguer avec comme mot de passe les informations contenues entre crochets ( donc... sans les crochets ) : [ blabla' OR 1='1 ] Si vous arrivez à vous authentifier, l'application n'est pas protégée contre les injections SQL. La question est comptée fausse et vous passez à la suivante..

        error:
            - fix bug with <script type='text/javascript'>alert('THE GAME');</script> in camera when you enter picture name

    ## Optionnal
            - remove comment
            - edit comment
            - remove account

# Questions:
        - pourquoi en js on peut pas faire string[2] = 'X' ? c'est bizarre de pas supporter ça
        - constructor de classe obligatoire?
        - destructor existe?
        - c'est quoi le délire des prototypes des objets (Child.create(parent))
        - wtf:
        // track = stream.getTracks();
        // track = stream.getTracks()[0];
