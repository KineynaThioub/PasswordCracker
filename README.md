# Password Cracker Factory

Outil modulaire de cassage de mots de passe basé sur le **pattern de conception Fabrique**.  
Permet d'exécuter dynamiquement des attaques **brute force** ou **dictionnaire**, sur des cibles **locales** (Java) ou **en ligne** (formulaire PHP).

---

##  Objectifs pédagogiques

- Implémenter les patrons **Factory Method** et/ou **Abstract Factory**
- Comprendre deux grandes techniques d’attaque : **brute force** et **dictionnaire**
- Concevoir un système **modulaire, évolutif et maintenable**
- Distinguer une **attaque locale** d'une **attaque en ligne**
- Gérer des cibles d’authentification en **console Java** ou **via HTTP (formulaire PHP)**
- Présenter un projet technique de manière claire

---

## Exemples d’utilisation

Lancement depuis la ligne de commande :

```bash
java CrackerApp --type dictionnary --target local --login **admin**
ou aussi :
java CrackerApp --type brute --target online --login **root**
java CrackerApp --type brute --target local --login **user1**
java CrackerApp --type dictionnary --target online --login **admin**



###Justification du pattern Fabrique
Le pattern Fabrique est utilisé pour séparer la création des objets Attack de leur exécution.
Il permet :
d'éviter les if et switch dans tout le code
d'ajouter de nouvelles attaques/cibles sans modifier le cœur de l'application
de garantir une architecture ouverte à l’extension, fermée à la modification




###Structure du projet
CrackerApp.java → Point d’entrée (main)
AttackFactory.java → Fabrique qui choisit la bonne attaque
DictionnaryLocalAttack.java, BruteForceOnlineAttack.java, etc. → Stratégies d’attaque
LocalAuthenticator.java → Cible locale (Java)
login.php → Cible en ligne (PHP)
dico.txt → Fichier de mots de passe pour attaque dictionnaire


###Combinaisons supportées
Type d’attaque  	Cible
Dictionnaire	    Locale
Dictionnaire	    En ligne
Brute force	      Locale
Brute force	      En ligne




###Pistes d’amélioration
Support multithreadé (exécution parallèle)
Attaques hybrides (dictionnaire + permutations)
Interface graphique (JavaFX ou Swing)
Statistiques de performance
Chargement de configuration via JSON






