# 🔐 Password Cracker Factory

Un mini-projet Java qui simule une **attaque de mots de passe** à l'aide de deux stratégies : 
- Brute Force 
- Dictionnaire. 

L'application cible peut être : 
- Un système **local**
- Un formulaire en ligne (**PHP**)

---

## ⚙️ Fonctionnement

L’utilisateur lance l’application `CrackerApp` avec des arguments de ligne de commande pour spécifier :
- La **stratégie d’attaque**
- Le **type de cible**
- Le **login à attaquer**

### Commande

```bash
java CrackerApp --type brute_force --target local --login admin
```

---

## 📂 Architecture du projet

```
PasswordCracker/
├── CrackerApp.java
├── BruteForceStrategie.java
├── DictionnaireStrategie.java
├── LocalCible.java
├── LigneCible.java
├── LocalAuthenticator.java
├── cibleFactory.java
├── StrategieFactory.java
├── LigneBruteCracker.java
├── LigneDictCracker.java
├── LocalBruteCracker.java
├── LocalDictCracker.java
├── login.php
├── logout.php
├── dashboard.php
└── README.md
```

---

## 🔧 Arguments disponibles

| Argument        | Description                                           | Exemple             |
|-----------------|-------------------------------------------------------|---------------------|
| `--type`        | Type d’attaque (`brute_force` ou `dictionnaire`)      | `--type brute_force`|
| `--target`      | Cible (`local` ou `online`)                           | `--target local`    |
| `--login`       | Identifiant à attaquer                                | `--login admin`     |

---

## 📌 Extrait de résultat attendu

![sortie](captures/essai.png)

---

## 🧱 Principes de conception

### Diagramme De Classe
![Diagramme UML](captures/image.png)

### 🧪 Design Pattern : Fabrique

Utilisé pour générer dynamiquement la stratégie et la cible selon les arguments.

### 🔄 Stratégies interchangeables

Les stratégies d’attaque implémentent l’interface `StrategieFactory` pour faciliter l’extension.

### Cibles modulables

Le projet peut facilement être étendu pour d'autres types de cibles (API, fichier, base de données...).

---


## À faire / Extensions possibles

- Ajouter une interface graphique
- Enregistrer les essais et le temps d'exécution
- Hacher les mots de passe dans `LocalAuthenticator`
- Ajouter des tests unitaires
- Implémenter des logs au format fichier

---

## Auteurs

Projet réalisé par **Fatou Kiné THIOUB**,**Cheikh Ibrahima NDIAYE**, **Coummba FALL**, **Mammadou Makhtar GUEYE**, et **Abdoul Aziz KANE** étudiant en **DIC1** à l’**École Supérieure Polytechnique (ESP)** de l’**UCAD**.

Dans le cadre du module **Patrons de conception**.

---

## 📄 Licence

Ce projet est réalisé **à but pédagogique** et n'est pas destiné à une utilisation malveillante.