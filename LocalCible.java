import java.io.BufferedReader;
import java.io.InputStreamReader;

public class LocalCible implements cibleFactory {

    // private final String loginValide = "admin";
    // private final String passwordValide = "bc";

    // @Override
    // public boolean connexion(String login, String password) {
    //     return loginValide.equals(login) && passwordValide.equals(password);
    // }
    public boolean connexion(String login, String password) {
        try {
            // Lancer LocalAuthenticator avec login et password en arguments
            ProcessBuilder pb = new ProcessBuilder("java", "-cp", ".", "LocalAuthenticator", login, password);
            pb.redirectErrorStream(true);
            Process process = pb.start();

            BufferedReader reader = new BufferedReader(
                new InputStreamReader(process.getInputStream())
            );

            String line;
            boolean success = false;

            while ((line = reader.readLine()) != null) {
                System.out.println("[AUTH] " + line); // Pour debug
                if (line.toLowerCase().contains("connexion reussie")) {
                    success = true;
                    break;
                }
            }

            process.waitFor();
            return success;

        } catch (Exception e) {
            System.err.println("Erreur lors de l'exécution de LocalAuthenticator : " + e.getMessage());
            return false;
        }
    }
}
