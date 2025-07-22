// CrackerApp.java
public class CrackerApp {
    public static void main(String[] args) {
        String type = "brute_force";
        String target = "local";
        String login = "admin";

        // Analyse des arguments
        for (int i = 0; i < args.length; i++) {
            if ("--type".equals(args[i]) && i + 1 < args.length) {
                type = args[i + 1].toLowerCase();
            } else if ("--target".equals(args[i]) && i + 1 < args.length) {
                target = args[i + 1].toLowerCase();
            } else if ("--login".equals(args[i]) && i + 1 < args.length) {
                login = args[i + 1];
            }
        }

        // Création de la cible via fabrique implicite
        cibleFactory cible;
        if ("online".equals(target) || "en_ligne".equals(target)) {
            cible = new LigneCible();
        } else {
            cible = new LocalCible(); //
        }

        StrategieFactory strategie;
        if ("dictionnaire".equals(type) || "dictionary".equals(type)) {
            strategie = new DictionnaireStrategie("rockyou.txt");
        } else {
            strategie = new BruteForceStrategie();
        }

        System.out.println("Démarrage de l'attaque...");
        System.out.println("Type : " + type);
        System.out.println("Cible : " + target);
        System.out.println("Login : " + login);
        System.out.println("----------------------------------------");

        strategie.attaque(login, cible);
    }
}