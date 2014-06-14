- Structure du projet - 

J'ai travaillé en MVC grâce au framework php (Yii-framework).

Pour éviter des répétitions de contenu, j'ai fait un layout 'themes/gluten//views/layoutsmain.php' qui contient le contenu qui se répète de page en page (il contient aussi tous les thèmes css, fonts, les images et le js),
tel que le header et le footer. Ensuite j'amène le contenu de chaque page grâce aux différentes vues qui se trouvent dans
'protected/views/site/*' 
La logique quant à elle se situe dans 'protected/controllers/*'.

Pour les informations se trouvant dans la base de données je passe par 'protected/models/', pour gérer mes accès à la base de données, l'ensemble des informations se trouvent dans 'protected/config/main.php'

Les autres dossiers et sous-dossiers qu'offrent Yii-Framework ne sont pas utilisés pour mon projet. Ils doivent tout de même rester présent car le framework devient instable si on les supprime, de plus si mon projet évolue, ils seront déjà présent c'est tout bénèf. :)
