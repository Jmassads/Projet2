# Projet 2 OpenClassroms
## Créer un thème WordPress - Strasbourg Office de Tourisme

### Projet Validé :white_check_mark:
https://juliaassad.fr/projet2/

Vous avez un client : l'office du tourisme de la ville de Strasbourg ! Ils souhaitent un site web à l'image de la ville 
pour attirer des touristes et informer sur les activités proposées.

### Voici les fonctionnalités attendues de la toute première version du site :

* Le site possèdera une page d’accueil, essentiellement graphique, avec un peu de texte, qui souhaite la bienvenue au 
  visiteur et lui indique ce que l’on peut trouver sur le site. Des liens sont prévus pour accéder aux autres pages dans 
  le corps de l’accueil. Un encart affichera un aperçu de la dernière actualité postée par la ville.
* Un menu de navigation en haut de la page doit suivre le visiteur lorsqu’on va plus bas dans la page. 
  Ce menu doit contenir les éléments suivants dans l’ordre : Accueil (avec une icône de maison à gauche du texte),  
  Actualités, Plus d’infos, Activités du mois, Contact
* Un Champ de recherche doit aussi être présent pour faciliter l’accès au contenu. Il n'est pas nécessaire que celui-ci 
  fonctionne pour cet exercice.
* Les pages doivent être conçues en responsive, de telle sorte à ce que le site s’affiche correctement sur toutes les 
  résolutions. La navigation sur mobile et tablettes doit être naturelle et ne doit pas nécessiter de zoomer.
* Le client veut valider l'intérêt des animations en pur CSS 3, vous devez donc en proposer une sur l'une des pages.

### Voici les différentes pages que doit proposer le site:

* La page « Actualités » affiche la liste des billets d’actualité. Les billets ne seront pas signés par un auteur : 
  ils seront tous postés au nom de la ville.
* La page « Plus d’infos »  présente différents types d’activités sportives et culturelles organisées 
  (musée de la ville, marathon… affichez-en au départ au moins 6 différentes). L'administrateur du site doit pouvoir indiquer 
  le nom de l’activité, une description et une image.
* La page « Activités du mois » liste au moins 10 activités à venir dans le mois sous forme de tableau 
  (avec date, titre et court descriptif). Les lignes doivent se colorer au survol de la souris pour qu’on puisse se repérer. 
  Un bouton « Inscription » à droite de chaque ligne du tableau ouvre un formulaire permettant de saisir son nom.  L'envoi 
  du formulaire n'a pas d'effet pour cet exercice.
* La page « Contact » affiche un formulaire de contact structuré avec les champs « Titre du message », « Votre nom », 
« Votre date de naissance », « Votre e-mail », une case à cocher « Résident de la ville », un menu déroulant « Nationalité « 
  et un champ « Message » où on peut rédiger son message. Un petit texte d’aide s’affiche sous le champ date de naissance 
  pour dire que le format JJ/MM/AAAA est attendu.

Le site doit avoir été optimisé pour le référencement naturel et doit suivre les bonnes pratiques d'accessibilité 
(WCAG 2.0 niveau A).

**Définir la structure de navigation du site**

* Le menu est présent et conforme à la demande
* L'ensemble des pages demandées - et leur contenu - est présent
* Les liens de navigation proposés sont pertinents
* Il est possible de revenir à la page d'accueil en cliquant sur le logo

**Assurer l'accessibilité du site aux différents types d'utilisateurs**

* Le code que vous avez écrit respecte les normes w3c HTML et CSS
* Le contenu que vous avez créé respecte la norme WCAG 2.0, selon l'outil de validation AChecker   

**Assurer la cohérence graphique du site**

* Les différentes pages du site sont cohérentes visuellement
* Des classes CSS pertinentes sont définies et utilisées
* Les fichiers du thème de base ne sont pas altérés
* Aucun builder de thème n'est utilisé

**Adapter l'affichage en fonction de la taille de l'écran**

* Le viewport est configuré dans l'en-tête de la page HTML
* (Au moins) Un breakpoint pertinent est défini
* Une grille (avec ou sans Framework de type Bootstrap) et/ou des Media Queries sont utilisés 
* Le contenu s'affiche sur une seule colonne en mobilité et occupe intelligemment l'espace sur un grand écran
* Les marges/padding sont adaptés

**Appliquer les principes de SEO dans le code HTML**

* Un plugin de référencement (type Yoast SEO) est installé dans Wordpress
* Le plugin valide un bon niveau de référencement
* Un sitemap est présent

**Créer une animation avec CSS3**

* L'animation est définie exclusivement à l'aide de CSS 3
* L'animation fonctionne même si JavaScript est désactivé
