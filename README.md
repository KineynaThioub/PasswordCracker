# 🏭 Password Cracker Factory

Ce projet Java implémente une fabrique de stratégies pour casser des mots de passe, avec deux types de cibles (locale ou web).

## 🚀 Fonctionnalités

- Connexion locale via exécutable Java (`LocalAuthenticator`)
- Connexion à distance via formulaire PHP
- Deux stratégies de cassage :
  - 🔨 Brute Force
  - 📘 Dictionnaire

## 🛠️ Architecture

```java
public interface cibleFactory {
    boolean connexion(String login, String password);
}
