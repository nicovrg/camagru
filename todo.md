# Stuff to do:
    ## Compulsory:
        mail:
        - new account validation
        - modif mdp
        - nouveau commentaire sur photo

        webcam:
        - add filters
        - save image



    ## Optionnal
        - remove comment
        - edit comment
        - deal with remove account / picture ?

# Questions:


## Today:
    move split split split to model

		<p> <?= split('-', split(' ', $comment->commentTime())[0])[2] ?> <?= split('-', split(' ', $comment->commentTime())[0])[1] ?> <?= split('-', split(' ', $comment->commentTime())[0])[0] ?> </p>


