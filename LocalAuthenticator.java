public class LocalAuthenticator {
    public static void main(String[] args) {
        if (args.length != 2) {
            System.out.println("Usage: java LocalAuthenticator <login> <password>");
            return;
        }

        String login = args[0];
        String password = args[1];

        LocalCible cible = new LocalCible();
        if (cible.connexion(login, password)) {
            System.out.println("Connexion réussie");
        } else {
            System.out.println("Échec de la connexion");
        }
    }
}