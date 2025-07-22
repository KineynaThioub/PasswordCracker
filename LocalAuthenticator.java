// public class LocalAuthenticator {
//     public static void main(String[] args) {
//         if (args.length != 2) {
//             System.out.println("Usage: java LocalAuthenticator <login> <password>");
//             return;
//         }

//         String login = args[0];
//         String password = args[1];

//         LocalCible cible = new LocalCible();
//         if (cible.connexion(login, password)) {
//             System.out.println("Connexion réussie");
//         } else {
//             System.out.println("Échec de la connexion");
//         }
//     }
// }

public class LocalAuthenticator {

    // Login et mot de passe corrects définis en dur.
    // Dans un vrai système, ceux-ci ne seraient jamais en dur et seraient hachés.
    private static final String CORRECT_USERNAME = "admin";
    private static final String CORRECT_PASSWORD = "a"; // C'est le mot de passe que votre cracker local devra trouver

    /**
     * Point d'entrée du programme LocalAuthenticator.
     * Attend le nom d'utilisateur et le mot de passe comme arguments de ligne de commande.
     * Exemple d'utilisation: java LocalAuthenticator admin passer1234
     *
     * @param args Les arguments de la ligne de commande. Doit contenir le nom d'utilisateur et le mot de passe.
     */
    public static void main(String[] args) {
        // Vérifier le nombre d'arguments
        if (args.length != 2) {
            System.out.println("Échec de l'authentification.");
            System.out.println("Utilisation : java LocalAuthentification <username> <password>");
            // Quitter avec un code d'erreur si les arguments sont incorrects
            System.exit(1);
        }

        String Username = args[0];
        String Password = args[1];

        if (authenticate(Username, Password)) {
            System.out.println("Connexion reussie.");
            // Quitter avec un code de succès (0)
            System.exit(0);
        } else {
            System.out.println("Erreur.");
            // Quitter avec un code d'échec (1)
            System.exit(1);
        }
    }

    /**
     * Simule le processus d'authentification.
     *
     * @param username Le nom d'utilisateur fourni.
     * @param password Le mot de passe fourni.
     * @return true si l'authentification est réussie, false sinon.
     */
    public static boolean authenticate(String username, String password) {
        // Simple comparaison de chaînes de caractères
        return CORRECT_USERNAME.equals(username) && CORRECT_PASSWORD.equals(password);
    }
}